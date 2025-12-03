{{-- resources/views/books/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Buku')
@section('content') <form class="mb-3" method="GET" action="{{ route('books.index') }}"> <div class="input-group" style="max-width: 420px;"> <input name="q" value="{{ old('q', $q ?? '') }}" placeholder="Cari judul..." class="form-control" /> <button class="btn btn-sm btn-primary">Cari</button> <a href="{{ route('books.create') }}" class="btn btn-sm btn-success ms-2">Tambah</a> </div> </form>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($books as $b)
        <tr>
            <td style="width:130px;">
                @if ($b->cover_path)
                    <img src="{{ asset('storage/' . $b->cover_path) }}" width="120" alt="cover" />
                @else
                    -
                @endif
            </td>
            <td>{{ $b->title }}</td>
            <td>{{ $b->author }}</td>
            <td>{{ $b->category->name ?? '-' }}</td>
            <td>Rp {{ number_format($b->price, 0, ',', '.') }}</td>
            <td>{{ $b->stock }}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('books.edit', $b) }}">Edit</a>
                <form action="{{ route('books.destroy', $b) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $books->withQueryString()->links() }}


@endsection
