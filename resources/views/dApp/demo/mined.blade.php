@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mined Block</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            Hash: {{ $data['hash'] }} <br>
                            Upper Limit: {{ $data['upper_limit'] }} <br>
                            Lower Limit: {{ $data['lower_limit'] }} <br>
                            Starting Value: {{ $data['start_val'] }} <br>
                            Ending Value: {{ is_null($data['end_val']) ? 'NULL' : $data['end_val'] }} <br>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <h3>Block Data</h3>
                                    Transaction ID: {{ $data['block_data']['txid'] }} <br>
                                    Transaction From: {{ $data['block_data']['from'] }} <br>
                                    Transaction To: {{ $data['block_data']['to'] }} <br>
                                    Specifics: {{ $data['block_data']['specifics'] }} <br>
                                    Previous Hash: {{ $data['block_data']['prev_hash'] }} <br>
                                    Timestamp: {{ $data['block_data']['timestamp'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection