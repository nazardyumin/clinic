@extends('admin.admin-nav')


@section('admin-extra')
    <form method="POST" action="{{route('speciality.store')}}">
        @csrf
        <div class="col-3" >
            <div class="mb-3">
                <label for="InputSpeciality" class="form-label">Введите специалиста</label>
                <input id="InputSpeciality" type="text" class="form-control" name="speciality" aria-describedby="Input Speciality" required>
            </div>
            <button type="submit" class="btn btn-secondary">Добавить</button>
            @error('speciality')
            <div class="form-text text-danger">{{$message}}</div>
            @enderror
            @error('success')
            <div class="form-text text-success">{{$message}}</div>
            @enderror
        </div>
    </form>
@endsection
