@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Transaction</div>
                <div class="card-body">
                    <form action="{{ route('transactions.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-6 my-3"><input type="number" name="transfer_from" class="form-control" placeholder="Transfer From"></div>
                            <div class="col-md-6 my-3"><input type="number" name="transfer_to" class="form-control" placeholder="Transfer To"></div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12 my-3">
                                <textarea name="specifics" class="form-control" cols="30" rows="10" placeholder="Specifics of Transter"></textarea>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-6 my-3">
                                <input type="file" name="doc" class="form-control">
                            </div>
                            <div class="col-md-6 my-3">
                                <button class="btn btn-success w-100" type="submit">Add Transaction</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection