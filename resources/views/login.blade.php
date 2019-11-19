@extends('app')

@section('title', 'Log In')

@section('content')
    <div class="content">
        <div class="m-auto" style="width:600px">
            <div class="h1">
                Log In
            </div>
            @php $messages = isset($errors) ? $errors->getMessages() : null @endphp
            @if($messages)
                @foreach ($messages as $status=>$errorMsgs)
                    @php
                        $status = (in_array($status, ['warning', 'danger', 'success'])) ? $status : 'warning';
                    @endphp
                    <div class="alert alert-{{$status}}">
                        @foreach ($errorMsgs as $errorMsg)
                            <div>{{$errorMsg}}</div>
                        @endforeach
                    </div>
                @endforeach
            @endif
            <form method="post" action="{{route('login')}}">
                @csrf
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="email" class="col-form-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="password" class="col-form-label">Password</label>
                    </div>
                    <div class="col-md-9">
                        <input type="password" name="password" id="password" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-12 text-right">
                        Not a registered user? <a href="{{route('register')}}">Register here</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
