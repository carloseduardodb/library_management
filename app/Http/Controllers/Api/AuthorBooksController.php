<?php
namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;

class AuthorBooksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Author $author)
    {
        $this->authorize('view', $author);

        $search = $request->get('search', '');

        $books = $author
            ->books()
            ->search($search)
            ->latest()
            ->paginate();

        return new BookCollection($books);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Author $author, Book $book)
    {
        $this->authorize('update', $author);

        $author->books()->syncWithoutDetaching([$book->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Author $author, Book $book)
    {
        $this->authorize('update', $author);

        $author->books()->detach($book);

        return response()->noContent();
    }
}
