@extends('master')

@section('head')

    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/neumorphic-login.css">

@endsection

@section('body')
    <section class="hero is-fullheight">
        <div class="hero-body has-text-centered" style="align-self: center">
            <div class="login">
                <figure class="image is-3by1">
                    <img src="/images/ZLF-Logo.png">
                </figure>
                <p class="title is-3">Registration</p>
                <p class="subtitle is-5">Reset Password for {{$email}}</p>
                <form action="{{route('updatePassword')}}" method="POST">
                    @csrf

                    <div class="field">
                        <div class="control">
                            <input class="input is-medium is-rounded @error('password') is-danger @enderror" id="password" name="password" type="password" autocomplete="current-password" required placeholder="New Password">
                            @error('password') <span class="tag is-danger is-light" id="passwordHelp"> {{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input id="confirm-password" aria-describedby="passwordHelp" name="confirm-password" type="password" required class="input is-medium is-rounded @error('confirm-password') is-danger @enderror"  placeholder="Confirm Password">
                            @error('confirm-password')<span class="tag is-danger is-light" id="passwordHelp"> {{$message}} </span>@enderror
                        </div>
                    </div>

                    <br />
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                        Update
                    </button>
                </form>
                <br>
                <nav class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <a href="{{route('login')}}">Back to Login</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
@endsection
