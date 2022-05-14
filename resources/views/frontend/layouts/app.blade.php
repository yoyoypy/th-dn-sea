<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @yield('meta')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- Stylesheets & Fonts --}}
    <link href="{{ asset('frontend/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZM91PR5H7B"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-ZM91PR5H7B');
    </script>
</head>

<body data-icon="16">
    {{-- Body Inner --}}
    <div class="body-inner">
        @include('frontend.includes.navbar')

        @yield('content')

        @include('frontend.includes.footer')

    </div>
    {{-- end: Body Inner --}}

    {{-- Scroll top --}}
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    {{-- Plugins --}}
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>

    {{-- Template functions --}}
    <script src="{{ asset('frontend/js/functions.js') }}"></script>

    @livewireScripts
</body>

</html>
