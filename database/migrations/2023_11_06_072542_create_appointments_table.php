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
            $table->string('day_off_status')->nullable();
            $table->timestamps();
        });

        //$tomorrow = new DateTime(date("Y")."-".date("m")."-".date("d"), new DateTimeZone('Europe/Moscow'));
        //$tomorrow_end = new DateTime(date("Y")."-".date("m")."-".date("d"), new DateTimeZone('Europe/Moscow'));

        $tomorrow_start = new DateTime(date("Y") . "-" . date("m") . "-" . date("d"), new DateTimeZone('Etc/GMT-5'));
        $tomorrow_end = new DateTime(date("Y") . "-" . date("m") . "-" . date("d"), new DateTimeZone('Etc/GMT-5'));

        $tomorrow_start->modify("+1 day 8 hours");
        $tomorrow_end->modify("+1 day 14 hours");

        for (; $tomorrow_start->getTimestamp() <= $tomorrow_end->getTimestamp(); $tomorrow_start->modify('+20 minutes')) {
            Appointment::create([
                'doctor_id' => 1,
                'date' => $tomorrow_start->getTimestamp()
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
