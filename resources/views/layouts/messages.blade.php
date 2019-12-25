@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="row text-center alert alert-danger push-down">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                {{$error}}
            </div>
            <div class="col-md-4"></div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="row text-center alert alert-success push-down">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            {{session('success')}}
        </div>
        <div class="col-md-4"></div>
    </div>
@endif

@if(session('error'))
    <div class="row text-center alert alert-danger push-down">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            {{session('error')}}
        </div>
        <div class="col-md-4"></div>
    </div>
@endif