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

    public function edit($appointment)
    {
        $appointment = Appointment::findOrFail($appointment);

        return view('appointment.edit', compact('appointment'));
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
        
            return redirect()->route('appointments.index')->withSuccess(__('Appointment created successfully.'));;
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
        
            return redirect()->back()->with('error', 'An error occurred while creating the appointment.');
        }
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|exists:appointments,id',
                'name' => 'required',
                'phone' => 'required',
                'date' => 'required|date_format:Y-m-d H:i:s'
            ]);
        
            DB::beginTransaction();
        
            $appointment = Appointment::findOrFail($validatedData['id']);
        
            $appointment->update([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'appointment_date' => $validatedData['date'],
            ]);
        
            DB::commit();
        
            session()->flash('success', 'Appointment updated successfully.');
        
            return redirect()->route('appointments.index')->withSuccess(__('Appointment updated successfully.'));
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
        
            return redirect()->back()->with('error', 'An error occurred while updating the appointment.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($appointment)
    {
        $appointment = Appointment::findOrFail($appointment)->delete();

        return redirect()->route('appointments.index')->withSuccess(__('Appointment deleted successfully.'));
    }
}
