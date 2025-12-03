{{-- resources/views/books/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('content') <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
@csrf


    <div class="mb-3">
        <label>Judul</label>
        <input class="form-control" name="title" value="{{ old('title') }}" />
        @error('title') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Penulis</label>
        <input class="form-control" name="author" value="{{ old('author') }}" />
        @error('author') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        @if(isset($categories) && $categories->count())
            <select name="category_id" class="form-control">
                <option value="">-- Pilih kategori (atau tulis baru di bawah) --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <small class="d-block mt-1">Atau buat kategori baru:</small>
        @endif
        <input class="form-control mt-1" name="category" value="{{ old('category') }}" placeholder="Nama kategori baru (opsional)" />
        @error('category') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input class="form-control" name="price" value="{{ old('price') }}" />
        @error('price') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input class="form-control" name="stock" value="{{ old('stock') }}" />
        @error('stock') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Sampul</label>
        <input type="file" class="form-control" name="cover" accept="image/*" />
        @error('cover') <small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
</form>


@endsection
