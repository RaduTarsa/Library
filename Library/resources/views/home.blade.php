@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($user->isAdmin())
                            <p>You are logged in as <strong>Admin</strong></p>

                            <a href="/book">
                                Go to Books!!!
                            </a>
                        @else
                            <p>You are logged in as <strong>Client</strong></p>

                            <a href="/book/client">
                                Go to Books!!!
                            </a>
                        @endif
                    </div>
                </div>

{{--                <div class="card mt-4">--}}
{{--                    <div class="card-header">{{ __('Information') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if (session('status'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ session('status') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        TO DO the word document here for details--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
