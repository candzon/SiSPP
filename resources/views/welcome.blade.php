<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <div class="relative min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Your App</h1>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center"></div>
                <h2 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                    <span class="block">Welcome to</span>
                    <span class="block text-indigo-600">Your Amazing App</span>
                </h2>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-400 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Start building something wonderful today. Your journey begins here.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow"></div>
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                            Get Started
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3"></div>
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Section -->
        <div class="bg-white dark:bg-gray-800 py-12"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Feature One</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-300">
                            Description of your first amazing feature.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Feature Two</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-300">
                            Description of your second amazing feature.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Feature Three</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-300">
                            Description of your third amazing feature.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 mt-12">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:mt-0">
                    <p class="text-center text-base text-gray-400"></p>
                        &copy; {{ date('Y') }} Your Company. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
