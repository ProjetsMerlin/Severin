# Severin

Severin est un projet minimaliste mais très complet. Ce système est un CMS JSON component-based hybride entre Twig & Next.js, soit un PHP Component System (Vite + JSON) mais ultra léger pour des sites vitrines performants.

---

## Structure du projet

/admin/data.json    => data

/assets             => Style
    app.js  
    style.css  
    /images  

/Composants         => Composants
    /Hero  
        index.php
        Hero.scss
        Hero.js
        hero.jpg

    /Global
        favicon.ico  
        Global.scss
        ...

index.php           => SEO
.htaccess           => Sécurité

---

## Spécificités

- routing PHP simple (index.php + .htaccess)
- SEO dynamique depuis JSON et url propres
- sécurité de base via l'.htaccess (sous Apache)
- composants isolés et réutilisables (SCSS modulaire par composant & JS modulaire par composant)
- contenu piloté par JSON (data.json) et un petit admin ajouté à cet effet

---

## Principe

Le système repose sur 3 piliers :

### 1. data.json
Contient :
- configuration globale (SEO, langue, siteName, auteur ...)
- routes du site
- Composition des pages
- Ce fichier est éditable deouis l'admin : /

### 2. Composants PHP
Chaque composant contient :
- rendu PHP
- styles (SCSS)
- JS éventuel associé
- assets propres (toutes les images dans un seul dossiers)

### 3. Vite
Compile les assets
- tous les SCSS → assets/style.css
- Tous le JS → assets/app.js
- toutes les images → assets/images

---

## Déploiement

En production, seuls ces fichiers sont nécessaires :

/admin/*
/assets/* 
/Composants/*  
index.php 
.htaccess  

---

## Objectif

Créer un système :
- simple comme PHP natif sans base de données
- structuré comme un framework moderne
- rapide, sécurisé et SEO-friendly

## Évolutions possibles

- routing avancé sans query string
- cache HTML statique
- layouts système
- CMS JSON admin
- lazy-loading composants
- SEO automatique complet
- build intelligent par page
- améliorer sécurité htacess

## Défaut principal

On se retrouve avec un fichier data.json très long puisqu'il renferme à lui seul le routing, le contenu et la structure des pages.
Mais il est possible de l'éditer via l'admin. L'idée serait de partager ce type de fichier pour changer d'apparence et de structure.

## idées

utilisation d'un framewok CSS ?
slugPage-composant pour ne charger que ce dernier ?

## composants

Menu ✔️
Hero ✔️
Footer ✔️
404 Section

Features
Services
About
CTA
Cards
Gallery
Testimonials
FAQ
Stats
Pricing
Team
Blog Grid
Contact Form
Map
Newsletter
Timeline