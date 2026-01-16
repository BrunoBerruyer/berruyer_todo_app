<?php
require_once 'connexion.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = (int)$_GET['id'];

    // Vérifier que le statut est valide
    $statuts_valides = ['todo', 'progress', 'done'];
    if (in_array($action, $statuts_valides)) {
        $stmt = $pdo->prepare("UPDATE taches SET statut = ? WHERE id = ?");
        $stmt->execute([$action, $id]);
    }
}

// Redirection vers l'accueil
header('Location: index.php');
exit;
