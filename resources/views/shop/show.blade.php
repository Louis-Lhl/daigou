<x-app-layout>
  <div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-2">{{ $p->name }}</h1>
    <div class="mb-4">NT$ {{ number_format($p->price_twd) }} ｜ 庫存：{{ $p->stock }}</div>
    <form method="post" action="{{ route('orders.store') }}">
      @csrf
      <input type="hidden" name="product_id" value="{{ $p->id }}">
      <label class="block mb-2">數量
        <input class="border rounded p-2 w-24" type="number" name="qty" value="1" min="1">
      </label>
      <label class="block mb-2">付款方式
        <select class="border rounded p-2" name="payment_method">
          <option value="BANK_TRANSFER">轉帳</option>
          <option value="CASH">現金</option>
        </select>
      </label>
      <label class="block mb-2">收件人
        <input class="border rounded p-2 w-full" name="receiver_name" required>
      </label>
      <label class="block mb-2">電話
        <input class="border rounded p-2 w-full" name="receiver_phone" required>
      </label>
      <label class="block mb-4">地址
        <input class="border rounded p-2 w-full" name="receiver_address" required>
      </label>
      <button class="bg-blue-600 text-white px-4 py-2 rounded">下單</button>
    </form>
  </div>
</x-app-layout>
