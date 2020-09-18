@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">{{ __('Commands')}}</div>
                    <div class="card-body">
                        <a href="/">Go Back</a><br>
                    </div>
                </div>
                @forelse($books as $book)
                    <div class="card mt-4">
                        <div class="card-header">{{ __('Book').' '.$book->id.' ' }}</div>
                        <div class="card-body">
                            <p><strong>Title: </strong>{{ $book->title }}</p>
                            <p><strong>Author: </strong>{{ $book->author }}</p>
                            <p><strong>Publisher: </strong>{{ $book->publisher }}</p>
                            <p><strong>Path: </strong>
                                <a href="/download/{{ $book->id }}">Download Book</a>
                            </p>
                            <p><strong>Category: </strong>{{ $book->category->name }}</p>
                        </div>
                    </div>
                @empty
                    <div class="card mt-4">
                        <div class="card-header">{{ __('No books added in database.') }}</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
