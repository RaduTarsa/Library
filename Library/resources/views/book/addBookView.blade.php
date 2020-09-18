@extends('adminlte::page')

@section('title', 'Add a Book')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Book</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/book/store" method="post" enctype="multipart/form-data" role="form">
        @csrf

        <div class="card-body">
            <!-- text input -->
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" class="form-control" name="author" value="{{ old('author') }}">
            </div>
            <div class="form-group">
                <label>Publisher</label>
                <input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" id="file" name="file" value="{{ old('file') }}"><br>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="category">Book Category</label>
                @if(count($categories)>0)
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                @else
                    <p>No categories.</p>
                @endif
                <br>
                <a class="btn-primary btn-sm" href="/book/category/add">Add Categories</a>
            </div>
        </div>
        <!-- /.card-body -->

        <p class="text-danger"> @error('title') {{ $message }} @enderror </p>
        <p class="text-danger"> @error('author') {{ $message }} @enderror </p>
        <p class="text-danger"> @error('publisher') {{ $message }} @enderror </p>
        <p class="text-danger"> @error('category') {{ $message }} @enderror </p>
        <p class="text-danger"> @error('file') {{ $message }} @enderror </p>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Book</button>
        </div>
    </form>
</div>
<!-- /.card -->

@stop
