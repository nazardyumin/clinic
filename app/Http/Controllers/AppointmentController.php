<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Doctor;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function show()
    {
        $timeZone = Auth::getUser()->timezone;
        $date = new DateTime("now", new DateTimeZone($timeZone));
        echo $date->format('Y-m-d H:i:s');

        //$date = new DateTime();
        //$timeZone = $date->getTimezone();
        //echo $timeZone->getName();

        setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian'); // устанавливаем локаль
        //dd(date('%d %b %G',strtotime($date)));
        // echo strftime("%d %b %G", strtotime($date)); // выводим дату на русском
        // $now = date('now');
        // dd($now);
        //$doc = Doctor::find(1);
        //dd($doc->appointments);

        return view('appointments.appointments');
    }
}
