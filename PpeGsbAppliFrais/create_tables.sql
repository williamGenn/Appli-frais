CREATE TABLE role_(
   id_role INT,
   role VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_role)
);
CREATE TABLE Visiteur(
   id VARCHAR(4),
   nom VARCHAR(30) NOT NULL,
   prenom VARCHAR(30) NOT NULL,
   addresse VARCHAR(50) NOT NULL,
   ville VARCHAR(50) NOT NULL,
   cp INT NOT NULL,
   dateEmbauche DATE NOT NULL,
   login VARCHAR(20) NOT NULL UNIQUE,
   mdp VARCHAR(50) NOT NULL,
   id_role INT,
   PRIMARY KEY(id),
   FOREIGN KEY (id_role) REFERENCES role_(id_role)
);

CREATE TABLE Etat(
   id CHAR(2),
   libelle VARCHAR(30),
   PRIMARY KEY(id)
);

CREATE TABLE FraisForfait(
   id CHAR(3),
   libelle CHAR(30),
   montant DECIMAL(5,2),
   PRIMARY KEY(id)
);

CREATE TABLE FicheFrais(
   mois CHAR(6),
   idVisiteur CHAR(4),
   nbJustificatifs INT,
   dateModif DATE,
   montantValide DECIMAL(10,2),
   id CHAR(2) NOT NULL,
   PRIMARY KEY(mois, idVisiteur),
   FOREIGN KEY(id) REFERENCES Etat(id),
   FOREIGN KEY(idVisiteur) REFERENCES Visiteur(id)
);

CREATE TABLE LigneFraisHorsForfait(
   id INT AUTO_INCREMENT NOT NULL,
   date DATE NOT NULL,
   montant DECIMAL(10,2),
   libelle VARCHAR(100),
   mois CHAR(6) NOT NULL,
   idVisiteur CHAR(4) NOT NULL,
   Etat CHAR(2) DEFAULT 'CL';
   PRIMARY KEY(id),
   FOREIGN KEY(mois, idVisiteur) REFERENCES FicheFrais(mois, idVisiteur),
   FOREIGN KEY(Etat) REFERENCES Etat(id)
);

CREATE TABLE LigneFraisForfait(
   idVisiteur CHAR(4),
   mois CHAR(6),
   idFraisForfait CHAR(3),
   quantite INT,
   PRIMARY KEY(idVisiteur, mois, idFraisForfait),
   FOREIGN KEY(idFraisForfait) REFERENCES FraisForfait(id),
   FOREIGN KEY(mois, idVisiteur) REFERENCES FicheFrais(mois, idVisiteur)
);
