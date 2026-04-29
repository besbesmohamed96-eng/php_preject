<?php require __DIR__ . '/../layout/header.php'; ?>

<?php $isEdit = !empty($produit); ?>

<section class="mx-auto max-w-2xl rounded-2xl border border-zinc-800 bg-zinc-900 p-8 shadow-2xl shadow-black/30">
    <h1 class="mb-2 text-2xl font-semibold"><?= $isEdit ? 'Modifier le produit' : 'Ajouter un produit' ?></h1>
    <p class="mb-6 text-sm text-zinc-400">Espace réservé au vendeur.</p>

    <?php if (!empty($error)): ?>
        <div class="mb-4 rounded-lg border border-red-900 bg-red-950/50 px-4 py-3 text-sm text-red-200"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="mb-1 block text-sm text-zinc-300">Désignation</label>
            <input
                type="text"
                name="designation"
                required
                value="<?= htmlspecialchars($produit['designation'] ?? '') ?>"
                class="w-full rounded-lg border border-zinc-700 bg-zinc-950 px-3 py-2 text-zinc-100 outline-none ring-zinc-400 focus:ring-1"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm text-zinc-300">Prix (TND)</label>
            <input
                type="number"
                step="0.01"
                min="0"
                name="prix"
                required
                value="<?= htmlspecialchars(isset($produit['prix']) ? (string) $produit['prix'] : '') ?>"
                class="w-full rounded-lg border border-zinc-700 bg-zinc-950 px-3 py-2 text-zinc-100 outline-none ring-zinc-400 focus:ring-1"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm text-zinc-300">Image produit (jpg/png/webp)</label>
            <input type="file" name="image_produit" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-lg border border-zinc-700 bg-zinc-950 px-3 py-2 text-zinc-100">
        </div>

        <button type="submit" class="rounded-lg bg-zinc-100 px-4 py-2 font-medium text-zinc-900 hover:bg-white">
            <?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?>
        </button>
    </form>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
