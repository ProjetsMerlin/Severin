# Severin

Severin est un projet minimaliste voulant être le plus complet possible.
Ce système est un CMS JSON component-based, tournant sous PHP Component et dons les assets sont compilés avec Vite.
Référencé, sécurisé et très léger pour des sites vitrines performants.

## Structure & concept du projet

Le projet s compose comme suit :

- Routing PHP simple (via le fichier index.php et .htaccess)
- Composants isolés et réutilisables
- Contenu piloté par JSON (data.json) et un petit admin ajouté à cet effet
- SEO dynamique depuis JSON et url propres
- Sécurité de base via l'.htaccess (avec PHP et sous Apache)

## Principe

Le système repose sur 5 piliers :

### 1. Le contenu

Le contenu est géré par le fichier data.json.\
Il permet à lui seul :

- La configuration globale (Sa version, son titre, sont URL définitive ou l' auteur par exemple)
- La structure du site : Construction du menu et du footer ou le contenu et slug des pages 
- Composition des pages en sépcifiant les composants énumérés par pages
- Ce fichier est éditable deouis l'admin : /admin
- Pourquoi pas partager ensuite ce fichier qui composera à lui seul d'autressite web

### 2. DEV

Ici, cette partie est dédiée aux développeurs qui construiront au fure et à mesure les composants. Chaque composant contient :
- Le rendu PHP via la fonction renderNomDuComposant($data)
- Le ou les styles (SCSS)
- Le JavaSript éventuel associé
- Des assets propres au composants (images et documents éventuels)

### 3. Design

Le design peut-être modifié via le fichier global/Global.SCSS qui est également coompilé avec le reste des assets : 

- Tous les SCSS sont compilés dans une suel fichier : assets/style.css
- Tous le JS sont compilés dans une suel fichier : assets/app.js
- Toutes les images sont déplacer dans le dossiers : assets/images
- Idem si vous y ajouteriez des ontes ou des vidéos par exemple
- Enfin, vous pouvez éditer le style des composants via le scss de chaque composants

### 4. SEO

Séverin a déjà tout pour obtenir un score important au niveau d'un SEO naturel.
Il possède :

- Fichier robots.txt dynamique
- Fichier sitemap.xml dynamique
- Rewriting des urls propres (exemple : /, /blog, blog/1)
- Balises Head dynamiques
- Balises oggs dynamiques (en cours)

### 5. Sécurité

Séverin a une sécurité de base surtout via le fichier .htacess d'Apacche :

- Dossiers du site cachés
- XSS-Protection
- Https forcé une fois en ligne

### Objectifs

Créer un système :
- Simple comme PHP natif mais sans base de données
- Structuré comme un framework moderne (Composants)
- Rapide, sécurisé et SEO-friendly

---
---

## Mise en ligne

1. Ajoutez vos composants, renseignez les dans le fichier /main.js, et compilez-le tout via la commande Vite : npm run build

2. Modifiez à votre guise le fichier data-json manuellement ou via l'/admin
Pour y accéder, vous trouverez le mot de passe (à changer une fois en ligne !!) et qui se trouve dans le fichier /admin/login.php

3. Passez le tout en ligne. En production, seuls ces fichiers sont nécessaires :

| Fichiers en ligne | Attribution           |
| ------------------|---------------------- |
(/admin/)data.json  |  Contenu & structure du site              |
/assets             |  Assets compilés & fichiers statiques     |
/Composants         |  UI Components avec SCSS et JS éditables  |
index.php           |  Points d'entrées & SEO engine            |
.htaccess           |  Routing & Security                       |

## Composants

### Déjà en place comme exemmple

Menu ✔️\
Hero ✔️\
Footer ✔️\
404 Section ✔️\
FAQ ✔️\
About ✔️\
Map ✔️\
Testimonials ✔️\
CTA ✔️\
Timeline ✔️\
Cards / Blog Grid ✔️

### Très prochainement

Pricing / Stats\
Gallery\
Contact Form\
Newsletter

## Défaut principal

On se retrouve avec un fichier data.json très long puisqu'il renferme à lui seul le routing, le contenu et la structure des pages.
Mais il est possible de l'éditer via l'admin.
L'idée serait de partager ce type de fichier pour changer d'apparence, de contenu ou de structure.