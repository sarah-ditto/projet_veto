@extends('base')

@section('title', 'Créer des créneaux')

@section('content')
<form method="POST" action="{{route('createSlots.post')}}">
    @csrf
    @if ($errors->any())
        <div class="alert alert-warning">
          Vos créneaux n'ont pas pu être créés &#9785;
        </div>
    @endif

    <div class="form-group">
      <label for="startDate">Date</label>
      <input type="date" id="startDate" name="startDate" value="{{old('startDate')}}"
             aria-describedby="startDate_feedback" class="form-control @error('startDate') is-invalid @enderror"> 
      @error('startDate')
      <div id="startDate_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="startTime">Heure de début</label>
      <input type="time" id="startTime" name="startTime" value="{{old('startTime')}}"
             aria-describedby="startTime_feedback" class="form-control @error('startTime') is-invalid @enderror">  
      @error('startTime')
      <div id="startTime_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="endTime">Heure de fin</label>
      <input type="time" id="endTime" name="endTime" value="{{old('endTime')}}"
             aria-describedby="endTime_feedback" class="form-control @error('endTime') is-invalid @enderror">  
      @error('endTime')
      <div id="endTime_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    

    <div class="form-group">
      <label for="duration">Durée d'un créneau</label>
      <input type="number" id="duration" name="duration" value="{{old('duration')}}"
             aria-describedby="duration_feedback" class="form-control @error('duration') is-invalid @enderror"
             min =5 max = 120 step=5>  
      @error('duration')
      <div id="duration_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
</form>
@endsection
