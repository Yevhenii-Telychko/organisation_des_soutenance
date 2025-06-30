<?php include $root . '/app/view/fragment/head.html'; ?>
<?php include $root . '/app/view/fragment/menu.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Liste des soutenances du projet</h2>
    <?php if (!empty($rdvs)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Label du projet</th>
                    <th>Examinateur</th>
                    <th>Creneau</th>
                    <th>Étudiant</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rdvs as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['projet_label']) ?></td>
                        <td><?= htmlspecialchars($rdv['examinateur_prenom']) ?> <?= htmlspecialchars($rdv['examinateur_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['creneau']) ?></td>
                        <td><?= htmlspecialchars($rdv['etudiant_prenom']) ?> <?= htmlspecialchars($rdv['etudiant_nom']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Aucun rendez-vous prévu pour ce projet.
        </div>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>
