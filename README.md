# 🎬 Le Vox - Cinéma de Saint-Ouen (80610)

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)
![Localisation: Somme](https://img.shields.io/badge/Localisation-Somme_80-blue.svg)
![Status: Development](https://img.shields.io/badge/Status-En_développement-orange.svg)

Bienvenue sur le dépôt officiel du site web du cinéma **Le Vox**, situé à **Saint-Ouen (80610)** dans la Somme. Ce projet citoyen a pour but d'offrir aux habitants un accès clair et moderne à la programmation culturelle de leur commune.

---

## 📍 À propos du projet
Le cinéma communal Le Vox est un pilier de la vie associative et culturelle de Saint-Ouen. Ce site web permet de :
* Consulter les films à l'affiche.
* Voir les horaires des séances.
* Accéder aux tarifs.

## 🚀 Fonctionnalités

* **Programmation :** Affichage dynamique des films de la semaine.
* **Fiches Films :** Synopsis, durée, genre et bandes-annonces.
* **Infos Pratiques :** Tarifs, accès au cinéma et contact.
* **Responsive Design :** Consultation fluide sur mobile, tablette et ordinateur.

## 🛠️ Technologies utilisées

* **Frontend :** HTML5, CSS3, JavaScript, Twig
* **Backend :** PHP, Symfony, MySQL, Doctrine
* **API :** [The Movie Database (TMDB)](https://www.themoviedb.org/) pour les données de films.

## 📦 Installation & Lancement

Ce projet est entièrement conteneurisé avec **Docker**. Un **Makefile** est disponible pour simplifier les commandes usuelles.

1.  **Cloner le dépôt (SSH)**
    ```bash
    git clone [git@github.com:ThibDel8/Le_Vox.git](git@github.com:ThibDel8/Le_Vox.git)
    ```
2.  **Accéder au dossier**
    ```bash
    cd Le_Vox
    ```
3.  **Démarrer l'environnement**
    ```bash
    make init
    ```
Cette commande lance les conteneurs (Nginx, PHP, MySQL), installe les dépendances Composer et prépare la base de données.
4.  **Accéder au site**
    Le site est disponible sur : [http://localhost:8080](http://localhost:8080)

Cette commande lance les conteneurs (Nginx, PHP, MySQL), installe les dépendances Composer et prépare la base de données.

## 📄 Licence

Ce projet est sous licence **MIT**. Vous êtes libre de copier, modifier et distribuer le code, à condition de conserver la mention du copyright original.

> **Note :** Le nom "Le Vox", les logos et les images spécifiques au cinéma communal sont la propriété exclusive de l'établissement et ne sont pas couverts par la licence de code Open Source.

---

## ✉️ Contact

Développé par **Thibault Delattre** - N'hésitez pas à ouvrir une *Issue* pour toute suggestion ou bug !
