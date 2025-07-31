<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- test -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script defer data-domain="club.trmc.nl" src="https://analytics.heapreaper.nl/js/script.outbound-links.js"></script>
        <script>window.plausible = window.plausible || function() { (window.plausible.q = window.plausible.q || []).push(arguments) }</script>

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
