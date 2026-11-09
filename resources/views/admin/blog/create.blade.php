@extends('admin.layouts.app')
@section('title', 'Tambah Blog')
@section('subtitle', 'Tambahkan Blog')

@section('content')
    <form action="{{ route('admin.blog.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label-custom">Cover</label>
            <input type="file"
            class="form-control" name="cover" required
            value={{ old('cover') }}>
            @error('cover')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama</label>
            <input type="text"
            class="form-control" name="name" required
            value={{ old('name') }}>
            @error('name')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Kategori</label>
            <input type="select"
            class="form-control" name="category_blogs" required
            value={{ old('category') }}>
            @error('category_blogs')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama</label>
            <input type="text"
            class="form-control" name="name" required
            value={{ old('name') }}>
            @error('name')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text"
            class="form-control" name="slug"
            value={{ old('slug') }}>
            @error('slug')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">
                Simpan
            </button>
        </div>
    </form>
@endsection
