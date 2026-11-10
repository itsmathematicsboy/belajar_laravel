@extends('admin.layouts.app')
@section('title', 'Tambah Blog')
@section('subtitle', 'Tambahkan Blog')

@section('content')
<form action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label-custom">Nama Kategori *</label>
        <select name="blog_category_id" id="" class="form-control">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name  }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Judul *</label>
        <input type="text"
            class="form-control" name="name" required
            value={{ old('name') }}>
        @error('name')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Slug (Opsional)</label>
        <input type="select"
            class="form-control" name="slug"
            value={{ old('slug') }}>
        @error('slug')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Deskripsi Singkat (Opsional)</label>
        <input type="text"
            class="form-control" name="brief_description"
            value={{ old('name') }}>
        @error('name')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Isi</label>
        <textarea name="content" id="" cols="30"
        rows="10" class="d-none"></textarea>
        <div id="editor">{!! old('content') !!}</div>
        @error('content')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Author</label>
        <input type="text"
            class="form-control" name="author" readonly
            value="{{ auth()->user()->name }}">
        @error('name')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Author</label>
        <input type="file"
            class="form-control" name="cover_path"
            value="{{ old('cover_path') }}">
        @error('cover_path')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <button type="submit" class="btn-custom btn-custom-primary">
            Simpan
        </button>
    </div>
</form>
@endsection
