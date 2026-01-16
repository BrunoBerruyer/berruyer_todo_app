<?php
require_once 'connexion.php';

header('Content-Type: application/json');

// Construire la requête SQL
$sql = "SELECT * FROM taches WHERE 1=1";
$params = [];

// Filtrer par statut
if (isset($_GET['statut']) && in_array($_GET['statut'], ['todo', 'progress', 'done'])) {
    $sql .= " AND statut = ?";
    $params[] = $_GET['statut'];
}

// Filtrer par priorité haute
if (isset($_GET['priorite']) && $_GET['priorite'] === 'haute') {
    $sql .= " AND priorite >= 4";
}

$sql .= " ORDER BY priorite DESC, date_echeance ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$taches = $stmt->fetchAll();

echo json_encode($taches, JSON_PRETTY_PRINT);
