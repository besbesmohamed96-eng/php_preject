<?php require __DIR__ . '/../layout/header.php'; ?>

<?php
// Vue premium : conditions d'affichage strictes selon le rôle connecté.
$isVendeur = (($_SESSION['role'] ?? null) === 'vendeur');
$isConnecte = !empty($_SESSION['user_id']);
?>

<section class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-semibold tracking-tight">Catalogue</h1>
        <p class="mt-1 text-zinc-400">Sélection raffinée de produits - Mini-Boutique</p>
    </div>

    <?php if ($isVendeur): ?>
        <a href="index.php?controller=produit&action=create" class="rounded-lg bg-zinc-100 px-4 py-2 font-medium text-zinc-900 hover:bg-white">
            Ajouter un produit
        </a>
    <?php endif; ?>
</section>

<section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($produits as $produit): ?>
        <article class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900 shadow-xl shadow-black/20">
            <img src="<?= htmlspecialchars($produit['image_produit']) ?>" alt="<?= htmlspecialchars($produit['designation']) ?>" class="h-52 w-full object-cover">
            <div class="space-y-4 p-5">
                <h2 class="text-lg font-semibold"><?= htmlspecialchars($produit['designation']) ?></h2>
                <p class="text-xl font-medium text-zinc-100"><?= number_format((float) $produit['prix'], 2, '.', ' ') ?> TND</p>

                <div class="flex gap-2">
                    <?php if ($isVendeur): ?>
                        <a href="index.php?controller=produit&action=edit&id=<?= (int) $produit['id'] ?>" class="rounded-md border border-zinc-600 px-3 py-2 text-sm text-zinc-100 hover:bg-zinc-800">Modifier</a>
                        <a href="index.php?controller=produit&action=delete&id=<?= (int) $produit['id'] ?>" class="rounded-md border border-red-900 px-3 py-2 text-sm text-red-300 hover:bg-red-950/40" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
                    <?php elseif ($isConnecte): ?>
                        <a href="index.php?controller=commande&action=add&produit_id=<?= (int) $produit['id'] ?>" class="rounded-md bg-zinc-100 px-3 py-2 text-sm font-medium text-zinc-900 hover:bg-white">Commander</a>
                    <?php else: ?>
                        <a href="index.php?controller=auth&action=login" class="rounded-md bg-zinc-100 px-3 py-2 text-sm font-medium text-zinc-900 hover:bg-white">Se connecter pour commander</a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
