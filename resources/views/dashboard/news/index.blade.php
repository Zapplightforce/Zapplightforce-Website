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
<section class="blog-posts">
    <div class="container">
        <div class="columns">
            <div class="column is-10 is-offset-1">
                <div class="columns featured-post is-multiline">
                    <div class="column is-12 post">
                        <article class="columns featured">
                                @foreach($articles as $article)
                            <div class="column is-7 post-img ">
                                <img src="{{$article['urlToImage']}}" alt="">
                            </div>
                            <div class="column is-5 featured-content va">
                                <div>
                                    <h3 class="heading post-category">{{$article['author']}}</h3>
                                    <h1 class="title post-title">{{$article['title']}}</h1>
                                    <p class="post-excerpt">{{$article['description']}}</p>
                                    <br>
                                    <a href="{{$article['url']}}" class="button is-primary">Visit Article</a>
                                </div>

                            </div>
                                    @break($loop->iteration == 1)
                            @endforeach
                        </article>
                    </div>
                </div>
                <hr>
                <div class="columns is-multiline">
                    @foreach($articles as $article)

                        @continue($loop->iteration == 1)
                    <div class="column post is-6">
                        <article class="columns is-multiline">
                            <div class="column is-12 post-img">
                                <img src="{{$article['urlToImage']}}" alt="Featured Image">
                            </div>
                            <div class="column is-12 featured-content ">
                                <h3 class="heading post-category">{{$article['author']}}</h3>
                                <h1 class="title post-title">{{$article['title']}}</h1>
                                <p class="post-excerpt">{{$article['description']}}</p>
                                <br>
                                <a href="{{$article['url']}}" class="button is-primary">Visit Article</a>
                            </div>
                        </article>
                    </div>

                    @break($loop->iteration == 3)
                    @endforeach

                    @foreach($articles as $article)
                            @continue($loop->iteration == 1 | $loop->iteration == 2 | $loop->iteration == 3)
                    <div class="column post is-4">
                        <article class="columns is-multiline">
                            <div class="column is-12 post-img">
                                <img src="{{$article['urlToImage']}}" alt="Featured Image">
                            </div>
                            <div class="column is-12 featured-content ">
                                <h3 class="heading post-category">{{$article['author']}}</h3>
                                <h1 class="title post-title">{{$article['title']}}</h1>
                                <p class="post-excerpt">{{$article['description']}}</p>
                                <br>
                                <a href="{{$article['url']}}" class="button is-primary">Visit Article</a>
                            </div>
                        </article>
                    </div>
                            @break($loop->iteration == 7)
                        @endforeach

                </div>
                        {!! $articles->links() !!}

            </div>
        </div>

    </div>
</section>
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
