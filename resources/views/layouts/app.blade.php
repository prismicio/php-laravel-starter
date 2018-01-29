<!DOCTYPE html>
<html lang="en">
<head>
    {{--  Meta  --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--  Meta Title --}}
    <title>Laravel starter for prismic.io</title>

    {{--  Scripts  --}}
    <script>
        // Required for previews and experiments
        window.prismic = {
            endpoint: '{{ $endpoint }}'
        };
    </script>
    <script src="https://static.cdn.prismic.io/prismic.js"></script>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>
