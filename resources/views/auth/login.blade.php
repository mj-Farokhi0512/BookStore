<x-guest-layout>
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
    @if (session('status'))
        <div class="bg-red-500 rounded-md p-2 text-white mb-2">
            {{ session('status') }}
        </div>
    @endif
    <form id="auth_form" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('ایمیل')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus
                autocomplete="username" />
            <div class="errors text-red-600 text-xs mt-1">{{ $errors->get('email') ? $errors->get('email')[0] : '' }}
            </div>
            {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمزعبور')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="current-password" />
            <div class="errors text-red-600 text-xs mt-1">
                {{ $errors->get('password') ? $errors->get('password')[0] : '' }}
            </div>
            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="mr-2 text-sm text-gray-600">{{ __('مرا به خاطر بسپار') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-3">
                {{ __('ورود') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('رمزعبور را فراموش کرده اید؟') }}
                </a>
            @endif

        </div>
    </form>
</x-guest-layout>
