<form id="editForm" action="{{ route('workorder.update', encrypt($workorder->id)) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    
    <!-- Product Name Input -->
    <!-- Nama Siswa Select -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
            Nama Siswa<span class="text-red-500">*</span>
        </label>
        <input type="text" name="id" value="{{ $workorder->id }}" hidden>
        <select 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('user_id') border-red-500 @enderror"
            id="user_id"
            name="user_id"
            required
        >
            <option value="">Select Siswa</option>
            @foreach($operators as $operator)
                <option 
                    value="{{ $operator->id }}" 
                    {{ old('user_id', $workorder->user_id) == $operator->id ? 'selected' : '' }}
                >
                    {{ $operator->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <!-- Kelas Input -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="kelas">
            Kelas<span class="text-red-500">*</span>
        </label>
        <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kelas') border-red-500 @enderror"
            id="kelas"
            type="text"
            name="kelas"
            value="{{ old('kelas', $workorder->kelas) }}"
            placeholder="Enter Kelas"
            required
        >
        @error('kelas')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <!-- Jumlah Input -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="jumlah">
            Jumlah<span class="text-red-500">*</span>
        </label>
        <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jumlah') border-red-500 @enderror"
            id="jumlah"
            type="number"
            name="jumlah"
            value="{{ old('jumlah', number_format($workorder->jumlah, 0, '', '')) }}"
            placeholder="Enter Jumlah"
            required
        >
        @error('jumlah')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <!-- Status Select -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
            Status<span class="text-red-500">*</span>
        </label>
        <select 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
            id="status"
            name="status"
            required
        >
            <option value="">Select Status</option>
            <option value="belum_bayar" {{ old('status', $workorder->status) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
            <option value="lunas" {{ old('status', $workorder->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        @error('status')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

     <!-- Update Form Actions -->
     <div class="flex justify-end space-x-4">
        <button 
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Update
        </button>
        <button 
            type="button"
            onclick="closeEditModal()"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
            Cancel
        </button>
    </div>
</form>

<script>
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeEditModal();
            window.location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>