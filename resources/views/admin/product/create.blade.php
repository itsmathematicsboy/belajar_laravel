@extends('admin.layouts.app')
@section('title', 'Tambah Produk')
@section('subtitle', 'Tambah Produk Baru')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">Categories</label>
            <select name="category_id" class="form-select">
                <option value="">--Pilih Kategori--</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}">{{  $c->name  }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="">Nama Produk</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Stock</label>
            <input type="number" name="Stock" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Harga</label>
            <input type="text" name="price" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Upload Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
    </form>
@endsection
