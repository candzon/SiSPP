@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="bg-red-100 p-6 rounded-lg shadow">
            <h3 class="text-blue-500 text-sm">Belum Bayar</h3>
            <p class="text-4xl font-bold">{{ $countWorkOrdersByPending }}</p>
        </div>

        <div class="bg-green-100 p-6 rounded-lg shadow">
            <h3 class="text-blue-500 text-sm">Lunas</h3>
            <p class="text-4xl font-bold">{{ $countWorkOrdersByCompleted }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div class="col-span-2 bg-blue-100 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Work Order Chart</h2>
            <div class="w-full">
                <canvas id="workOrderChart"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('workOrderChart');
                        const data = {
                            pending: {{ $countWorkOrdersByPending }},
                            completed: {{ $countWorkOrdersByCompleted }}
                        };

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Belum Bayar', 'Lunas'],
                                datasets: [{
                                    label: 'Jumlah',
                                    data: [data.pending, data.completed],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(75, 192, 192, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        align: 'start',
                                        display: false
                                    }
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection