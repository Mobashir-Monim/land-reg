@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @foreach (App\Node::all() as $node)
                <div class="row mb-5">
                    <div class="col-md-12">
                        ssh -i "land-reg.pem" ubuntu@ec2-{{ str_replace(".", "-", $node->ip) }}.ap-southeast-1.compute.amazonaws.com <br>
                        sudo su <br>
                        cd /var/www/html <br>
                        git pull <br>
                        exit <br>
                        exit <br>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection