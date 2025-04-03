<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h4 class="text-lg font-semibold">WO Number: {{ $workorder->wo_number }}</h4>
        <span class="px-3 py-1 text-sm rounded-full 
            {{ $workorder->status === 'completed' ? 'bg-green-100 text-green-800' :
    ($workorder->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
        ($workorder->status === 'canceled' ? 'bg-red-100 text-red-800' :
            'bg-blue-100 text-blue-800')) }}">
            {{ ucfirst($workorder->status) }}
        </span>
    </div>

    <div class="border-t pt-4">
        <h5 class="font-semibold mb-4">Status Timeline</h5>
        <div class="space-y-6">
            <!-- Pending Status -->
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12">
                    <div class="h-4 w-4 rounded-full {{ $workorder->created_at ? 'bg-yellow-500' : 'bg-gray-300' }}">
                    </div>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">Pending</p>
                    @if($workorder->created_at)
                        <p class="text-xs text-gray-500">
                            {{ $workorder->created_at->format('d M Y, H:i') }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400">Not set</p>
                    @endif
                </div>
            </div>

            <!-- In Progress Status -->
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12">
                    <div class="h-4 w-4 rounded-full {{ $workorder->inprogress_at ? 'bg-blue-500' : 'bg-gray-300' }}">
                    </div>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">In Progress</p>
                    @if($workorder->inprogress_at)
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($workorder->inprogress_at)->format('d M Y, H:i') }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400">Not set</p>
                    @endif
                </div>
            </div>

            <!-- Completed Status -->
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12">
                    <div class="h-4 w-4 rounded-full {{ $workorder->completed_at ? 'bg-green-500' : 'bg-gray-300' }}">
                    </div>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">Completed</p>
                    @if($workorder->completed_at)
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($workorder->completed_at)->format('d M Y, H:i') }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400">Not set</p>
                    @endif
                </div>
            </div>

            <!-- Canceled Status -->
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12">
                    <div class="h-4 w-4 rounded-full {{ $workorder->canceled_at ? 'bg-red-500' : 'bg-gray-300' }}">
                    </div>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">Canceled</p>
                    @if($workorder->canceled_at)
                        <p class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($workorder->canceled_at)->format('d M Y, H:i') }}
                        </p>
                    @else
                        <p class="text-xs text-gray-400">Not set</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t">
        <button type="button" onclick="closeMilestoneModal()"
            class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
            Close
        </button>
    </div>
</div>