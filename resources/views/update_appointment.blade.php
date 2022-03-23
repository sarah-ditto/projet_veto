@extends('base')

@section('title')
Modifier la consultation
@endsection

@section('content')
<form method="POST" action="{{route('updateAppointment.post',['IDClient'=>$consult->IDClient,'IDAnimal'=>$consult->IDAnimal,'IDConsult'=>$consult->IDConsult])}}" >
    @csrf
    @if ($errors->any())
        <div class="alert alert-warning">
          La modification n'a pas pu être faite &#9785;
        </div>
    @endif
<div class="form-group">
      <label for="motifConsult">Motif de la consultation</label>
      <select id="motifConsult" name="motifConsult"
       aria-describedby="motifConsult_feedback" class="form-control @error('motifConsult') is-invalid @enderror"
       required>
          <option value="Contrôle"> Contrôle </option>
          <option value="Vaccination"> Vaccination </option>
          <option value="Analyses"> Analyses </option>
          <option value="Imagerie"> Imagerie </option>
          <option value="Chirurgie"> Chirurgie </option>
      </select>
      @error('motifConsult')
      <div id="motifConsult_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
</div>

<div class="form-group">
      <label for="obsConsult">Observations de la consultation</label>
      <textarea type="number" id="obsConsult" name="obsConsult"
             aria-describedby="obsConsult_feedback" class="form-control @error('obsConsult') is-invalid @enderror"
             maxlength=200>{{$consult->ObsConsult}}</textarea>  
      @error('obsConsult')
      <div id="obsConsult_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-outline-info">Sauvegarder</button>
</form>

@endsection