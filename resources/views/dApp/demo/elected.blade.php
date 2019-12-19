@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Election Results</div>
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-md-4 my-3">Elected Area: {{ $data }}</div>
                        <div class="col-md-4 my-3"></div>
                        <div class="col-md-4 my-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection