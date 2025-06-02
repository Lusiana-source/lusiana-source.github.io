@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Checkout - Beli Sekarang</h2>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-shrink-0 w-full md:w-1/2">
                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('images/default.jpg') }}"
                    class="w-full h-auto object-cover rounded" alt="Gambar Produk">
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="text-xl font-semibold uppercase">{{ $item['name'] }}</h3>
                <p class="mt-2">Harga: <span class="text-gray-800 font-medium">Rp{{ number_format($item['price'], 0, ',', '.') }}</span></p>
                <p>Jumlah: <span class="text-gray-800">{{ $item['quantity'] }}</span></p>
                <p class="mt-2 font-bold text-lg">Total: Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout.buy-now.process') }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold">No. HP</label>
                <input type="text" name="phone" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1 font-semibold">Alamat</label>
                <textarea name="address" class="w-full border border-gray-300 rounded px-3 py-2" rows="4" required></textarea>
            </div>
        </div>

        <button type="submit"
    class="mt-6 w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 transition duration-200">
    Selesaikan Pembelian
</button>

    </form>
</div>
@endsection
