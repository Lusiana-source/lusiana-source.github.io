@extends('layouts.admin')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Tambah Produk</h2>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

<div class="mb-4">
    <label class="block font-medium text-gray-700">Kategori</label>
    <select name="category_id" id="category-select" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-4">
            <label class="block font-medium text-gray-700">Harga</label>
            <input type="text" name="price" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Gambar</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="stock" class="block font-medium mb-1">Stok Produk</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? 0) }}"
            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-500">
        </div>

<div class="mb-4">
    <label for="size" class="block text-sm font-medium text-gray-700">Ukuran (Size)</label>
    <input type="text" name="size" id="size"
           placeholder="Contoh: M, L, 38, 40"
           class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
</div>

        <button type="submit" 
        class="w-full bg-blue-600 text-stone font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition mt-4">
            Simpan
        </button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categorySelect = document.getElementById("category-select");
        const sizeInput = document.getElementById("size-input");

        function toggleSizeInput() {
            const selectedText = categorySelect.options[categorySelect.selectedIndex].text.toLowerCase();
            sizeInput.style.display = selectedText.includes("sepatu") ? "block" : "none";
        }

        toggleSizeInput();
        categorySelect.addEventListener("change", toggleSizeInput);
    });
</script>

@endsection