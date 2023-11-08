<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;

class AppointmentHelper
{
    public static function get_doctor_appointments(string $id)
    {
        $months = ['', ' января', ' февраля', ' марта', ' апреля', ' мая', ' июня', ' июля', ' августа', ' сентября', ' октября', ' ноября', ' декабря'];
        $days = ['Вс ', 'Пн ', 'Вт ', 'Ср ', 'Чт ', 'Пт ', 'Сб '];
        $timeZone = Auth::getUser()->timezone;
        $current_date = new DateTime("now", new DateTimeZone($timeZone));
        $current_date->modify("+15 minutes");
        $doctor = Doctor::find($id);
        $appointments = $doctor->appointments;
        $filtered = $appointments->where('date', '>', $current_date->getTimestamp())->where('day_off','!=','true')->sortBy('date');
        $appointments_to_view = [];
        $count = 0;
        if(count($filtered)>0)
        {
            date_default_timezone_set($timeZone);
        $n = date('n', $filtered[0]->date);
        $j = date('j', $filtered[0]->date);
        $w = date('w', $filtered[0]->date);

        $time_memory = $days[$w] . $j . $months[$n];

        $appointments_to_view = [$time_memory => []];

        foreach ($filtered as $item) {
            $n = date('n', $item->date);
            $j = date('j', $item->date);
            $w = date('w', $item->date);
            $time_item = $days[$w] . $j . $months[$n];

            if ($time_memory != $time_item) {
                $appointments_to_view[$time_item] = [];
                $time_memory = $time_item;
            }
            $appointments_to_view[$time_memory][] = ['id' => $item->id, 'user_id' => $item->user_id, 'time' => date('H:i', $item->date), 'day_off' => $item->day_off];
        }
        $count = 0;
        foreach ($appointments_to_view as $key=>$value) {
            if (count($value) > $count) {
                $count = count($value);
            }
        }
        }

        return ['doctor' => $doctor, 'appointments' => $appointments_to_view, 'count' => $count];
    }
}
