@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Config</div>
                <div class="card-body">
                    <form action="{{ route('server.config.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-3">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-md-6 my-3">
                                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Description"></textarea>
                            </div>
                        </div>

                        @foreach (App\Node::all() as $node)
                            <div class="row my-3">
                                <div class="col-md-4 my-auto">{{ $node->ip }}</div>
                                <div class="col-md-8">
                                    <input type="text" name="value[{{ $node->ip }}]" class="form-control" placeholder="Value">
                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><button type="submit" class="btn btn-success w-100">Save</button></div>
                            <div class="col-md-2"></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection