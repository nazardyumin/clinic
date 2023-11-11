<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show_speciality_form()
    {
        return view('admin.admin-add-speciality');
    }

    public function show_doctor_form()
    {
        return view('admin.admin-add-doctor');
    }

    public function show_timetable_form()
    {
        return view('admin.admin-add-timetable');
    }

    public function add_speciality(Request $request)
    {
        $data = $request->validate([
            "speciality" => ["required", "string", "unique:specialities,speciality"]
        ]);

        Speciality::create([
            "speciality" => $data["speciality"]
        ]);

        return redirect(route('admin.speciality'))->withErrors(['success'=>'Специалист успешно добавлен']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
