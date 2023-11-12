<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Doctor;
use App\Models\Speciality;

class DoctorController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all();
        $doctors = Doctor::all();
        return view('admin.admin_doctor', ['specialities' => $specialities, 'doctors' => $doctors]);
    }

    public function show_doctors()
    {
        $doctors = Doctor::all();
        return view('doctors.doctors', compact('doctors'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "photo" => ["required", "image", "dimensions:min_width=1500,min_height=1000,max_width=1500,max_height=1000"]
        ]);

        if ((int)$request->speciality_id > 0) {
            $photo = Storage::disk('public')->put('images', $data['photo']);
            Doctor::create([
                "name" => $data["name"],
                "speciality_id" => $request->speciality_id,
                "photo" => 'storage/' . $photo
            ]);
            return redirect(route('doctor.index'))->withErrors(['success' => 'Врач успешно добавлен']);
        }
        return redirect(route('doctor.index'))->withErrors(['name' => 'Специальность не выбрана']);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
