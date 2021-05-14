<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('css/app.css').'?v='.date('YmdHis', filemtime(public_path().'/css/app.css')) }}" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <div id="website">
            <div class="mb-2 p-2 text-white bg-primary">
                <div class="container text-right">
                    <user-balance user-id="10"></user-balance>
                </div>
            </div>
            <div class="container">
                <balance-history limit="50"></balance-history>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js').'?v='.date('YmdHis', filemtime(public_path().'/js/app.js')) }}"></script>
    </body>
</html>
