# Severin

Severin est un projet minimaliste voulant être le plus complet possible.
Ce système est un CMS JSON component-based, tournant sous PHP natif et dont les assets sont compilés avec Vite.
Référencé, sécurisé et très léger pour des sites vitrines performants.

## Structure & concept du projet

Le projet se compose comme suit :

- Routing PHP simple (via le fichier `index.php` et `.htaccess`)
- Composants isolés et réutilisables
- Contenu piloté par JSON (`data.json`) et un petit admin ajouté à cet effet
- SEO dynamique depuis le JSON et URLs propres
- Sécurité de base via le `.htaccess` (avec PHP et sous Apache)

## Principe

Le système repose sur 5 piliers :

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
- Réécriture des URLs propres (exemple : `/`, `/blog`, `/blog/1`)
- Balises `<head>` dynamiques
- Balises Open Graph dynamiques (en cours)

### 5. Sécurité

Severin dispose d'une sécurité de base, principalement via le fichier `.htaccess` Apache :

- Listage des répertoires désactivé
- Protection XSS
- HTTPS forcé une fois en ligne

### Objectifs

Créer un système :

- Simple comme PHP natif, mais sans base de données
- Structuré comme un framework moderne (composants)
- Rapide, sécurisé et SEO-friendly

---

## Mise en ligne

1. Ajoutez vos composants, renseignez-les dans le fichier `/main.js`, et compilez le tout via la commande Vite : `npm run build`

2. Modifiez à votre guise le fichier `data.json` manuellement ou via l'admin `/admin`.
Pour y accéder, le mot de passe se trouve dans le fichier `/admin/login.php` — **pensez à le changer une fois en ligne !**

3. Mettez le tout en ligne. En production, seuls ces fichiers sont nécessaires :

| Fichiers en ligne   | Attribution                               |
| ------------------- | ----------------------------------------- |
| `/admin/data.json`  | Contenu & structure du site               |
| `/assets`           | Assets compilés & fichiers statiques      |
| `/Composants`       | Composants UI avec SCSS et JS éditables   |
| `index.php`         | Point d'entrée & moteur SEO               |
| `.htaccess`         | Routing & sécurité                        |

## Composants

### Déjà en place

Menu ✔️  
Hero ✔️  
Footer ✔️  
Section 404 ✔️  
FAQ ✔️  
About ✔️  
Map ✔️  
Testimonials ✔️  
CTA ✔️  
Timeline ✔️  
Cards / Blog Grid ✔️  

### Très prochainement

Pricing / Stats  
Gallery  
Contact Form  
Newsletter  

## Défaut principal

On se retrouve avec un fichier `data.json` très long puisqu'il renferme à lui seul le routing, le contenu et la structure des pages.
Il est toutefois possible de l'éditer via l'admin.
L'idée serait de partager ce type de fichier pour changer d'apparence, de contenu ou de structure d'un site à l'autre.