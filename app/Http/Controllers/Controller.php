<?php

namespace App\Http\Controllers;

use Exception;
use App\Repositories\Repository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Repository $repository){
        $this->repository = $repository;
    }

    // Show the profile of a veterinary with all of his info, his slots, and the species treated
    public function showVetProfile($IDVeto){
        $veto = $this->repository->veterinaire($IDVeto);
        $creneaux = $this->repository->availableSlotsVeto($IDVeto);
        $pecs = $this->repository->getVetPriseEnCharge($IDVeto);
        return view('vet_profile', ['veto' => $veto, 'creneaux' => $creneaux, 'creneaux' => $creneaux, 'pecs' => $pecs]);
    }

    // Display of a list of veterinaries corresponding to the results after a search 
    // with infos and slots/appointments available
    public function showAllVetProfiles(){
        $vetos = $this->repository->veterinaires();
        $creneaux = $this->repository->availableSlots();
        return view('all_vet_profiles', ['vetos' => $vetos, 'creneaux' => $creneaux]);
    }

    // Display of the welcome page
    public function showWelcome(Request $request){
        $request->session()->forget('backUrl');
        return view('welcome');
    }

    // Display of the page about
    public function showAbout(Request $request){
        $request->session()->forget('backUrl');
        return view('about');
    }

    // Display of the page FAQ  
    public function showFaq(Request $request){
        $request->session()->forget('backUrl');
        return view('faq');
    }

    // Display of the login page that redirects to the welcome page if authentification is successfull
    public function showLogin(Request $request){
        if ($request->session()->has('user'))
            return redirect()->route('welcome.show');
        return view('login');
    }

    // Display of the sign up for for the client
    public function showClientRegistrationForm(){
        return view('create_client');
    }

    // Saving the client in the database after validation of the form
    public function storeClient(Request $request){
        $messages = [
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
        $rules = [
            'MailClient' => ['required', 'email', 'unique:Clients,MailClient'],
            'MdpClient' => ['required'],
            'NomClient' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'PrenomClient' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'TelClient' => ['required'],
            'NomRueClient' => ['required'],
            'NumRueClient' => ['required'],
            'CodePostalClient' => ['required'],
            'Ville' => ['required', 'regex:/^[\p{L}-]+$/u']
        ];
        $validatedData = $request->validate($rules, $messages);

        try {
            $this->repository->addClient(
                $validatedData['MailClient'],
                $validatedData['MdpClient'],
                $validatedData['NomClient'],
                $validatedData['PrenomClient'],
                $validatedData['TelClient'],
                $validatedData['NomRueClient'],
                $validatedData['NumRueClient'],
                $validatedData['CodePostalClient'],
                $validatedData['Ville']
            );
        } 
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("L'utilisateur existe déjà.");
        }

        return redirect()->route('login.show');
    }

    // Display of the sign up form for the veterinary
    public function showVetRegistrationForm() {
        return view('create_vet');
    }

    //  Saving the veterinary in the database after validation of the form
    public function storeVet(Request $request) {
        $messages = [
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
            'PresentationVeto.required' => 'Vous devez vous présentez en quelques lignes.',
            'chat.required_without_all' => 'Vous devez cocher au moins une case',
            'chien.required_without_all' => 'Vous devez cocher au moins une case',
            'nac.required_without_all' => 'Vous devez cocher au moins une case',
            'animal_rural.required_without_all' => 'Vous devez cocher au moins une case'

        ];
        
        $rules = [
            'MailVeto' => ['required', 'email', 'unique:Clients,MailClient'],
            'MdpVeto' => ['required'],
            'NomVeto' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'PrenomVeto' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'TelVeto' => ['required'],
            'NomRueVeto' => ['required'],
            'NumRueVeto' => ['required'],
            'CodePostalVeto' => ['required'],
            'Ville' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'PresentationVeto' => ['required'],
            'chat' =>  ['required_without_all:chien,nac,animal_rural'],
            'chien' =>  ['required_without_all:chat,nac,animal_rural'],
            'nac' =>  ['required_without_all:chat,chien,animal_rural'],
            'animal_rural' =>  ['required_without_all:chat,chien,nac'],
        ];

        $validatedData = $request->validate($rules, $messages);
        
        try {
            $idVeto = $this->repository->addVet(
                $validatedData['MailVeto'],
                $validatedData['MdpVeto'],
                $validatedData['NomVeto'],
                $validatedData['PrenomVeto'],
                $validatedData['TelVeto'],
                $validatedData['NomRueVeto'],
                $validatedData['NumRueVeto'],
                $validatedData['CodePostalVeto'],
                $validatedData['Ville'],
                $validatedData['PresentationVeto']
            );
        } 
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("L'utilisateur existe déjà.");
        }

        if (array_key_exists('chat', $validatedData))
            $this->repository->insertPriseEnCharge(['EspeceAnimal' => $validatedData['chat'], 'IDVeto' => $idVeto]);
        if (array_key_exists('chien', $validatedData))
            $this->repository->insertPriseEnCharge(['EspeceAnimal' => $validatedData['chien'], 'IDVeto' => $idVeto]);
        if (array_key_exists('nac', $validatedData))
            $this->repository->insertPriseEnCharge(['EspeceAnimal' => $validatedData['nac'], 'IDVeto' => $idVeto]);
        if (array_key_exists('animal_rural', $validatedData))
            $this->repository->insertPriseEnCharge(['EspeceAnimal' => $validatedData['animal_rural'], 'IDVeto' => $idVeto]);

        return redirect()->route('login.show');
    }

    // Login of the veterinary or the client if authentification is successful 
    public function login(Request $request, Repository $repository) {

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
            $user = $this->repository->getUser($validatedData['email'], $validatedData['password']);
            $request->session()->put('user', $user['user']);
            $request->session()->put('userType', $user['userType']);
        } 
        
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['email' => "Impossible de vous authentifier." . $e->getMessage()]);
        }
        return ($url = $request->session()->get('backUrl')) ?
            redirect($url) :
            redirect()->route('welcome.show');
    }

    // Log out of the user (client or veterinary) and redirection to the welcome page
    public function logout(Request $request) {
        $request->session()->forget('user');
        $request->session()->forget('userType');
        $request->session()->forget('backUrl');
        return redirect()->route('welcome.show');
    }

    // Dispaly of the slots available for a veterinary
    public function showCreneaux() {
        $vetos = $this->repository->veterinaires();
        $creneaux = $this->repository->availableSlots();
        return view('creneaux', ['vetos' => $vetos, 'creneaux' => $creneaux]);
    }

    // Display of the form to create a slot ==> Veterinary account userType=1
    public function showCreateSlotsForm(Request $request) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') != 1)
            return redirect()->route('welcome.show');
        return view('create_slots');
    }

    // Save the slots added to the database after validation of the form
    public function storeSlots(Request $request) {
        $rules = [
            'startDate' => ['required', 'date'],
            'startTime' => ['required', 'date_format:H:i', 'before:endTime'],
            'endTime' => ['required', 'date_format:H:i', 'after:startTime'],
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
            $this->repository->insertCreatedSlots($slots, $validatedData['duration'], $request->session()->get('user'));
        } 
        
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['startDate' => "Impossible de créer vos créneaux." . $e->getMessage()]);
        }
        return redirect()->route('welcome.show');
    }

    // Display of the form to add an animal ==> account client userType=2
    public function createAnimal(Request $request) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') != 2)
            return redirect()->route('welcome.show');
        return view('create_animal');
    }

    // Saving the animal in the database after validating the form
    public function storeAnimal(Request $request) {
        $rules = [
            'photoAnimal' => ['image'],
            'nameAnimal' => ['required', 'regex:/^[\p{L}-]+$/u'],
            'dateAnimal' => ['required', 'date'],
            'typeAnimal' => ['required', 'exists:Especes,TypeAnimal'],
            'sexeAnimal' => ['required'],
            'sterilisationAnimal' => ['required'],
            'poidsAnimal' => ['numeric', 'nullable'],
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
        $validatedData = $request->validate($rules, $messages);
        try {
            $IDAnimal = $this->repository->insertAnimaux([
                'NomAnimal' => $validatedData['nameAnimal'],
                'DateNaissAnimal' => $validatedData['dateAnimal'],
                'SterilisationAnimal' => $validatedData['sterilisationAnimal'],
                'PoidsAnimal' => $validatedData['poidsAnimal'],
                'SexeAnimal' => $validatedData['sexeAnimal'],
                'PathologiesAnimal' => $validatedData['pathologiesAnimal'],
                'IDClient' => $request->session()->get('user'),
                'TypeAnimal' => $validatedData['typeAnimal']
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Impossible d'ajouter l'animal");
        }
        // photo de l'animal :
        // if($request->photoAnimal != NULL)
        //     Storage::disk('local')->put("animals/$IDAnimal",$request->photoAnimal);
        // else
        //     Storage::copy('animals/image.jpg', "animals/$IDAnimal/image.jpg");

        return ($url = $request->session()->get('backUrl')) ?
            redirect($url) :
            redirect()->route('client.show', ['IDClient' => $request->session()->get('user')]);
    }

    // Display of confirmation of a slot for an appointment
    public function showConfirmSlotForm(Request $request, int $IDCreneau) {
        if (!($request->session()->has('user'))) {
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $request->session()->put('backUrl', $url);
            return redirect()->route('login.show');
        }

        if ($request->session()->get('userType') == 1)
            return redirect()->route('welcome.show');
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $request->session()->put('backUrl', $url);
        $creneau = $this->repository->creneau($IDCreneau);
        $animaux = $this->repository->animauxProprio($request->session()->get('user'));
        return view('confirmation', ['creneau' => $creneau, 'animaux' => $animaux]);
    }

    // Display of the client profile for the client and the veterinary of the client
    public function showClient(Request $request, int $IDClient) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if (($request->session()->get('userType') == 2) && ($request->session()->get('user') != $IDClient))
            return redirect()->route('welcome.show');
        if (($request->session()->get('userType') == 1) && ($this->repository->isVetofClient($IDClient, $request->session()->get('user')) == 0))
            return redirect()->route('welcome.show');
        if ($request->session()->get('userType') == 1)
            $animaux = $this->repository->listAnimalsOfClient($request->session()->get('user'), $IDClient);
        else
            $animaux = $this->repository->animauxProprio($IDClient);
        $client = $this->repository->client($IDClient)[0];
        return view('client_profile', ['animaux' => $animaux, 'client' => $client]);
    }

    // Display of the animal file for the client and for the veterinary of the animal
    public function showAnimal(Request $request, int $IDClient, int $IDAnimal) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if (($request->session()->get('userType') == 2) && ($request->session()->get('user') != $IDClient))
            return redirect()->route('welcome.show');
        if (($request->session()->get('userType') == 1) && ($this->repository->isVetofAnimal($IDAnimal, $request->session()->get('user')) == 0))
            return redirect()->route('welcome.show');
        $animal = $this->repository->animal($IDAnimal);
        $consultations = $this->repository->getAnimalAppointments($IDAnimal);
        return view('animal_profil', ['animal' => $animal, 'consults' => $consultations]);
    }

    // saving a confirmed appointement in the database
    function storeSlotConfirmation(Request $request, int $IDCreneau) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') == 1)
            return redirect()->route('welcome.show');
        $rules = ['animal' => ['exists:Animaux,IDAnimal']];
        $messages = ['animal.exists' => 'Vous devez choisir un animal existant.'];
        $validatedData = $request->validate($rules, $messages);
        try {
            $IDVeto = $this->repository->creneau($IDCreneau)->IDVeto;
            $this->repository->isVetofType($validatedData['animal'], $IDVeto);
        } 
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Type non pris en charge.");
        }
        try {
            $this->repository->insertConsultation([
                'ObsConsult' => " ",
                'MotifConsult'  => " ",
                'IDAnimal'  => $validatedData['animal'],
                'IDCreneau'  => $IDCreneau
            ]);
        } 
        catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Le créneaux a déjà été réservé.");
        }


        return redirect()->route('appointments.show');
    }

    // Display of the appointments (history and upcoming) ==> Client account userType=2
    public function showClientAppointments(Request $request) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') == 1)
            return redirect()->route('welcome.show');
        $futureConsults = $this->repository->getFutureAppointmentsClient($request->session()->get('user'));
        $pastConsults = $this->repository->getPastAppointmentsClient($request->session()->get('user'));
        return view('client_appointments', ['pastConsults' => $pastConsults, 'futureConsults' => $futureConsults]);
    }

    // Display of the veterinary's schedule, appointments with clients, consultation motives, date and time...
    // Veterinary account userType=1
    public function showBookedSlotsList(Request $request) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') != 1)
            return redirect()->route('welcome.show');
        $veto = $this->repository->veterinaire($request->session()->get('user'));
        $consultations = $this->repository->bookedSlotsVeto($request->session()->get('user'));
        return view('booked_slots', ['veto' => $veto, 'consultations' => $consultations]);
    }

    // Display of the clients for the veterinary: list of the clients and their pets with info
    // Veterinary account userType=1
    public function showClientsList(Request $request) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') != 1)
            return redirect()->route('welcome.show');
        $clients = $this->repository->listClients($request->session()->get('user'));
        $animals = $this->repository->listAnimals($request->session()->get('user'));
        return view('clients_list', ['clients' => $clients, 'animals' => $animals]);
    }

    // Shows a list of results (veterinaries) when searching by zip code and animal category
    public function searchByZipCode(Request $request) {
        $rules = [
            'codePostal' => ['regex:/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/'],
            'categorie_animal1' => ['required']
        ];
        $messages = [
            'codePostal.regex' => 'Vous devez saisir code postal valide.',
            'categorie_animal1.required' => 'Vous devez renseigner la catégorie de votre animal'
        ];
        $validatedData = $request->validate($rules, $messages);

        try {
            $vets = $this->repository->vetByZipCode($validatedData['codePostal'], $validatedData['categorie_animal1']);
            $slots = $this->repository->availableSlotsZipCode($validatedData['codePostal']);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Recherche impossible");
        }
        return view('search_results', ['vetos' => $vets, 'creneaux' => $slots]);
    }

    // Shows a list of results (veterinaries) when searching by name of the veterinary and animal category
    public function searchByName(Request $request) {
        $rules = [
            'nom' => ['regex:/^[\p{L}-]+$/u'],
            'categorie_animal2' => ['required']
        ];
        $messages = [
            'nom.regex' => 'Vous devez un nom valide.',
            'categorie_animal2.required' => 'Vous devez renseigner la catégorie de votre animal'
        ];
        $validatedData = $request->validate($rules, $messages);

        $vets = $this->repository->vetByName($validatedData['nom'], $validatedData['categorie_animal2']);
        $slots = $this->repository->availableSlotsName($validatedData['nom']);
        return view('search_results', ['vetos' => $vets, 'creneaux' => $slots]);
    }

    // deleting an appointment
    public function deleteAppointment(Request $request, int $IDConsult) {
        try {
            $this->repository->deleteAppointment($IDConsult);
        } 
        
        catch (Exception $e) {
            return redirect()->back()->withErrors("Annulation impossible");
        }
        return redirect()->back();
    }

    // Display of the form to modify/update the consultation in the animal file
    // Veterinary account userType=1
    public function showAppointmentUpdateForm(Request $request, int $IDClient, int $IDAnimal, int $IDConsult) {
        if (!($request->session()->has('user')))
            return redirect()->route('login.show');
        if ($request->session()->get('userType') == 2)
            return redirect()->route('welcome.show');
        if (($request->session()->get('userType') == 1) && ($this->repository->isAppointmentofVet($IDConsult, $request->session()->get('user')) == 0))
            return redirect()->route('welcome.show');
        $consult = $this->repository->getAnimalAppointment($IDAnimal, $IDConsult);
        return view('update_appointment', ['consult' => $consult]);
    }

    // Saving the modifications of the consultations, added by the veterinary in the animal file, in the database
    public function storeAppointmentUpdate(Request $request, int $IDClient, int $IDAnimal, int $IDConsult) {
        $rules = [
            'motifConsult' => ['string', 'nullable'],
            'obsConsult' => ['string', 'nullable']
        ];
        $messages = [
            'motifConsult.string' => ['Votre motif doit être valide.'],
            'obsConsult.string' => ['Vos observations doivent être valides.']
        ];
        $validatedData = $request->validate($rules, $messages);
        try {
            $this->repository->updateAppointment($IDConsult, $validatedData['motifConsult'], $validatedData['obsConsult']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Modification impossible");
        }
        return redirect()->route('animal.show', ['IDClient' => $IDClient, 'IDAnimal' => $IDAnimal]);
    }
}
