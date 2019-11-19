@extends('app')

@section('title', 'User Details')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="m-auto" style="width:600px">
                @isset ($user)
                    <div class="row">
                        <div class="col-12 h1">User Details -</div>
                    </div>
                    <div class="row">
                        <div class="col-form-label col-3">Name:</div>
                        <div class="col-form-label col-9">{{$user->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-form-label col-3">Email:</div>
                        <div class="col-form-label col-9">{{$user->email}}</div>
                    </div>
                @else
                    User not found.
                @endif
            </div>
        </div>
    </div>
@endsection
