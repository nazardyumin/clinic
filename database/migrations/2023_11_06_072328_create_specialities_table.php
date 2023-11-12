<?php

use App\Models\Speciality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->string('speciality');
            $table->timestamps();
        });

        $list_specialities = array('Терапевт', 'Хирург', 'Аллерголог', 'Дерматолог', 'Диетолог', 'Невролог', 'Отоларинголог', 'Эндокринолог', 'Кардиолог', 'Офтальмолог');
        foreach ($list_specialities as $speciality) {
            Speciality::create([
                'speciality' => $speciality
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('specialities');
    }
};
