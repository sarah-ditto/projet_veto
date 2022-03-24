<?php

namespace App\Repositories;


class Data {
    function CodesPostaux(){
        return [
            ['CodePostal' => '13001',
            'Ville' => 'Marseille'],
            ['CodePostal' => '13010',
            'Ville' => 'Marseille'],
            ['CodePostal' => '13005',
            'Ville' => 'Marseille'],
            ['CodePostal' => '13015',
            'Ville' => 'Marseille'],
            ['CodePostal' => '13016',
            'Ville' => 'Marseille'],

            ['CodePostal' => '75005',
            'Ville' => 'Paris'],
            ['CodePostal' => '75015',
            'Ville' => 'Paris'],
            ['CodePostal' => '75013',
            'Ville' => 'Paris'],
            ['CodePostal' => '75014',
            'Ville' => 'Paris'],
            ['CodePostal' => '75012',
            'Ville' => 'Paris'],
            
        ];
    }


    function Veterinaires(){
        return [
            ['MailVeto' => 'BenoitLambert@gmail.com', 
            'NomVeto' => 'Lambert', 
            'PrenomVeto' => 'Benoit', 
            'MdpVeto'=> 'jvjhbj6l', 
            'TelVeto'=> '0647700256', 
            'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Nantes  1986/1990',
            'NumRueVeto' => 31,
            'NomRueVeto' =>'Rue du Canada',
            'CodePostalVeto'=> 13001 ],

            ['MailVeto' => 'Carobosch@gmail.com', 
            'NomVeto' => 'Caroline', 
            'PrenomVeto' => 'Bosch', 
            'MdpVeto'=> 'jvjhbjel', 
            'TelVeto'=> '0644324688', 
            'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Nantes  1986/1990',
            'NumRueVeto' => 31,
            'NomRueVeto' =>'Rue du Canada',
            'CodePostalVeto'=> 13000 ],

            ['MailVeto' => 'BoschMarie@gmail.com', 
            'NomVeto' => 'Bosch', 
            'PrenomVeto' => 'Marie', 
            'MdpVeto'=> 'jBIH7h', 
            'TelVeto'=> '0747700686', 
            'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Lyon 2020',
            'NumRueVeto' => 31,
            'NomRueVeto' =>'Rue du Canada',
            'CodePostalVeto'=> 13005],

            ['MailVeto' => 'NathanFernandez@gmail.com', 
             'NomVeto' => 'Nathan', 
             'PrenomVeto' => 'Fernandez', 
             'MdpVeto'=> 'jvj789h', 
             'TelVeto'=> '0647700686', 
             'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Marseille 1986/1990',
             'NumRueVeto' => 31,
             'NomRueVeto' =>'Rue du Canada',
             'CodePostalVeto'=> 13010],


            ['MailVeto' => 'ManuelLacombe@outlook.FR', 
            'NomVeto' => 'Lacombe', 
            'PrenomVeto' => 'Manuel', 
            'MdpVeto'=> 'jvjhbu6l', 
            'TelVeto'=> '0447700256', 
            'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Starsbourg 1998',
            'NumRueVeto' => 31,
            'NomRueVeto' =>'Rue du Canada',
            'CodePostalVeto'=> 13015 ],

            ['MailVeto' => 'CoquelleMelanie@outlook.fr', 
            'NomVeto' => 'Coquelle', 
            'PrenomVeto' => 'Melanie', 
            'MdpVeto'=> 'giu7897', 
            'TelVeto'=> '0756700686', 
            'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Marseille 1989',
            'NumRueVeto' => 31,
            'NomRueVeto' =>'Rue du Canada',
            'CodePostalVeto'=> 13016],

    //         ['MailVeto' => 'CharlotteMisbach@gmail.com', 
    //         'NomVeto' => 'Misbach', 
    //         'PrenomVeto' => 'Charlotte', 
    //         'MdpVeto'=> 'jskNIoFG', 
    //         'TelVeto'=> '0647890695', 
    //         'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Nantes 2005',
    //         'CodePostalVeto'=> 13015],

    //         ['MailVeto' => 'Emmanuelle.Bensiguior@gmail.com', 
    //         'NomVeto' => 'Bensiguior', 
    //         'PrenomVeto' => 'Emmanuelle', 
    //         'MdpVeto'=> 'jBIo7hdf', 
    //         'TelVeto'=> '0638053636', 
    //         'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Lyon 2006',
    //         'CodePostalVeto'=> 13005],

    //         ['MailVeto' => 'Aude.Demyster@outlook.FR', 
    //         'NomVeto' => 'Demyster', 
    //         'PrenomVeto' => 'Aude', 
    //         'MdpVeto'=> 'uoshbu6l', 
    //         'TelVeto'=> '0446789028', 
    //         'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Starsbourg 1994',
    //         'CodePostalVeto'=> 13000 ],

    //         ['MailVeto' => 'Pierre.Moissonier@outlook.fr', 
    //         'NomVeto' => 'Moissonier', 
    //         'PrenomVeto' => 'Pierre', 
    //         'MdpVeto'=> 'giu7jo7', 
    //         'TelVeto'=> '0756390686', 
    //         'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Marseille 1996',
    //         'CodePostalVeto'=> 13010],

    //         ['MailVeto' => 'David.massenet@gmail.com', 
    //         'NomVeto' => 'David', 
    //         'PrenomVeto' => 'Massenet', 
    //         'MdpVeto'=> 'jskNIonG', 
    //         'TelVeto'=> '0749730695', 
    //         'PresentationVeto'=> 'Docteur Veterinaire Ecole Nationale Vétérinaire de Nantes 2002',
    //         'CodePostalVeto'=> 13015],
        ];
     }

    function Clients () {
        return [
            ['MailClient' => 'BenoithhgheLambert@gmail.com', 
            'NomClient'  => 'Bazin',
            'PrenomClient'=>'Benjamin',
            'TelClient'  => '0367536782',
            'MdpClient'  => 'HDJKSL',
            'NumRueClient' => 56 ,
            'NomRueClient' => 'Rue du CANADA',
            'CodePostalClient'=>13010],

            ['MailClient' => 'Maurice.Meyer@outlook.fr', 
            'NomClient'  => 'Maurice',
            'PrenomClient'=>'Meyer',
            'TelClient'  => '0467293894',
            'MdpClient'  => 'HudhjuYj',
            'NumRueClient' => 67 ,
            'NomRueClient' => 'Boulevard Baille',
            'CodePostalClient'=>13016],

            ['MailClient' => 'Bentrand.Texier@gmail.com', 
            'NomClient'  => 'Texier',
            'PrenomClient'=>'Benrtrand',
            'TelClient'  => '0667836082',
            'MdpClient'  => 'HDJnql,',
            'NumRueClient' => 36 ,
            'NomRueClient' => 'Rue de ROME',
            'CodePostalClient'=>13005],

            ['MailClient' => 'Claude.Gosselin@outlook.fr', 
            'NomClient'  => 'Gosselin',
            'PrenomClient'=>'Claude',
            'TelClient'  => '0567293894',
            'MdpClient'  => 'HudsnuYj',
            'NumRueClient' => 90 ,
            'NomRueClient' => 'Rue Montparnasse',
            'CodePostalClient'=>13010],

            ['MailClient' => 'Francois.Paul@gmail.com', 
            'NomClient'  => 'Paul',
            'PrenomClient'=>'Francois',
            'TelClient'  => '0865636782',
            'MdpClient'  => 'HDninsL',
            'NumRueClient' => 50 ,
            'NomRueClient' => 'Rue du carpentras',
            'CodePostalClient'=>13000],

            ['MailClient' => 'Morel.David@outlook.fr', 
            'NomClient'  => 'morel',
            'PrenomClient'=>'David',
            'TelClient'  => '0798093894',
            'MdpClient'  => 'HbkojuYj',
            'NumRueClient' => 70 ,
            'NomRueClient' => 'Boulevard Baille',
            'CodePostalClient'=>13016],

            ['MailClient' => 'Fournier.laurent@gmail.com', 
            'NomClient'  => 'Fournier',
            'PrenomClient'=>'Laurent',
            'TelClient'  => '0798378920',
            'MdpClient'  => 'HDJ79NU,',
            'NumRueClient' => 36 ,
            'NomRueClient' => 'Rue de ROME',
            'CodePostalClient'=>13005],

            ['MailClient' => 'Mathilde.josselin@outlook.fr', 
            'NomClient'  => 'josselin',
            'PrenomClient'=>'Mathilde',
            'TelClient'  => '0668988948',
            'MdpClient'  => 'Hudsnnsj',
            'NumRueClient' => 90,
            'NomRueClient' => 'Rue Montparnasse',
            'CodePostalClient'=>13010],
        ];
    }

    function Especes () {
        return [

            // ['EspeceAnimal'=>'Iguane', 
            // 'TypeAnimal'=> 'NAC', ],
            
            // ['EspeceAnimal'=>'Labradore', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Chihuaha', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Bengal', 
            // 'TypeAnimal'=> 'Felin', ],

            // ['EspeceAnimal'=>'Lésard', 
            // 'TypeAnimal'=> 'NAC', ],

            // ['EspeceAnimal'=>'siamois', 
            // 'TypeAnimal'=> 'Felin', ],

            // ['EspeceAnimal'=>'Chartreux', 
            // 'TypeAnimal'=> 'Felin', ],

            // ['EspeceAnimal'=>'Radgoll', 
            // 'TypeAnimal'=> 'Felin', ],

            // ['EspeceAnimal'=>'Maine coon', 
            // 'TypeAnimal'=> 'Felin', ],

            // ['EspeceAnimal'=>'Beagle', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Boxer', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Berger allemand', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'staff', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Bodeguero', 
            // 'TypeAnimal'=> 'Canin', ],

            // ['EspeceAnimal'=>'Lapin Bélier nain', 
            // 'TypeAnimal'=> 'Rurale', ],

            // ['EspeceAnimal'=>'Vache Limousine', 
            // 'TypeAnimal'=> 'Rurale', ],

            // ['EspeceAnimal'=>'Vache Charolaise', 
            // 'TypeAnimal'=> 'Rurale', ],
            ['TypeAnimal'=> 'CHAT'],
            ['TypeAnimal'=> 'CHIEN'],
            ['TypeAnimal'=> 'NAC'],
            ['TypeAnimal'=> 'RURAL']

        ];
    }

    function Animaux () {
        return [
            [   'NomAnimal' => 'Lilou', 
                'DateNaissAnimal' => '2020-08-03',
                'SterilisationAnimal' => 'TRUE',
                'PoidsAnimal' => '6Kg',
                'SexeAnimal' => 'MALE',
                'PathologiesAnimal' => 'gale aux oreilles',
                'IDClient' => '1',
                'TypeAnimal' => 'CHIEN'],

            [   'NomAnimal' => 'Cliford', 
                'DateNaissAnimal' => '2018-06-02',
                'SterilisationAnimal' => 'TRUE',
                'PoidsAnimal' => '10Kg',
                'SexeAnimal' => 'MALE',
                'PathologiesAnimal' => 'absence',
                'IDClient' => '2',
                'TypeAnimal' => 'CHIEN'],

            [   'NomAnimal' => 'Lana', 
                'DateNaissAnimal' => '2016-03-02',
                'SterilisationAnimal' => 'FALSE',
                'PoidsAnimal' => '12Kg',
                'SexeAnimal' => 'FEMALE',
                'PathologiesAnimal' => 'absence',
                'IDClient' => '2',
                'TypeAnimal' => 'CHIEN'],

                [   'NomAnimal' => 'Lara', 
                'DateNaissAnimal' => '2016-03-02',
                'SterilisationAnimal' => 'FALSE',
                'PoidsAnimal' => '12Kg',
                'SexeAnimal' => 'FEMALE',
                'PathologiesAnimal' => 'absence',
                'IDClient' => '2',
                'TypeAnimal' => 'CHIEN'],
    
        ];
               
    }

    function Creneaux () {
        return [
            ['DateCreneau' => '2023-02-27 19:30:00', 
            'IDVeto' => 1],

            ['DateCreneau' => '2023-02-27 20:30:00', 
            'IDVeto' => 1],
            ['DateCreneau' => '2023-02-27 22:30:00', 
            'IDVeto' => 1],

            ['DateCreneau' => '2023-02-27 19:00:00', 
            'IDVeto' => 1],

            ['DateCreneau' => '2023-02-27 19:30:00',
            'IDVeto' => 2],  
            ['DateCreneau' => '2023-02-27 19:00:00', 
            'IDVeto' => 2],          
        ];
    }
    
    function Consultations () {
        return [
            [
            'ObsConsult' => 'blalhbqjkk', 
            'MotifConsult' => 'dtfcygvkhbjnk,',
            'IDAnimal' => '2',
            'IDCreneau'=> '2' ],

            [
            'ObsConsult' => 'blalhbqjkk', 
            'MotifConsult' => 'fievre,',
            'IDAnimal' => '1',
            'IDCreneau'=> '1' ],
            
            [
            'ObsConsult' => 'blalhbqjkk', 
            'MotifConsult' => 'vaccin,',
            'IDAnimal' => '3',
            'IDCreneau'=> '3' ],

            [
            'ObsConsult' => 'blalhbqjkk', 
            'MotifConsult' => 'analyse',
            'IDAnimal' => '4',
            'IDCreneau'=> '4' ],
            
            
        ];
    }

    // function PriseEnCharge () {
    //     return [
    //         ['EspeceAnimal' => 'Iguane',
    //         'MailVeto' => 'BenoitLambert@gmail.com' ],

    //         ['EspeceAnimal' => 'Bodeguero',
    //         'MailVeto' => 'BenoitLambert@gmail.com' ],            
    //     ];
    // }

    // function HorairesVeto() {
    //     return [
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 17:30:00',
    //         'MailVeto' => 'BenoitLambert@gmail.com'],

    //         ['DateDebutAM' => '2023-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:00:00',
    //         'DateFinPM' => '2048-08-24 18:30:00',
    //         'MailVeto' => 'NathanFernandez@gmail.com'],

    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 22:30:00',
    //         'MailVeto' => 'BoschMarie@gmail.com'],
            
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 19:30:00',
    //         'MailVeto' => 'ManuelLacombe@outlook.FR'],
            
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 19:30:00',
    //         'MailVeto' => 'CoquelleMelanie@outlook.fr'],
            
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 20:30:00',
    //         'MailVeto' => 'CharlotteMisbach@gmail.com'],
            
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 22:30:00',
    //         'MailVeto' => 'Emmanuelle.Bensiguior@gmail.com'], 

    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 23:30:00',
    //         'MailVeto' => 'Aude.Demyster@outlook.FR'],
            
    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 16:30:00',
    //         'MailVeto' => 'Pierre.Moissonier@outlook.fr'], 

    //         ['DateDebutAM' => '2040-08-24 8:30:00',
    //         'DateFinAM' => '2048-08-24 12:30:00',
    //         'DateDebutPM' => '2040-08-24 13:30:00',
    //         'DateFinPM' => '2048-08-24 17:30:00',
    //         'MailVeto' => 'David.massenet@gmail.com'], 
            
    //     ];
    
    // }



    
}