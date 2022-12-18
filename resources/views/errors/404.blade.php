<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/error.css" />
    <title>404</title>

</head>
<body>


<h1>404</h1>
<div class="cloak__wrapper">
    <div class="cloak__container">
        <div class="cloak"></div>
    </div>
</div>
<div class="info">
    <h2>We can't find that page</h2>
    <p>We're fairly sure that page used to be here, but seems to have gone missing. We do apologise on it's behalf.</p>
    <a href="{{ url()->previous() }}" target="_blank" rel="noreferrer noopener">Back</a>
    <a href="{{route('home')}}" target="_blank" rel="noreferrer noopener">Home</a>
</div>

</body>


</html>

