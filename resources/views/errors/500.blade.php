<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/error.css" />
    <title>500</title>

</head>
<body>


<h1>500</h1>
<div class="cloak__wrapper">
    <div class="cloak__container">
        <div class="cloak"></div>
    </div>
</div>
<div class="info">
    <h2>Unexpected Error</h2>
    <p>It's not your fault. We currently don't know what went wrong. We suggest that you go back or to the home page</p>
    <a href="{{ url()->previous() }}" target="_blank" rel="noreferrer noopener">Back</a>
    <a href="{{route('home')}}" target="_blank" rel="noreferrer noopener">Home</a>
</div>

</body>


</html>


