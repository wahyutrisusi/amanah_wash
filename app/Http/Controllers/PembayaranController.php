<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function checkout(Pemesanan $pemesanan)
    {
        try {
            // Buat transaksi di Midtrans
            $transaction_details = [
                'order_id' => 'ORDER-' . $pemesanan->id . '-' . time(),
                'gross_amount' => (int) $pemesanan->layanan->harga,
            ];

            $customer_details = [
                'first_name' => $pemesanan->nama,
                'phone' => $pemesanan->telepon,
            ];

            $transaction = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'enabled_payments' => [
                    'gopay', 'bank_transfer', 'echannel', 'bca_va', 
                    'bni_va', 'bri_va', 'shopeepay'
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($transaction);

            // Simpan data pembayaran
            $pembayaran = Pembayaran::create([
                'pemesanan_id' => $pemesanan->id,
                'jumlah' => $pemesanan->layanan->harga,
                'metode_pembayaran' => 'midtrans',
                'snap_token' => $snapToken,
                'status' => 'pending',
                'expired_at' => now()->addDay(),
            ]);

            return view('cucimotor.pembayaran.checkout', compact('pemesanan', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function notification(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();
            
            $transaction_status = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $order_id = $notification->order_id;

            // Get pemesanan ID from order_id
            $pemesanan_id = explode('-', $order_id)[1];
            $pembayaran = Pembayaran::where('pemesanan_id', $pemesanan_id)->first();

            if ($transaction_status == 'capture') {
                if ($fraud == 'challenge') {
                    $pembayaran->status = 'challenge';
                } else if ($fraud == 'accept') {
                    $pembayaran->status = 'success';
                    $pembayaran->paid_at = now();
                }
            } else if ($transaction_status == 'settlement') {
                $pembayaran->status = 'success';
                $pembayaran->paid_at = now();
            } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
                $pembayaran->status = 'failed';
            } else if ($transaction_status == 'pending') {
                $pembayaran->status = 'pending';
            }

            $pembayaran->save();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 