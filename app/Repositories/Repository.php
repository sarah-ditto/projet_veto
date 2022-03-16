<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Repositories\Data;


class Repository{

    function createDatabase(): void  {
        DB::unprepared(file_get_contents('database\build.sql'));
    }

    function insertCodesPostaux(array $cp): int{ 
        return DB::table('CodesPostaux')
        ->insertGetId(['CodePostal' => $cp['CodePostal'],
                        'Ville'=> $cp['Ville']]);
    } 

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

    function veterinaire ( int $IDveto){
        $veto = DB::table('Veterinaires')->where('IDVeto',$IDveto)
        ->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=', 'CodesPostaux.CodePostal')->get()->toArray()[0];
        if (count((array)$veto)==0)
           throw new Exception('Vétérinaire inconnu');
        return $veto;
    }

    function veterinaires(){
        return  
        DB::table('Veterinaires')->join('CodesPostaux', 'Veterinaires.CodePostalVeto', '=', 'CodesPostaux.CodePostal')
        -> get()->toArray();
    
    }


    function creneaux(){
        return  
        DB::table('Creneaux')->get()->toArray();
    
    }

    function creneau(int $IDCreneau){
        $creneau = DB::table('Creneaux')->where('IDCreneau',$IDCreneau)
        ->join('Veterinaires', 'Creneaux.IDVeto', '=', 'Veterinaires.IDVeto')->get()->toArray();
        if (count($creneau)==0)
            throw new Exception('Creneau inconnu');
        return $creneau[0];
    }
    
    
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


    function clients(): array{
        return DB::table('Clients')->get()->toArray();
    }

    function client(int $clientId): array{
        //get et toArray renvoie des tableaux de tableaux
        $client=DB::table('Clients')->where('IDClient', $clientId)->get()->toArray();
        if(empty($client))
            throw new Exception("Client inconnu");
        return $client;
    }

    function insertEspeces (array $Especes) :int{
        return  
        DB:: table('Especes')
            ->insertGetId(['TypeAnimal' => $Especes ['TypeAnimal']]);
    }

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

    //affcihe tous les animaux de la base
    function animaux(): array{
        return DB::table('Animaux')->get()->toArray();
    }

    //affiche tous les animaux d'un proprietaire
    function animauxProprio ($IDClient): array {
        return  
        DB::table('Animaux')->where('IDClient',$IDClient)-> get()->toArray();
    }

    // Affiche un animal
    function animal ($IDAnimal){
        $animal = DB::table('Animaux')->where('IDAnimal',$IDAnimal)-> get()->toArray()[0];
        return $animal;
    }

   function insertCreneaux(array $Creneaux) :int{
        return array_key_exists("IDCreneau", $Creneaux) ? 
        DB:: table('Creneaux')
        ->insertGetId([ 'IDCreneau' => $Creneaux ['IDCreneau'],
                        'DateCreneau' => $Creneaux ['DateCreneau'], 
                        'IDVeto'=> $Creneaux ['IDVeto'], 
        ])

        : DB::table('Creneaux')
        ->insertGetId(['DateCreneau' => $Creneaux ['DateCreneau'], 
                    'IDVeto'=> $Creneaux ['IDVeto'], 
        ]);
   }

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
   

   function insertPriseEnCharge (array $PriseEnCharge) :int{
        return  
        DB:: table('PriseEnCharge')
            ->insertGetId(['EspeceAnimal' => $PriseEnCharge ['EspeceAnimal'],
                           'MailVeto'  => $PriseEnCharge ['MailVeto' ],
            ])
        ;
    }

    function insertHorairesVeto (array $HorairesVeto) :int{
        return  
        DB:: table('HorairesVeto')
            ->insertGetId(['DateDebutAM'  => $HorairesVeto ['DateDebutAM'],
                            'DateFinAM'  => $HorairesVeto ['DateFinAM'],
                            'DateDebutPM'  => $HorairesVeto ['DateDebutPM'],
                            'DateFinPM'  => $HorairesVeto ['DateFinPM'],
                            'MailVeto'  => $HorairesVeto ['MailVeto']
            ])
        ;
    }


    function fillDatabase(): void {
        $this->data = new Data();

        foreach($this->data->CodesPostaux() as $cp){
            $this->insertCodesPostaux($cp);
        }

        foreach($this->data->Veterinaires() as $veto){
              $this->insertVeterinaires($veto);
        }
        //  foreach($this->data->Clients()as$Clients){
        //      $this->insertClients($Clients);
        //  }
        foreach($this->data->Especes()as$Especes){
            $this->insertEspeces($Especes);
        }
        //  foreach($this->data->Animaux()as$Animaux){
        //      $this->insertAnimaux($Animaux);
        //  }
    
        //  foreach($this->data->Creneaux()as$Creneau){
        //      $this->insertCreneaux($Creneau);
        //  }

        //  foreach($this->data->Consultations()as$Consultations){
        //       $this->insertConsultation($Consultations);
        // }
        // foreach($this->data->PriseEnCharge()as$PriseEnCharge){
        //     $this->insertPriseEnCharge($PriseEnCharge);
        // }
        // foreach($this->data->HorairesVeto()as$HorairesVeto){
        //     $this->insertHorairesVeto($HorairesVeto);
        // }
    }

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

        function addVet(string $mail, string $mdp, string $nom, string $prenom, string $tel,
        string $nomRue, int $numRue, string $cp, string $ville, string $presentation): int
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

        // génère un tableau de créneaux de $temps minutes à partir d'une date jusqu'à une date de fin
        function generCreneaux(string $debutjour, string $finjour, int $temps): array
        {
                $date =  Carbon::parse($debutjour);
                $fin =  Carbon::parse($finjour);
                $tab_date = [$date];
                if (Carbon::parse($date)->gt($fin))
                    throw new Exception('Dates incompatibles');
                while($date < Carbon::parse($fin)->subMinutes($temps)){
                    $newDateTime = Carbon::parse($date)->addMinutes($temps);
                    $date =  $newDateTime;
                    array_push($tab_date, $date);
                }
    
                return $tab_date;
        }
    
       // Insère la liste de créneaux générés pour un véto dans la table Créneaux
       function insertCreneauxGeneres(array $tab_date, $IDVeto): void{
            foreach($tab_date as $date){
                $this->insertCreneaux(['IDVeto'=>$IDVeto,'DateCreneau'=>$date]);
            }
    
       }

       function availableSlots(){
            $slots = DB::table('Creneaux')->select('*')->whereNOTIn('IDCreneau',function($query){
                $query->select('IDCreneau')->from('Consultations');
                })
                ->get()->toArray();
            return $slots;
       }

       function availableSlotsVeto(int $IDVeto){
            $slots = DB::table('Creneaux')->select('*')->whereNOTIn('IDCreneau',function($query){
            $query->select('IDCreneau')->from('Consultations');
            })
            ->where('IDVeto',$IDVeto)->get()->toArray();
            return $slots;
        }

        function getConsultClient(int $IDClient){
            $consult = DB::table('Animaux')->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->join('Veterinaires', 'Creneaux.IDVeto', '=', 'Veterinaires.IDVeto')
            ->where('Animaux.IDClient',$IDClient)->get()->toArray();
            return $consult;
        }
        
        function bookedSlotsVeto($IDVeto){
            $slots = DB::table('Creneaux')
            -> JOIN ('Consultations', 'Creneaux.IDCreneau', '=','Consultations.IDCreneau')
            ->JOIN('Animaux', 'Consultations.IDAnimal', '=','Animaux.IDAnimal')
            ->JOIN ('Clients','Animaux.IDClient', '=' ,'Clients.IDClient')
            -> where ('IDVeto', $IDVeto)
            
                ->get()->toArray();
            return $slots; 
        }

        function listAnimals(int $IDVeto){
            $animals = DB::table('Animaux')->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
            ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
            ->where('Creneaux.IDVeto',$IDVeto)->get()->toArray();
            return $animals;
        }

        function listClients(int $IDVeto){
            $clients = DB::table('Clients')->select('*')->whereIn('IDClient',function($query) use ($IDVeto){
                $query->select('IDClient')->from('Animaux')->join('Consultations', 'Animaux.IDAnimal', '=', 'Consultations.IDAnimal')
                ->join('Creneaux', 'Consultations.IDCreneau', '=', 'Creneaux.IDCreneau')
                ->where('Creneaux.IDVeto',$IDVeto);
                })
                ->get()->toArray();
            return $clients;
        } 
}