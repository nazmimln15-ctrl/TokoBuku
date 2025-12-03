<?php
// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', '');

        $books = Book::with('category')
            ->when($q, function ($query, $q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('books.index', compact('books', 'q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover_path'] = $path;
        }

        // Tangani kategori: jika pilih category_id gunakan itu, jika input nama buat/ambil firstOrCreate
        if (!empty($data['category_id'] ?? null)) {
            $data['category_id'] = (int) $data['category_id'];
            unset($data['category']);
        } elseif (!empty($data['category'] ?? null)) {
            $category = Category::firstOrCreate(['name' => $data['category']]);
            $data['category_id'] = $category->id;
            unset($data['category']);
        } else {
            $data['category_id'] = null;
        }

        Book::create($data);

        return redirect()->route('books.index')->with('ok', 'Buku ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book')); // opsional bila butuh
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|integer|exists:categories,id',
            'category' => 'nullable|string|max:100',
            'cover' => 'nullable|image|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('cover')) {
            if ($book->cover_path && Storage::disk('public')->exists($book->cover_path)) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $path = $request->file('cover')->store('covers', 'public');
            $validatedData['cover_path'] = $path;
        }

        if (!empty($validatedData['category_id'] ?? null)) {
            $validatedData['category_id'] = (int) $validatedData['category_id'];
            unset($validatedData['category']);
        } elseif (!empty($validatedData['category'] ?? null)) {
            $category = Category::firstOrCreate(['name' => $validatedData['category']]);
            $validatedData['category_id'] = $category->id;
            unset($validatedData['category']);
        }

        $book->update($validatedData);

        return redirect()->route('books.index')->with('ok', 'Buku diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path && Storage::disk('public')->exists($book->cover_path)) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return redirect()->route('books.index')->with('ok', 'Buku dihapus.');
    }
}
