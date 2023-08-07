<div class="vertical-menu">
    <div data-simplebar="init" class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: -15px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <!--- Sidemenu -->
                            <div id="sidebar-menu" class="mm-active">
                                <!-- Left Menu Start -->
                                <ul class="metismenu list-unstyled mm-show" id="side-menu">
                                    {{-- <li class="menu-title">Main</li> --}}
                                    <li class="mm-active">
                                        <a href="{{route('dashboard')}}" class="waves-effect mm-active">
                                            <i class="mdi mdi-view-dashboard"></i>
                                            <span> {{__('Dashboard')}} </span>
                                        </a>

                                    </li>
                                    @auth
                                        @include('layouts.menus.menu')
                                    @endauth

                                </ul>
                            </div>
                            <!-- Sidebar -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
