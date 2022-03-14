@extends('base')

@section('title')
FAQ
@endsection

@section('content')
<p>
  <a class="btn btn-primary dropdown-toggle" data-toggle="collapse" href="#Rep1" role="button" aria-expanded="false" aria-controls="collapseExample">
    Question 1
  </a>
</p>
<div class="collapse" id="Rep1">
  <div class="card card-body mb-3">
    Réponse à la question 1
  </div>
</div>
<p>
  <a class="btn btn-primary dropdown-toggle" data-toggle="collapse" href="#Rep2" role="button" aria-expanded="false" aria-controls="collapseExample">
    Question 2
  </a>
</p>
<div class="collapse" id="Rep2">
  <div class="card card-body mb-3">
    Réponse à la question 2
  </div>
</div>
@endsection