@extends('nav.nav')

@section('extra')

    <div class="container" style="margin-top: 100px">
        <h3>Запись на прием</h3>
        <form>
            <div class="mb-3 mt-3">
                <label for="SpecialitySelection" class="form-label">Выберите специалиста</label>
                <select id="SpecialitySelection" class="form-select" aria-label="Speciality selection">
                    @if (session()->has('doctor'))
                        @php
                            $doctor = session('doctor');
                            $spec = $doctor->speciality;
                            session()->forget('doctor');
                        @endphp
                        <option value="0">-- Не выбран --</option>
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}"
                                {{ $speciality->speciality == $spec->speciality ? 'selected' : '' }}>
                                {{ $speciality->speciality }}</option>
                        @endforeach
                    @else
                        <option selected value="0">-- Не выбран --</option>
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->speciality }}</option>
                        @endforeach
                    @endif
                </select>
                <div id="SpecialitySelectionHelp" class="form-text text-danger"></div>
            </div>

            <div class="mb-3">
                <label for="DoctorSelection" class="form-label">Врач</label>
                <select id="DoctorSelection" class="form-select" aria-label="Doctor Selection">
                    @if (session()->has('doctors'))
                        @php
                            $doctors = session('doctors');
                            session()->forget('doctors');
                        @endphp
                        @foreach ($doctors as $doc)
                            <option value="{{ $doc->id }}"
                            {{ $doc->id == $doctor->id ? 'selected' : '' }}>
                            {{ $doc->name }}</option>
                        @endforeach
                    @endif
                </select>
                <div id="DoctorSelectionHelp" class="form-text text-danger"></div>
            </div>
            {{-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Записаться</button>
        </form>
    </div>
@endsection
