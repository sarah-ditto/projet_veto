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

    public function __construct(Repository $repository){
        $this->repository = $repository;
    }

    public function showVetProfile($IDVeto){
        $veto = $this->repository->veterinaire($IDVeto);
        $creneaux = $this->repository->availableSlotsVeto($IDVeto);
        
        return view('vet_profile', ['veto'=>$veto,'creneaux'=>$creneaux]); 
    }

    public function showAllVetProfiles(){
        $vetos = $this->repository->veterinaires();
        $creneaux = $this->repository->availableSlots();
        return view('all_vet_profiles', ['vetos'=>$vetos, 'creneaux'=>$creneaux]); 
    }
    
    public function showWelcome(){
        return view('welcome');
    }

    public function showAbout(){
        return view('about');
    }

    public function showFaq(){
        return view('faq');
    }

    public function showLogin(Request $request){
        if ($request->session()->has('user'))
            return redirect()->route('welcome.show');
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

    public function storeClient(Request $request){
        $messages=[
            'MailClient.required' => 'Vous devez saisir un e-mail.',
            'MailClient.email' => 'Vous devez saisir un e-mail valide.',
            'MailClient.unique' => "Cet utilisateur existe déjà.",
            'MdpClient.required' => "Vous devez saisir un mot de passe.",
            'NomClient.required' => 'Vous devez saisir un nom.',
            'NomClient.regex' => 'Vous devez saisir un nom valide',
            'PrenomClient.required' => 'Vous devez saisir un prénom.',
            'PrenomClient.regex' => 'Vous devez saisir un prénom valide',
            'TelClient.required' => 'Vous devez saisir un téléphone.',
            'NomRueClient.required' => 'Vous devez saisir un nom de rue.',
            'NumRueClient.required' => 'Vous devez saisir un numéro de rue.',
            'CodePostalClient.required' => 'Vous devez saisir un code postal.',
            'Ville.required' => 'Vous devez saisir une ville.',
            'Ville.regex' => 'Vous devez saisir un nom de ville valide.'
        ];
        $rules=[
            'MailClient' => ['required', 'email','unique:Clients,MailClient'],
            'MdpClient' => ['required'],
            'NomClient' => ['required','regex:/^[\p{L}-]+$/'],
            'PrenomClient' => ['required','regex:/^[\p{L}-]+$/'],
            'TelClient' => ['required'],
            'NomRueClient' => ['required'],
            'NumRueClient' => ['required'],
            'CodePostalClient' => ['required'],
            'Ville' => ['required','regex:/^[\p{L}-]+$/']
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
            'NomVeto.regex' => 'Vous devez saisir un nom valide',
            'PrenomVeto.required' => 'Vous devez saisir un prénom.',
            'PrenomVeto.regex' => 'Vous devez saisir un prénom valide',
            'TelVeto.required' => 'Vous devez saisir un téléphone.',
            'NomRueVeto.required' => 'Vous devez saisir un nom de rue.',
            'NumRueVeto.required' => 'Vous devez saisir un numéro de rue.',
            'CodePostalVeto.required' => 'Vous devez saisir un code postal.',
            'Ville.required' => 'Vous devez saisir une ville.',
            'Ville.regex' => 'Vous devez saisir un nom de ville valide.',
            'PresentationVeto.required' => 'Vous devez vous présentez en quelques lignes.'
        ];
        $rules=[
            'MailVeto' => ['required', 'email','unique:Clients,MailClient'],
            'MdpVeto' => ['required'],
            'NomVeto' => ['required','regex:/^[\p{L}-]+$/'],
            'PrenomVeto' => ['required','regex:/^[\p{L}-]+$/'],
            'TelVeto' => ['required'],
            'NomRueVeto' => ['required'],
            'NumRueVeto' => ['required'],
            'CodePostalVeto' => ['required'],
            'Ville' => ['required','regex:/^[\p{L}-]+$/'],
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

    public function login(Request $request, Repository $repository){
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

    public function logout(Request $request) {
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
            $slots = $this->repository->createSlots($start, $end, $validatedData['duration']);
            $this->repository->insertCreatedSlots($slots,$request->session()->get('user'));
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
            'nameAnimal' => ['required','regex:/^[\p{L}-]+$/'],
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
            'nameAnimal.regex' => 'Vous devez saisir un nom valide',
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
        $animaux = $this->repository->animauxProprio($request->session()->get('user'));
        return view('confirmation',['creneau'=>$creneau,'animaux' => $animaux]);
    }

    public function showClient(Request $request, int $IDClient){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if (($request->session()->get('userType')==2)&&($request->session()->get('user')!=$IDClient))
            return redirect()->route('welcome.show');
        if (($request->session()->get('userType')==1)&&($this->repository->isVetofClient($IDClient,$request->session()->get('user'))==0))
            return redirect()->route('welcome.show');
        if ($request->session()->get('userType')==1)
            $animaux = $this->repository->listAnimalsOfClient($request->session()->get('user'),$IDClient);
        else 
            $animaux = $this->repository->animauxProprio($IDClient);
        $client = $this->repository->client($IDClient)[0];
        return view('client_profile', ['animaux'=>$animaux,'client'=>$client]);
    }

    public function showAnimal(Request $request, int $IDClient, int $IDAnimal){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if (($request->session()->get('userType')==2)&&($request->session()->get('user')!=$IDClient))
            return redirect()->route('welcome.show');
        if (($request->session()->get('userType')==1)&&($this->repository->isVetofAnimal($IDAnimal,$request->session()->get('user'))==0))
            return redirect()->route('welcome.show');
        $animal = $this->repository->animal($IDAnimal);
        return view('animal_profil', ['animal'=>$animal]); 
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

    public function showClientAppointments(Request $request){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')==1)
            return redirect()->route('welcome.show');
        $futureConsults = $this->repository->getFutureAppointmentsClient($request->session()->get('user'));
        $pastConsults = $this->repository->getPastAppointmentsClient($request->session()->get('user'));
        return view('client_appointments',['pastConsults'=>$pastConsults,'futureConsults'=>$futureConsults]);
    }
    
    public function showBookedSlotsList (Request $request){
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType')!=1)
            return redirect()->route('welcome.show');
        $veto = $this->repository->veterinaire ($request->session()->get('user'));
        $consultations = $this->repository -> bookedSlotsVeto($request->session()->get('user'));
        return view ('booked_slots', ['veto'=> $veto, 'consultations'=>$consultations] );
    }

    public function showClientsList(Request $request){
        if (!($request->session()->has('user')))
           return redirect()->route('login.show');
        if ($request->session()->get('userType')!=1)
           return redirect()->route('welcome.show');
        $clients = $this->repository->listClients($request->session()->get('user'));
        $animals = $this->repository->listAnimals($request->session()->get('user'));
        return view ('clients_list', ['clients'=> $clients, 'animals'=>$animals] );
    }

    public function searchByZipCode (Request $request){
        $rules = [
            'codePostal' => ['regex:/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/']
        ];
        $messages = [
            'codePostal.regex' => 'Vous devez saisir code postal valide.',
        ];
        $validatedData = $request->validate($rules, $messages);

        try{
            $vets = $this->repository->vetByZipCode($validatedData['codePostal']);
            $slots = $this->repository -> availableSlotsZipCode($validatedData['codePostal']); 
            } catch (Exception $e) {
                return redirect()->back()->withInput()->withErrors("Recherche impossible");
            }
        return view ('search_results', ['vetos'=> $vets, 'creneaux'=>$slots] );
    }

    public function searchByName (Request $request){
        $rules = [
            'nom' => ['regex:/^[\p{L}-]+$/']
        ];
        $messages = [
            'nom.regex' => 'Vous devez un nom valide.',
        ];
        $validatedData = $request->validate($rules, $messages);

        $vets = $this->repository->vetByName($validatedData['nom']);
        $slots = $this->repository -> availableSlotsName($validatedData['nom']);
        return view ('search_results', ['vetos'=> $vets, 'creneaux'=>$slots] );
    }

    public function deleteAppointment(Request $request, int $IDConsult){
        try{
            $this->repository->deleteAppointment($IDConsult);
            } catch (Exception $e) {
                return redirect()->back()->withErrors("Annulation impossible");
            }
        return redirect()->back();
    }

    


}
