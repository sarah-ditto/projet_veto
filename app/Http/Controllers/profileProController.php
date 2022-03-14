<?php

namespace App\Http\Controllers;

use App\Repositories\Data;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Repositories\Repository;

class profileProController extends Controller {

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function showVetProfile($IDVeto){
        $veto = $this->repository->veterinaire ($IDVeto);

        //$veto= DB::table('Veterinaires')->where('TelVeto',$tel)->get()->toArray();
        return view('vet_profile', ['veto'=>$veto] );
    }
    
    public function showCreateSlotsForm(Request $request){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')!=1)
            return redirect()->route('welcome.show');
        return view('create_slots');
    }

}