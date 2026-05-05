# Gestion de Residence

## Description
Application web de gestion de residence permettant l'authentification des utilisateurs (clients et employes), la gestion des logements et des services.
Il y a aussi celle du Directeur et Admin 

## Fonctionnalites

### Authentification
- Inscription des clients et employes avec formulaires distincts
- Connexion securisee par type de compte (client/employe)
- Gestion des sessions PHP
- Messages d'erreur et de succes personnalises

### Gestion des Logements
- Consultation des disponibilites
- Recherche de logements par criteres

### Gestion des Services
(A completer selon ce que tu as implemente)
- Liste des services disponibles (menage, gardiennage, etc.)
- Demande de services par les clients
- Gestion des prestations par les employes

## Technologies utilisees
- Frontend : HTML5, CSS3, JavaScript
- Backend : PHP
- Base de donnees : MySQL 
- Serveur : Apache

residence/
├── Login.php # Page principale d'authentification
├── traitement_inscription.php # Traitement du formulaire d'inscription
├── traitement_connexion.php # Traitement du formulaire de connexion
├── mot_de_passe_oublie.php # Recuperation de mot de passe
├── Login.css # Styles de la page d'authentification
├── /logements # Gestion des logements
│ └── ...
├── /services # Gestion des services
│ └── ...
└── /config # Configuration
└── ...

  Voilà seulement les fonctionnalités que j'ai fini mais pour le réserver ça ne marche pas encore et pour l'Employer j'ai pas encore fait d'interface 

