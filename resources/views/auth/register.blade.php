<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div class="grid grid-row grid-cols-1 text-center">
            <p class="font-bold italic">Introducir nombre completo (Nombres y Apellidos)</p>
            <p class="font-extrabold underlin">El ALIAS es requerido</p>
        </div>
        {{-- <x-validation-errors class="mb-4" /> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-row grid-cols-1">
                <div>
                    <x-label for="name" value="Nombre(s)" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" maxlength="50" required autofocus autocomplete="name" />
                    @error('name')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="grid grid-row grid-cols-1 mt-2">
                <div>
                    <x-label for="alias" value="Alias: Mínimo 6 y Máximo 12 Carácteres" />
                    <x-input id="alias" class="block mt-1 w-full" type="text" name="alias" :value="old('alias')" maxlength="12" minlength="6" required />
                    @error('alias')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="flex flex-grow justify-between md:flex-cols-2 gap-2 mt-2">
                <div class="mt-4">
                    <x-label for="email" value="Correo" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    @error('email')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                </div>

                <div class="mt-4">
                    <x-label for="phone" value="Teléfono" />
                    <x-input id="phone"
                            class="block mt-1 w-full"
                            type="text"
                            name="phone"
                            :value="old('phone')"
                            maxlength="10"
                            minlength="10"
                            required
                            autocomplete="username" />
                            @error('phone')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                </div>

            </div>

            <div class="flex flex-grow justify-between md:flex-cols-2 gap-2">
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <div class="badge rounded-pill bg-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <div class="badge rounded-pill bg-danger  mt-1 w-full">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                {{-- Aceptar ser mayor de edad --}}
            <div class="row align-items-start">
                    <div class="mt-4">
                        <x-label for="adult">
                            <div class="flex items-center">
                                <x-checkbox name="adult" id="adult" required />
                                <div class="ml-2">
                                    <label for="" class="underline text-sm text-red-600 dark:text-gray-400 hover:text-red-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                        ACEPTO SER MAYOR DE EDAD
                                    </label>
                                </div>
                        </x-label>
                    </div>
                    @error('adult')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror
            </div>

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
                            </div>
                            @error('terms')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
