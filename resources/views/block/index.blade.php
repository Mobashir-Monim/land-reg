@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ 'reset-chain' }}" class="btn btn-danger w-100">Reset Chain</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12" id="blocks-container">
            <div class="row mb-3" id="row-0">
                @foreach (App\Block::all() as $block)
                    @include('block.block')
                @endforeach
            </div>
        </div>
    </div>
    @if (count(App\MineData::whereNull('timestamp')->get()) > 0)
        <div class="row mt-3">
            <div class="col-md-12" id="blocks-container">
                <div class="row mb-3" id="row-0">
                    @foreach (App\MineData::whereNull('timestamp')->get() as $mineData)
                        {{-- @php
                            $block = json_decode($mineData->data);
                        @endphp --}}
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    Unmined Block
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        {!! $mineData->data !!}
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ route('mine.start', ['txid' => $mineData->txid]) }}" class="btn btn-success w-100">Start Mining</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Add Block
                </div>
                <div class="card-body">
                    <form action="{{ route('mine') }}" method="POST">
                        @csrf
                        <textarea name="block_data" class="form-control mb-3" placeholder="Block Data" id="block_data"></textarea>
                        <input type="text" name="upper_limit" id="upper_limit" class="form-control mb-3" placeholder="Upper Limit">
                        <button class="btn btn-success w-100" type="submit">Add Block</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div> --}}

    <script>
        const mine = () => setTimeout(async () => {
            console.log('before calling');
            const data = await postData('{{ route('mine') }}');
            console.log(JSON.stringify(data));;
            console.log('after calling');
        }, 0);

        // try {
        //     const data = await postData('{{ route('mine') }}');
        //     console.log(JSON.stringify(data)); // JSON-string from `response.json()` call
        // } catch (error) {
        //     console.error(error);
        // }

        const postData = async (url) => {
            // Default options are marked with *
            let data = {
                '_token': $('meta[name=csrf-token]').attr('content'),
                // 'X-CSRF-TOKEN': '{{ Session::token() }}',
                'upper_limit': document.getElementById('upper_limit').value,
                'block_data': document.getElementById('block_data').value,
            };

            console.log(data);

            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                // credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                // redirect: 'follow', // manual, *follow, error
                // referrer: 'no-referrer', // no-referrer, *client
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            });

            return await response.json(); // parses JSON response into native JavaScript objects
        }

        const wait = ms =>{
            var start = new Date().getTime();
            var end = start;
            while(end < start + ms) {
                end = new Date().getTime();
            }
        }
    </script>
@endsection

{{-- @section('scripts')
    
@endsection --}}