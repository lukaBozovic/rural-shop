<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100"
    style="background-color: #D4E9D7">
    <div>
        @isset($logo)
            {{ $logo }}
        @else
            <Link href="/">
                <img src="{{ asset('logo.png') }}" alt="logo" class="ml-7 w-4/5 h-4/5">
            </Link>
        @endisset
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
