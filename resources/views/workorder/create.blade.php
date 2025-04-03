@extends('layouts.app')
@section('title', 'New WorkOrder')
@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">New SPP</h1>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('workorder.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="assigned">
                        Nama Siswa
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('user_id') border-red-500 @enderror"
                        id="user_id" name="user_id" required>
                        <option value="">Select Siswa</option>
                        @foreach ($operators as $operator)
                            <option value="{{ $operator->id }}" {{ old('user_id') }}>
                                {{ $operator->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kelas">
                        Kelas
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kelas') border-red-500 @enderror"
                        id="kelas" type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Enter Kelas"
                        required>
                    @error('kelas')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jumlah">
                        Jumlah
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jumlah') border-red-500 @enderror"
                        id="jumlah" type="number" name="jumlah" value="{{ old('jumlah') }}" placeholder="Enter Jumlah"
                        required>
                    @error('jumlah')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                        id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="belum_bayar" {{ old('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar
                        </option>
                        <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        </div>

        <div class="flex">

            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105"
                type="submit">
                Simpan
            </button>
            <a href="{{ route('workorder.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                Batal
            </a>
        </div>
        </form>
    </div>
    </div>
@endsection
