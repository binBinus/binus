<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InstaClass</title>
    <link rel="stylesheet" href="css/landing-page.css">
</head>
<body>

    <section class="showcase">
        <header>
            <h2 class="logo">InstaClass</h2>
        </header>
        
        <div class="overlay"></div>
        <div class="text">
            <h2>Never Stop</h2>
            <h3>Learning</h3>
            <p>
                You Will Never Grow Unless You Try To Do Something <br>Beyond What You Have Already Mastered.
            </p>
            <a href="{{ route('register') }}"> Register Now! </a>
                @if (Route::has('login'))
            @auth
                <a href="{{ url('join-class') }}">Continue Your Session</a>
            @else
                {{-- display navbar with login here --}}
                <a href="{{ route('login') }}">Login</a>
            @endauth
    @endif
        </div>
    </section>

</body>
</html>