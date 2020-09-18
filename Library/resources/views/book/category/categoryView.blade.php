@extends('adminlte::page')

@section('title', 'Edit Book')

@section('content_header')
    <h1>Show Categories:</h1>
@stop

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($categories as $category)
                    <div class="card mt-4">
                        <div class="card-header">{{ __('Category').' '.$category->id.' ' }}

                        </div>
                        <div class="card-body">
                            <p><strong>Name: </strong>{{ $category->name }}</p>
                        </div>
                        <div class="card-footer" style="display: flex">
                            <a class="btn btn-primary" href="/book/category/save/{{ $category->id }}">Edit</a>
                            <form action="/book/category/delete/{{ $category->id }}" method="post">
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="card mt-4">
                        <div class="card-header">{{ __('No categories.') }}</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@stop
