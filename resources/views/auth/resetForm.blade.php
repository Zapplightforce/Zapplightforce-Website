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
                <p class="title is-3">Reset Password</p>
                <p class="subtitle is-5">Please enter the email address you <br> used for the account.</p>
                <form action="{{route('askSecurityQuestion')}}" method="GET">
                    @if(Session::has('fail'))
                        <article class="message is-danger">
                            <div class="message-body">
                                <strong>Attention!</strong>, {{Session::get('fail')}}
                            </div>
                        </article>
                    @endif
                    @if(Session::has('success'))
                        <article class="message is-success">
                            <div class="message-body">
                                <strong>Success!</strong>{{Session::get('success')}}
                            </div>
                        </article>
                    @endif
                    @csrf

                    <div class="field">
                        <div class="control">
                            <input id="email-address" value="@if(Cookie::has('email')) {{Cookie::get('email')}} @else {{old('email')}} @endif" class="input is-medium is-rounded @error('email') is-danger @enderror" name="email" type="email" autocomplete="email" required placeholder="Email address">
                            @error('email')  <span class="tag is-danger is-light" id="passwordHelp">{{$message}} </span> @enderror
                        </div>
                    </div>
                    <br />
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                        Submit
                    </button>
                </form>
                <br>
                <div class="columns is-1">
                    <div class="column is-half">
                        <div>
                            <a href="{{route('login')}}">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
