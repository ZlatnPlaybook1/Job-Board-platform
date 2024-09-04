<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
@include('theme.layout.head')

<body data-instant-intensity="mousedown">
@include('theme.layout.nav')

    {{-- Differnt Content --}}
    @yield('content')

   @include('theme.layout.footer')

   @include('theme.layout.scripts')

    @yield('customJs')
</body>
</html>
