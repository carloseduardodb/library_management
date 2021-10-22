<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Author::class);

        $search = $request->get('search', '');

        $authors = Author::search($search)
            ->latest()
            ->paginate(5);

        return view('app.authors.index', compact('authors', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Author::class);

        return view('app.authors.create');
    }

    /**
     * @param \App\Http\Requests\AuthorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorStoreRequest $request)
    {
        $this->authorize('create', Author::class);

        $validated = $request->validated();

        $author = Author::create($validated);

        return redirect()
            ->route('authors.edit', $author)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Author $author)
    {
        $this->authorize('view', $author);

        return view('app.authors.show', compact('author'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Author $author)
    {
        $this->authorize('update', $author);

        return view('app.authors.edit', compact('author'));
    }

    /**
     * @param \App\Http\Requests\AuthorUpdateRequest $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $this->authorize('update', $author);

        $validated = $request->validated();

        $author->update($validated);

        return redirect()
            ->route('authors.edit', $author)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Author $author)
    {
        $this->authorize('delete', $author);

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
