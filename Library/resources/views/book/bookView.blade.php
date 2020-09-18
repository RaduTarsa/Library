{{--@extends('layouts.app')--}}
@extends('adminlte::page')

{{--title of page--}}
@section('title', 'Books')

{{--title on top left corner--}}
@section('content_header')
    <h1>All Books:</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($books as $book)
                    <div class="card mt-4">
                        <div class="card-header">{{ __('Book').' '.$book->id.' ' }}
                        </div>
                        <div class="card-body">
                            <p><strong>Title: </strong>{{ $book->title }}</p>
                            <p><strong>Author: </strong>{{ $book->author }}</p>
                            <p><strong>Publisher: </strong>{{ $book->publisher }}</p>
                            <p><strong>Path: </strong>
                                <a href="/download/{{ $book->id }}">Download Book</a>
                            </p>
                            <p><strong>Category: </strong>{{ $book->category->name }}</p>
                        </div>
                        <div class="card-footer" style="display: flex">
                            <a class="btn btn-primary" href="/book/save/{{ $book->id }}">Edit</a>
                            <form action="/book/delete/{{ $book->id }}" method="post">
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="card mt-4">
                        <div class="card-header">{{ __('No books.') }}</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
