@extends('base')

@section('title', 'Ajouter un animal')

@section('content')
<form method="POST" action="{{route('createAnimal.post')}}" enctype="multipart/form-data" >
    @csrf
    @if ($errors->any())
        <div class="alert alert-warning">
          Votre animal n'a pas pu être ajouté &#9785;
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
      <label for="photoAnimal">Photo</label>
      <input type="file" id="photoAnimal" name="photoAnimal" value="{{old('photoAnimal')}}"
             aria-describedby="photoAnimal_feedback" class="form-control @error('photoAnimal') is-invalid @enderror"> 
      @error('photoAnimal')
      <div id="photoAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="nameAnimal">Nom de l'animal</label>
      <input type="text" id="nameAnimal" name="nameAnimal" value="{{old('nameAnimal')}}"
             aria-describedby="nameAnimal_feedback" class="form-control @error('nameAnimal') is-invalid @enderror"> 
      @error('nameAnimal')
      <div id="nameAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="dateAnimal">Date de naissance</label>
      <input type="date" id="dateAnimal" name="dateAnimal" value="{{old('dateAnimal')}}"
             aria-describedby="dateAnimal_feedback" class="form-control @error('dateAnimal') is-invalid @enderror">  
      @error('dateAnimal')
      <div id="dateAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="typeAnimal">Type de l'animal</label>
      <select id="typeAnimal" name="typeAnimal"
       aria-describedby="typeAnimal_feedback" class="form-control @error('typeAnimal') is-invalid @enderror"
       required>
          <option selected="selected" value="CHAT"> Chat </option>
          <option value="CHIEN"> Chien </option>
          <option value="NAC"> NAC </option>
          <option value="RURAL"> Animal Rural </option>
      </select>
      @error('typeAnimal')
      <div id="typeAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="sexeAnimal">Sexe</label>
      <select id="sexeAnimal" name="sexeAnimal"
       aria-describedby="sexeAnimal_feedback" class="form-control @error('sexeAnimal') is-invalid @enderror"
       required>
          <option selected="selected" value="INCONNU"> Inconnu </option>
          <option value="FEMELLE"> FEMELLE </option>
          <option value="MALE"> MÂLE </option>
      </select>
      @error('sexeAnimal')
      <div id="sexeAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="sterilisationAnimal">État de stérilisation</label>
      <select id="sterilisationAnimal" name="sterilisationAnimal"
       aria-describedby="sterilisationAnimal_feedback" class="form-control @error('sterilisationAnimal') is-invalid @enderror"
       required>
          <option selected="selected" value="INCONNU"> Inconnu </option>
          <option value="OUI"> OUI </option>
          <option value="NON"> NON </option>
      </select>
      @error('sterilisationAnimal')
      <div id="sterilisationAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="poidsAnimal">Poids (kg)</label>
      <input type="number" id="poidsAnimal" name="poidsAnimal" value="{{old('poidsAnimal')}}"
             aria-describedby="poidsAnimal_feedback" class="form-control @error('poidsAnimal') is-invalid @enderror"
             step='any'>  
      @error('poidsAnimal')
      <div id="poidsAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="pathologiesAnimal">Pathologies connues</label>
      <textarea type="number" id="pathologiesAnimal" name="pathologiesAnimal" value="{{old('pathologiesAnimal')}}"
             aria-describedby="pathologiesAnimal_feedback" class="form-control @error('pathologiesAnimal') is-invalid @enderror"
             maxlength=200></textarea>  
      @error('pathologiesAnimal')
      <div id="pathologiesAnimal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
@endsection

