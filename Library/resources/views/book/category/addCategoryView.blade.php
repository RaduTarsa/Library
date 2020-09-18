@extends('adminlte::page')

@section('title', 'Edit Book')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/book/category/store" method="post" role="form">
            @csrf

            <div class="card-body">
                <!-- text input -->
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <!-- /.card-body -->

            <p class="text-danger"> @error('name') {{ $message }} @enderror </p>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
