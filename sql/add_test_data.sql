-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, salasana) VALUES ('Teemu','teemu123');
INSERT INTO Kayttaja (nimi, salasana) VALUES ('Nipsu','nipsu123');
INSERT INTO Resepti (nimi, raaka_aineet, ohje) VALUES ('Jauhelihapihvi','Jauheliha, suola ja pippuri',
'Muotoile ja mausta pihvit, paista pannulla 2min per puoli');

INSERT INTO Resepti (nimi, raaka_aineet, ohje, tekija_id) VALUES ('Kinkkupitsa','atrian pitsa','lämmitä mikrossa 2min', 1);

INSERT INTO Kategoria (nimi) VALUES ('Liharuoka');