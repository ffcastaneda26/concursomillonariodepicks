<div class="main-content" id="result">
    <div class="page-content">
        {{ $slot }}
{{--          @yield('content')  --}}
        @stack('modals')
    </div>
</div>
