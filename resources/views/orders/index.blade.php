<x-app-layout>
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">我的訂單</h1>
    @if($orders->isEmpty())
      <p class="text-gray-600">目前沒有訂單。</p>
    @else
      <div class="space-y-4">
        @foreach($orders as $order)
          <a class="block border rounded p-4 hover:bg-gray-50" href="{{ route('orders.show', $order) }}">
            <div class="flex justify-between items-center">
              <div>
                <div class="font-semibold">{{ $order->order_no }}</div>
                <div class="text-sm text-gray-500">{{ $order->placed_at?->format('Y-m-d H:i') }}</div>
              </div>
              <div class="text-right">
                <div class="text-sm text-gray-600">狀態：{{ $order->status }}</div>
                <div class="font-medium">NT$ {{ number_format($order->total_twd) }}</div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
      <div class="mt-6">{{ $orders->links() }}</div>
    @endif
  </div>
</x-app-layout>