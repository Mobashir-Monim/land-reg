@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Election Results</div>
                <div class="card-body">
                    <form action="#" method="POST" id="decision-form">
                        @csrf
                        <input type="hidden" name="txid" value="{{ $data['block_data']['txid'] }}">
                        <input type="hidden" name="elected" value="{{ json_encode($elected) }}">
                        <input type="hidden" name="data" value="{{ json_encode($data) }}">
                        <div class="row my-3">
                            <div class="col-md-4 my-3 h3 text-center">Elected Area: {{ $elected['area'] }}</div>
                            <div class="col-md-4 my-3 h3 text-center">Elected Subzone: {{ $elected['cluster'] }}</div>
                            <div class="col-md-4 my-3 h3 text-center">Elected Node: {{ $elected['node'] }}</div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6 my-3 h5">Upper Limit: {{ $data['upper_limit'] }}</div>
                            <div class="col-md-6 my-3 h5">Lower Limit: {{ $data['lower_limit'] }}</div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6 my-3">Transfer from: {{ $data['block_data']['from'] }}</div>
                            <div class="col-md-6 my-3">Transfer to: {{ $data['block_data']['to'] }}</div>
                            <div class="col-md-12 my-3">
                                Specifics: <br>
                                {{ $data['block_data']['specifics'] }}
                            </div>
                            <div class="col-md-6 my-3">
                                Has File: <br>
                                {{ is_null($data['block_data']['file']) ? 'No': 'Yes' }}
                            </div>
                            <div class="col-md-6 my-3">
                                File Type: <br>
                                {{ $data['block_data']['ext'] }}
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6 my-3"><a href="#/" class="btn btn-primary w-100" onclick=reelect()>Re-Elect</a></div>
                            <div class="col-md-6 my-3"><a href="#/" class="btn btn-success w-100" onclick="continueMine()">Continue Mine</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <script>
        var dForm = null;

        window.onload = () => {
            dForm = document.getElementById('decision-form');
        }

        const reelect = () => {
            dForm.action = "{{ route('transactions.create') }}";
            dForm.submit();
        }

        const continueMine = () => {
            dForm.action = "{{ route('transactions.mine') }}";
            dForm.submit();
        }
    </script>
@endsection