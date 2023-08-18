<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        {{-- <div class="flex justify-center items-center h-screen"> --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf
                {{-- Nombre y apellido --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="first_name" :value="old('first_name')" class="mt-1 p-2 w-full border rounded-md" required autofocus autocomplete="name" maxlength="50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" name="last_name" :value="old('last_name')" class="mt-1 p-2 w-full border rounded-md" required maxlength="50">
                    </div>
                </div>

                {{-- Correo y Teléfono --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="email"
                                name="email"
                                :value="old('email')"
                                class="mt-1 p-2 w-full border rounded-md"
                                       required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono (Números)</label>
                        <input type="text"
                                name="phone"
                                :value="old('phone')"
                                class="mt-1 p-2 w-full border rounded-md"
                                required
                                maxlength="10"
                                minlength="10"
                                pattern="[0-9]+">
                    </div>
                </div>

                {{-- Fecha de Nacimiento y Curp --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha Nacimiento</label>
                           <input type="date"
                                name="birthday"
                                max="{{Carbon\Carbon::now()->subYear(18)->format('Y-m-d')}}"
                                :value="old('birthday')"
                                class="mt-1 p-2 w-full border rounded-md"
                                required
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Curp</label>
                        <input type="text"
                                name="curp"
                                :value="old('curp')"
                                class="mt-1 p-2 w-full border rounded-md"
                                required
                                maxlength="18"
                                minlength="18"
                                pattern="^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$"
                        >
                    </div>
                </div>

                {{-- Contraseña y confirmación --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password"  name="password" class="mt-1 p-2 w-full border rounded-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirme Contraseña</label>
                        <input type="password"  name="password_confirmation" class="mt-1 p-2 w-full border rounded-md" required>
                    </div>
                </div>

                <div class="row align-items-start">


                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        Acepto los <a target="_blank" href="{{ route('terms.show') }} "
                                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                        {{ __('Terms of Service')  }}
                                                    </a>
                                        y <a target="_blank" href="{{ route('policy.show') }} "
                                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                {{ __('Privacy Policy')  }}
                                            </a>
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        {{-- </div> --}}

    </x-authentication-card>
</x-guest-layout>
