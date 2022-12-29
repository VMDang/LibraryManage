<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.change') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="Name" :value="__('Họ và Tên')" />

                <x-input id="Name" class="block mt-1 w-full" type="text" name="Name" value="{{$user_name}}" readonly />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user_email}}" readonly />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mật khẩu mới')" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required />
            </div>

            <!-- Logout other device -->
            <div class="block mt-4">
                <label for="logoutOtherDevice" class="inline-flex items-center">
                    <input id="logoutOtherDevice" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="logoutOtherDevice">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Đăng xuất tất cả thiết bị khác') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">
                        {{ __('Trang chủ') }}
                    </a>
                <x-button class="ml-3">
                    {{ __('Đổi mật khẩu') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

