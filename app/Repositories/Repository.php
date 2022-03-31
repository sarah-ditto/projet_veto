<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Repositories\Data;


class Repository {

    // create database
    function createDatabase(): void  {
        DB::unprepared(file_get_contents('database/build.sql'));
    }

    // insert zip codes in the database
    function insertCodesPostaux(array $cp): int{ 
        return DB::table('CodesPostaux')
        ->insertGetId(['CodePostal' => $cp['CodePostal'],
                        'Ville'=> $cp['Ville']]);
    } 

    // insert veterinaries in the database
    function insertVeterinaires(array $veto): int{   
        return array_key_exists("IDVeto", $veto) ? 
        DB::table('Veterinaires')
            ->insertGetId([ "IDVeto"=>$veto['IDVeto'], 
                            'MailVeto' =>$veto['MailVeto'], 
                            'NomVeto' =>$veto['NomVeto'],
                            'PrenomVeto' =>$veto['PrenomVeto'], 
                            'MdpVeto' =>$veto['MdpVeto'],
                            'TelVeto' =>$veto['TelVeto'],
                            'NumRueVeto' => $veto['NumRueVeto'],
                            'NomRueVeto' => $veto['NomRueVeto'],
                            'PresentationVeto' =>$veto['PresentationVeto'],
                            'CodePostalVeto' =>$veto['CodePostalVeto'],
            ])
            : DB::table('Veterinaires')
            ->insertGetId([  
                            'MailVeto' =>$veto['MailVeto'], 
                            'NomVeto' =>$veto['NomVeto'],
                            'PrenomVeto' =>$veto['PrenomVeto'], 
                            'MdpVeto' =>$veto['MdpVeto'],
                            'TelVeto' =>$veto['TelVeto'],
                            'NumRueVeto' => $veto['NumRueVeto'],
                            'NomRueVeto' => $veto['NomRueVeto'],
                            'PresentationVeto' =>$veto['PresentationVeto'],
                            'CodePostalVeto' =>$veto['CodePostalVeto'],
            ])
        ;
    }

    // return a veterniary using his ID
    function veterinaire ( int $IDveto){
        $veto = DB::table('Veterinaires')->where('IDVeto',$IDveto)
        ->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=', 'CodesPostaux.CodePostal')->get()->toArray()[0];
        if (count((array)$veto)==0)
           throw new Exception('Vétérinaire inconnu');
        return $veto;
    }

    // returns a list of veterinaries
    function veterinaires(){
        return  
        DB::table('Veterinaires')->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=', 'CodesPostaux.CodePostal')
        -> get()->toArray();
    
    }

    // returns slots
    function creneaux(){
        return  
        DB::table('Creneaux')->get()->toArray();
    
    }

    // returns a slot using its ID
    function creneau(int $IDCreneau){
        $creneau = DB::table('Creneaux')->where('IDCreneau',$IDCreneau)
        ->join('Veterinaires', 'Creneaux.IDVeto', '=', 'Veterinaires.IDVeto')
        ->join('CodesPostaux', 'CodesPostaux.CodePostal', '=', 'Veterinaires.CodePostalVeto')->get()->toArray();
        if (count($creneau)==0)
            throw new Exception('Creneau inconnu');
        return $creneau[0];
    }
    
    // insert Clients into database
    function insertClients (array $client) :int{
        return array_key_exists("IDClient", $client) ? 
        DB::table('Clients')
            ->insertGetId([ "IDClient"=>$client['IDClient'], 
                            'MailClient' =>$client['MailClient'], 
                            'NomClient' =>$client['NomClient'],
                            'PrenomClient' =>$client['PrenomClient'], 
                            'MdpClient' =>$client['MdpClient'],
                            'TelClient' =>$client['TelClient'],
                            'NumRueClient' => $client['NumRueClient'],
                            'NomRueClient' => $client['NomRueClient'],
                            'CodePostalClient' =>$client['CodePostalClient']
            ])
            : DB::table('Clients')
            ->insertGetId([  
                            'MailClient' =>$client['MailClient'], 
                            'NomClient' =>$client['NomClient'],
                            'PrenomClient' =>$client['PrenomClient'], 
                            'MdpClient' =>$client['MdpClient'],
                            'TelClient' =>$client['TelClient'],
                            'NumRueClient' => $client['NumRueClient'],
                            'NomRueClient' => $client['NomRueClient'],
                            'CodePostalClient' =>$client['CodePostalClient']
            ]);
    }


    // returns clients list
    function clients(): array{
        return DB::table('Clients')->get()->toArray();
    }

    // return a client using its ID
    function client(int $clientId): array{
        //get et toArray renvoie des tableaux de tableaux
        $client=DB::table('Clients')
        ->join('CodesPostaux','Clients.CodePostalClient','=','CodesPostaux.CodePostal')
        ->where('IDClient', $clientId)->get()->toArray();
        if(empty($client))
            throw new Exception("Client inconnu");
        return $client;
    }

    // insert a species
    function insertEspeces (array $Especes) :int{
        return  
        DB:: table('Especes')
            ->insertGetId(['TypeAnimal' => $Especes ['TypeAnimal']]);
    }

    // insert animals
    function insertAnimaux(array $Animaux) :int{
        return array_key_exists("IDAnimaux", $Animaux) ? 
        DB:: table('Animaux')
        ->insertGetId([ 'IDAnimaux' => $Animaux ['IDAnimaux'],
                        'NomAnimal' => $Animaux ['NomAnimal'], 
                        'DateNaissAnimal'=> $Animaux ['DateNaissAnimal'], 
                        'SterilisationAnimal' => $Animaux ['SterilisationAnimal'], 
                        'PoidsAnimal' => $Animaux ['PoidsAnimal'], 
                        'SexeAnimal' => $Animaux ['SexeAnimal'], 
                        'PathologiesAnimal' => $Animaux ['PathologiesAnimal'], 
                        'IDClient' => $Animaux ['IDClient'], 
                        'TypeAnimal' => $Animaux ['TypeAnimal'],
        ])
        : DB::table('Animaux')
        ->insertGetId(['NomAnimal' => $Animaux ['NomAnimal'], 
                        'DateNaissAnimal'=> $Animaux ['DateNaissAnimal'],
                        'SterilisationAnimal' => $Animaux ['SterilisationAnimal'], 
                        'PoidsAnimal' => $Animaux ['PoidsAnimal'], 
                        'SexeAnimal' => $Animaux ['SexeAnimal'], 
                        'PathologiesAnimal' => $Animaux ['PathologiesAnimal'], 
                        'IDClient' => $Animaux ['IDClient'], 
                        'TypeAnimal' => $Animaux ['TypeAnimal'],
        ]);
   }

    // returns all the animals of the database
    function animaux(): array{
        return DB::table('Animaux')->get()->toArray();
    }

    // returns all the animals of an owner/client
    function animauxProprio ($IDClient): array {
        return  
        DB::table('Animaux')->where('IDClient',$IDClient)-> get()->toArray();
    }

    // Displays an animal
    function animal ($IDAnimal){
        $animal = DB::table('Animaux')->where('IDAnimal',$IDAnimal)-> get()->toArray()[0];
        return $animal;
    }

    // return a consultation using its ID
    function consultation($IDConsult){
        return  
        DB::table('Consultations')->where('IDConsult',$IDConsult)-> get()->toArray();
    }

    // interts a slot in the database
   function insertCreneaux(array $Creneaux) :int{
        return array_key_exists("IDCreneau", $Creneaux) ? 
        DB:: table('Creneaux')
        ->insertGetId([ 'IDCreneau' => $Creneaux ['IDCreneau'],
                        'DateCreneau' => $Creneaux ['DateCreneau'],
                        'DureeCreneau' => $Creneaux ['DureeCreneau'],
                        'IDVeto'=> $Creneaux ['IDVeto'], 
        ])

        : DB::table('Creneaux')
        ->insertGetId(['DateCreneau' => $Creneaux ['DateCreneau'], 
                    'IDVeto'=> $Creneaux ['IDVeto'],
                    'DureeCreneau' => $Creneaux ['DureeCreneau'] 
        ]);
   }

   // inserts a consultation in the database
   function insertConsultation(array $Consultations) :int{
        return array_key_exists("IDConsult", $Consultations) ? 
        DB:: table('Consultations')
        ->insertGetId(['IDConsult' => $Consultations ['IDConsult'],
                        'ObsConsult' => $Consultations ['ObsConsult'], 
                        'MotifConsult'  => $Consultations ['MotifConsult'],
                        'IDAnimal'  => $Consultations ['IDAnimal'],
                        'IDCreneau'  => $Consultations ['IDCreneau']
        ])

        : DB::table('Consultations')
        ->insertGetId(['ObsConsult' => $Consultations ['ObsConsult'], 
                        'MotifConsult'  => $Consultations ['MotifConsult'],
                        'IDAnimal'  => $Consultations ['IDAnimal'],
                        'IDCreneau'  => $Consultations ['IDCreneau']
        ])
        ;
   }
   

   // inserts species of animals supported
   function insertPriseEnCharge (array $PriseEnCharge) :int{
        return  
        DB:: table('PriseEnCharge')
            ->insertGetId(['EspeceAnimal' => $PriseEnCharge ['EspeceAnimal'],
                           'IDVeto'  => $PriseEnCharge ['IDVeto' ],
            ])
        ;
    }

    

    // fills the database
    function fillDatabase(): void {
        $this->data = new Data();

        foreach($this->data->CodesPostaux() as $cp){
            $this->insertCodesPostaux($cp);
        }
        foreach($this->data->Veterinaires() as $veto){
               $this->insertVeterinaires($veto);
        }
        foreach($this->data->Clients()as$Clients){
               $this->insertClients($Clients);
           }
        foreach($this->data->Especes()as$Especes){
             $this->insertEspeces($Especes);
        }
        foreach($this->data->Animaux()as$Animaux){
             $this->insertAnimaux($Animaux);
        }
    
        foreach($this->data->Creneaux()as$Creneau){
             $this->insertCreneaux($Creneau);
        }

        foreach($this->data->Consultations()as$Consultations){
             $this->insertConsultation($Consultations);
        }
        foreach($this->data->PriseEnCharge()as$PriseEnCharge){
            $this->insertPriseEnCharge($PriseEnCharge);
        }
        
    }

    // adds a new client in the database
    function addClient(string $mail, string $mdp, string $nom, string $prenom, string $tel,
        string $nomRue, int $numRue, string $cp, string $ville): int
        {
            $user = DB::table('Clients')->where('MailClient', $mail)->get()->toArray();
            if (count($user)!=0)
                throw new Exception('Utilisateur inconnu');
            $mdpHash =  Hash::make($mdp);
            $loc = DB::table('CodesPostaux')->where('CodePostal', $cp)
            ->where('Ville',$ville)->get()->toArray();
            if (count($loc)==0)
                $this->insertCodesPostaux(['CodePostal' => $cp,'Ville'=> $ville]);
            return $this->insertClients(['MailClient' => $mail,
                                'NomClient'  => $nom,
                                'PrenomClient'  => $prenom,
                                'TelClient'  => $tel,
                                'MdpClient'  => $mdpHash,
                                'NumRueClient' => $numRue,
                                'NomRueClient' => $nomRue,
                                'CodePostalClient' => $cp
                                ]);
        }

        // adds a new veterinary in the database
        function addVet(string $mail, string $mdp, string $nom, string $prenom, string $tel,
        string $nomRue, int $numRue, string $cp, string $ville, string $presentation, ): int
        {
            $user = DB::table('Veterinaires')->where('MailVeto', $mail)->get()->toArray();
            if (count($user)!=0)
                throw new Exception('Utilisateur inconnu');
            $mdpHash =  Hash::make($mdp);
            
            $loc = DB::table('CodesPostaux')->where('CodePostal', $cp)
            ->where('Ville',$ville)->get()->toArray();
            if (count($loc)==0)
                $this->insertCodesPostaux(['CodePostal' => $cp,'Ville'=> $ville]);
            return DB::table('Veterinaires')->insertGetId([ 'MailVeto' => $mail, 
                                'NomVeto' => $nom,
                                'PrenomVeto' =>$prenom, 
                                'MdpVeto' =>$mdpHash,
                                'TelVeto' =>$tel,
                                'NumRueVeto' => $numRue,
                                'NomRueVeto' => $nomRue,
                                'PresentationVeto' =>$presentation,
                                'CodePostalVeto' =>$cp]);

            
        }

        // returns a table of users
        function getUser(string $email, string $password): array
        {
            $userVeto = DB::table('Veterinaires')->where('MailVeto', $email)->select(['IDVeto as ID','MdpVeto as Password','1 as Type']);
            $user = DB::table('Clients')->where('MailClient', $email)->select(['IDClient as ID','MdpClient as Password','2 as Type'])
                    ->union($userVeto)->get(['ID','Password','Type']);
            
            
            if (count($user)==0)
                throw new Exception('Utilisateur inconnu');
            else{
                $passwordHash = $user->first()->Password;
                if(!(Hash::check($password, $passwordHash)))
                    throw new Exception('Utilisateur inconnu');
                return ['user' => $user->first()->ID,'userType' => $user->first()->Type];
            }
        }

        // generates a table of slots using a start and an end date
        function createSlots(string $debutjour, string $finjour, int $temps): array
        {
                $date =  Carbon::parse($debutjour);
                $fin =  Carbon::parse($finjour);
                $tab_date = [$date];
                if ((Carbon::parse($date)->gt($fin))||($date<Carbon::now()))
                    throw new Exception('Dates incompatibles.');
                while($date < Carbon::parse($fin)->subMinutes($temps)){
                    $newDateTime = Carbon::parse($date)->addMinutes($temps);
                    $date =  $newDateTime;
                    array_push($tab_date,$date);
                }
    
                return $tab_date;
        }
    
       // inserts the list of slots generated by the veterinary in the table Crénaux (slots)
       function insertCreatedSlots(array $tab_date, $duration, $IDVeto): void{
            $existingSlots = $this->vetSlots($IDVeto);
            foreach ($existingSlots as $existingSlot){
                $startdate = $existingSlot->DateCreneau;
                $enddate = Carbon::parse($startdate)->addMinutes($existingSlot->DureeCreneau);
                foreach ($tab_date as $date){
                    if (Carbon::parse($date)->gte(Carbon::parse($startdate)) && Carbon::parse($date)->lt(Carbon::parse($enddate)))
                        throw new Exception('Dates incompatibles avec les créneaux déjà exisants.');
                }
            }
            foreach($tab_date as $date){
                $this->insertCreneaux(['IDVeto'=>$IDVeto,'DateCreneau'=>$date,'DureeCreneau'=>$duration]);
            }
       }

       // returns the slots of a veterenary using its ID
       function vetSlots(int $IDVeto){
           return DB::table('Creneaux')->where('IDVeto',$IDVeto)->get()->toArray();
       }

       // returns available slots
       function availableSlots(){
        $today = new Carbon();
            $slots = DB::table('Creneaux')->select('*')->whereNOTIn('IDCreneau',function($query){
                $query->select('IDCreneau')->from('Consultations');
                })
                ->where('DateCreneau','>',$today)
                ->orderBy('DateCreneau','asc')
                ->get()->toArray();
            return $slots;
       }

        // returns available slots for a veterniary using its ID
       function availableSlotsVeto(int $IDVeto){
            $today = new Carbon();
            $slots = DB::table('Creneaux')->select('*')
            ->whereNOTIn('IDCreneau',function($query){
                $query->select('IDCreneau')->from('Consultations');
            })
            ->where('IDVeto',$IDVeto)
            ->where('DateCreneau','>',$today)
            ->orderBy('DateCreneau','asc')
            ->get()->toArray();
            return $slots;
        }

        // returns client future appointments 
        function getFutureAppointmentsClient(int $IDClient){
            $today = new Carbon();
            $consult = DB::table('Animaux')
            ->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=', 'Veterinaires.IDVeto')
            ->where('Animaux.IDClient',$IDClient)
            ->where('Creneaux.DateCreneau','>',$today)
            ->orderBy('Creneaux.DateCreneau','asc')->get()->toArray();
            return $consult;
        }

        // returns client past appointments
        function getPastAppointmentsClient(int $IDClient){
            $today = new Carbon();
            $consult = DB::table('Animaux')->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=', 'Veterinaires.IDVeto')
            ->where('Animaux.IDClient',$IDClient)
            ->where('Creneaux.DateCreneau','<',$today)
            ->orderBy('Creneaux.DateCreneau','desc')->get()->toArray();
            return $consult;
        }

        // returns booked slots for a veterinary
        function bookedSlotsVeto($IDVeto){
            $slots = DB::table('Creneaux')
            ->join('Consultations', 'Creneaux.IDCreneau', '=','Consultations.IDCreneau')
            ->join('Animaux', 'Consultations.IDAnimal', '=','Animaux.IDAnimal')
            ->join('Clients','Animaux.IDClient', '=' ,'Clients.IDClient')
            ->where('IDVeto', $IDVeto)
            ->get()->toArray();
            return $slots; 
        }

        // returns the list of animals that a veterinary consulted
        function listAnimals(int $IDVeto){
            $animals = DB::table('Animaux')
            ->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto',$IDVeto)->select('Animaux.NomAnimal','Animaux.IDAnimal','Animaux.IDClient')->distinct()->get()->toArray();
            return $animals;
        }

        // returns a list of client's animals
        function listAnimalsOfClient(int $IDVeto, int $IDClient){
            $animals = DB::table('Animaux')
            ->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto',$IDVeto)
            ->where('Animaux.IDClient',$IDClient)
            ->get()->toArray();
            return $animals;
        }

        // returns a list of clients for a veterinary
        function listClients(int $IDVeto){
            $clients = DB::table('Clients')->select('*')->distinct()
            ->whereIn('IDClient',function($query) use ($IDVeto){
                $query->select('IDClient')->from('Animaux')->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
                ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
                ->where('Creneaux.IDVeto',$IDVeto);
            })
            ->get()->toArray();
            return $clients;
        }
        
        // returns the veterinary of a client
        function isVetofClient(int $IDClient, int $IDVeto){
            $veto = DB::table('Consultations')
            ->join('Animaux', 'Consultations.IDAnimal', '=','Animaux.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=','Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto',$IDVeto)
            ->where('Animaux.IDClient',$IDClient)->get()->toArray();
            if (count($veto)!=0)
                return 1;
            return 0;
        }

        // returns the veterinary of an animal
        function isVetofAnimal(int $IDAnimal, int $IDVeto){
            $veto = DB::table('Consultations')
            ->join('Creneaux', 'Consultations.IDCreneau', '=','Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto',$IDVeto)
            ->where('Consultations.IDAnimal',$IDAnimal)->get()->toArray();
            if (count($veto)!=0)
                return 1;
            return 0;

        }

        // returns a list of veterinaries by zip code
        function vetByZipCode(string $cp, string $espece){
            $veto = DB::table('Veterinaires')
            ->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=','CodesPostaux.CodePostal')
            ->join('PriseEnCharge', 'Veterinaires.IDVeto', '=','PriseEnCharge.IDVeto')
            ->where('Veterinaires.CodePostalVeto',$cp)
            ->where('PriseEnCharge.EspeceAnimal', $espece)
            ->get()->toArray();
            return $veto;
        }

        // returns a list of available slots by zip code
        function availableSlotsZipCode(string $cp){
            $slots = DB::table('Creneaux')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=','Veterinaires.IDVeto')
            ->select('Creneaux.IDCreneau','Creneaux.DateCreneau','Creneaux.IDVeto')
            ->whereNOTIn('IDCreneau',function($query){
                $query->select('IDCreneau')->from('Consultations');
            })
            ->where('Veterinaires.CodePostalVeto',$cp)
            ->where('DateCreneau','>',Carbon::now())
            ->orderBy('DateCreneau','asc')
            ->get()->toArray();
            return $slots;
        }

        // returns a list of veterinaries usint the zip code, the animals treated and the name
        function vetByName(string $cp, string $espece){
            $veto = DB::table('Veterinaires')
            ->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=','CodesPostaux.CodePostal')
            ->join('PriseEnCharge', 'Veterinaires.IDVeto', '=','PriseEnCharge.IDVeto')
            ->where(DB::raw('lower(Veterinaires.NomVeto)'), strtolower($cp))
            ->where('PriseEnCharge.EspeceAnimal', $espece)
            ->get()->toArray();
            return $veto;
        }

        //returns available slots for a veterinary
        function availableSlotsName(string $cp){
            $slots = DB::table('Creneaux')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=','Veterinaires.IDVeto')
            ->select('Creneaux.IDCreneau','Creneaux.DateCreneau','Creneaux.IDVeto')
            ->whereNOTIn('IDCreneau',function($query){
                $query->select('IDCreneau')->from('Consultations');
            })
            ->where(DB::raw('lower(Veterinaires.NomVeto)'), strtolower($cp))
            ->where('DateCreneau','>',Carbon::now())
            ->orderBy('DateCreneau','asc')
            ->get()->toArray();
            return $slots;
        }

        // delete an appointment booked
        function deleteAppointment(int $IDConsult){
            $consult = DB::table('Consultations')
            ->where('IDConsult', $IDConsult)
            ->join('Creneaux', 'Creneaux.IDCreneau', '=','Consultations.IDCreneau')
            ->get();
            if (count($consult)==0)
                throw new Exception('Consultation inconnue');
            if ($consult->first()->DateCreneau<Carbon::now())
                throw new Exception('Consultation passée'); 
            DB::table('Consultations')
            ->where('IDConsult', $IDConsult)
            ->delete();
        }

        // returns a list of animal's appointments
        function getAnimalAppointments(int $IDAnimal){
            $consult = DB::table('Consultations')
            ->join('Creneaux', 'Creneaux.IDCreneau', '=','Consultations.IDCreneau')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=','Veterinaires.IDVeto')
            ->join('Animaux', 'Consultations.IDAnimal', '=','Animaux.IDAnimal')
            ->where('Animaux.IDAnimal', $IDAnimal)
            ->orderBy('DateCreneau','desc')
            ->get()->toArray();
            if (count($consult)==0)
                throw new Exception('Consultation inconnue');
            return $consult;
        }

        // returns animal's appointment
        function getAnimalAppointment(int $IDAnimal, int $IDConsult){
            $consult = DB::table('Consultations')
            ->join('Animaux', 'Consultations.IDAnimal', '=','Animaux.IDAnimal')
            ->where('Animaux.IDAnimal', $IDAnimal)
            ->where('Consultations.IDConsult', $IDConsult)
            ->get()->toArray();
            if (count($consult)==0)
                throw new Exception('Consultation inconnue');
            return $consult[0];
        }

        // update appointment (observations)
        function updateAppointment(int $IDConsult, $motifConsult, $obsConsult){
            $consult = DB::table('Consultations')->where('IDConsult',$IDConsult)->get();
            if (count($consult)==0)
                throw new Exception('Consultation inconnue');
            DB::table('Consultations')
            ->where('IDConsult', $IDConsult)
            ->update(['MotifConsult' => $motifConsult, 'ObsConsult'=> $obsConsult]);
        }

        //  
        function isAppointmentofVet(int $IDConsult, int $IDVeto){
            $consult= DB::table('Consultations')
            ->join('Creneaux', 'Consultations.IDCreneau', '=','Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto', $IDVeto)
            ->where('Consultations.IDConsult', $IDConsult)
            ->get()->toArray();
            if (count($consult)==0)
                return 0;
            return 1;
        }

        function isVetofType(int $IDAnimal, int $IDVeto){
            $veto = DB::table('PriseEnCharge')
            ->join('Animaux', 'PriseEnCharge.EspeceAnimal', '=','Animaux.TypeAnimal')
            ->where('PriseEnCharge.IDVeto',$IDVeto)
            ->where('Animaux.IDAnimal',$IDAnimal)
            ->get()->toArray();
            if (count($veto)==0)
                throw new Exception('Type non pris en charge.');
        }

        function getVetPriseEnCharge(int $IDVeto){
            return DB::table('PriseEnCharge')->where('IDVeto',$IDVeto)->get()->toArray();
        }
}