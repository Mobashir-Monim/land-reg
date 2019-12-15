@extends('layouts.app')

@section('content')
    <script>
        var current = 0;

        copyText = () => {
            let containerid = 'node-'+current;
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
            } else if (document.selection) {
                document.selection.empty();
            }

            if (document.selection) { 
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("copy"); 

            } else if (window.getSelection) {
                var range = document.createRange();
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("copy");
            }

            current++;
            console.log(current);
        }
    </script>
    <div class="card">
        <div class="card-body">
            <a href="#/" onclick="copyText()" class="btn btn-primary w-100">Copy Next</a>
            @foreach (App\Node::all() as $key => $node)
                <div class="row mb-5">
                    <div class="col-md-12" id="{{ 'node-'.$key }}">
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