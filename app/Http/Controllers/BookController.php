<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Book::class);

        $search = $request->get('search', '');

        $books = Book::search($search)
            ->latest()
            ->paginate(5);

        return view('app.books.index', compact('books', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Book::class);

        return view('app.books.create');
    }

    /**
     * @param \App\Http\Requests\BookStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $this->authorize('create', Book::class);

        $validated = $request->validated();

        $book = Book::create($validated);

        return redirect()
            ->route('books.edit', $book)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Book $book)
    {
        $this->authorize('view', $book);

        return view('app.books.show', compact('book'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        return view('app.books.edit', compact('book'));
    }

    /**
     * @param \App\Http\Requests\BookUpdateRequest $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $validated = $request->validated();

        $book->update($validated);

        return redirect()
            ->route('books.edit', $book)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();

        return redirect()
            ->route('books.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
