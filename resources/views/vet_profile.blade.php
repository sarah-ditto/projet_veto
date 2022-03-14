@extends('base')

@section('title')
Profil des veto coté clients
@endsection

@section('content')
<form method="POST" action="{{route('vetProfile.post')}}">
@csrf

@if ($errors->any())
    <div class="alert alert-warning">
        Impossible d'afficher le profile &#9785;
    </div>
@endif


<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                
                
        
        <ul>
            <li>{{$veto->MailVeto}}</li>
</ul>
        
                    
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label></div>
                    <div class="col-md-6"><label class="labels">Surname</label></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label></div>
                    <div class="col-md-12"><label class="labels">Address Line 1</label></div>
                    <div class="col-md-12"><label class="labels">Address Line 2</label></div>
                    <div class="col-md-12"><label class="labels">Postcode</label></div>
                    <div class="col-md-12"><label class="labels">State</label></div>
                    <div class="col-md-12"><label class="labels">Area</label></div>
                    <div class="col-md-12"><label class="labels">Email ID</label></div>
                    <div class="col-md-12"><label class="labels">Education</label></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label></div>
                    <div class="col-md-6"><label class="labels">State/Region</label></div>
                </div>
               
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label></div>
            </div>
        </div>
    </div>
</div>


@endsection