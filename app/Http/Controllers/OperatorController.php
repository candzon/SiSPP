<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Jika role bukan manager mengakses url manajemen operator maka akan dialihkan ke page 403
        $response = $this->IfRoleNotManagerReturnErrorPages(request());
        if ($response) {
            return $response;
        }

        //Get users role operator
        $operators = User::getOperators();

        return view('operator.list', compact('operators'));
    }

    public function create()
    {
        // Jika role bukan manager mengakses url manajemen operator maka akan dialihkan ke page 403
        $response = $this->IfRoleNotManagerReturnErrorPages(request());
        if ($response) {
            return $response;
        }
        return view('operator.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $validated = $request->only(['name', 'email']);
        $validated['password'] = bcrypt($request->password);
        $validated['role'] = 'siswa';
        $validated['is_active'] = 1;

        // create the operator
        User::create($validated);

        return redirect()->route('operator.index')->with('success', 'Operator created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $decryptedId = decrypt($id);

        // validate the request
        $validated = $request->validate([
            'name' => ['string'],
            'email' => ['email'],
            'password' => ['nullable', 'min:8'],
        ]);

        if ($request->password) {
            $validated['password'] = bcrypt($request->password);
        }

        // update the operator
        $operator = User::findOrFail($decryptedId);
        $operator->update($validated);

        return redirect()->route('operator.index')
            ->with('success', 'Operator updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $decryptedId = decrypt($id);
        // delete the operator
        $operator = User::findOrFail($decryptedId);
        $operator->delete();

        return redirect()->route('operator.index')
            ->with('success', 'Operator deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decryptedId = decrypt($id);
        // get the operator
        $operator = User::findOrFail($decryptedId);

        return view('operator.edit', compact('operator'));
    }

    public function IfRoleNotManagerReturnErrorPages(Request $request)
    {
        if (!$request->user()->isManager()) {
            return view('errors.403');
        }
    }
}
