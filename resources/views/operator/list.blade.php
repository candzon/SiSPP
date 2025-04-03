@extends('layouts.app')
@section('title', 'List Siswa')
@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">List Siswa</h1>
            <a href="{{ route('operator.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                New Siswa
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-black-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @if($operators->count() > 0)
                        @foreach($operators as $operator)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $operator->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $operator->email }}</td>
                                <td class="py-3 px-6 text-left">
                                    <span
                                        class="{{ $operator->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} py-1 px-3 rounded-full text-xs">
                                        {{ $operator->is_active ? 'Active' : 'Non Active' }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ \Carbon\Carbon::parse($operator->created_at)->locale('id')->isoFormat('LL') }}</td>
                                <td class="py-3 px-6">
                                    <div class="flex item-center justify-center">
                                        <button onclick="openEditOperatorModal('{{ encrypt($operator->id) }}')"
                                            class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('operator.delete', encrypt($operator->id)) }}"
                                            class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-6 text-center" colspan="7">Tidak ada data rapat</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="editOperatorModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative w-full max-w-3xl bg-white rounded-lg shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold">Edit Siswa</h3>
                    <button onclick="closeEditOperatorModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6" id="editOperatorContent"></div>
            </div>
        </div>
    </div>
@endsection