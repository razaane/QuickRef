# QuickRef — Plateforme de Gestion des Arbitres FRMF

> Application web de gestion des arbitres de football pour la Fédération Royale Marocaine de Football (FRMF).

![Laravel](https://img.shields.io/badge/Laravel-13.x-E0283C?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat-square&logo=php)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-CDN-06B6D4?style=flat-square&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql)

---

## Table des Matières

- [Présentation](#présentation)
- [Stack Technique](#stack-technique)
- [Installation](#installation)
- [Structure du Projet](#structure-du-projet)
- [Base de Données](#base-de-données)
- [Rôles & Authentification](#rôles--authentification)
- [Fonctionnalités Admin](#fonctionnalités-admin)
- [Fonctionnalités Arbitre](#fonctionnalités-arbitre)
- [Seeders](#seeders)
- [Palette de Couleurs](#palette-de-couleurs)

---

## Présentation

QuickRef est une application web développée pour la FRMF permettant de gérer l'ensemble du cycle de vie des arbitres :

- **Désignation** aux matchs (arbitre central, assistants, 4ème arbitre)
- **Suivi** des convocations et statuts des matchs
- **Gestion** des paiements d'indemnités par arbitre

Deux interfaces distinctes : une pour les **administrateurs FRMF**, une pour les **arbitres**.

---

## Stack Technique

| Composant | Technologie | Version |
|-----------|-------------|---------|
| Backend | Laravel | 13.x |
| Langage | PHP | 8.4 |
| Base de données | MySQL | 8.x |
| Frontend CSS | TailwindCSS (CDN) | 3.x |
| Icônes | Material Symbols Outlined | Google Fonts |
| Polices | Manrope + Inter | Google Fonts |
| Auth | Laravel Auth (custom) | — |
| ORM | Eloquent | — |

---

## Installation

### Prérequis

- PHP >= 8.2
- Composer
- MySQL 8.x

### Étapes

```bash
# 1. Cloner le projet
git clone 
cd quickref

# 2. Installer les dépendances
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données dans .env
DB_DATABASE=quickref
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrations + Seeders
php artisan migrate:fresh --seed

# 6. Lancer le serveur
php artisan serve
```

### Logo FRMF

Placer le logo dans :
public/images/marocLogo.webp

### Identifiants de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | admin@arbitrage.ma | password |
| Arbitre 1 | youssef.alami@arbitrage.ma | password |
| Arbitre 2 | khalid.benali@arbitrage.ma | password |

---

## Structure du Projet
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── ArbitreController.php
│   │   │   ├── EquipeController.php
│   │   │   ├── CategorieController.php
│   │   │   ├── MatchController.php
│   │   │   ├── PaiementController.php
│   │   │   └── ProfilController.php
│   │   └── Arbitre/
│   │       ├── ArbitreMatchController.php
│   │       └── ProfilController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── ArbitreMiddleware.php
├── Models/
│   ├── User.php
│   ├── Arbitre.php
│   ├── Game.php          ← modèle des matchs ($table = 'matchs')
│   ├── Equipe.php
│   └── Categorie.php
database/
├── migrations/
└── seeders/
resources/views/
├── admin/
│   ├── dashboard.blade.php
│   ├── arbitres/
│   ├── equipes/
│   ├── categories/
│   ├── matchs/
│   ├── paiements/
│   └── profil/
├── arbitre/
│   ├── dashboard.blade.php
│   ├── matchs/
│   └── profil/
└── layouts/
├── app.blade.php       ← layout racine
├── admin.blade.php     ← sidebar + header admin
└── arbitre.blade.php   ← navbar top arbitre

> ⚠️ Le modèle des matchs s'appelle `Game` (mot réservé PHP) avec `$table = 'matchs'`.

---

## Base de Données

### Tables

| Table | Description | Colonnes clés |
|-------|-------------|---------------|
| `users` | Comptes de connexion | name, email, password, role |
| `arbitres` | Profil arbitre | user_id, telephone, grade, adresse |
| `equipes` | Équipes de football | nom, ville |
| `categories` | Catégories de match | nom, montant (MAD) |
| `matchs` | Matchs désignés | equipes, arbitres x4, date_heure, terrain, statut |
| `paiements` | Paiements arbitres | arbitre_id, mois (=match_id), montant, statut |

### Statuts d'un Match

| Statut | Description |
|--------|-------------|
| `en_attente` | Match créé, pas encore confirmé |
| `confirmer` | Match confirmé aux arbitres |
| `jouer` | Match s'est déroulé |
| `annuler` | Match annulé |
| `reporter` | Match reporté à une autre date |

### Statuts d'un Paiement

| Statut | Description |
|--------|-------------|
| `en_attente` | Indemnité pas encore traitée |
| `paye` | Indemnité versée à l'arbitre |
| `non_paye` | Paiement refusé par l'admin |

### Relations Eloquent
User          ──hasOne──►   Arbitre
Arbitre       ──belongsTo── User
Game          ──belongsTo── Equipe (domicile + visiteur)
Game          ──belongsTo── Arbitre (central, assistant1, assistant2, quatrieme)
Game          ──belongsTo── Categorie

---

## Rôles & Authentification

| Rôle | Préfixe URL | Middleware |
|------|-------------|------------|
| `admin` | `/admin/*` | `auth` + `admin` |
| `arbitre` | `/arbitre/*` | `auth` + `arbitre` |

Les middlewares vérifient `auth()->user()->role` et redirigent si non autorisé.

---

## Fonctionnalités Admin

### Dashboard
- Total matchs joués / en attente
- Total arbitres enregistrés
- Total paiements en attente (MAD)
- Liste des derniers matchs
- Actions rapides (ajouter arbitre, créer match, paiements)

### Gestion des Arbitres
- CRUD complet
- Création simultanée User + Arbitre (transaction DB)
- Grades : `régional` / `national` / `international`

### Gestion des Équipes
- CRUD complet (nom + ville)

### Catégories & Tarifs
- CRUD des catégories de compétition
- Montant d'indemnité fixe par catégorie (MAD)

### Matchs & Désignations
- Créer un match : 2 équipes, catégorie, 3 ou 4 arbitres, date/heure, terrain, ville
- Validation : équipes différentes obligatoires
- Validation : un arbitre ne peut pas être désigné deux fois le même jour
- Gestion des statuts

### Paiements
- Affiche uniquement les matchs `jouer`
- Paiement individuel par arbitre (pas par match global)
- Bouton Payer / Refuser par arbitre
- Possibilité de changer d'avis après traitement
- Total global restant à régler

### Profil Admin
- Modifier nom et email
- Changer le mot de passe (optionnel)

---

## Fonctionnalités Arbitre

### Dashboard
- Total indemnités / déjà payé / en attente (MAD)
- 5 prochains matchs avec statut
- Historique des matchs joués avec statut de paiement

### Mes Matchs
- Liste paginée de tous ses matchs
- Rôle dans chaque match (central / assistant 1 / assistant 2 / 4ème)
- Vue détail : équipes, terrain, corps arbitral complet

### Profil Arbitre
- Modifier nom, email, téléphone, adresse
- Changer le mot de passe (optionnel)
- Le grade est modifiable uniquement par l'admin

---

## Seeders

| Seeder | Données créées |
|--------|---------------|
| `UserSeeder` | 1 admin + 10 arbitres (users) |
| `ArbitreSeeder` | 10 profils arbitres liés aux users |
| `CategorieSeeder` | 5 catégories (Botola Pro D1, D2, Coupe du Trône, U21, U18) |
| `EquipeSeeder` | 10 équipes (WAC, Raja, FUS, FAR, Hassania...) |
| `MatchSeeder` | 7 matchs avec différents statuts |
| `PaiementSeeder` | ~20 paiements pour les arbitres |

---

## Palette de Couleurs

| Variable | Hex | Usage |
|----------|-----|-------|
| `primary` | `#E0283C` | Rouge FRMF — sidebar active, boutons |
| `primary-dark` | `#B01E2E` | Hover sur éléments rouges |
| `primary-light` | `#fb7185` | Icônes inactives sidebar |
| `sidebar` | `#020617` | Fond de la sidebar |
| `background` | `#F8FAFC` | Fond des pages |
| `surface` | `#FFFFFF` | Cards, modales |
| `on-surface` | `#020617` | Textes principaux |
| `on-surface-variant` | `#64748B` | Textes secondaires |
| `on-surface-muted` | `#94A3B8` | Labels, placeholders |
| `outline-variant` | `#E2E8F0` | Bordures, séparateurs |
| `accent-green` | `#1B6B3A` | Badges positifs (payé, confirmé) |
| `accent-gold` | `#C9A84C` | Logo FRMF, accents dorés |

---

*QuickRef — FRMF © 2025 — Plateforme Officielle d'Arbitrage*