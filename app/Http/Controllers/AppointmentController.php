<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)->get();

        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)->get();

        return view('appointment.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'date' => 'required|date_format:Y-m-d H:i:s'
            ]);
        
            DB::beginTransaction();
        
            $appointment = Appointment::create([
                'user_id' => $request->user()->id,
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'appointment_date' => $validatedData['date'],
            ]);
        
            DB::commit();
        
            session()->flash('success', 'Appointment created successfully.');
        
            return redirect()->route('appointments.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
        
            return redirect()->back()->with('error', 'An error occurred while creating the appointment.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
