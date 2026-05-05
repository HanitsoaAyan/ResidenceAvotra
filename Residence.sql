CREATE DATABASE IF NOT EXISTS Residence;

USE Residence;

-- Table user (parent)
CREATE TABLE IF NOT EXISTS user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    section ENUM('client', 'employe') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table client (enfant de user)
CREATE TABLE IF NOT EXISTS client (
    cin VARCHAR(20) PRIMARY KEY,
    id_user INT NOT NULL UNIQUE,
    numero VARCHAR(20) NOT NULL,
    adresse TEXT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

-- Table employe (enfant de user)
CREATE TABLE IF NOT EXISTS employe (
    cin VARCHAR(20) PRIMARY KEY,
    id_user INT NOT NULL UNIQUE,
    poste VARCHAR(100) NOT NULL,
    salaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);

-- Table logement
CREATE TABLE IF NOT EXISTS logement (
    id_logement INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(10) NOT NULL UNIQUE,
    type ENUM('studio', 'T1', 'T2', 'T3', 'T4', 'villa') NOT NULL,
    superficie DECIMAL(8,2) NOT NULL,
    capacite_max INT NOT NULL,
    statut ENUM('disponible', 'occupe', 'reserve', 'en_maintenance') DEFAULT 'disponible',
    prix_nuit DECIMAL(10,2) NOT NULL,
    prix_mois DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insérer des logements avec prix Madagascar (Ar)
INSERT INTO logement (numero, type, superficie, capacite_max, statut, prix_nuit, prix_mois, description) VALUES
-- Studios
('101', 'studio', 20.00, 2, 'disponible', 25000, 550000, 'Studio simple mais confortable. Ideal pour etudiant ou travailleur.'),
('102', 'studio', 22.00, 2, 'disponible', 30000, 650000, 'Studio meuble avec kitchenette. Proche des commodites.'),
('103', 'studio', 25.00, 2, 'reserve', 35000, 750000, 'Grand studio lumineux avec balcon.'),
('104', 'studio', 18.00, 1, 'disponible', 20000, 450000, 'Petit studio economique.'),
('105', 'studio', 30.00, 3, 'disponible', 40000, 850000, 'Studio familial avec coin repas.'),

-- T1
('201', 'T1', 35.00, 3, 'disponible', 45000, 950000, 'T1 moderne avec chambre separee.'),
('202', 'T1', 38.00, 3, 'disponible', 50000, 1050000, 'Bel appartement T1 climati-se.'),
('203', 'T1', 32.00, 2, 'occupe', 40000, 850000, 'T1 cosy pres du centre ville.'),
('204', 'T1', 40.00, 3, 'disponible', 55000, 1150000, 'T1 spacieux avec cuisine equipee.'),

-- T2
('301', 'T2', 50.00, 4, 'disponible', 65000, 1350000, 'T2 spacieux avec deux chambres.'),
('302', 'T2', 55.00, 4, 'disponible', 70000, 1450000, 'Appartement T2 tres lumineux.'),
('303', 'T2', 48.00, 4, 'reserve', 60000, 1250000, 'T2 avec terrasse et vue degagee.'),
('304', 'T2', 60.00, 5, 'disponible', 75000, 1550000, 'Grand T2 avec balcon et parking.'),

-- T3
('401', 'T3', 70.00, 6, 'disponible', 90000, 1850000, 'Grand T3 pour famille.'),
('402', 'T3', 75.00, 6, 'disponible', 100000, 2050000, 'T3 moderne avec grand salon.'),
('403', 'T3', 68.00, 5, 'occupe', 85000, 1750000, 'Appartement T3 bien agence.'),
('404', 'T3', 80.00, 6, 'disponible', 95000, 1950000, 'T3 avec balcon et vue sur jardin.'),

-- T4
('501', 'T4', 90.00, 8, 'disponible', 130000, 2650000, 'T4 de standing avec garage.'),
('502', 'T4', 95.00, 8, 'disponible', 140000, 2850000, 'Grand T4 pour grande famille.'),
('503', 'T4', 100.00, 9, 'reserve', 150000, 3050000, 'T4 luxueux avec terrasse.'),

-- Villas
('601', 'villa', 120.00, 10, 'disponible', 200000, 4000000, 'Villa avec jardin et parking.'),
('602', 'villa', 150.00, 12, 'disponible', 250000, 5000000, 'Belle villa avec piscine.'),
('603', 'villa', 100.00, 8, 'reserve', 180000, 3600000, 'Villa moderne securisee.'),
('604', 'villa', 180.00, 14, 'disponible', 300000, 6000000, 'Grande villa avec piscine et jardin.'),
('605', 'villa', 200.00, 15, 'occupe', 350000, 7000000, 'Villa de luxe avec spa et sauna.');

-- Table service
CREATE TABLE IF NOT EXISTS service (
    id_service INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    statut ENUM('disponible', 'non_disponible') DEFAULT 'disponible',
    prix DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insérer des services
INSERT INTO service (nom, description, statut, prix) VALUES
('Menage quotidien', 'Service de menage complet de votre logement chaque jour', 'disponible', 15000),
('Blanchisserie', 'Lavage, sechage et repassage de votre linge', 'disponible', 10000),
('Petit dejeuner', 'Petit dejeuner livre directement dans votre logement', 'disponible', 8000),
('Conciergerie', 'Service de conciergerie 24h/24', 'disponible', 5000),
('Transfert aeroport', 'Prise en charge a l aeroport et transfert vers la residence', 'disponible', 35000),
('Location de voiture', 'Vehicule disponible pour vos deplacements', 'disponible', 45000),
('Garderie', 'Service de garde d enfants pendant votre absence', 'disponible', 20000),
('Spa et massage', 'Service de spa et massage a domicile', 'disponible', 60000),
('Wifi haut debit', 'Connexion internet fibre optique', 'disponible', 5000),
('Parking securise', 'Place de parking securisee dans l enceinte', 'disponible', 8000),
('Guide touristique', 'Guide pour visiter les sites touristiques', 'non_disponible', 50000),
('Cuisinier prive', 'Chef a domicile pour vos repas', 'disponible', 75000),
('Babysitting', 'Service de babysitting le soir', 'disponible', 18000),
('Cours de gym', 'Cours de fitness a domicile', 'non_disponible', 25000),
('Soiree privee', 'Organisation de soiree privee', 'disponible', 150000);