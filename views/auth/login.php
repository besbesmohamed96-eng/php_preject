<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="mx-auto max-w-md rounded-2xl border border-zinc-800 bg-zinc-900 p-8 shadow-2xl shadow-black/30">
    <h1 class="mb-2 text-2xl font-semibold">Connexion</h1>
    <p class="mb-6 text-sm text-zinc-400">Accédez à votre espace Mini-Boutique.</p>

    <?php if (!empty($error)): ?>
        <div class="mb-4 rounded-lg border border-red-900 bg-red-950/50 px-4 py-3 text-sm text-red-200"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="mb-1 block text-sm text-zinc-300">Email</label>
            <input type="email" name="email" required class="w-full rounded-lg border border-zinc-700 bg-zinc-950 px-3 py-2 text-zinc-100 outline-none ring-zinc-400 focus:ring-1">
        </div>
        <div>
            <label class="mb-1 block text-sm text-zinc-300">Mot de passe</label>
            <input type="password" name="password" required class="w-full rounded-lg border border-zinc-700 bg-zinc-950 px-3 py-2 text-zinc-100 outline-none ring-zinc-400 focus:ring-1">
        </div>
        <button type="submit" class="w-full rounded-lg bg-zinc-100 px-4 py-2 font-medium text-zinc-900 hover:bg-white">Se connecter</button>
    </form>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
