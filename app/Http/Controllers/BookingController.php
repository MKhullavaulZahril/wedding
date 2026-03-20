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

                $gallery = collect($venue->gallery)->toArray();
        
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
     * Tampilkan halaman checkout untuk seluruh isi keranjang.
     */
    public function checkoutCart()
    {
        // View ini akan membaca data langsung dari localStorage via JS
        return view('checkout-cart');
    }

    /**
     * Tampilkan riwayat pemesanan pengguna dari MySQL.
     */
    public function orders(Request $request)
    {
        $userId = auth()->id();
        $search = $request->query('q');
        $type = $request->query('type', 'all');
        
        $query = Booking::where('user_id', $userId);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('booking_details', 'like', '%' . $search . '%');
            });
        }

        if ($type !== 'all') {
            $query->where('item_type', $type);
        }

        $myBookings = $query->latest()->get();

        $orders = [];
        foreach ($myBookings as $booking) {
            // Map status classes
            $status = $booking->status ?? 'Belum Diproses';
            $statusClass = 'status-warning'; // Default for 'Belum Diproses' & 'Diproses'
            
            if ($status === 'Selesai') $statusClass = 'status-success';
            if ($status === 'Dibatalkan') $statusClass = 'status-danger';

            $details = is_string($booking->booking_details) ? json_decode($booking->booking_details, true) : ($booking->booking_details ?? []);

            $itemName = isset($details['item_name']) ? $details['item_name'] : 'Item #' . ($booking->item_id ?? '');

            $orders[] = [
                'id' => $booking->id,
                'venue_name' => $itemName,
                'venue_id' => $booking->item_id ?? null,
                'location' => $details['location'] ?? '-',
                'date' => $booking->created_at ? $booking->created_at->format('d M Y') : date('d M Y'),
                'total_price' => 'IDR ' . number_format((float)($booking->total_price ?? 0), 0, ',', '.'),
                'status' => $status,
                'status_class' => $statusClass,
                'image' => asset(ltrim($details['image'] ?? '', '/'))
            ];
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
            // Cek apakah ini pembayaran massal dari keranjang
            if ($request->has('cart_items')) {
                $cartItems = $request->cart_items; // Array of items
                
                foreach ($cartItems as $item) {
                    Booking::create([
                        'user_id' => $userId,
                        'item_type' => $item['type'] ?? 'venue',
                        'item_id' => $item['id'] ?? '0',
                        'status' => 'Selesai',
                        'total_price' => $item['price_numeric'] ?? 0,
                        'booking_details' => [
                            'item_name' => $item['name'] ?? 'Wedding Service',
                            'image' => $item['image'] ?? '',
                            'location' => $item['location'] ?? '',
                            'payment_method' => $request->payment_method ?? 'Card',
                            'guest_name' => $request->guest_name,
                            'guest_email' => $request->guest_email,
                            'guest_phone' => $request->guest_phone,
                            'guest_address' => $request->guest_address,
                            'notes' => $request->notes,
                        ],
                    ]);
                }
                
                return redirect()->route('orders')->with('success', 'Pembayaran Keranjang Berhasil! Semua item telah diproses.');
            }

            // Pembayaran single item (logika lama)
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
            return back()->with('error', 'Maaf, terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage());
        }
    }
}

