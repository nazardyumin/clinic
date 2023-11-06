<?php

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Doctor::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('date');
            $table->string('day_off_status')->nullable();
            $table->timestamps();
        });
        //$now = date("Y-m-d H:i:s");
        $tomorrow_start = mktime(8, 0, 0, date("m")  , date("d")+1, date("Y"));
        $tomorrow_end = mktime(14, 0, 0, date("m")  , date("d")+1, date("Y"));
        $date1 = new DateTime(date("Y-m-d H:i:s",$tomorrow_start));
        $date2 = new DateTime(date("Y-m-d H:i:s",$tomorrow_end));

        for(; $date1<= $date2; $date1->modify('+20 minutes') ){
            Appointment::create([
                'doctor_id'=>1,
                'date'=>$date1
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
