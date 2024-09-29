# 404 Hobby Found

## Contexte
Projet finaliste sur le concours de workshop par équipes de l'EPSI Montpellier pour la rentrée 2024 en Bachelor. Pour réaliser ce projet, nous avons disposé de 4 jours pour constituer l'ensemble des éléments du cahier des charges, soit 3 jours et demi de développement. 

## Présentation du projet
404 Hobby Found est une plateforme web dédiée à la gestion des clubs universitaires et des événements qu'ils organisent. Elle permet aux étudiants de découvrir les différents clubs, de visualiser les événements sur un calendrier interactif, et de s'inscrire à une newsletter pour recevoir les dernières actualités. Ce projet est développé en Symfony, avec l'intégration de FullCalendar pour la gestion des événements.

## Fonctionnalités
Gestion des clubs : Affiche une liste complète des clubs disponibles au sein de l'université.
Calendrier des événements : Visualisez les événements de chaque club via un calendrier interactif, avec les détails des activités.
Système de newsletter : Les utilisateurs peuvent s'inscrire pour recevoir les dernières informations sur les événements à venir.
Interface utilisateur moderne : Design intuitif basé sur Bootstrap pour une navigation fluide.

## Captures d'écran

## Installation
### Prérequis
PHP 8.0 ou supérieur
Symfony 5.4
Composer
MySQL ou tout autre SGBD compatible
### Étapes d'installation
1. Cloner le repository : 
```bash git clone https://github.com/votre-utilisateur/404-hobby-found.git```
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
### Création de clubs
### Gestion des événements

## Vidéo marketing & présentation technique
Pendant cette semaine de workshop, nous avons réalisé une vidéo pour présenter le projet. Les 3 premières minutes sont consacrées à une présentation marking du projet tandis que la deuxième partie de la vidéo présente le parcours utilisateur avec des captures de l'application fonctionnelle : [Présentation de 404 Hobby Found](https://youtu.be/c667akO-25o)

## Technologies utilisées
Symfony 5.4 : Framework PHP pour le backend.
FullCalendar : Librairie JavaScript pour la gestion des événements.
Bootstrap 5 : Framework CSS pour une interface responsive.
MySQL : Base de données.
JavaScript (ES6) : Interaction dynamique avec FullCalendar.

## Contributeurs
Garis SELLIER - infra, montage, dossiers
Terrence RISS - infra, support dev et dossiers
Michael PICARD - dev full stack (nick : Unrising)
Axel POIDEBARD - dev full stack (nick : h3lax)
