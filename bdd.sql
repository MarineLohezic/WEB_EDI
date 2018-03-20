use bgxrhxa5e;
#table utilisateurs
create table utilisateurs(
	ID int(11) not null auto_increment primary key,
	LOGIN varchar(250),
	MDP varchar(70),
	NOM varchar(20), 
	PRENOM varchar(20),
	NB_TENTATIVE int(11),
	DATE_CONNEXION date,
	VALIDATION int(11)
);

#table operations
create table operations(
	ID int(11) not null auto_increment primary key,
	TYPE varchar(5),
	MONTANT int(11),
	CPT_ORIGINE varchar(20),
	CPT_DEST varchar(20),
	DEVISE varchar(5),
	ID_UTILISATEUR int(11),
	ID_LOT timestamp
);

# Clés étrangères
ALTER TABLE operations ADD CONSTRAINT userId_FK FOREIGN KEY (ID_UTILISATEUR) REFERENCES utilisateurs(ID);