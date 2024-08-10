<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('assets/admin.css').'?'.time() }}">
    </head>
    <body class="">

        <div class="container">
            <textarea class="tinymce"></textarea>
        </div>

        <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('assets/admin2.js').'?'.time() }}"></script>
    </body>
</html>
