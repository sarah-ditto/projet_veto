DROP TABLE IF EXISTS Especes;
DROP TABLE IF EXISTS CodesPostaux;
DROP TABLE IF EXISTS Clients;
DROP TABLE IF EXISTS Veterinaires;
DROP TABLE IF EXISTS HorairesVeto;
DROP TABLE IF EXISTS PriseEnCharge;
DROP TABLE IF EXISTS Animaux;
DROP TABLE IF EXISTS Creneaux;
DROP TABLE IF EXISTS Consultations;


CREATE TABLE Especes ( 
TypeAnimal VARCHAR (30) PRIMARY KEY 
) ;

CREATE TABLE CodesPostaux(
CodePostal VARCHAR(5) PRIMARY KEY,
Ville VARCHAR(30) NOT NULL,
UNIQUE(CodePostal,Ville)
);

CREATE TABLE Clients(
IDClient INTEGER PRIMARY KEY AUTOINCREMENT, 
MailClient VARCHAR(50) NOT NULL UNIQUE,
NomClient VARCHAR(20) NOT NULL,
PrenomClient VARCHAR(20) NOT NULL,
TelClient VARCHAR(15) NOT NULL UNIQUE CHECK (length(TelClient) >= 10), 
MdpClient VARCHAR(80) NOT NULL CHECK (length(MdpClient) >= 6 ), 
NumRueClient INTEGER NOT NULL,
NomRueClient VARCHAR(70) NOT NULL,
CodePostalClient VARCHAR(5) NOT NULL CHECK (length(CodePostalClient) >= 4),
CONSTRAINT fk_Client_ref_cp FOREIGN KEY (CodePostalClient) REFERENCES CodesPostaux(CodePostal)
) ;

CREATE TABLE Veterinaires (
IDVeto INTEGER PRIMARY KEY AUTOINCREMENT, 
MailVeto VARCHAR(50) NOT NULL UNIQUE, 
NomVeto VARCHAR(15) NOT NULL, 
PrenomVeto VARCHAR (15) NOT NULL, 
MdpVeto VARCHAR(80) NOT NULL CHECK (length(MdpVeto) >= 6 ), 
TelVeto VARCHAR(15) NOT NULL UNIQUE CHECK (length(TelVeto) >= 10),  
PresentationVeto VARCHAR(300),
NumRueVeto INTEGER NOT NULL,
NomRueVeto VARCHAR(70) NOT NULL,
CodePostalVeto VARCHAR(5) NOT NULL CHECK (length(CodePostalVeto) >= 4),
CONSTRAINT fk_Veto_ref_cp FOREIGN KEY (CodePostalVeto) REFERENCES CodesPostaux(CodePostal)
);


DROP TRIGGER IF EXISTS validate_email_Veterinaires;
CREATE TRIGGER validate_email_Veterinaires
   BEFORE INSERT ON Veterinaires
BEGIN
   SELECT
      CASE
	WHEN NEW.MailVeto NOT LIKE '%_@__%.__%' THEN
   	  RAISE (ABORT,'Invalid email address')
       END;
END;

DROP TRIGGER IF EXISTS validate_email_Clients;
CREATE TRIGGER validate_email_Clients
   BEFORE INSERT ON Clients
BEGIN
   SELECT
      CASE
	WHEN NEW.MailClient NOT LIKE '%_@__%.__%' THEN
   	  RAISE (ABORT,'Invalid email address')
       END;
END;

DROP TRIGGER IF EXISTS validate_MailVeto_NOTIN_On_Clients;
CREATE TRIGGER validate_MailVeto_NOTIN_On_Clients 
   BEFORE INSERT ON Veterinaires
BEGIN
   SELECT
      CASE
   WHEN NEW.MailVeto IN (SELECT MailClient FROM Clients) THEN
   	  RAISE (ABORT,'email address exist in Clients')
       END;
END;



DROP TRIGGER IF EXISTS validate_MailClients_NOTIN_On_Veto;
CREATE TRIGGER validate_MailClients_NOTIN_On_Veto 
   BEFORE INSERT ON Clients
BEGIN
   SELECT
      CASE
   WHEN NEW.MailClient IN (SELECT MailVeto FROM Veterinaires ) THEN
   	  RAISE (ABORT,'email address already exist in Veto')
       END;
END;

/*CREATE TABLE HorairesVeto (
DateDebutAM DATE , 
DateFinAM DATE CHECK (DateDebutAM < DateFinAM) ,
DateDebutPM DATE CHECK(DateDebutPM > CURRENT_DATE), 
DateFinPM DATE  , 
MailVeto VARCHAR (50),
CONSTRAINT pk_HorairesVeto PRIMARY KEY (DateDebutAM, DateFinAM, DateDebutPM, DateFinPM, MailVeto),
CONSTRAINT fk_Veto FOREIGN KEY (MailVeto) REFERENCES Veterinaires (MailVeto),
CONSTRAINT Check_Veto CHECK((DateDebutAM > CURRENT_DATE) AND (DateDebutPM < DateFinPM))
); 

CREATE TABLE PriseEnCharge(
EspeceAnimal VARCHAR(30), 
MailVeto VARCHAR(50),
CONSTRAINT pk_PriseEnCharge PRIMARY KEY (EspeceAnimal, MailVeto),
CONSTRAINT fk_PriseEnCharge1 FOREIGN KEY (EspeceAnimal) REFERENCES Especes (EspeceAnimal),
CONSTRAINT fk_PriseEnCharge2 FOREIGN KEY (MailVeto) REFERENCES Veterinaires (MailVeto)
); */

CREATE TABLE Animaux(
IDAnimal INTEGER PRIMARY KEY AUTOINCREMENT, 
NomAnimal VARCHAR (20) NOT NULL,
DateNaissAnimal DATETIME CHECK (DateNaissAnimal < CURRENT_DATE), 
--SterilisationAnimal TEXT NOT NULL CHECK (typeof("SterilisationAnimal") = "text" AND "SterilisationAnimal" IN ("OUI","NON","INCONNU")),
SterilisationAnimal VARCHAR(7) NOT NULL,
PoidsAnimal REAL,
--SexeAnimal TEXT NOT NULL CHECK (typeof("SexeAnimal") = "text" AND "SexeAnimal" IN ("MALE","FEMALE","INCONNU")),
SexeAnimal VARCHAR(7) NOT NULL, 
PathologiesAnimal VARCHAR (200), 
IDClient INTEGER NOT NULL, 
TypeAnimal VARCHAR (30) NOT NULL,
CONSTRAINT fk_Animaux_ref_Clients FOREIGN KEY (IDClient) REFERENCES Clients (IDClient),
CONSTRAINT fk_Animaux_ref_Esp FOREIGN KEY (TypeAnimal) REFERENCES Especes (TypeAnimal)
);

CREATE TABLE Creneaux (
IDCreneau INTEGER PRIMARY KEY AUTOINCREMENT, 
DateCreneau DATETIME NOT NULL,
--CHECK(DateCreneau > CURRENT_DATE),   
IDVeto INTEGER NOT NULL,
UNIQUE (DateCreneau,IDVeto),
CONSTRAINT fk_Creneaux_ref_veto FOREIGN KEY (IDVeto) REFERENCES Veterinaires (IDVeto)
);

CREATE TABLE Consultations(
IDConsult INTEGER PRIMARY KEY AUTOINCREMENT, 
ObsConsult VARCHAR(500), 
MotifConsult VARCHAR (30) NOT NULL, 
IDAnimal INTEGER, 
IDCreneau INTEGER,
CONSTRAINT fk_Consul_ref_Animaux FOREIGN KEY (IDAnimal) REFERENCES Animaux (IDAnimal),
CONSTRAINT fk_Consult_ref_Creneaux FOREIGN KEY (IDCreneau) REFERENCES Creneaux (IDCreneau)
);

