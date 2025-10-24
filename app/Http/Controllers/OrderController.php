<?php

namespace App\Http\Controllers;
use App\Models\Order; use App\Models\OrderItem; use App\Models\Product;
use Illuminate\Http\Request; use Illuminate\Support\Str; use Illuminate\Support\Facades\DB; use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function store(Request $r){
        $data = $r->validate([
        'product_id'=>'required|exists:products,id',
        'qty'=>'nullable|integer|min:1',
        'payment_method'=>'required|in:CASH,BANK_TRANSFER',
        'receiver_name'=>'required|string|max:100',
        'receiver_phone'=>'required|string|max:30',
        'receiver_address'=>'required|string|max:255',
        ]);
        $qty = $data['qty'] ?? 1;

        return DB::transaction(function() use ($data,$qty){
        $p = Product::lockForUpdate()->findOrFail($data['product_id']);
        abort_if($p->stock < $qty, 422, '庫存不足');

        $subtotal = $p->price_twd * $qty; $ship=0; $total=$subtotal+$ship;
        $orderNo = now()->format('YmdHis').'-'.strtoupper(Str::random(4));

        $order = Order::create([
            'user_id'=>auth()->id(),'order_no'=>$orderNo,'status'=>'PENDING_PAYMENT',
            'subtotal_twd'=>$subtotal,'shipping_fee_twd'=>$ship,'total_twd'=>$total,
            'payment_method'=>$data['payment_method'],
            'receiver_name'=>$data['receiver_name'],'receiver_phone'=>$data['receiver_phone'],
            'receiver_address'=>$data['receiver_address'],'placed_at'=>now()
        ]);

        OrderItem::create([
            'order_id'=>$order->id,'product_id'=>$p->id,
            'product_name_snapshot'=>$p->name,'unit_price_twd'=>$p->price_twd,'quantity'=>$qty
        ]);

        $p->decrement('stock', $qty);
        return redirect()->route('orders.show',$order)->with('ok','下單成功：'.$orderNo);
        });
    }

    public function show(Order $order){
        abort_unless($order->user_id === auth()->id(), 403);
        return view('orders.show', compact('order'));
    }

    public function uploadProof(Request $r, Order $order){
        abort_unless($order->user_id === auth()->id(), 403);
        $r->validate(['payment_proof'=>'required|image|max:4096']);
        $path = $r->file('payment_proof')->store('payment_proofs','public');
        $order->update(['payment_proof_path'=>$path]);
        return back()->with('ok','已上傳匯款憑證');
    }
}
