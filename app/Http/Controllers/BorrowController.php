<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.borrows.index', compact('borrows', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Borrow::class);

        $books = Book::pluck('name', 'id');
        $students = Student::pluck('name', 'id');

        return view('app.borrows.create', compact('books', 'students'));
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

        return redirect()
            ->route('borrows.edit', $borrow)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Borrow $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Borrow $borrow)
    {
        $this->authorize('view', $borrow);

        return view('app.borrows.show', compact('borrow'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Borrow $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Borrow $borrow)
    {
        $this->authorize('update', $borrow);

        $books = Book::pluck('name', 'id');
        $students = Student::pluck('name', 'id');

        return view('app.borrows.edit', compact('borrow', 'books', 'students'));
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

        return redirect()
            ->route('borrows.edit', $borrow)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('borrows.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
