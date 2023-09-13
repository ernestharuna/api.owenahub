<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            background: #F6F7F8;
            font-family: Tahoma, sans-serif;
        }

        body div {
            padding: 1rem 2rem;
            margin: 10rem auto;
            border: 1px solid #000;
            border-radius: 3px;
            text-align: center;
            background: #fff;
            width: max-content;
            box-shadow: 0 2px 5px 0 #00000060;
        }

        small {
            color: #989898;
        }
    </style>
</head>

<body class="antialiased">
    <div>
        <p> Hello <b>World!</b> </p>
        <p>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </p>
        <p><small>owenahub</small></p>
    </div>
</body>

</html>
