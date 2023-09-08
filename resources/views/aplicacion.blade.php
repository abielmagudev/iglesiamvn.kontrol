<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/mvn-favicon-b.png') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .has-background-light-hoverable {
                background-color: inherit;
            }
            .has-background-light-hoverable:hover {
                background-color: rgba(0, 0, 0, 0.02);
            }
            .has-text-nowrap {
                white-space: nowrap;
            }
            .is-text-ellipsis {
                /* Define the width */
                overflow: hidden; 
                text-overflow: ellipsis; 
                white-space: nowrap;
            }
            .is-width-100 {
                width:100%;
            }
            .is-borderless {
                border-width: 0px !important;
            }
            .is-border-colorless {
                border-color: none !important;
            }
        </style>
    </head>
    <body class="has-background-light">
        @auth
            @include('aplicacion.navbar')
            <div style="min-height:100vh">
                <div class="container">
                    <section class="section">
                        <x-notification></x-notification>
                        <x-custom.search-miembros />
                        @yield('contenido')
                    </section>
                </div>
            </div>
            @include('aplicacion.scripts.bulma')
            @include('aplicacion.scripts.helpers')

        @else
            @yield('contenido')

        @endauth
        
        @stack('scripts')
    </body>
</html>
