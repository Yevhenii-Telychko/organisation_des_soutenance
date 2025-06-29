<?php include $root . '/app/view/fragment/header.html'; ?>
<?php include $root . '/app/view/fragment/menu.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Mes projets</h2>

    <?php if (!empty($listeProjets)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Nom du projet</th>
                    <th>Responsable</th>
                    <th>Taille du groupe</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listeProjets as $projet): ?>
                    <tr>
                        <td><?= htmlspecialchars($projet['label']) ?></td>
                        <td><?= htmlspecialchars($projet['responsable_prenom']) ?> <?= htmlspecialchars($projet['responsable_nom']) ?></td>
                        <td><?= htmlspecialchars($projet['groupe']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Vous n’êtes affecté à aucun projet actuellement.
        </div>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>
