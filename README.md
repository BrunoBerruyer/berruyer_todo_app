# Gestionnaire de Tâches - Bruno Berruyer

Application web de gestion de tâches (todo list) avec statuts et priorités.

## Installation

1. Importer `todo_app.sql` dans phpMyAdmin
2. Vérifier la connexion dans `connexion.php` (port 3307)
3. Accéder via http://localhost/berruyer_todo_app

## Fonctionnalités

- 3 colonnes : À faire / En cours / Terminé
- Ajout de tâches avec validation
- Priorités (0-5) avec indicateur visuel rouge pour priorité haute (≥4)
- Dates d'échéance
- API JSON avec filtres :
  - `api.php?statut=todo` (ou progress, done)
  - `api.php?priorite=haute`
- Design pixel art rétro

## Technologies

- PHP 8+ / MySQL (MariaDB)
- PDO pour la sécurité
- CSS responsive

## Structure

- `index.php` - Interface principale
- `ajouter.php` - Formulaire d'ajout
- `traitement.php` - Changement de statut
- `api.php` - API JSON
- `connexion.php` - Connexion BDD
- `style.css` - Design
- `todo_app.sql` - Export base de données
