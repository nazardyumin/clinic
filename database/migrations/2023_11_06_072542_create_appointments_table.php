<?php

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Doctor::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('date');
            $table->boolean('day_off')->default(false);
            $table->timestamps();
        });

        //date_default_timezone_set('Europe/Moscow');
        date_default_timezone_set('Etc/GMT-5');

        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $start = strtotime(date($year.'-'.$month.'-'.$day.' 08:00')); //сегодня 08:00
        $end = strtotime('+8 hours', $start); //сегодня 16:00

        do
        {
            Appointment::create([
                'doctor_id' => 1,
                'date' => $start
            ]);
            $start = strtotime('+20 minutes', $start);
        }while($start<$end);

        $start = strtotime('+22 hours', $start); //завтра 14:00
        $end = strtotime('+1 day 4 hours', $end); //завтра 20:00

        do
        {
            Appointment::create([
                'doctor_id' => 1,
                'date' => $start
            ]);
            $start = strtotime('+20 minutes', $start);
        }while($start<$end);

        $start = strtotime('+16 hours', $start); //послезавтра 12:00
        $end = strtotime('+22 hours', $end); //послезавтра 18:00

        do
        {
            Appointment::create([
                'doctor_id' => 1,
                'date' => $start
            ]);
            $start = strtotime('+20 minutes', $start);
        }while($start<$end);

    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
