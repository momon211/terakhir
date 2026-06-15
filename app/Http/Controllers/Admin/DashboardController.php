<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Category::count();

        $totalProduk = Product::count();

        $totalStok = Product::sum('stock');

        $totalNilaiInventaris =
            Product::selectRaw('SUM(price * stock) as total')
            ->value('total') ?? 0;

        $produkTerbaru = Product::latest()
            ->take(5)
            ->get();

        $stokMenipis = Product::where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        $pesananMasuk = Order::with([
                'user',
                'items.product'
            ])
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Grafik Penjualan 7 Hari Terakhir
        |--------------------------------------------------------------------------
        */

        $salesLabels = [];
        $salesData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i);

            $salesLabels[] = $date->format('d M');

            $salesData[] = Order::whereDate(
                    'created_at',
                    $date->toDateString()
                )
                ->where('payment_status', 'paid')
                ->sum('total_price');
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik Tambahan
        |--------------------------------------------------------------------------
        */

        $totalPesanan = Order::count();

        $pesananDibayar = Order::where(
            'payment_status',
            'paid'
        )->count();

        $pesananBelumDibayar = Order::where(
            'payment_status',
            'pending'
        )->count();

        $totalPenjualan = Order::where(
                'payment_status',
                'paid'
            )
            ->sum('total_price');

        return view('admin.dashboard', compact(
            'totalKategori',
            'totalProduk',
            'totalStok',
            'totalNilaiInventaris',
            'produkTerbaru',
            'stokMenipis',
            'pesananMasuk',
            'salesLabels',
            'salesData',
            'totalPesanan',
            'pesananDibayar',
            'pesananBelumDibayar',
            'totalPenjualan'
        ));
    }
}