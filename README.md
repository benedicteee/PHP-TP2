# PHP-TP2 - Système de Gestion de Planning Académique

## Table des Matières

- [Analyse des Besoins](#analyse-des-besoins)
- [Structure des Fichiers](#structure-des-fichiers)
- [Choix de Conception](#choix-de-conception)
- [Installation et Configuration](#installation-et-configuration)
- [Utilisation](#utilisation)
- [Technologies Utilisées](#technologies-utilisées)
- [Développement](#développement)
- [Limitations](#limitations)
- [Améliorations Possibles](#améliorations-possibles)
- [Licence](#licence)

## Analyse des Besoins

### Contexte
Ce projet est un système de gestion de planning académique développé dans le cadre d'un TP (Travail Pratique) en PHP. Il vise à automatiser la création d'un planning hebdomadaire pour des cours universitaires.

### Besoins Fonctionnels
- **Gestion des ressources** : Salles, promotions, cours et options
- **Génération automatique du planning** : Attribution automatique des cours aux créneaux horaires et salles
- **Interface web** : Consultation et modification des données via un navigateur
- **Persistance des données** : Stockage des informations sans base de données complexe

### Besoins Non-Fonctionnels
- **Simplicité** : Application légère sans frameworks lourds
- **Maintenabilité** : Code organisé et modulaire
- **Performance** : Génération rapide du planning pour un nombre limité de données
- **Accessibilité** : Interface web standard compatible avec les navigateurs modernes

### Acteurs
- **Administrateur** : Gère les salles, promotions, cours et options
- **Utilisateur** : Consulte le planning généré

## Structure des Fichiers

```
PHP-TP2/
├── index.php                 # Page principale - génère et affiche le planning
├── README.md                 # Documentation du projet
├── assets/                   # Ressources statiques (CSS)
│   ├── style.css            # Styles principaux
│   └── style_new.css        # Styles alternatifs
├── data/                     # Stockage des données (fichiers texte)
│   ├── cours.txt            # Liste des cours (format: CODE;NOM;DUREE;TYPE;NIVEAU)
│   ├── options.txt          # Liste des options (format: CODE;NOM)
│   ├── planning.txt         # Planning généré (format: CRENEAU;SALLE;PROMOTION;COURS)
│   ├── promotions.txt       # Liste des promotions (format: CODE;NOM)
│   └── salles.txt           # Liste des salles (format: CODE;NOM;CAPACITE)
├── formulaires/              # Formulaires d'ajout/modification
│   ├── ajouter_cours.php    # Formulaire ajout cours
│   ├── ajouter_option.php   # Formulaire ajout option
│   ├── ajouter_promotion.php # Formulaire ajout promotion
│   └── ajouter_salle.php    # Formulaire ajout salle
├── includes/                 # Fonctions utilitaires (architecture modulaire)
│   ├── fonction_affichage.php    # Fonctions d'affichage HTML
│   ├── fonctions_chargement.php  # Chargement des données depuis fichiers
│   ├── fonctions_planning.php    # Algorithme de génération du planning
│   ├── fonctions_sauvegarde.php  # Sauvegarde des données
│   └── fonctions_verification.php # Vérifications et validations
├── pages/                    # Pages de gestion (contrôleurs)
│   ├── assigner_cours.php   # Assignation manuelle des cours
│   ├── cours.php            # Gestion des cours
│   ├── liste_cours.php      # Liste des cours
│   ├── options.php          # Gestion des options
│   ├── planning.php         # Affichage détaillé du planning
│   ├── promotions.php       # Gestion des promotions
│   └── salles.php           # Gestion des salles
└── templates/                # Templates HTML (vues partielles)
    ├── footer.php           # Pied de page
    ├── header.php           # En-tête HTML
    └── menu.php             # Menu de navigation
```

### Organisation Logique
- **Racine** : Point d'entrée de l'application
- **assets/** : Ressources statiques (CSS, JS, images)
- **data/** : Couche de persistance (fichiers texte)
- **formulaires/** : Composants de saisie utilisateur
- **includes/** : Logique métier et utilitaires
- **pages/** : Pages principales (contrôleurs)
- **templates/** : Éléments d'interface réutilisables

## Choix de Conception

### Architecture
L'application suit une architecture **MVC-like simplifiée** adaptée à PHP procédural :
- **Modèle** : Fonctions de manipulation des données (`includes/`)
- **Vue** : Templates HTML et fonctions d'affichage
- **Contrôleur** : Pages principales orchestrant les actions

### Stockage des Données
- **Choix** : Fichiers texte plats au lieu d'une base de données
- **Raison** : Simplicité, pas de dépendance à un SGBD, facilité de déploiement
- **Format** : CSV-like avec séparateur point-virgule
- **Limitation** : Pas adapté à de gros volumes de données

### Langage et Technologies
- **PHP natif** : Pas de framework pour rester léger et éducatif
- **HTML/CSS purs** : Interface simple sans JavaScript complexe
- **Pas de base de données** : Stockage fichier pour la démonstration

### Génération du Planning
- **Algorithme simple** : Attribution séquentielle des cours aux créneaux disponibles
- **Critères** : Disponibilité des salles, compatibilité promotion/cours
- **Approche** : Priorité aux cours de tronc commun, puis options

### Interface Utilisateur
- **Design simple** : Tableaux HTML pour l'affichage du planning
- **Navigation** : Menu principal avec liens vers les sections
- **Formulaires** : Saisie directe des données sans validation JavaScript côté client

### Modularité
- **Séparation des responsabilités** : Une fonction par fichier d'inclusion
- **Réutilisabilité** : Templates pour les éléments communs (header, footer, menu)
- **Maintenabilité** : Code organisé par fonctionnalité

## Description

PHP-TP2 est une application web PHP simple pour la gestion d'un planning hebdomadaire académique. Elle permet de gérer les salles, promotions, cours et options, puis génère automatiquement un planning basé sur ces données.

## Fonctionnalités

- **Gestion des salles** : Ajouter, modifier et supprimer des salles avec leur capacité
- **Gestion des promotions** : Gérer les différentes promotions étudiantes
- **Gestion des cours** : Administrer les cours avec leur durée, type (tronc commun/option) et niveau
- **Gestion des options** : Gérer les options disponibles
- **Génération automatique du planning** : Créer un planning hebdomadaire basé sur les données disponibles
- **Affichage du planning** : Visualiser le planning sous forme de tableau HTML

## Installation et Configuration

### Prérequis

- Serveur web avec PHP 7.0+ (recommandé : WAMP, XAMPP, ou serveur Apache/Nginx)
- Navigateur web moderne

### Installation

1. Cloner ou télécharger le projet dans le répertoire web de votre serveur (ex: `c:\wamp64\www\` pour WAMP)
2. Assurer que les permissions d'écriture sont accordées sur le dossier `data/`
3. Ouvrir votre navigateur et accéder à l'URL du projet (ex: `http://localhost/PHP-TP2/`)

## Utilisation

### Page Principale (index.php)

- Affiche le planning hebdomadaire généré automatiquement
- Fournit des liens vers les différentes sections de gestion

### Gestion des Entités

- **Salles** : Ajouter/modifier des salles avec code, nom et capacité
- **Promotions** : Gérer les promotions étudiantes
- **Cours** : Administrer les cours avec durée, type et niveau
- **Options** : Gérer les options disponibles

### Format des Données

Les données sont stockées dans des fichiers texte avec séparateur point-virgule :

- **salles.txt** : `CODE;NOM;CAPACITE`
- **promotions.txt** : `CODE;NOM`
- **cours.txt** : `CODE;NOM;DUREE;TYPE;NIVEAU`
- **options.txt** : `CODE;NOM`

## Technologies Utilisées

- **PHP** : Langage de programmation principal
- **HTML/CSS** : Interface utilisateur
- **Fichiers texte** : Stockage des données (sans base de données)

## Développement

### Architecture

L'application suit une architecture simple MVC-like :
- **Modèle** : Fonctions de chargement et sauvegarde des données
- **Vue** : Templates HTML et fonctions d'affichage
- **Contrôleur** : Pages principales gérant la logique métier

### Fonctions Principales

- `charger_*()` : Chargement des données depuis les fichiers texte
- `sauvegarder_*()` : Sauvegarde des données
- `generer_planning()` : Algorithme de génération du planning
- `afficher_planning_html()` : Affichage du planning en HTML

## Limitations

- Stockage en fichiers texte (pas de base de données)
- Pas d'authentification utilisateur
- Génération de planning basique (sans optimisation avancée)
- Interface utilisateur simple (pas de framework CSS/JS)

## Améliorations Possibles

- Migration vers une base de données (MySQL, SQLite)
- Ajout d'un système d'authentification
- Interface plus moderne (Bootstrap, Vue.js)
- Algorithmes de planning plus sophistiqués
- Export du planning (PDF, Excel)
- API REST pour intégration

## Licence

Ce projet est fourni tel quel, sans garantie. Utilisez-le à vos propres risques.