<?php
namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCollection;

class BookAuthorsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Book $book)
    {
        $this->authorize('view', $book);

        $search = $request->get('search', '');

        $authors = $book
            ->authors()
            ->search($search)
            ->latest()
            ->paginate();

        return new AuthorCollection($authors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book, Author $author)
    {
        $this->authorize('update', $book);

        $book->authors()->syncWithoutDetaching([$author->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book, Author $author)
    {
        $this->authorize('update', $book);

        $book->authors()->detach($author);

        return response()->noContent();
    }
}
