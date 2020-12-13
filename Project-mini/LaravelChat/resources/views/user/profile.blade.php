@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px">
                <h2>{{ $user->name}}</h2>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    @csrf
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <a href="/">
                        <button type="submit" class="btn btn-primary">Submit
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection