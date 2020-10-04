
CREATE DATABASE IF NOT EXISTS project1;


CREATE TABLE IF NOT EXISTS account(
	account_id INT(22) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY (account_id)
);

CREATE TABLE IF NOT EXISTS persoon(
	persoon_id INT(22) NOT NULL AUTO_INCREMENT,
	voornaam VARCHAR(255) NOT NULL,
	tussenvoegsel VARCHAR(255) NOT NULL,
	achternaam VARCHAR(255) NOT NULL,
	account_id INT(22) NOT NULL,
	PRIMARY KEY (persoon_id),
	FOREIGN KEY (account_id) REFERENCES account(account_id)
);