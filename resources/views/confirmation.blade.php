@extends('base')

@section('title')
Confirmation du RDV
@endsection
@section('content')
<p> Vous allez confirmer la prise d'un rendez-vous le {{$creneau->DateCreneau}} avec
    le Docteur {{$creneau->NomVeto}}.
<form method="POST" action="{{route('confirmSlot.post',['IDCreneau'=>$creneau->IDCreneau])}}" >
    @csrf
    @if ($errors->any())
        <div class="alert alert-warning">
          Votre RDV n'a pas pu être confirmé &#9785;
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form-group">
      <label for="animal">Animal pour lequel le RDV est pris</label>
      <select id="animal" name="animal"
       aria-describedby="animal_feedback" class="form-control @error('animal') is-invalid @enderror"
       required>
        @foreach ($animaux as $animal)
          <option value="{{$animal->IDAnimal}}"> {{$animal->NomAnimal}} </option>
        @endforeach
      </select>
      @error('animal')
      <div id="animal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    
    <button type="submit" class="btn btn-primary">Réserver</button>
</form>
@endsection



@section('content')
@endsection