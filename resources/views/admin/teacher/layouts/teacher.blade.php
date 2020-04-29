<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page Teacher</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<style>
    body{
        margin-top:80px;
    }
    body {
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
    main {
        margin-top: 80px;
    }
</style>
<body>
    <header>
       @include('admin.teacher.layouts.blocks.nav.index')
    </header>
    <div id="app">
        <div class="wrapper">
            <main>
                @yield('form')
            </main>
            <footer>
                <footer-component></footer-component>
            </footer>
        </div>
    </div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
