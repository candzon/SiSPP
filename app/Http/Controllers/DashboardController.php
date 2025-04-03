<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        // Dashboard by role operator accounts
        if (auth()->user()->role == 'siswa') {
            $countWorkOrdersByPending = Workorder::countWorkOrderByStatusAssigned('belum_bayar', auth()->id());
            $countWorkOrdersByProgress = Workorder::countWorkOrderByStatusAssigned('lunas', auth()->id());
            $countWorkOrdersByCompleted = Workorder::countWorkOrderByStatusAssigned('completed', auth()->id()); // Tidak digunakan
            $countWorkOrdersByCanceled = Workorder::countWorkOrderByStatusAssigned('canceled', auth()->id()); // Tidak digunakan

            return view('dashboard', compact(
                'countWorkOrdersByPending',
                'countWorkOrdersByProgress',
                'countWorkOrdersByCompleted',
                'countWorkOrdersByCanceled'
            ));
        }

        $countWorkOrdersByPending = Workorder::countWorkOrderByStatus('belum_bayar');
        $countWorkOrdersByProgress = Workorder::countWorkOrderByStatus('lunas');
        $countWorkOrdersByCompleted = Workorder::countWorkOrderByStatus('completed'); // Tidak digunakan
        $countWorkOrdersByCanceled = Workorder::countWorkOrderByStatus('canceled'); // Tidak digunakan

        return view('dashboard', compact(
            'countWorkOrdersByPending',
            'countWorkOrdersByProgress',
            'countWorkOrdersByCompleted', 
            'countWorkOrdersByCanceled'
        ));
    }
}