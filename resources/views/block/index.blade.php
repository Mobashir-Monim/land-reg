@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12" id="blocks-container">
            <div class="row mb-3" id="row-0">
                @foreach (App\Block::all() as $block)
                    @include('block.block')
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Add Block
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('mine') }}" method="POST">
                        @csrf --}}
                        <textarea name="block_data" class="form-control mb-3" placeholder="Block Data" id="block_data"></textarea>
                        <input type="text" name="upper_limit" id="upper_limit" class="form-control mb-3" placeholder="Upper Limit">
                        <button class="btn btn-success w-100" onclick="mine()">Add Block</button>
                        {{-- <button class="btn btn-success w-100" type="submit">Add Block</button>
                    </form> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection

@section('scripts')
    <script>
        const mine = () => setTimeout(function() {
            console.log('before calling');
            mineRequest();
            console.log('after calling');
        }, 0);

        const mineRequest = () => {
            let url = '{{ route('mine') }}';

            fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow',
                referrer: 'no-referrer',
                body: JSON.stringify({
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'block_data': document.getElementById('block_data').value,
                    'upper_limit': document.getElementById('upper_limit'),
                })
            });

            console.log('Request Sent');
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