@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Options</div>
                <div class="card-body">
                    <div class="row">
                        @foreach (App\ServerConfig::all() as $item)
                            <div class="col-md-3 my-3">
                                <a href="{{ route('server.config.alter', ['item' => $item->name]) }}" class="btn btn-warning w-100">Alter {{ $item->name }}</a>
                            </div>
                        @endforeach

                        <div class="col-md-3 my-3"><a href="{{ route('server.config.create') }}" class="btn btn-danger w-100">Create field</a></div>
                    </div>

                    @isset(request()->responses)
                        <div class="row my-3">
                            {{ request()->responses }}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection