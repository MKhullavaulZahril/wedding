<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Venue;

class BookingController extends Controller
{
    /**
     * Tampilkan halaman checkout.
     */
    public function checkout($venue_id = null)
    {
        // Jika ada venue_id, ambil dari MySQL
        if ($venue_id) {
            $venue = Venue::find($venue_id);
            if ($venue) {
                // Owner logic fix
                $ownerName = is_string($venue->owner) ? $venue->owner : (isset($venue->owner['name']) ? $venue->owner['name'] : 'Unknown');

                $gallery = is_string($venue->gallery) ? json_decode($venue->gallery, true) : ($venue->gallery ?? []);
                if(!is_array($gallery)) $gallery = [];
        
                $booking = [
                    'item_name' => $venue->name,
                    'owner' => $ownerName,
                    'location' => $venue->location,
                    'price_per_night' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
                    'image' => asset(ltrim($venue->image ?? '', '/')),
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
                    'gallery' => $gallery
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
     * Tampilkan riwayat pemesanan pengguna dari MySQL.
     */
    public function orders()
    {
        $userId = auth()->id();
        $myBookings = Booking::where('user_id', $userId)->latest()->get();

        $orders = [];
        foreach ($myBookings as $booking) {
            // Map status classes
            $statusClass = 'status-warning';
            if ($booking->status === 'Selesai') $statusClass = 'status-success';
            if ($booking->status === 'Dibatalkan') $statusClass = 'status-danger';

            $details = is_string($booking->booking_details) ? json_decode($booking->booking_details, true) : ($booking->booking_details ?? []);

            $itemName = isset($details['item_name']) ? $details['item_name'] : 'Item #' . ($booking->item_id ?? '');

            $orders[] = [
                'id' => $booking->id,
                'venue_name' => $itemName,
                'venue_id' => $booking->item_id ?? null,
                'location' => $details['location'] ?? '-',
                'date' => $booking->created_at ? $booking->created_at->format('d M Y') : date('d M Y'),
                'total_price' => 'IDR ' . number_format((float)($booking->total_price ?? 0), 0, ',', '.'),
                'status' => $booking->status ?? 'Diproses',
                'status_class' => $statusClass,
                'image' => asset(ltrim($details['image'] ?? '', '/'))
            ];
        }

        // Demo data if empty
        if (empty($orders)) {
            // Ambil 3 venue pertama dari Database MySQL untuk demo
            $venues = Venue::take(3)->get();
            
            $statuses = [
                ['text' => 'Selesai', 'class' => 'status-success'],
                ['text' => 'Diproses', 'class' => 'status-warning'],
                ['text' => 'Menunggu Pembayaran', 'class' => 'status-danger'],
            ];

            foreach ($venues as $index => $venue) {
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
     * Proses pembayaran (Simpan ke MySQL).
     */
    public function pay(Request $request)
    {
        $userId = auth()->id();
        
        try {
            Booking::create([
                'user_id' => $userId,
                'item_type' => 'venue',
                'item_id' => $request->item_id ?? '1',
                'status' => 'Selesai',
                'total_price' => $request->total_price ?? 0,
                'booking_details' => [
                    'item_name' => $request->item_name ?? 'Wedding Service',
                    'image' => $request->image ?? '',
                    'location' => $request->location ?? '',
                    'payment_method' => $request->payment_method ?? 'Card',
                ],
            ]);

            return redirect()->route('orders')->with('success', 'Pembayaran Berhasil! Pesanan Anda telah tersimpan di Database.');
        } catch (\Exception $e) {
            \Log::error('MySQL Booking Error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan saat menyimpan pesanan.');
        }
    }
}
