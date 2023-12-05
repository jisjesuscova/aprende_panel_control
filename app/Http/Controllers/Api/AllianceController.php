<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alliance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AllianceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alliances = Alliance::select('id', 'name', 'alias', 'contact', 'contact_email', 'contact_phone', 'start_date', 'end_date', 'status_id')
             ->orderByDesc('id')
             ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $alliances
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $alliance = Alliance::create([
                'status_id' => 1,
                'rut' => $request->rut,
                'name' => $request->name,
                'alias' => $request->alias,
                'contact' => $request->contact,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            return response()->json([
                'success' => true,
                'data' => $alliance
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $alliance = Alliance::find($request->id);

        return response()->json([
            'success' => true,
            'data' => $alliance
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alliance = Alliance::find($id);
        $alliance->rut = $request->rut;
        $alliance->name = $request->name;
        $alliance->alias = $request->alias;
        $alliance->contact = $request->contact;
        $alliance->contact_email = $request->contact_email;
        $alliance->contact_phone = $request->contact_phone;
        $alliance->start_date = $request->start_date;
        $alliance->end_date = $request->end_date;
        $alliance->save();

        return response()->json([
            'success' => true,
            'data' => $alliance
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $alliance = Alliance::find($request->id);
        $alliance->delete();

        return response()->json([
            'success' => true,
            'data' => $alliance
        ], 200);
    }
}
