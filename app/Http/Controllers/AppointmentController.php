<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Speciality;
use DateTime;
use DateTimeZone;

class AppointmentController extends Controller
{
    public function show(string $id = null)
    {
        $specialities = Speciality::all();
        return view('appointments.appointments', compact('specialities'));
    }

    public function redirect_from_doctors_page(string $id)
    {
        $doctor = Doctor::find($id);
        $doctors = Doctor::where('speciality_id','=',$doctor->speciality_id)->get();
        $timeZone = Auth::getUser()->timezone;
        $current_date = new DateTime("now", new DateTimeZone($timeZone));
        $current_date->modify("+15 minutes");
        $appointments = $doctor->appointments;
        $filtered_appointments = $appointments->where('date', '>', $current_date->getTimestamp());
        session(['doctor' => $doctor, 'doctors'=> $doctors, 'appointments'=>$filtered_appointments]);
        return redirect(route('appointments'));
    }

    public function get_doctors(string $id)
    {
        $doctors = Doctor::where('speciality_id', $id)->get();
        return response()->json($doctors);
    }

    public function get_appointments(string $id)
    {
        $timeZone = Auth::getUser()->timezone;
        $current_date = new DateTime("now", new DateTimeZone($timeZone));
        $current_date->modify("+15 minutes");
        //$testdate = new DateTime(date("Y-m-d H:i:s", 1699430400), new DateTimeZone($timeZone));
        $doc = Doctor::find($id);
        $appointments = $doc->appointments;
        $filtered_appointments = $appointments->where('date', '>', $current_date->getTimestamp());
        return response()->json($filtered_appointments);



        // $doc = Doctor::find(1);
        // $appointments = $doc->appointments;
        // $filtered_appointments = $appointments->where('date', '>', $current_date->getTimestamp());
        // dd($filtered_appointments);
        // setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian'); // устанавливаем локаль
        //dd(date('%d %b %G',strtotime($date)));
        // echo strftime("%d %b %G", strtotime($date)); // выводим дату на русском
        // $now = date('now');
        // dd($now);
        //$doc = Doctor::find(1);
        //dd($doc->appointments);
        //$date = new DateTime();
        //$timeZone = $date->getTimezone();
        //echo $timeZone->getName();

    }
}
