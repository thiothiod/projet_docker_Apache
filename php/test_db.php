<?php
try {
    $pdo = new PDO(
        "pgsql:host=postgres_db;port=5432;dbname=crud_db",
        "postgres",
        "postgres"
    );
    echo "✅ Connexion PostgreSQL réussie";
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
