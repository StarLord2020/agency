<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        header {
            position: fixed;
            width: 100%;
            z-index: 100;
            top: 0;
            background-color: #051d2c;
        }
        body {
            padding-top: 70px;
            height: 100%;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex: 0 0 auto;
        }

    </style>
</head>
<body>
    <header>
        @include('student.layouts.blocks.nav.index')
    </header>
    <div id="app">
        <div class="wrapper">
            <main>
                @yield('content')
            </main>
            <footer>
                <footer-component></footer-component>
            </footer>
        </div>
    </div>

    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>
