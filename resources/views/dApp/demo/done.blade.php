@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notification</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 my-3">Sent Data to be Mined</div>
                        <div class="col-md-12 my-3">Mine request sent to: {{ $elected->node }}</div>
                        <div class="col-md-12 my-3">To see if block is mined visit: <a href="http://{{ $elected->node }}/blocks" target="_blank">http://{{ $elected->node }}/blocks</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection