<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon-black.png') }}" type="image/png">
    <title>Boxyfay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/js/ecommerceloader.js'])
    @livewireStyles
</head>

<body>
    <x-navbar />
    <div class="min-vh-100">
        {{ $slot }}
    </div>

    <x-footer />
    <script src="https://kit.fontawesome.com/9e19a67773.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.16/build/spline-viewer.js"></script>


    @livewireScripts
</body>

</html>
