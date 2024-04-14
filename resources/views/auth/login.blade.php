<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}" class="space-y-4">
            <!-- Email Address -->
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required autofocus />
            <x-splade-input id="password" type="password" name="password" label="Lozinka" required autocomplete="current-password" />
            <x-splade-checkbox id="remember_me" name="remember" label="Zapamti me" />

            <div class="flex items-center justify-end">
                <Link class="underline mr-16 text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Registruj se
                </Link>
                @if (Route::has('password.request'))
                    <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        Zaboravili ste lozinku?
                    </Link>
                @endif

                <x-splade-submit style="background-color: #258c3d" class="ml-3" label="Uloguj se" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
