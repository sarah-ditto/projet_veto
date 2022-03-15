<?php

namespace App\Http\Controllers;

use Exception;
use App\Repositories\Repository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function showVetProfile($IDVeto){
        $veto = $this->repository->veterinaire ($IDVeto);
        //$veto= DB::table('Veterinaires')->where('TelVeto',$tel)->get()->toArray();
        return view('vet_profile', ['veto'=>$veto ]); 
    }

    public function showAllVetProfile(){
        $vetos = $this->repository->veterinaires();
        $creneaux = $this->repository->availableSlots();
        return view('all_vet_profile', ['vetos'=>$vetos, 'creneaux'=>$creneaux]); 
    }
    
   
    public function showWelcome()
    {
        return view('welcome');
    }

    public function showAbout()
    {
        return view('about');
    }

    public function showFaq()
    {
        return view('faq');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function showClientRegistrationForm(){
        return view('create_client');
    }



    // public function showCreneaux(){
    //     $vetos = $this->repository->veterinaires();
    //     $creneaux = $this->repository->creneaux();
    //     return view('creneaux', ['vetos'=>$vetos, 'creneaux'=>$creneaux]);
    // }

    public function storeClient(Request $request)
    {
        $messages=[
            'MailClient.required' => 'Vous devez saisir un e-mail.',
            'MailClient.email' => 'Vous devez saisir un e-mail valide.',
            'MailClient.unique' => "Cet utilisateur existe déjà.",
            'MdpClient.required' => "Vous devez saisir un mot de passe.",
            'NomClient.required' => 'Vous devez saisir un nom.',
            'PrenomClient.required' => 'Vous devez saisir un prénom.',
            'TelClient.required' => 'Vous devez saisir un téléphone.',
            'NomRueClient.required' => 'Vous devez saisir un nom de rue.',
            'NumRueClient.required' => 'Vous devez saisir un numéro de rue.',
            'CodePostalClient.required' => 'Vous devez saisir un code postal.',
            'Ville.required' => 'Vous devez saisir une ville.',
        ];
        $rules=[
            'MailClient' => ['required', 'email','unique:Clients,MailClient'],
            'MdpClient' => ['required'],
            'NomClient' => ['required'],
            'PrenomClient' => ['required'],
            'TelClient' => ['required'],
            'NomRueClient' => ['required'],
            'NumRueClient' => ['required'],
            'CodePostalClient' => ['required'],
            'Ville' => ['required']
        ];
        $validatedData = $request->validate($rules,$messages);
        try {
            $this->repository->addClient($validatedData['MailClient'],$validatedData['MdpClient'],
            $validatedData['NomClient'],$validatedData['PrenomClient'],$validatedData['TelClient'],
            $validatedData['NomRueClient'],$validatedData['NumRueClient'],$validatedData['CodePostalClient'],
            $validatedData['Ville']);
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors("L'utilisateur existe déjà.");
            }
            return redirect()->route('welcome.show');
    }

    public function showVetRegistrationForm(){
        return view('create_vet');
    }

    public function storeVet(Request $request){
        $messages=[
            'MailVeto.required' => 'Vous devez saisir un e-mail.',
            'MailVeto.email' => 'Vous devez saisir un e-mail valide.',
            'MailVeto.unique' => "Cet utilisateur existe déjà.",
            'MdpVeto.required' => "Vous devez saisir un mot de passe.",
            'NomVeto.required' => 'Vous devez saisir un nom.',
            'PrenomVeto.required' => 'Vous devez saisir un prénom.',
            'TelVeto.required' => 'Vous devez saisir un téléphone.',
            'NomRueVeto.required' => 'Vous devez saisir un nom de rue.',
            'NumRueVeto.required' => 'Vous devez saisir un numéro de rue.',
            'CodePostalVeto.required' => 'Vous devez saisir un code postal.',
            'Ville.required' => 'Vous devez saisir une ville.',
            'PresentationVeto.required' => 'Vous devez vous présentez en quelques lignes.'
        ];
        $rules=[
            'MailVeto' => ['required', 'email','unique:Clients,MailClient'],
            'MdpVeto' => ['required'],
            'NomVeto' => ['required'],
            'PrenomVeto' => ['required'],
            'TelVeto' => ['required'],
            'NomRueVeto' => ['required'],
            'NumRueVeto' => ['required'],
            'CodePostalVeto' => ['required'],
            'Ville' => ['required'],
            'PresentationVeto' => ['required']
        ];
        $validatedData = $request->validate($rules,$messages);
        try {
            $this->repository->addVet($validatedData['MailVeto'],$validatedData['MdpVeto'],
            $validatedData['NomVeto'],$validatedData['PrenomVeto'],$validatedData['TelVeto'],
            $validatedData['NomRueVeto'],$validatedData['NumRueVeto'],$validatedData['CodePostalVeto'],
            $validatedData['Ville'],$validatedData['PresentationVeto']);
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors("L'utilisateur existe déjà.");
            }
            return redirect()->route('welcome.show');
    }

    public function login(Request $request, Repository $repository)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
        $messages = [
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'password.required' => "Vous devez saisir un mot de passe."
        ];
        $validatedData = $request->validate($rules, $messages);
        try {
        $user = $this->repository->getUser($validatedData['email'],$validatedData['password']);
        $request->session()->put('user', $user['user']);
        $request->session()->put('userType', $user['userType']);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['email'=>"Impossible de vous authentifier.".$e->getMessage()]);
        }
        return redirect()->route('welcome.show');
    }

    public function logout(Request $request) 
    {
        $request->session()->forget('user');
        $request->session()->forget('userType');
        return redirect()->route('welcome.show');
    }

    public function showCreneaux(){
        $vetos = $this->repository->veterinaires();
        $creneaux = $this->repository->availableSlots();
        return view('creneaux', ['vetos'=>$vetos, 'creneaux'=>$creneaux]);
    }

    public function showCreateSlotsForm(Request $request){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')!=1)
            return redirect()->route('welcome.show');
        return view('create_slots');
    }

    public function storeSlots(Request $request){
        $rules = [
            'startDate' => ['required','date'],
            'startTime' => ['required','date_format:H:i','before:endTime'],
            'endTime'=> ['required','date_format:H:i','after:startTime'],
            'duration' => ['required']
        ];
        $messages = [
            'startTime.required' => 'Vous devez saisir une heure de début.',
            'startTime.date_format' => 'Vous devez saisir une heure valide.',
            'startTime.before' => 'Votre heure de début doit être avant votre heure de fin.',
            'startDate.required' => 'Vous devez saisir une date de début.',
            'startDate.date' => 'Vous devez saisir une date valide.',
            'endTime.required' => 'Vous devez saisir une heure de fin.',
            'endTime.date_format' => 'Vous devez saisir une heure valide.',
            'endTime.before' => 'Votre heure de fin doit être après votre heure de début.',
            'duration.required' => 'Vous devez saisir une durée de rendez vous.'
        ];
        $validatedData = $request->validate($rules, $messages);
        $date = $validatedData['startDate'];
        $endTime = $validatedData['endTime'];
        $startTime = $validatedData['startTime'];
        $start = "$date $startTime";
        $end = "$date $endTime";
        try {
            $slots = $this->repository->generCreneaux($start, $end, $validatedData['duration']);
            $this->repository->insertCreneauxGeneres($slots,$request->session()->get('user'));
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors(['startDate'=>"Impossible de créer vos créneaux.".$e->getMessage()]);
            }
        return redirect()->route('welcome.show');
    }

    public function createAnimal(Request $request){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')!=2)
            return redirect()->route('welcome.show');
        return view('create_animal');
    }

    public function storeAnimal(Request $request){
        $rules = [
            'photoAnimal' => ['image'],
            'nameAnimal' => ['required'],
            'dateAnimal' => ['required','date'],
            'typeAnimal'=> ['required','exists:Especes,TypeAnimal'],
            'sexeAnimal' => ['required'],
            'sterilisationAnimal' => ['required'],
            'poidsAnimal' => ['numeric','nullable'],
            'pathologiesAnimal' => ['nullable']
        ];
        $messages = [
            'photoAnimal.image' => 'Votre image doit être du type jpg, jpeg, png, bmp, gif, svg, ou webp.',
            'nameAnimal.required' => 'Vous devez saisir une heure de début.',
            'dateAnimal.required' => 'Vous devez saisir une date de naissance, même approximative.',
            'dateAnimal.date' => 'Vous devez saisir une date valide.',
            'typeAnimal.required' => 'Vous devez séléctionner un type d\'animal.',
            'typeAnimal.exists' => 'Vous devez séléctionner un type d\'animal existant.',
            'sexeAnimal.required' => 'Vous devez séléctionner un sexe.',
            'sterilisationAnimal.required' => 'Vous devez séléctionner saisir un état de stérilisation.',
            'poidsAnimal.numeric' => 'Le poids doit être un nombre.'
        ];
        $validatedData = $request->validate($rules,$messages);
        try {
            $IDAnimal = $this->repository->insertAnimaux(['NomAnimal' => $validatedData['nameAnimal'],
            'DateNaissAnimal'=> $validatedData['dateAnimal'],
            'SterilisationAnimal' => $validatedData['sterilisationAnimal'],
            'PoidsAnimal' => $validatedData['poidsAnimal'], 
            'SexeAnimal' => $validatedData['sexeAnimal'], 
            'PathologiesAnimal' => $validatedData['pathologiesAnimal'], 
            'IDClient' => $request->session()->get('user'), 
            'TypeAnimal' => $validatedData['typeAnimal'] ]);
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors("Impossible d'ajouter l'animal");
            }
        // if($request->photoAnimal != NULL)
        //     Storage::disk('local')->put("animals/$IDAnimal",$request->photoAnimal);
        // else
        //     Storage::copy('animals/image.jpg', "animals/$IDAnimal/image.jpg");

        return redirect()->route('welcome.show');
    }

    public function showConfirmSlotForm(Request $request, int $IDCreneau){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')==1)
            return redirect()->route('welcome.show');
        $creneau = $this->repository->creneau($IDCreneau);
        $animaux = $this->repository->animaux($request->session()->get('user'));
        return view('confirmation',['creneau'=>$creneau,'animaux' => $animaux]);
    }

    function storeSlotConfirmation(Request $request, int $IDCreneau){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')==1)
            return redirect()->route('welcome.show');
        $rules = ['animal'=>['exists:Animaux,IDAnimal']];
        $messages = ['animal.exists' => 'Vous devez choisir un animal existant.'];
        $validatedData = $request->validate($rules,$messages);
        try{
            $this->repository->insertConsultation(['ObsConsult' => " ", 
            'MotifConsult'  => " ",
            'IDAnimal'  => $validatedData['animal'],
            'IDCreneau'  => $IDCreneau]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Impossible de réserver le créneaux");
        }
        return redirect()->route('welcome.show');
    }

    public function showListReservation (Request $request,$IDVeto){
       if (!($request->session()->has('user')))
           return redirect()->route('login.show');
       if ($request->session()->get('userType')==1)
           return redirect()->route('welcome.show');

        $veto = $this->repository->veterinaire ($IDVeto);
        $consultation = $this->repository -> bookedSlotsVeto($IDVeto);
        
        return view ('List_Reservation', ['veto'=> $veto, 'consultation'=>$consultation] );
    }
    
}
