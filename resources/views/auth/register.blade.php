<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Họ và Tên')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-label for="image" :value="__('Ảnh đại diện')" />

                <x-input id="image" class="block mt-1 w-full" type="file" accept="image/png, image/gif, image/jpeg, image/jpg, img/svg, img/heic" name="image" :value="old('image')" />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="image" :value="__('Giới tính')" />
                    <div class="" style="display: inline-block; align-items: center; text-align: center">
                        <input type="radio" id="gender1" name="gender" value="1" checked>
                        <label for="gender1" style="margin-right: 24px">
                            Nam
                        </label>
                        <input type="radio" id="gender2" name="gender" value="0">
                        <label for="gender2">
                            Nữ
                        </label>
                    </div>
            </div>

            <!-- Birthday -->
            <div class="mt-4">
                <x-label for="birthday" :value="__('Ngày sinh')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Số điện thoại')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="address" :value="__('Địa chỉ')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mật khẩu')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Bạn đã có tài khoản?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Đăng ký') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
