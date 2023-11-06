<?php

use App\Models\Speciality;
use App\Models\Doctor;
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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->foreignIdFor(Speciality::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        $list_names=array('Иванов Сергей Михайлович', 'Петрова Анна Павловна');

        for ($i = 1; $i <= 10; $i++) {
            $male_photo='storage/images/doc_male.jpg';
            $female_photo='storage/images/doc_female.jpg';
            if($i%2==0){
                $male_photo='storage/images/doc_male1.jpg';
                $female_photo='storage/images/doc_female1.jpg';
            }
            Doctor::create([
                'name'=>$list_names[0],
                'photo'=>$male_photo,
                'speciality_id'=>$i
            ]);
            Doctor::create([
                'name'=>$list_names[1],
                'photo'=>$female_photo,
                'speciality_id'=>$i
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
