<x-app-layout>
  <div class="max-w-xl mx-auto p-6">
    @if(session('ok'))<div class="p-3 bg-green-100 mb-3">{{ session('ok') }}</div>@endif
    <h1 class="text-xl font-bold mb-2">訂單 {{ $order->order_no }}</h1>
    <div class="mb-2">狀態：{{ $order->status }}</div>
    <div class="mb-2">總額：NT$ {{ number_format($order->total_twd) }}</div>
    <div class="mb-4">付款方式：{{ $order->payment_method }}</div>

    <h2 class="font-semibold mb-2">上傳匯款憑證</h2>
    <form method="post" action="{{ route('orders.uploadProof',$order) }}" enctype="multipart/form-data">
      @csrf
      <input type="file" name="payment_proof" accept="image/*" required>
      <button class="ml-2 bg-gray-800 text-white px-3 py-1 rounded">上傳</button>
    </form>

    @if($order->payment_proof_path)
      <div class="mt-3">
        <img src="{{ asset('storage/'.$order->payment_proof_path) }}" alt="付款憑證" class="max-w-full border">
      </div>
    @endif
  </div>
</x-app-layout>
