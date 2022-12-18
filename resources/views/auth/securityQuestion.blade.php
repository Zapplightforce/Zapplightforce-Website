@extends('master')

@section('head')

    <title>Reset Password</title>
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
                <p class="title is-3">Security Question</p>
                <form action="{{route('submitQuestion')}}" method="POST">
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
                            <p class="subtitle is-6">Please enter a security question (only one that you can answer). <br> So if you forget your password we can ask you this question and we can reset your password</p>
                            <div class="control">
                                <input id="email-address" value="{{old('question')}}" class="input is-medium is-rounded @error('question') is-danger @enderror" name="question" type="text" autocomplete="question" required placeholder="Question">
                                @error('question')  <span class="tag is-danger is-light" id="passwordHelp">{{$message}} </span> @enderror
                            </div>
                        </div>
                    <div class="field">
                        <div class="control">
                            <input id="email-address" class="input is-medium is-rounded @error('answer') is-danger @enderror" name="answer" type="text" autocomplete="answer" required placeholder="Answer">
                            @error('answer')  <span class="tag is-danger is-light" id="passwordHelp">{{$message}} </span> @enderror
                        </div>
                    </div>
                    <br />
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                        Submit Security Question
                    </button>
                </form>
                <br>
                <nav class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <a href="{{ url()->previous() }}">Back to registration</a>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <a href="{{ route('login')}}">Cancel</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
@endsection
