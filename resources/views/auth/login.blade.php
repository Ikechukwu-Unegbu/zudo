<x-guest-layout>
    {{-- <x-auth-card> --}}
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <div class="mt-3 new-account">
            <p class="text-sm">Don't have an account? <a class="text-primary" href="{{ route('register.index') }}">Sign up</a></p>
        </div> --}}
    {{-- </x-auth-card> --}}

    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">


        <div class="w-full sm:max-w-md text-center mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="pb-3 border-b mt-5">
                <a href="{{ route('administrator.login') }}">
                    <i class="fa fa-user" style="font-size: 50px"></i>
                </a>
                <br>
                <div>
                    <a href="{{ route('administrator.login') }}" class="btn btn-sm btn-secondary bg-black">Admin</a>
                </div>
            </div>

            <div class="pt-3 mt-5">
                <a href="{{ route('channel.login.index') }}">
                    <i class="fa fa-user" style="font-size: 50px"></i>
                </a>
                <br>
                <div>
                    <a href="{{ route('channel.login.index') }}" class="btn btn-sm btn-secondary bg-black">Channel</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
