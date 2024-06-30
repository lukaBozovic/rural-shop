<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Tables\OrderTable;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', ['orders' => OrderTable::class]);
    }

    public function show($order)
    {
        $order = Http::get(
            config('app.rural_shop_ordering_url') . '/api/orders/' . $order
        )->json();
        $ad = Ad::query()->find($order['ad_id']);
        return view('orders.show', ['order' => $order, 'ad' => $ad]);
    }

    public function changeActivity($orderId): void
    {
        Http::post(
            config('app.rural_shop_ordering_url') . '/api/orders/' . $orderId . '/approve'
        )->json();
    }
}
