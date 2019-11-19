@extends('app')

@section('title', 'Register')

@section('content')
    <div class="content">
        <div class="m-auto" style="width:600px">
            <div class="h1">
                Register
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
            <form method="post" action="{{route('register')}}">
                @csrf
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="name" class="col-form-label">Full Name</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-3">
                        <label for="email" class="col-form-label">Email</label>
                    </div>
                    <div class="col-md-9">
                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
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
                        Already registered? <a href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
