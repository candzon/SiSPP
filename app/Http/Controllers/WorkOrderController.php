<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $user_id = $request->query('user_id');

        if ($status) {
            if (auth()->user()->role === 'finance') {
                $workOrders = WorkOrder::getWorkOrderByStatus($status, $user_id);
            } else {
                $workOrders = WorkOrder::getWorkOrderByStatus($status, $user_id)
                    ->where('user_id', auth()->user()->id);
            }
        } else {
            if (auth()->user()->role === 'finance') {
                $workOrders = WorkOrder::getWorkOrders();
            } else {
                $workOrders = WorkOrder::getWorkOrders()
                    ->where('user_id', auth()->user()->id);
            }
        }

        $operators = User::getOperators();
        return view('workorder.list', compact('workOrders', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'int'],
            'kelas' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
            'status' => ['required', 'string', 'in:belum_bayar,lunas'],
        ]);

        $validated['tanggal_pembayaran'] = now()->setTimezone('UTC');
        $validated['created_at'] = now()->setTimezone('UTC');
        $validated['updated_at'] = now()->setTimezone('UTC');

        WorkOrder::create($validated);

        return redirect()->route('workorder.index')
            ->with('success', 'SPP berhasil dibuat.');
    }

    /**
     * Update the workorder resource in storage.
     */
    public function update(Request $request, $id)
    {
        $decryptedId = decrypt($id);

        // Your existing validation
        $validated = $request->validate([
            'user_id' => ['int'],
            'kelas' => ['string'],
            'jumlah' => ['integer'],
            'status' => ['string', 'in:belum_bayar,lunas'],
        ]);

        $validated['updated_at'] = now()->setTimezone('UTC');

        WorkOrder::where('id', $decryptedId)->update($validated);
        

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'SPP berhasil diupdate.'
            ]);
        }

        return redirect()->route('workorder.index')
            ->with('success', 'SPP berhasil diupdate.');
    }

    /**
     * Delete or Destroy work order
     */
    public function delete($id)
    {
        $decryptedId = decrypt($id);
        $workorder = WorkOrder::findOrFail($decryptedId);
        $workorder->delete();
        return redirect()->route('workorder.index')
            ->with('success', 'SPP berhasil dihapus.');
    }

    /**
     * Get Milestone View work order
     */
    public function milestone($id)
    {
        $decryptedId = decrypt($id);
        $workorder = WorkOrder::findOrFail($decryptedId);

        if (request()->ajax()) {
            return view('workorder.milestone', compact('workorder'));
        }

        return view('workorder.milestone', compact('workorder'));
    }


    /**
     * Get Edit View work order
     */
    public function edit($id, Request $request)
    {
        $decryptedId = decrypt($id);
        $workorder = WorkOrder::findOrFail($decryptedId);
        $operators = User::getOperators();

        if ($request->ajax()) {
            return view('workorder.edit', compact('workorder', 'operators'));
        }

        return view('workorder.edit', compact('workorder', 'operators'));
    }

    /**
     * Get Create View work order
     */
    public function create()
    {
        // if role is not manager return error pages
        $response = $this->IfRoleNotManagerReturnErrorPages(request());
        if ($response) {
            return $response;
        }

        //Get users if role's operator
        $operators = User::getOperators();
        return view('workorder.create', compact('operators'));
    }

    /**
     * Filter work order by status
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->status;
        $user_id = $request->user_id;

        // Get work orders by status 
        if ($status === 'All' || $user_id === 'All') {
            if (auth()->user()->role === 'finance') {
                if ($status !== 'All') {
                    // Get work orders by status pending, in progress, completed and canceled but all operators
                    $workOrders = WorkOrder::getWorkOrders()->where('status', $status);
                } else if ($user_id !== 'All') {
                    // Get work orders by all status but spesific operator
                    $workOrders = WorkOrder::getWorkOrders()->where('user_id', $user_id);
                } else {
                    // Get work orders by all status and all operators
                    $workOrders = WorkOrder::getWorkOrders();
                }
            } else {
                // Get work orders by status and all operators for operators
                $workOrders = WorkOrder::getWorkOrderByOperator(auth()->user()->id);
            }
            $operators = User::getOperators();
        } else {
            if (auth()->user()->role === 'finance') {
                // Get work orders by status and spesific operator
                $workOrders = WorkOrder::getWorkOrderByStatus($status, $user_id);
            } else {
                // Get work orders by status and spesific operator for operators
                $workOrders = WorkOrder::getWorkOrderByStatus($status, auth()->user()->id);
            }
            $operators = User::getOperators();
        }

        return view('workorder.list', compact('workOrders', 'operators'));
    }

    /**
     * This Function for generated number work order
     */
    public function generatedNumberWO()
    {
        $lastWorkOrder = WorkOrder::lastWorkOrder();

        if (!$lastWorkOrder) {
            $dateFormat = now()->format('Ymd');
            return 'WO-' . $dateFormat . '-001';
        }

        $lastNumber = intval(substr($lastWorkOrder->wo_number, -3));
        $newNumber = $lastNumber + 1;
        $dateFormat = now()->format('Ymd');
        $generatedNumberWO = 'WO-' . $dateFormat . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $generatedNumberWO;
    }

    /**
     * This Function for Report Work Order
     */
    public function exportPdf(Request $request)
    {
        // Get parameters from query
        $status = $request->query('status', 'All');
        $user_id = $request->query('user_id', 'All');

        // Normalize status case
        $normalizedStatus = ucfirst(strtolower($status));

        try {
            // Get filtered work orders based on status, assigned and user role
            if (auth()->user()->role === 'finance') {
                $query = WorkOrder::query();

                if ($status !== 'All') {
                    $dbStatus = str_replace(' ', '_', strtolower($status));
                    $query->where('status', $dbStatus);
                }

                if ($user_id !== 'All') {
                    $query->where('user_id', $user_id);
                }

                $workOrders = $query->get();
            } else {
                // For operators, always filter by their ID
                $query = WorkOrder::where('user_id', auth()->user()->id);

                if ($status !== 'All') {
                    $dbStatus = str_replace(' ', '_', strtolower($status));
                    $query->where('status', $dbStatus);
                }

                $workOrders = $query->get();
            }

            // Get operator name for filename if assigned filter is used
            $operatorName = '';
            if ($user_id !== 'All') {
                $operator = User::find($user_id);
                $operatorName = '-' . Str::slug($operator->name);
            }

            // Configure DomPDF
            $pdf = Pdf::setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'defaultPaperSize' => 'a4',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'chroot' => public_path()
            ]);

            // Get operator data for the view
            $assignedOperator = $user_id !== 'All' ? User::find($user_id) : null;

            // Generate PDF view
            $html = view('template.report', [
                'workOrders' => $workOrders,
                'status' => $normalizedStatus,
                'assignedOperator' => $assignedOperator,
                'exportDate' => now()->setTimezone('UTC')->format('d M Y, H:i')
            ])->render();

            if (empty($html)) {
                throw new \Exception('Template report tidak dapat dibuat');
            }

            $pdf->loadHTML($html);

            // Generate filename with status and operator
            $filename = sprintf(
                'spp-list-%s%s-%s.pdf',
                strtolower($status),
                $operatorName,
                now()->setTimezone('UTC')->format('Y-m-d')
            );

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * This Function for check role is not manager
     */
    public function IfRoleNotManagerReturnErrorPages(Request $request)
    {
        if (!$request->user()->isManager()) {
            return view('errors.403');
        }
    }
}
