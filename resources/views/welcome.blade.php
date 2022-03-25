@extends('base')

@section('title')
<div  style="margin: 15px; font-family: Cabin, serif;">    Consultations pour Compagnons Instantanées </div> 
@endsection

@section('content')

<img style= "background-size:full" class="container-fluid rounded mx-auto d-block " alt="Responsive image" id="welcome" src="https://images.pexels.com/photos/5122172/pexels-photo-5122172.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260">
<div class="rounded m-auto p-3" id="form">
<h4 class="text-center">Prenez RDV en ligne chez un vétérinaire :</h4>
<h5 class="text-center">Recherche par code postal</h5>
<div class="d-flex justify-content-center">
<form class="form-inline" method="POST" action="{{route('zipSearchResult')}}">
@csrf

<div>
    <select name="categorie_animal1" id="categorie_animal1" aria-describedby="categorie_animal1_feedback" class="form-control @error('categorie_animal1') is-invalid @enderror" >
    <option value="">Sélectionnez la catégorie de votre animal</option>
    <option value="CHAT">Chat</option>
    <option value="CHIEN">Chien</option>
    <option value="NAC">NAC</option>
    <option value="RURAL">Animal Rural</option>
    </select>
      @error('categorie_animal1')
      <div id="categorie_animal1_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
  </div>
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
    <select name="categorie_animal2" id="categorie_animal2" aria-describedby="categorie_animal2_feedback" class="form-control @error('categorie_animal2') is-invalid @enderror">
    <option value="">Sélectionnez la catégorie de votre animal</option>
    <option value="CHAT">Chat</option>
    <option value="CHIEN">Chien</option>
    <option value="NAC">NAC</option>
    <option value="RURAL">Animal Rural</option>
    </select>
      @error('categorie_animal2')
      <div id="categorie_animal2_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
</div>
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


