        {{-- Logias--}}
        <li>
            <a href="{{route('logias')}}" class="waves-effect">
                <i class="mdi mdi-hospital-building"></i>
                <span>Logias</span>
            </a>
        </li>


        {{-- Masones--}}
        <li>
            <a href="{{route('masones')}}" class="waves-effect">
                <i class="mdi mdi-account-tie"></i>
                <span>Masones</span>
            </a>
        </li>

        {{-- Profanos--}}
        <li>
            <a href="{{route('profanos')}}" class="waves-effect">
                <i class="mdi mdi-account-alert"></i>
                <span>Profanos</span>
            </a>
        </li>

        {{-- Referencias de Profanos--}}
        <li>
            <a href="{{route('referencias-profano')}}" class="waves-effect">
                <i class="mdi mdi-account-check"></i>
                <span>Referencias Profano</span>
            </a>
        </li>
    @if(!Auth::user()->isSecretario())
        {{-- Radios--}}

            <li>
                <a href="{{route('radios')}}" class="waves-effect">
                    <i class="mdi mdi-radio"></i>
                    <span>Radios</span>
                </a>
            </li>
    @endif

