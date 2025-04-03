<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiSPP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-800">
                    SiSPP
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Silakan login untuk melanjutkan
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-stone-500 focus:border-stone-500 focus:z-10 sm:text-sm"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-stone-500 focus:border-stone-500 focus:z-10 sm:text-sm"
                            placeholder="Password">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
<div class="fixed inset-0 bg-white z-50" x-data="{ show: true }" x-show="show"
    x-transition:enter="transition-all duration-1000" x-transition:leave="transition-all duration-1000"
    x-init="setTimeout(() => show = false, 3000)">

    <div class="flex flex-col items-center justify-center h-screen">
        <div class="animate-bounce mb-8">
            <div class="animate-bounce mb-8">
                <img src="{{ asset('image/SiSPP-nobg.jpg') }}" alt="Logo" class="w-24 h-24">
            </div>
        </div>
        <h1 class="text-4xl font-bold text-stone-800 mb-4 animate-pulse">
            Selamat Datang di SiSPP
        </h1>
        <p class="text-stone-700 text-xl opacity-75 text-center px-4">
            Sistem Informasi SPP
        </p>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</script>
</div>
