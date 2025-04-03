@extends('layouts.app')
@section('title', 'List WorkOrder')
@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">List SPP</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center space-y-7 space-x-4">
            <div class="flex items-center space-y-7 space-x-4">
                <form id="filterForm" action="{{ route('workorder.filter') }}" method="GET"
                    class="flex items-center space-x-4">
                    <div>
                        <label for="status-filter" class="block text-gray-700 text-sm font-bold mb-2">Filter by
                            Status:</label>
                        <select id="status-filter" name="status" onchange="handleStatusChange()"
                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="All">All Status</option>
                            <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum
                                Bayar</option>
                            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>
                    @if (auth()->user()->role === 'finance')
                        <div>
                            <label for="assigned-filter" class="block text-gray-700 text-sm font-bold mb-2">Filter by
                                Siswa:</label>
                            <select id="assigned-filter" name="user_id" onchange="handleStatusChange()"
                                class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="All">All Siswa</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}"
                                        {{ request('user_id') == $operator->id ? 'selected' : '' }}>
                                        {{ $operator->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </form>
                <button onclick="exportFilteredPdf()"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Export PDF
                </button>
            </div>
            @if (auth()->user()->role === 'finance')
                <a href="{{ route('workorder.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    New SPP
                </a>
            @endif
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <table id="workOrderTable" class="min-w-full table-auto display">
                <thead>
                    <tr class="bg-gray-200 text-black-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Siswa</th>
                        <th class="py-3 px-6 text-left">Kelas</th>
                        <th class="py-3 px-6 text-left">Jumlah</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Tanggal Pembayaran</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($workOrders as $workorder)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $workorder->id }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $workorder->siswa_name }}</td>
                            <td class="py-3 px-6 text-left">{{ $workorder->kelas }}</td>
                            <td class="py-3 px-6 text-left">Rp {{ number_format($workorder->jumlah, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left">{{ $workorder->status }}</td>
                            <td class="py-3 px-6 text-center">{{ $workorder->tanggal_pembayaran }}</td>
                            <td class="py-3 px-6 text-center">
                                @if (auth()->user()->role !== 'siswa')
                                    <div class="flex item-center justify-center">
                                        <button onclick="openEditModal('{{ encrypt($workorder->id) }}')"
                                            class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('workorder.delete', encrypt($workorder->id)) }}"
                                            class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="milestoneModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative w-full max-w-3xl bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold">Work Order Milestone</h3>
                    <button onclick="closeMilestoneModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6" id="milestoneModalContent"></div>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative w-full max-w-3xl bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold">Edit Work Order</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6" id="editModalContent"></div>
            </div>
        </div>
    </div>
@endsection
