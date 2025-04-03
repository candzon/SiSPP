<aside class="w-64 min-h-screen bg-gray-800 text-white transition-all duration-200 flex flex-col">
    <!-- Top Logo Section -->
    <div class=" d-flex flex-col items-center gap-3 px-5 py-5">
        <img src="{{ asset('image/SiSPP-nobg.jpg') }}" alt="Logo" class="w-12 object-cover">
        <h1 class="text-xl font-bold text-white">SISPP</h1>
    </div>


    <nav class="mt-4 flex-grow">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-2 hover:bg-gray-700 transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <!-- Manajemen WorkOrder -->
        <div x-data="{ open: false }" class="mt-4">
            <button @click="open = !open"
                class="w-full px-4 py-2 flex items-center justify-between hover:bg-gray-700 transition-colors duration-150">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-semibold">Manajemen SPP</span>
                </div>
                <svg class="w-4 h-4 transform transition-transform duration-150" :class="{ 'rotate-180': open }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="transform opacity-0 -translate-y-2"
                x-transition:enter-end="transform opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="transform opacity-100 translate-y-0"
                x-transition:leave-end="transform opacity-0 -translate-y-2" class="space-y-1">
                <a href="{{ route('workorder.index') }}"
                    class="flex items-center px-8 py-2 hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('workorder.index') ? 'bg-gray-700' : '' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    List SPP
                </a>
                @if (auth()->user()->role === 'finance')
                    <a href="{{ route('workorder.create') }}"
                        class="flex items-center px-8 py-2 hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('workorder.create') ? 'bg-gray-700' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New SPP
                    </a>
                @endif
            </div>
        </div>

        <!-- Manajemen Operator -->
        @if (auth()->user()->role == 'finance')
            <div x-data="{ open: false }" class="mt-4">
                <button @click="open = !open"
                    class="w-full px-4 py-2 flex items-center justify-between hover:bg-gray-700 transition-colors duration-150">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-semibold">Manajemen Akun</span>
                    </div>
                    <svg class="w-4 h-4 transform transition-transform duration-150" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="transform opacity-0 -translate-y-2"
                    x-transition:enter-end="transform opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="transform opacity-100 translate-y-0"
                    x-transition:leave-end="transform opacity-0 -translate-y-2" class="space-y-1">
                    <a href="{{ route('operator.index') }}"
                        class="flex items-center px-8 py-2 hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('operator.index') ? 'bg-gray-700' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        List Akun
                    </a>
                    <a href="{{ route('operator.create') }}"
                        class="flex items-center px-8 py-2 hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('operator.create') ? 'bg-gray-700' : '' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        New Akun
                    </a>
                </div>
            </div>
        @endif

        <!-- Logout Sidebar -->
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-2 hover:bg-gray-700 transition-colors duration-150 text-left">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </nav>
</aside>

@push('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
