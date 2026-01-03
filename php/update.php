<?php
require 'db.php';
$id = $_GET['id'] ?? null;

if (!$id) die("ID manquant");

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute(['id' => $id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) die("Produit introuvable");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libelle = $_POST['libelle'] ?? '';
    $quantite = $_POST['quantite'] ?? 0;
    $prix = $_POST['prix'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $stmt = $pdo->prepare("UPDATE produits SET libelle=:libelle, quantite=:quantite, prix=:prix, stock=:stock WHERE id=:id");
    $stmt->execute([
        'libelle'=>$libelle,
        'quantite'=>$quantite,
        'prix'=>$prix,
        'stock'=>$stock,
        'id'=>$id
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Modifier un produit</h1>
    <form method="post">
        <div class="mb-3">
            <label>Libellé</label>
            <input type="text" name="libelle" class="form-control" value="<?= htmlspecialchars($p['libelle']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" value="<?= htmlspecialchars($p['quantite']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" step="0.01" name="prix" class="form-control" value="<?= htmlspecialchars($p['prix']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($p['stock']) ?>" required>
        </div>
        <button class="btn btn-primary">Modifier</button>
        <a href="index.php" class="btn btn-secondary">Retour</a>
    </form>
</body>
</html>
