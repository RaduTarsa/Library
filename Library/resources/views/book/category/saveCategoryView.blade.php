@extends('adminlte::page')

@section('title', 'Edit Book')

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/book/category/update" method="post" role="form">
            @csrf

            <div class="card-body">
                <input type="hidden" name="id" value="{{ $old_data['id'] }}">
                <!-- text input -->
                <div class="form-group">
                    <label>Category name</label>
                    <input type="text" class="form-control" name="name" value="{{ $old_data['name'] }}">
                </div>
            </div>
            <!-- /.card-body -->

            <p class="text-danger"> @error('name') {{ $message }} @enderror </p>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit Category</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
