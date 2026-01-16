<?php
require_once 'connexion.php';

$erreurs = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $priorite = (int)($_POST['priorite'] ?? 0);
    $date_echeance = $_POST['date_echeance'] ?? null;

    if (empty($titre)) {
        $erreurs[] = "Le titre est obligatoire";
    }

    if ($priorite < 0 || $priorite > 5) {
        $erreurs[] = "La priorité doit être entre 0 et 5";
    }

    // Insertion si pas d'erreurs
    if (empty($erreurs)) {
        $stmt = $pdo->prepare("INSERT INTO taches (titre, description, priorite, date_echeance) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titre, $description, $priorite, $date_echeance ?: null]);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn-submit {
            background: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit:hover {
            background: #45a049;
        }

        .btn-back {
            background: #999;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-left: 10px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .success {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>➕ Ajouter une tâche</h1>

    <div class="form-container">
        <?php if (!empty($erreurs)): ?>
            <div class="error">
                <?php foreach ($erreurs as $erreur): ?>
                    <p><?= htmlspecialchars($erreur) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success">
                ✅ Tâche ajoutée avec succès !
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="titre">Titre *</label>
                <input type="text" id="titre" name="titre" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="priorite">Priorité (0-5)</label>
                <input type="number" id="priorite" name="priorite" min="0" max="5" value="0">
            </div>

            <div class="form-group">
                <label for="date_echeance">Date d'échéance</label>
                <input type="date" id="date_echeance" name="date_echeance">
            </div>

            <button type="submit" class="btn-submit">Ajouter</button>
            <a href="index.php" class="btn-back">Retour</a>
        </form>
    </div>
</body>

</html>