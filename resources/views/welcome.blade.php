@extends('base')

@section('title')
Consultations pour Compagnons Instantanées
@endsection

@section('content')
<img class="rounded mx-auto d-block" id="welcome" src="{{URL::asset('images/welcome.jpg')}}">
<div class="rounded m-auto p-3" id="form">
<h4 class="text-center">Prenez RDV en ligne chez un vétérinaire :</h4>
<h5 class="text-center">Recherche par code postal</h5>
<div class="d-flex justify-content-center">
<form class="form-inline" method="POST" action="{{route('zipSearchResult')}}">
@csrf
    <div>
      <input type="text" id="codePostal" name="codePostal" placeholder="Code postal" value="{{old('codePostal')}}"
             aria-describedby="codePostal_feedback" class="form-control @error('codePostal') is-invalid @enderror"> 
      <button type="submit" class="btn btn-outline-info">Rechercher</button>
      @error('codePostal')
      <div id="codePostal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
</form>
</div> 

<h5 class="text-center mt-3">Recherche par nom d'un professionnel</h4>
<div class="d-flex justify-content-center">
<form class="form-inline" method="POST" action="{{route('nameSearchResult')}}">
@csrf
    <div>
      <input type="text" id="nom" name="nom" placeholder="Nom" value="{{old('nom')}}"
             aria-describedby="nom_feedback" class="form-control @error('nom') is-invalid @enderror"> 
      <button type="submit" class="btn btn-outline-info">Rechercher</button>
      @error('nom')
      <div id="nom_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
</form> 
</div>
</div>
@endsection