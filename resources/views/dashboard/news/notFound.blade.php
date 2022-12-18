@extends('dashboard.main')

@section('title')
    News
@endsection
@section('dashboardBody')
    <div class="columns" style="margin: 0">
        <div class="column" style="background-color: #060606"></div>
        <div class="column is-one-quarter" style="background-color: #060606">

            <form action="{{route('news')}}" method="GET">
                @csrf
                <div class="field has-addons">
                    <div class="control">
                        <input name="search" class="input" id="searchInput" type="text" placeholder="Search for News">
                    </div>
                    <div class="control">
                        <button type="submit" id="search" class="button is-info">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="/images/Not-Found.webp">
            </figure>
        </div>
        <div class="is-overlay columns is-mobile is-centered is-vcentered">
            <span class="tag is-large is-primary">Sorry we couldn't find anything :(</span>
        </div>
    </div>
@endsection

@section('dashboardScript')
    <script>
        // Get the input field
        var input = document.getElementById("searchInput");

        // Execute a function when the user presses a key on the keyboard
        input.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("search").click();
            }
        });
    </script>
@endsection
