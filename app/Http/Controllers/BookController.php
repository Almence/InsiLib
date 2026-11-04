<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search', ''));
        $sortBy = (string) $request->input('sort_by', 'title');
        $sortDirection = (string) $request->input('sortDirection', 'asc');
        $filterBy = (string) $request->input('filter_by', 'all');
        $perPage = (int) $request->input('per_page', 20);
        $perPage = in_array($perPage, [10, 20, 50, 100], true) ? $perPage : 20;

        $categories = \App\Models\Category::all();
        $books = Book::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when($filterBy !== 'all', function (Builder $query) use ($filterBy): void {
                $query->where('category_id', $filterBy);
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)
            ->withQueryString();

        return view('katalog', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|numeric|digits:4',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $image = null;

        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'year' => $validated['year'],
            'stock' => $validated['stock'],
            'cover_image' => $imagePath ?? null,
        ]);

        $book->categories()->attach($request->category_ids);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.books.update', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|numeric|digits:4',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
        ]);

        // Siapkan data dasar yang mau di-update
        $updateData = [
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'year' => $validated['year'],
            'stock' => $validated['stock'],
        ];

        // Cek apakah user mengupload gambar cover baru
        if ($request->hasFile('cover_image')) {
            // Opsional: Hapus gambar lama jika ada di storage
            if ($book->cover_image && \Storage::disk('public')->exists($book->cover_image)) {
                \Storage::disk('public')->delete($book->cover_image);
            }

            // Simpan gambar baru
            $path = $request->file('cover_image')->store('covers', 'public');
            $updateData['cover_image'] = $path; // Masukkan path baru ke data update
        }

        // Eksekusi update data buku
        $book->update($updateData);

        // Sinkronisasi kategori (Many-to-Many)
        $book->categories()->sync($request->category_ids);

        return redirect()->route('catalog')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
