@extends('master')

@section('head')
    <title>Login</title>
@endsection

@section('body')
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-15 w-auto" src="/images/ZLF-Logo.png" alt="Workflow">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Set new Password</h2>

            </div>

            <form class="mt-8 space-y-6" action="{{route('login-user')}}" method="POST">
                @if(Session::has('fail'))
                    <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            <span class="font-medium">Attention!</span> {{Session::get('fail')}}
                        </div>
                    </div>
                @endif
                @csrf

                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" value="@if(Cookie::has('user')) {{Cookie::get('user')}} @else {{old('email')}} @endif" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                        @error('email')  <span class="text-xs text-red-700" id="passwordHelp">{{$message}} </span> @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" @if(Cookie::has('userpwd')) value="{{Cookie::get('userpwd')}}"  @endif type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="New Password">
                        @error('password') <span class="text-xs text-red-700" id="passwordHelp"> {{$message}}</span> @enderror
                    </div>
                    <div>
                        <label for="confirm-password" class="sr-only">Confirm Password</label>
                        <input id="confirm-password" aria-describedby="passwordHelp" name="confirm-password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm @error('confirm-password') border-red-700 rounded-lg focus:shadow-outline @enderror"  placeholder="Confirm new Password">
                        <span class="text-xs text-red-700" id="passwordHelp">@error('confirm-password') {{$message}} @enderror</span>
                    </div>
                </div>



                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: solid/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
