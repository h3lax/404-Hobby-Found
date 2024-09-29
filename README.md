# 404 Hobby Found

## Sommaire
1. [Contexte](#contexte)
2. [Présentation du projet](#présentation-du-projet)
3. [Fonctionnalités](#fonctionnalités)
4. [Captures d'écran](#captures-décran)
5. [Installation](#installation)
   1. [Prérequis](#prérequis)
   2. [Étapes d'installation](#étapes-dinstallation)
6. [Usage](#usage)
   1. [Gestion des profils utilisateurs](#gestion-des-profils-utilisateurs)
   2. [Création de clubs](#création-de-clubs)
   3. [Gestion des événements](#gestion-des-événements)
7. [Vidéo marketing & présentation technique](#vidéo-marketing--présentation-technique)
8. [Technologies utilisées](#technologies-utilisées)
9. [Contributeurs](#contributeurs)

## Contexte
Projet finaliste sur le concours de workshop par équipes de l'EPSI Montpellier pour la rentrée 2024 en Bachelor. Pour réaliser ce projet, nous avons disposé de 4 jours pour constituer l'ensemble des éléments du cahier des charges, soit 3 jours et demi de développement. 

## Présentation du projet
404 Hobby Found est une plateforme web dédiée à la création et la gestion de groupes d'étudiants centrés autour des activités qu'ils exercent organisés en clubs. Elle permet aux étudiants de découvrir les différents clubs, de visualiser les événements qu'ils organisent sur un calendrier interactif, et de s'inscrire à une newsletter pour recevoir les dernières actualités du campus. Ce projet est développé en Symfony, avec l'intégration de FullCalendar pour la gestion des événements.

## Fonctionnalités
Gestion des clubs : Affiche une liste complète des clubs disponibles au sein de l'université.<br>
Calendrier des événements : Visualisez les événements de chaque club via un calendrier interactif, avec les détails des activités.<br>
Système de newsletter : Les utilisateurs peuvent s'inscrire pour recevoir les dernières informations sur les événements à venir.<br>
Interface utilisateur moderne : Design intuitif basé sur Bootstrap pour une navigation fluide.

## Captures d'écran
Accueil:<br>
![Accueil](public/img/captures/Accueil.PNG)<br>
Création de club : <br>
![Création de club](public/img/captures/Crea_club.PNG)<br>
Evenements : <br>
![Evenements](public/img/captures/Evenements.PNG)<br>
Mes clubs :<br>
![Mes clubs](public/img/captures/Mes_clubs.PNG)

## Installation
### Prérequis
PHP 8.0 ou supérieur<br>
Symfony 5.4<br>
Composer<br>
MySQL ou tout autre SGBD compatible
### Étapes d'installation
1. Cloner le repository : 
```bash
git clone https://github.com/votre-utilisateur/404-hobby-found.git
```
2. Installer les dépendances :
```bash
composer install
npm install
```
3. Configurer la base de données dans le fichier .env :
```bash
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```
4. Appliquer les migrations :
```bash
php bin/console doctrine:migrations:migrate
```

## Usage
### Gestion des profils utilisateurs
Création de compte utilisateur<br>
Connexion/déconnexion<br>
à réaliser : gestion des différents rôles pour ajouter de la modération et des responsables pour chaque club
### Création de clubs
Création de Clubs<br>
Présentation des différents liens et informations spécifique à chaque clubs<br>
Génération de photo de profil avec dall-e-2 en fonction du nom du club
### Gestion des événements
Création d'évènements rattachés aux clubs<br>
Affichage de l'ensemble des évènements en bdd pour informer les étudiants de l'ensemble de l'activité parscolaire de leur campus<br>
à réaliser : Création de newsletter qui rescence l'activité du campus sur la période à venir

## Vidéo marketing & présentation technique
Pendant cette semaine de workshop, nous avons réalisé une vidéo pour présenter le projet. Les 3 premières minutes sont consacrées à une présentation marking du projet tandis que la deuxième partie de la vidéo présente le parcours utilisateur avec des captures de l'application fonctionnelle : [Présentation de 404 Hobby Found](https://youtu.be/c667akO-25o)

## Technologies utilisées
Symfony 5.4 : Framework PHP pour le backend.<br>
FullCalendar : Librairie JavaScript pour la gestion des événements.<br>
Bootstrap 5 : Framework CSS pour une interface responsive.<br>
Open AI Api : Api de Dall-e pour la génération d'image par IA<br>
MySQL : Base de données.<br>
JavaScript (ES6) : Interaction dynamique avec FullCalendar.
Document Technique répertoriant notre travail ici :
![Document Technique](workshop2425-b3g26-doctech.PDF)

## Contributeurs
Garis SELLIER - infra, montage, dossiers<br>
Terrence RISS - infra, support dev et dossiers<br>
Michael PICARD - dev full stack (nick : Unrising)<br>
Axel POIDEBARD - dev full stack (nick : h3lax / calamm)
