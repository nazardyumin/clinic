@extends('nav.nav')
@php
    $timeZone = Auth::getUser()->timezone;
    date_default_timezone_set($timeZone);
@endphp
@section('extra')
    <div class="container-fluid- mx-5" style="margin-top: 100px">
        <h4>Добрый день, {{ Auth::getUser()->name }}!</h4>
        <div class="row mt-5">
            <h6>Ваши записи:</h6>
            <hr>
            @if (count($appointments) > 0)
                @foreach ($appointments as $app)
                    <div class="col-5 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Врач: <strong>{{ $app->doctor->name }}</strong>
                                    ({{ $app->doctor->speciality->speciality }})
                                </h5>
                                <p class="card-text">Дата: {{ date('d-m-Y', $app->date) }} время:
                                    {{ date('H:i', $app->date) }}
                                </p>
                                <input type="hidden" name="appointment_id" value="{{ $app->id }}">
                                @php
                                    $str_date = date('Y-m-d H:i:s', $app->date);
                                @endphp
                                <a id="a{{ $str_date }}" href="{{ route('delete_appointment', $app->id) }}"><button
                                        id="but{{ $str_date }}" class="btn btn-danger">Отменить запись</button></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h6>Вы пока не записаны ни к одному врачу</h6>
            @endif
        </div>
    </div>
@endsection
