<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $availability = $request->query('availability');

        $books = Book::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($availability === 'available', fn ($query) => $query->where('is_available', true))
            ->when($availability === 'unavailable', fn ($query) => $query->where('is_available', false))
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $activeFilters = (filled($search) ? 1 : 0) + (filled($availability) ? 1 : 0);

        $viewData = [
            'books'        => $books,
            'filters'      => ['search' => $search, 'availability' => $availability ?? ''],
            'totalBooks'   => $books->count(),
            'activeCount'  => $activeFilters,
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html'          => view('admin.books._results', $viewData)->render(),
                'total'         => $books->count(),
                'activeFilters' => $activeFilters,
            ]);
        }

        return view('admin.books.index', $viewData);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        } else {
            $data['cover_image'] = null;
        }

        $data['is_available'] = $request->boolean('is_available');
        $data['stock']        = $data['stock'] ?? 0;
        $data['sort_order']   = $data['sort_order'] ?? 0;

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', ['book' => $book]);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        } elseif ($request->boolean('remove_cover')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = null;
        } else {
            unset($data['cover_image']);
        }

        $data['is_available'] = $request->boolean('is_available');

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book removed successfully.');
    }
}
