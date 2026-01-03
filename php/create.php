<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libelle = $_POST['libelle'] ?? '';
    $quantite = $_POST['quantite'] ?? 0;
    $prix = $_POST['prix'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    if ($libelle) {
        $stmt = $pdo->prepare("INSERT INTO produits (libelle, quantite, prix, stock) VALUES (:libelle, :quantite, :prix, :stock)");
        $stmt->execute([
            'libelle' => $libelle,
            'quantite' => $quantite,
            'prix' => $prix,
            'stock' => $stock
        ]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Ajouter un produit</h1>
    <form method="post">
        <div class="mb-3">
            <label>Libellé</label>
            <input type="text" name="libelle" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <button class="btn btn-success">Ajouter</button>
        <a href="index.php" class="btn btn-secondary">Retour</a>
    </form>
</body>
</html>
