<?php

namespace App\Http\Controllers\Api;

use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowResource;
use App\Http\Resources\BorrowCollection;
use App\Http\Requests\BorrowStoreRequest;
use App\Http\Requests\BorrowUpdateRequest;

class BorrowController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Borrow::class);

        $search = $request->get('search', '');

        $borrows = Borrow::search($search)
            ->latest()
            ->paginate();

        return new BorrowCollection($borrows);
    }

    /**
     * @param \App\Http\Requests\BorrowStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowStoreRequest $request)
    {
        $this->authorize('create', Borrow::class);

        $validated = $request->validated();

        $borrow = Borrow::create($validated);

        return new BorrowResource($borrow);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Borrow $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Borrow $borrow)
    {
        $this->authorize('view', $borrow);

        return new BorrowResource($borrow);
    }

    /**
     * @param \App\Http\Requests\BorrowUpdateRequest $request
     * @param \App\Models\Borrow $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(BorrowUpdateRequest $request, Borrow $borrow)
    {
        $this->authorize('update', $borrow);

        $validated = $request->validated();

        $borrow->update($validated);

        return new BorrowResource($borrow);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Borrow $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Borrow $borrow)
    {
        $this->authorize('delete', $borrow);

        $borrow->delete();

        return response()->noContent();
    }
}
