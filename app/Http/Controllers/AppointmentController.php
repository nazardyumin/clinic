<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\AppointmentHelper;

class AppointmentController extends Controller
{
    public function show(string $id = null)
    {
        $specialities = Speciality::all();
        return view('appointments.appointments', compact('specialities'));
    }

    public function redirect_from_doctors_page(string $id)
    {
        $response = AppointmentHelper::get_doctor_appointments($id);
        $doctors = Doctor::where('speciality_id', '=', $response['doctor']->speciality_id)->get();
        session(['doctor' => $response['doctor'], 'doctors' => $doctors, 'appointments' => $response['appointments'], 'count' => $response['count']]);
        return redirect(route('appointments'));
    }

    // public function redirect_from_ajax(string $id)
    // {
    //     $response = AppointmentHelper::get_doctor_appointments($id);
    //     $doctors = Doctor::where('speciality_id', '=', $response['doctor']->speciality_id)->get();
    //     $specialities = Speciality::all();
    //     session(['doctor' => $response['doctor'], 'doctors' => $doctors, 'appointments' => $response['appointments'], 'count' => $response['count']]);
    //     return view('appointments.appointments', compact('specialities'));
    // }

    public function get_doctors(string $id)
    {
        $doctors = Doctor::where('speciality_id', $id)->get();
        return response()->json($doctors);
    }

    public function get_appointments(string $id)
    {
        $response = AppointmentHelper::get_doctor_appointments($id);
        return response()->json(['appointments' => $response['appointments'], 'count' => $response['count']]);
    }

    public function save_appointment(Request $request)
    {
        if ($request->appointment_id) {
            //TODO add model, controller, save appointment to DB!!!
            return redirect(route('home'));
        }
        $response = AppointmentHelper::get_doctor_appointments($request->doctor_id);
        $doctors = Doctor::where('speciality_id', '=', $response['doctor']->speciality_id)->get();
        session(['doctor' => $response['doctor'], 'doctors' => $doctors, 'appointments' => $response['appointments'], 'count' => $response['count']]);
        return redirect(route('appointments'))->withErrors(["appointment_id" => "Не выбрано время для записи"]);
    }
}
