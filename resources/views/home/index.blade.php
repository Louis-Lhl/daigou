<x-app-layout>
  <section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-16 flex flex-col-reverse lg:flex-row items-center gap-10">
      <div class="w-full lg:w-1/2 space-y-6">
        <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">新到商品</span>
        <h1 class="text-4xl font-bold text-gray-900">代購商城，精選商品一次看</h1>
        <p class="text-lg text-gray-600">探索我們最新上架的熱門商品，下單後可直接在訂單中心追蹤狀態。</p>
        <div class="flex gap-4">
          <a href="{{ route('shop.index') }}" class="inline-flex items-center px-5 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 transition">開始選購</a>
          <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-3 border border-indigo-600 text-indigo-600 font-semibold rounded-md hover:bg-indigo-50 transition">會員登入</a>
        </div>
      </div>
      <div class="w-full lg:w-1/2">
        <img class="w-full rounded-xl shadow-lg object-cover" src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80" alt="購物插圖">
      </div>
    </div>
  </section>

  <section class="bg-gray-50 py-14">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">商品列表</h2>
        <a href="{{ route('shop.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">查看全部</a>
      </div>
      @if($products->isEmpty())
        <p class="text-gray-600">目前沒有可購買的商品，請稍後再來看看。</p>
      @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          @foreach($products as $product)
            <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition">
              <div class="aspect-video bg-gray-100 rounded-t-lg"></div>
              <div class="p-5 space-y-2">
                <div class="text-lg font-semibold text-gray-900">{{ $product->name }}</div>
                <div class="text-sm text-gray-500 truncate">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</div>
                <div class="text-indigo-600 font-bold">NT$ {{ number_format($product->price_twd) }}</div>
                <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800">查看詳情 →</a>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>
</x-app-layout>
