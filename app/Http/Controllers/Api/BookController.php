<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
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
            ->paginate();

        return new BookCollection($books);
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

        return new BookResource($book);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Book $book)
    {
        $this->authorize('view', $book);

        return new BookResource($book);
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

        return new BookResource($book);
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

        return response()->noContent();
    }
}
