<?php
require_once 'connexion.php';

// Récupérer toutes les tâches
$stmt = $pdo->query("SELECT * FROM taches ORDER BY priorite DESC, date_echeance ASC");
$taches = $stmt->fetchAll();

// Organiser par statut
$todo = array_filter($taches, fn($t) => $t['statut'] === 'todo');
$progress = array_filter($taches, fn($t) => $t['statut'] === 'progress');
$done = array_filter($taches, fn($t) => $t['statut'] === 'done');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>📋 Gestionnaire de Tâches</h1>
    <a href="ajouter.php" class="btn-add">➕ Nouvelle tâche</a>

    <div class="container">
        <!-- Colonne À FAIRE -->
        <div class="column">
            <h2>📌 À faire</h2>
            <?php foreach ($todo as $tache): ?>
                <div class="card <?= $tache['priorite'] >= 4 ? 'priorite-haute' : '' ?>">
                    <h3><?= htmlspecialchars($tache['titre']) ?></h3>
                    <p><?= htmlspecialchars($tache['description']) ?></p>
                    <small>Priorité: <?= $tache['priorite'] ?>/5</small>
                    <?php if ($tache['date_echeance']): ?>
                        <small>Échéance: <?= date('d/m/Y', strtotime($tache['date_echeance'])) ?></small>
                    <?php endif; ?>
                    <div class="actions">
                        <a href="traitement.php?action=progress&id=<?= $tache['id'] ?>">▶️ Commencer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Colonne EN COURS -->
        <div class="column">
            <h2>⏳ En cours</h2>
            <?php foreach ($progress as $tache): ?>
                <div class="card <?= $tache['priorite'] >= 4 ? 'priorite-haute' : '' ?>">
                    <h3><?= htmlspecialchars($tache['titre']) ?></h3>
                    <p><?= htmlspecialchars($tache['description']) ?></p>
                    <small>Priorité: <?= $tache['priorite'] ?>/5</small>
                    <?php if ($tache['date_echeance']): ?>
                        <small>Échéance: <?= date('d/m/Y', strtotime($tache['date_echeance'])) ?></small>
                    <?php endif; ?>
                    <div class="actions">
                        <a href="traitement.php?action=done&id=<?= $tache['id'] ?>">✅ Terminer</a>
                        <a href="traitement.php?action=todo&id=<?= $tache['id'] ?>">◀️ Retour</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Colonne TERMINÉ -->
        <div class="column">
            <h2>✅ Terminé</h2>
            <?php foreach ($done as $tache): ?>
                <div class="card done">
                    <h3><?= htmlspecialchars($tache['titre']) ?></h3>
                    <p><?= htmlspecialchars($tache['description']) ?></p>
                    <small>Priorité: <?= $tache['priorite'] ?>/5</small>
                    <?php if ($tache['date_echeance']): ?>
                        <small>Échéance: <?= date('d/m/Y', strtotime($tache['date_echeance'])) ?></small>
                    <?php endif; ?>
                    <div class="actions">
                        <a href="traitement.php?action=progress&id=<?= $tache['id'] ?>">🔄 Réactiver</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>