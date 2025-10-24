<x-guest-layout>
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">商品列表</h1>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach($products as $p)
        <a class="border rounded p-4 block hover:bg-gray-50" href="{{ route('products.show',$p->slug) }}">
          <div class="text-lg">{{ $p->name }}</div>
          <div class="text-gray-600">NT$ {{ number_format($p->price_twd) }}</div>
          <div class="text-sm text-gray-500">庫存：{{ $p->stock }}</div>
        </a>
      @endforeach
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
  </div>
</x-guest-layout>
