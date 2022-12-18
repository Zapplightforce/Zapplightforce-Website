@extends('master')

@section('head')
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/15181efa86.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/ghost-blog.css">


@endsection


@section('body')
    <section class="hero is-medium">
        <div class="hero-head">
            <div class="container">
                <nav class="navbar" role="navigation" aria-label="main navigation">

                    <div id="navbarBasicExample" class="navbar-menu">
                        <div class="navbar-start">
                            <a href="{{route('home')}}" class="navbar-item {{ Request::is('home') ? 'is-active' : '' }}">
                                Home
                            </a>
                            <a href="{{route('news')}}" class="navbar-item {{ Request::is('news') ? 'is-active' : '' }}">
                                News
                            </a>
                        </div>

                        <div class="navbar-end">
                            <div class="navbar-item">
                                <a href="https://www.facebook.com/">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <div class="dropdown is-hoverable is-right">
                                    <div class="dropdown-trigger">
                                        <button class="button is-black" aria-haspopup="true" aria-controls="dropdown-menu3">
                                            <i class="fas fa-user-circle"></i>
                                        </button>
                                    </div>
                                    <div class="dropdown-menu" id="dropdown-menu6" role="menu">
                                        <div class="dropdown-content has-background-grey-dark">
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Overview
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Modifiers
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Grid
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Form
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Elements
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Components
                                            </a>
                                            <a href="#" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Layout
                                            </a>
                                            <hr class="dropdown-divider">
                                            <a href="{{route('logout')}}" class="dropdown-item" style="margin: 0; background-color: hsl(0, 0%, 29%)">
                                                Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        @yield('dashboardBanner')

    </section>
    @yield('dashboardBody')



@endsection

@section('script')

    @yield('dashboardScript')

@endsection
