@php use Support\Settings\AppearanceSettings; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @php
        function hexToRgb($hex) {
            $hex = ltrim($hex, '#');

            if(strlen($hex) == 3) {
                $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
            } else {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }

            return "{$r}, {$g}, {$b}";
        }

        try {
            $appearanceSettings = app(AppearanceSettings::class);
            $fontFamily = $appearanceSettings->font_family ?? 'Inter, sans-serif';
            $primaryColor = $appearanceSettings->primary_color ?? AppearanceSettings::DEFAULT_PRIMARY_COLOR;
            $secondaryColor = $appearanceSettings->secondary_color ?? AppearanceSettings::DEFAULT_SECONDARY_COLOR;
            $logoPath = '/storage/' . $appearanceSettings->logo_path ?? AppearanceSettings::DEFAULT_LOGO;
        } catch (\Throwable $e) {
            // If settings are not available (e.g., during testing), use defaults
            $fontFamily = 'Inter, sans-serif';
            $primaryColor = AppearanceSettings::DEFAULT_PRIMARY_COLOR;
            $secondaryColor = AppearanceSettings::DEFAULT_SECONDARY_COLOR;
            $logoPath = AppearanceSettings::DEFAULT_LOGO;
        }
    @endphp

    {{ filament()->getFontHtml() }}

    <!-- Styles -->
    @vite(['src/App/resources/css/auth.css'])

    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --primary-color-hover: {{ $primaryColor }}dd;
            --primary-color-rgb: {{ hexToRgb($primaryColor) }};
            --secondary-color: {{ $secondaryColor }};
            --secondary-color-rgb: {{ hexToRgb($secondaryColor) }};
            --font-family: {{ $fontFamily }};
        }

        body {
            font-family: var(--font-family);
        }
    </style>

    <!-- Google SSO Button Styles -->
    <link rel="stylesheet" href="{{ asset('css/google-sso.css') }}">
</head>
<body>
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <img src="{{ $logoPath }}" alt="{{ config('app.name', 'Laravel') }}">
            </div>
        </div>

        <div class="auth-body">
            @yield('content')
        </div>

        @hasSection('footer')
            <div class="auth-footer">
                @yield('footer')
            </div>
        @endif
    </div>
</div>
</body>
</html>
