<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MarketPlace</title>
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    </head>
    <body>
        
        @extends('layouts.app')
        @section('content')
            <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
                <div class="d-block text-center">
                    <img src="{{ asset('images/think.svg') }}" class="mb-5" width="150" />
                    <h3>Inicia sesion para comenzar a ver las estadísticas!</h3>
                </div>
            </div>
        @endsection
        
    </body>
</html>
