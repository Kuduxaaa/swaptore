<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">

        <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">
        <title>{{ env('APP_NAME') }} &mdash; Admin panel</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/icons.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}" />
        <script src="{{ asset('assets/admin/js/modernizr.min.js') }}"></script>

    </head>
    <body class="bg-transparent">

        @yield('body')

        <script>
            var resizefunc = [];
        </script>

        <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/detect.js') }}"></script>
        <script src="{{ asset('assets/admin/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/admin/js/waves.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.app.js') }}"></script>

    </body>
</html>