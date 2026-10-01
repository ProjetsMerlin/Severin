# Severin

Severin est un projet minimaliste tout en étant le plus complet possible.
Ce système est un CMS JSON component-based, tournant sous PHP natif, et dont les assets sont compilés avec Vite (React).
Référencé, sécurisé et très léger, il conviendra pour des sites vitrines multilingues et performants.

## Objectifs

Créer un micro-CMS PHP piloté par JSON, basé sur des composants autonomes, sans base de données ni dépendance serveur complexe.

- Simple comme PHP natif, mais sans base de données
- Structuré comme un framework moderne (Composants)
- Rapide, sécurisé et SEO-friendly

---

## Concept & Strucutre

Le projet se compose comme suit :

- Contenu piloté par JSON (`data.json`) et un petit admin ajouté à cet effet
- Composants isolés et réutilisables
- Routing PHP simple (via le fichier `index.php` et `.htaccess`)
- SEO dynamique depuis le JSON et URLs propres
- Sécurité de base via le `.htaccess` (avec PHP et sous Apache)

## Le système repose sur 5 piliers

### 1. Le contenu

Le contenu est géré par le fichier `data.json`.
Il permet à lui seul :

- La configuration globale (version, titre, URL définitive, auteur, etc.)
- La structure du site : construction du menu, du footer, du contenu et des slugs de pages
- La composition des pages en spécifiant les composants énumérés par page
- Ce fichier est éditable depuis l'admin : `/admin`
- Il est possible de partager ce fichier pour composer à lui seul d'autres sites web

### 2. DEV

Cette partie est dédiée aux développeurs qui construiront les composants au fur et à mesure. Chaque composant contient :

- Le rendu PHP via la fonction `renderNomDuComposant($data)`
- Le ou les styles (SCSS)
- Le JavaScript éventuel associé
- Les assets propres au composant (images et documents éventuels)

### 3. Design

Le design peut être modifié via le fichier `global/Global.scss`, également compilé avec le reste des assets :

- Tous les SCSS sont compilés dans un seul fichier : `assets/style.css`
- Tout le JS est compilé dans un seul fichier : `assets/app.js`
- Toutes les images sont déplacées dans le dossier : `assets/images`
- Idem pour les polices ou les vidéos éventuelles
- Le style de chaque composant est également éditable via son propre fichier SCSS

### 4. SEO

Severin a déjà tout pour obtenir un score élevé en référencement naturel.
Il possède :

- Fichier `robots.txt` dynamique
- Fichier `sitemap.xml` dynamique
- Réécriture des URLs propres (exemple : `/`, `/blog`, `/blog/1/slug-de-l-article`)
- Balises `<head>` dynamiques
- Balises Open Graph dynamiques

### 5. Sécurité

Severin dispose d'une sécurité de base, principalement via le fichier `.htaccess` sous Apache :

- Listage des répertoires désactivé
- Protection XSS
- HTTPS forcé une fois en ligne

---

## Manuel d'utilisation

### Mise en ligne

1. Ajoutez vos composants, renseignez-les dans le fichier `/main.js`, et compilez le tout via la commande Vite :
`npm run build`

2. Modifiez à votre guise le fichier `data.json` manuellement ou via l'admin `/admin`.
Pour y accéder, le mot de passe se trouve dans le fichier `/admin/login.php` — **pensez à le changer une fois votre projet en ligne !**

3. Mettez le tout en ligne. En production, seuls ces fichiers sont nécessaires :

| Fichiers en ligne   | Attribution                               |
| ------------------- | ----------------------------------------- |
| `/admin/data.json`  | Contenu & structure du site               |
| `/assets`           | Assets compilés & fichiers statiques      |
| `/Composants`       | Composants UI avec SCSS et JS éditables   |
| `index.php`         | Point d'entrée & moteur SEO               |
| `.htaccess`         | Routing & sécurité                        |

### Layout system

Vous pouvez inclure des composants "fixes", soit qui se répètent sur chaque page en utilisant la fonction **fixedContent($layout)** que vous pouvez placer dans le fichier index.php.

Exemple :

```php
<aside><?php fixedContent("aside"); ?></aside>
<?php fixedContent("footer"); ?>
```

### Composants

15 composants sont déjà en place pour vous et à titre d'exemple :

Blog ✔️  
CTA ✔️  
Error 404 ✔️  
FAQ ✔️  
Footer ✔️  
Gallery ✔️  
Hero ✔️  
Introduction ✔️  
Map ✔️  
Menu ✔️  
Newsletter ✔️  
Pricing ✔️  
Slider ✔️  
Testimonial ✔️  
Timeline ✔️  

### Dépendance(s)

| Label               | Description                                | URL                                           | Required       |
| ------------------- | -------------------------------------------|---------------------------------------------- | -------------- |
| JSON Editor         |  Pour éditer le data.json depuis l'admin   | https://cdn.jsdelivr.net/npm/jsoneditor/      | Non requis     |

---

## Features & améliorations

On se retrouve avec un fichier `data.json` très long puisqu'il renferme à lui seul le routing, le contenu et la structure des pages.\
Il est toutefois possible de l'éditer via l'admin du projet.\
L'idée serait de partager ce type de fichier pour changer d'apparence, de contenu ou de structure d'un site à l'autre en partageant des fichiers .json ayant la même strucure.

## Compatiblité Wordpress

J'ai également rendu compatible le projet à Wordpress.

Pour ce faire, il faut télécharger le thème "Severin" situé dans le dossier /wordpress/wp-content/themes du dépôt, et de renseigner la constante "**WP_API**" de l'index.php à "**TRUE**".

Vous pouvez ensuite éditer l'endpoint de l'API vers votre Wordprress et installer le thème. Une fois installé, le thème vous proposera d'installer des plugins utiles et non obligatoires mais dans le but de sécuriser votre Wordpress ou de faciliter la gestion de contenu. Parmi eux, un plugin est obligatoire pour la construction des composants dont le contenu sera dynamique via le dashboard de Wordpress. Ainsi, il est possible de construire un site avec Wordpress et la célèbre extention "**ACF**". Vous devez également installer le fichier **acf.json** pour installer les nouveaux types de posts et les composants d'exemples.

Enfin, vous pouvez installer le plugin **Poly Lang** pour faire de votre projet, un site web **multilingue**.

Une fois que tout est installé, vous allez pouvoir créer des pages. Les routes se créeront automatiquement. Vous pourrez ensuite associer les composants à chaque page.

Chaque composants possèdent sa catégorie. Lorsque vous créez un nouveau composant, associé-le à une catégorie et les champs dynamiques apparaîtront pour en éditer le contenu.