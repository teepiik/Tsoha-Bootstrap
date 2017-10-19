-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, salasana) VALUES ('Admin','teemu123');
INSERT INTO Kayttaja (nimi, salasana) VALUES ('Nipsu123','nipsu123');
INSERT INTO Resepti (nimi, raaka_aineet, ohje) VALUES ('Jauhelihapihvi','Jauheliha, suola ja pippuri',
'Muotoile ja mausta pihvit, paista pannulla 2min per puoli');

INSERT INTO Resepti (nimi, raaka_aineet, ohje, tekija_id) VALUES ('Kinkkupitsa','atrian pitsa','lämmitä mikrossa 2min', 2);

INSERT INTO Kategoria (nimi) VALUES ('Aamiainen');