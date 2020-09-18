<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index()
    {
        $user = \App\Models\User::findOrFail(auth()->user()->id);
        $books = \App\Models\Book::all();

        return view('book.bookView', compact('books', 'user'));
    }

    public function indexClient()
    {
        $user = \App\Models\User::findOrFail(auth()->user()->id);
        $books = \App\Models\Book::all();

        return view('book.bookViewClient', compact('books', 'user'));
    }

    public function addView()
    {
        $categories = \App\Models\Category::all();

        return view('book.addBookView', compact('categories'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required',
            'file' => 'required|file|mimes:pdf|max:25600'
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category_id' => $request->category,
            'path' => 'null',
        ];

        $book = \App\Models\Book::create($data);

        $path = $request->file->storeAs('public_html/uploads', $book->id.'.pdf');
        $book->path = $path;
        $book->save();

        return redirect('/book');
    }

    public function saveView($book_id)
    {
        $categories = \App\Models\Category::all();

        $book = \App\Models\Book::findOrFail($book_id);

        $old_data = [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'publisher' => $book->publisher,
            'category' => $book->category_id
        ];

        return view('book.saveBookView', compact('categories', 'old_data'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'category' => 'required'
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'category_id' => $request->category,
        ];

        \App\Models\Book::where('id', $request->input('id'))
            ->update($data);

        if ($request->hasFile('file')) {
            $this->validate($request, ['file' => 'file|mimes:pdf|max:25600']);
            Storage::delete('public_html/uploads/'.$request->input('id').'.pdf');
            $request->file->storeAs('public_html/uploads', $request->input('id').'.pdf');
        }

        return redirect('/book');
    }

    public function delete($book_id)
    {
        \App\Models\Book::where('id', $book_id)->delete();
        Storage::delete('public_html/uploads/'.$book_id.'.pdf');

        return redirect('/book');
    }

    public function download($book_id)
    {
        return Response::download(storage_path('app/public_html/uploads/'.$book_id.'.pdf'));
    }

}
