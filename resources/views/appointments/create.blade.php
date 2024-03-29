@extends('layouts.panel')
@section('title', 'Reservar Cita')
@section('content')
<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Reservar Cita</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('patients') }}" class="btn btn-sm btn-primary">Cancelar y Volver</a>
      </div>
    </div>
  </div>

  <form action="{{ url('appointments') }}" method="post">
    @csrf
  <div class="container-fluid">
  @if (count($errors) > 0)
      <div class="alert alert-danger">
        <p>Corrige los siguientes errores:</p>
          <ul>
              @foreach ($errors->all() as $message)
                  <li>{{ $message }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <div class="form-group">
        <div id="error">
        </div>
    </div>
    <div class="form-group">
        <label for="description">Descripcion</label>
        <div class="input-group input-group-alternative mb-3">
                <span class="input-group-text"><i class="ni ni-caps-small"></i></span>
                <input  class="form-control" name="description" id="description" 
                for="type1" placeholder="Describe brevemente la consulta" required value="{{old('description')}}">
            </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <div class="input-group input-group-alternative mb-3">
                <select name="specialty_id" id="specialty" class="form-control" required >
                <option value="" selected  disabled>Seleccionar Especialidad</option>
                    @foreach ($specialties as $specialty)
                    <option value="{{$specialty->id}}" @if(old('specialty_id') == $specialty->id) selected @endif>{{$specialty->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="input-group input-group-alternative mb-3">
                <select name="doctor_id" id="doctor" class="form-control" required>
                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}" @if(old('doctor_id') == $doctor->id) selected @endif>{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
                <input class="form-control datepicker" placeholder="Select date" 
                id="date" name="schedule_date" type="text"  value="{{ old('schedule_date', date('Y-m-d')) }}" 
                data-date-format="yyyy-mm-dd"
                data-date-start-date="{{date('Y-m-d')}}" 
                data-date-end-date="+30d">
        </div>
    </div>
    <div class="form-group">
          <label for="address">Hora de atención</label>
          <div id="hours">
            @if ($intervals)
              @foreach ($intervals['morning'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="schedule_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
              @foreach ($intervals['afternoon'] as $key => $interval)
                <div class="custom-control custom-radio mb-3">
                  <input name="schedule_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalAfternoon{{ $key }}" type="radio" required>
                  <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                </div>
              @endforeach
            @else
              <div class="alert alert-info" role="alert">
                Seleccione un médico y una fecha, para ver sus horas disponibles.
              </div>
            @endif
          </div>
        </div>
    <div class="form-group">
          <label for="type">Tipo de consulta</label>
          <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type1" type="radio"
              @if(old('type', 'Consulta') == 'Consulta') checked @endif value="Consulta">
            <label class="custom-control-label" for="type1">Consulta</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type2" type="radio"
              @if(old('type') == 'Examen') checked @endif value="Examen">
            <label class="custom-control-label" for="type2">Examen</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input name="type" class="custom-control-input" id="type3" type="radio"
              @if(old('type') == 'Operación') checked @endif value="Operación">
            <label class="custom-control-label" for="type3">Operación</label>
          </div>
        </div>
   
    <button type="submit" class="btn btn-sm btn-primary mt-4 mb-4">Guardar Datos</button>
   </div>
  </form>
</div>
@endsection
@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appoinments/create.js') }}"></script>
@endsection