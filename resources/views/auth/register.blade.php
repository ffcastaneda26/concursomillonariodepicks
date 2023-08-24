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
                        <label class="block text-sm font-medium text-gray-700">Nombre(s)</label>
                        <input type="text" name="first_name" :value="old('first_name')" class="mt-1 p-2 w-full border rounded-md" required autofocus autocomplete="name" maxlength="50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido(s)</label>
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

                {{-- Hombre o Mujer --}}
                <div class="mt-2">
                    <div class="flex justify-between">
                        <!--Botón para Hombre-->
                        <div class="inline-block ml-5">
                          <input
                            class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                            type="radio"
                            name="gender"
                            id="hombre"
                            value="Hombre"
                            required/>
                            <label class=" ml-2 mt-px inline-block pl-[0.15rem] hover:cursor-pointer" for="hombre">
                                <img src="{{ asset('images/hombre.png') }}" alt="Hombre" width="25" height="25">
                            </label
                          >
                        </div>

                        <!--Botón para Mujer -->
                        <div class="inline-block ml-5">
                            <input
                                class="relative float-right h-5 w-5 appearance-none rounded-full border-2 border-solid checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                type="radio"
                                name="gender"
                                id="mujer"
                                value="Mujer"
                                required/>
                            <label class="mt-px inline-block pl-[0.15rem] hover:cursor-pointer"for="mujer">
                                <img src="{{ asset('images/mujer.png') }}" alt="Mujer" width="25" height="25">
                            </label>

                        </div>
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
                </div>

                {{-- Aceptar términos y condiciones como la política de privacidad --}}
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
