@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Nodes</div>
                <div class="card-body">
                    @isset($responses)
                        <div class="row">
                            <div class="col-md-12 my-3">{{ $responses }}</div>
                        </div>
                    @endisset
                    <div class="row">
                        <div class="col-md-12 my-3"><a href="{{ route('git.pull', ['node' => 'all']) }}" class="btn btn-secondary w-100">Pull All</a></div>
                    </div>
                    @foreach (App\Node::all() as $node)
                        <div class="row my-3">
                            <div class="col-md-4 my-auto">{{ $node->ip }}</div>
                            <div class="col-md-8"><a href="{{ route('git.pull', ['node' => $node->ip]) }}" class="btn btn-primary w-100">Pull Code on {{ $node->ip }}</a></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection