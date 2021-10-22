<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorCollection;
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
            ->paginate();

        return new AuthorCollection($authors);
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

        return new AuthorResource($author);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Author $author)
    {
        $this->authorize('view', $author);

        return new AuthorResource($author);
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

        return new AuthorResource($author);
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

        return response()->noContent();
    }
}
