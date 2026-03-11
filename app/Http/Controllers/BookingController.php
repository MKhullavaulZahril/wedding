<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class BookingController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Tampilkan halaman checkout.
     */
    public function checkout($venue_id = null)
    {
        // Jika ada venue_id, ambil dari Firebase
        if ($venue_id) {
            $venue = $this->firebase->getData("venues/$venue_id");
            if ($venue) {
                $venue = (object) $venue;
                $booking = [
                    'item_name' => $venue->name,
                    'owner' => is_array($venue->owner) ? ($venue->owner['name'] ?? 'Unknown') : ($venue->owner ?? 'Unknown'),
                    'location' => $venue->location,
                    'price_per_night' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
                    'image' => asset($venue->image ?? ''),
                    'details' => [
                        'check_in' => request('date_start', '2026-03-07'),
                        'check_out' => request('date_end', '2026-03-13'),
                        'guests' => 2,
                        'nights' => 6,
                    ],
                    'summary' => [
                        'Sewa' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
                        'Biaya Layanan' => 'IDR 50.000',
                        'Pajak (11%)' => 'IDR ' . number_format((float)($venue->price ?? 0) * 0.11, 0, ',', '.'),
                        'Total' => 'IDR ' . number_format((float)($venue->price ?? 0) * 1.11 + 50000, 0, ',', '.')
                    ],
                    'gallery' => $venue->gallery ?? []
                ];
                return view('checkout', compact('booking'));
            }
        }

        // Mock data fallback jika tidak ada venue_id atau venue tidak ditemukan
        $booking = [
            'item_name' => 'Royal Wedding Hall',
            'owner' => 'Bapak Shrikanth',
            'location' => '116, Townhall Resort 15, Rustom. Kepulauan Kyd',
            'price_per_night' => 'IDR 3.333',
            'image' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=800&q=80',
            'details' => [
                'check_in' => request('date_start', '2026-03-07'),
                'check_out' => request('date_end', '2026-03-13'),
                'guests' => 2,
                'nights' => 6,
            ],
            'summary' => [
                'Sewa per malam' => 'IDR 3.333',
                'Sewa * 6 malam' => 'IDR 19.998',
                'Biaya Layanan' => 'IDR 500',
                'Biaya Kebersihan' => 'IDR 200',
                'Pajak (11%)' => 'IDR 2.277',
                'Diskon Promo' => '- IDR 1.000',
                'Total' => 'IDR 21.975'
            ],
            'gallery' => [
                'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=800&q=80'
            ]
        ];

        return view('checkout', compact('booking'));
    }

    /**
     * Tampilkan riwayat pemesanan pengguna dari Firebase.
     */
    public function orders()
    {
        // Ambil data bookings dari Firebase
        $userId = auth()->id();
        $allBookings = $this->firebase->getData('bookings');
        
        $myBookings = collect($allBookings ?? [])
            ->filter(function($booking) use ($userId) {
                return isset($booking['user_id']) && (string)$booking['user_id'] === (string)$userId;
            })
            ->sortByDesc('created_at');

        $orders = [];
        foreach ($myBookings as $id => $booking) {
            $booking = (object) $booking;
            // Map status classes
            $statusClass = 'status-warning';
            if ($booking->status === 'Selesai') $statusClass = 'status-success';
            if ($booking->status === 'Dibatalkan') $statusClass = 'status-danger';

            $orders[] = [
                'id' => $booking->id ?? $id,
                'venue_name' => $booking->item_name ?? 'Item #' . ($booking->item_id ?? ''),
                'venue_id' => $booking->item_id ?? null,
                'location' => $booking->location ?? '-',
                'date' => date('d M Y', strtotime($booking->created_at ?? 'now')),
                'total_price' => 'IDR ' . number_format((float)($booking->total_price ?? 0), 0, ',', '.'),
                'status' => $booking->status ?? 'Diproses',
                'status_class' => $statusClass,
                'image' => asset($booking->image ?? '')
            ];
        }

        // Demo data if empty
        if (empty($orders)) {
            // Ambil 3 venue pertama dari Firebase untuk demo
            $venues = collect($this->firebase->getData('venues') ?? [])->take(3);
            
            $statuses = [
                ['text' => 'Selesai', 'class' => 'status-success'],
                ['text' => 'Diproses', 'class' => 'status-warning'],
                ['text' => 'Menunggu Pembayaran', 'class' => 'status-danger'],
            ];

            foreach ($venues->values() as $index => $venue) {
                $venue = (object) $venue;
                $orders[] = [
                    'id' => 'ORD-00' . ($index + 1),
                    'venue_name' => $venue->name,
                    'venue_id' => $venue->id,
                    'location' => $venue->location,
                    'date' => (24 + $index) . ' Feb 2026',
                    'total_price' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
                    'status' => $statuses[$index]['text'],
                    'status_class' => $statuses[$index]['class'],
                    'image' => asset($venue->image ?? '')
                ];
            }
        }

        return view('orders', compact('orders'));
    }

    /**
     * Proses pembayaran (Simpan ke Firebase).
     */
    public function pay(Request $request)
    {
        $userId = auth()->id();
        $bookingData = $request->all();
        
        // Simpan ke Firebase Realtime Database
        try {
            $this->firebase->pushData('bookings', [
                'user_id' => $userId,
                'item_id' => $request->item_id,
                'status' => 'Selesai',
                'created_at' => now()->toDateTimeString(),
                'item_name' => $request->item_name ?? 'Wedding Service',
                'image' => $request->image ?? '',
                'location' => $request->location ?? '',
                'total_price' => $request->total_price ?? 0,
                'payment_method' => $request->payment_method ?? 'Card',
            ]);

            return redirect()->route('orders')->with('success', 'Pembayaran Berhasil! Pesanan Anda telah tersimpan di Cloud.');
        } catch (\Exception $e) {
            \Log::error('Booking Firebase Error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan saat menyimpan pesanan.');
        }
    }
}
