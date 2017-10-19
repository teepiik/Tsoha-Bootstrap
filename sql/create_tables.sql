-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
salasana varchar(15) NOT NULL
);

CREATE TABLE Kategoria(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL
);

CREATE TABLE Resepti(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
raaka_aineet varchar(400),
ohje varchar(600),
tekija_id INTEGER REFERENCES Kayttaja(id),
kategoria_id INTEGER REFERENCES Kategoria(id)
);



