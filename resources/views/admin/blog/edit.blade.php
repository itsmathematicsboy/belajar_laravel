@extends('admin.layouts.app')
@section('title', 'Edit Kategori Blog')
@section('subtitle', 'Edit kategori ke panel Admin')

@section('content')
<form action="{{ route('admin.category_blog.update', $blog->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label-custom">Nama Kategori</label>
        <select name="blog_category_id" id="" class="form-control">
            @foreach ($category as $c)
            <option {{ $c->blog_category_id === $c->id ? 'selected' : ''  }} value="{{ $c->id }}">{{ $c->name  }}</option>
            @endforeach
        </select>
        @error('name')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label-custom">Slug (Opsional)</label>
        <input type="text"
            class="form-control" name="slug" required
            value={{ old('slug', $c->slug) }}>
        @error('slug')
        <div class="invalid-feedback d-block">{{ $message  }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label-custom"> Cover Path</label>
                <input type="file">
            </div>
            <div class="col-6">
                <label for="" class="form-label-custom">Cover Path Existing</label>
                <img src="{{ asset('storage/' . $blog->cover_path) }}" alt="">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn-custom btn-custom-primary">
            Simpan
        </button>
    </div>
</form>
@endsection
