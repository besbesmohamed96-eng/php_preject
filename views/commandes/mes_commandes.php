<?php require __DIR__ . '/../layout/header.php'; ?>

<section>
    <h1 class="mb-6 text-3xl font-semibold tracking-tight">Mes commandes</h1>

    <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">
        <table class="min-w-full divide-y divide-zinc-800 text-sm">
            <thead class="bg-zinc-950">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-zinc-300">Produit</th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-300">Prix</th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-300">Statut</th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-300">Date</th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-300">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800">
                <?php foreach ($commandes as $commande): ?>
                    <tr class="hover:bg-zinc-800/40">
                        <td class="px-4 py-3"><?= htmlspecialchars($commande['designation']) ?></td>
                        <td class="px-4 py-3"><?= number_format((float) $commande['prix'], 2, '.', ' ') ?> TND</td>
                        <td class="px-4 py-3">
                            <span class="rounded-md border border-emerald-900 bg-emerald-950/40 px-2 py-1 text-emerald-300">
                                <?= htmlspecialchars($commande['statut']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-zinc-400"><?= htmlspecialchars($commande['date_commande']) ?></td>
                        <td class="px-4 py-3">
                            <a
                                href="index.php?controller=commande&action=delete&id=<?= (int) $commande['id'] ?>"
                                class="rounded-md border border-red-900 px-3 py-2 text-xs text-red-300 hover:bg-red-950/40"
                                onclick="return confirm('Supprimer cet article de votre panier/commande ?');"
                            >
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
