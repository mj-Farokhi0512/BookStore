<x-guest-layout>
    <form id="auth_form" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('نام')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus
                autocomplete="name" />
            <div class="errors text-red-600 text-xs mt-1">{{ $errors->get('name') ? $errors->get('name')[0] : '' }}</div>
            {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('ایمیل')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                autocomplete="email" />
            <div class="errors text-red-600 text-xs mt-1">{{ $errors->get('email') ? $errors->get('email')[0] : '' }}
            </div>

            {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمزعبور')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="new-password" />
            <div class="errors text-red-600 text-xs mt-1">
                {{ $errors->get('password') ? $errors->get('password')[0] : '' }}
            </div>

            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تکرار رمزعبور')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" autocomplete="new-password" />
            <div class="errors text-red-600 text-xs mt-1">
                {{ $errors->get('password_confirmation') ? $errors->get('password_confirmation')[0] : '' }}</div>

            {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class="ml-4">
                {{ __('ثبت نام') }}
            </x-primary-button>

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('حساب دارید؟') }}
            </a>

        </div>
    </form>
</x-guest-layout>
