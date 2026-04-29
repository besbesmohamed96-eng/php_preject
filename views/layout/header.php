<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Boutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100">
    <header class="border-b border-zinc-800 bg-zinc-900/80 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="index.php?controller=produit&action=catalogue" class="text-lg font-semibold tracking-wide text-zinc-100">
                Mini-Boutique
            </a>
            <nav class="flex items-center gap-3 text-sm">
                <a class="rounded-md px-3 py-2 text-zinc-300 hover:bg-zinc-800 hover:text-white" href="index.php?controller=produit&action=catalogue">Catalogue</a>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <a class="rounded-md px-3 py-2 text-zinc-300 hover:bg-zinc-800 hover:text-white" href="index.php?controller=commande&action=mesCommandes">Mes commandes</a>
                    <span class="rounded-md border border-zinc-700 px-3 py-2 text-zinc-300">
                        <?= htmlspecialchars($_SESSION['nom_complet'] ?? 'Utilisateur') ?> (<?= htmlspecialchars($_SESSION['role'] ?? '-') ?>)
                    </span>
                    <a class="rounded-md bg-zinc-100 px-3 py-2 font-medium text-zinc-900 hover:bg-white" href="index.php?controller=auth&action=logout">Déconnexion</a>
                <?php else: ?>
                    <a class="rounded-md px-3 py-2 text-zinc-300 hover:bg-zinc-800 hover:text-white" href="index.php?controller=auth&action=login">Connexion</a>
                    <a class="rounded-md bg-zinc-100 px-3 py-2 font-medium text-zinc-900 hover:bg-white" href="index.php?controller=auth&action=register">Inscription</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="mx-auto max-w-7xl px-6 py-8">
