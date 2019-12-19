@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <a href="{{ route('server.config.index') }}" class="btn btn-danger w-100">Config Servers</a>
                        </div>
                        <div class="col-md-6 my-3">
                                <a href="{{ route('transactions.create') }}" class="btn btn-warning w-100">Add Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
