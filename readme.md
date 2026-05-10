# Severin

Un projet minimaliste mais ultra complet. Ce système est un CMS JSON component-based hybride entre Twig & Next.js, soit un PHP Component System (Vite + JSON) mais ultra léger pour des sites vitrines performants.

---

## Structure du projet

/assets
    app.js  
    style.css  
    /images  

/Composants  
    /Hero  
        index.php  
        Hero.scss  
        Hero.js  
        hero.jpg  

    /Global  
        favicon.ico  

index.php  
data.json  
.htaccess  

---

## Spécificités

- routing PHP simple (index.php + .htaccess)
- SEO dynamique depuis JSON et url propres
- sécurité de base via l'htaccess
- composants isolés et réutilisables (SCSS modulaire par composant & JS modulaire par composant)
- contenu piloté par JSON (data.json)

---

## Principe

Le système repose sur 3 piliers :

### 1. data.json
Contient :
- routes du site
- contenu des pages
- configuration globale (SEO, langue, siteName, auteur ...)

### 2. Composants PHP
Chaque composant contient :
- rendu PHP
- styles SCSS
- JS associé
- assets propres (toutes les images dans un seul dossiers)

### 3. Vite
Compile :
- SCSS → assets/style.css
- JS → assets/app.js
- images → assets/images

---

## Déploiement

En production, seuls ces fichiers sont nécessaires :

/assets  
/Composants  
index.php  
data.json  
.htaccess  

---

## Objectif

Créer un système :
- simple comme PHP natif sans base de données
- structuré comme un framework moderne
- rapide et SEO-friendly

## Évolutions possibles

- routing avancé sans query string
- cache HTML statique

- layouts système
- CMS JSON admin
- lazy-loading composants
- SEO automatique complet
- build intelligent par page

## défaut principal

On se retrouve avec un fichier data.json très long puisqu'il renferme à lui seul le routing, le contenu et la structure des pages