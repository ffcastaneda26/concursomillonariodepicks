<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            @include('layouts.home.logo')
            <!-- Botón contraer barra lateral -->
            @include('layouts.home.button_show_hide_lateral_menu')
            {{--  Titulo del Componente  --}}
            @yield('main_title')
        </div>
        <div class="text-center">
            {{-- <img src="{{asset('images/logo.png')}}" alt="" class="w-auto p-2" height="60x"> --}}
            @auth
                <img  src="{{asset('images/logo.png')}}" class="avatar-xs">

            @else
                <img  src="{{asset('images/logo.png')}}" class="avatar-xs">

            @endauth
        </div>
        <div class="d-flex">
            <!-- Cambio de idioma -->

            @if(env('APP_MULTI_LANGUAGE',false))
                @include('layouts.home.change_language')
            @endif
            {{--  Profile / Logout  --}}
            {{-- @include('layouts.home.profile_logout') --}}
        </div>
    </div>
</header>
