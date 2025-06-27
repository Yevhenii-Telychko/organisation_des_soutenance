<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Mes rendez-vous de soutenance</h2>

    <?php if (!empty($listeRDV)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Projet</th>
                    <th>Examinateur</th>
                    <th>Créneau</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listeRDV as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv['projet_label']) ?></td>
                        <td><?= htmlspecialchars($rdv['examinateur_prenom'] . ' ' . $rdv['examinateur_nom']) ?></td>
                        <td><?= htmlspecialchars($rdv['creneau']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Vous n’avez aucun rendez-vous planifié pour le moment.
        </div>
    <?php endif; ?>
</div>

<?php
include $root . '/app/view/fragment/footer.html';
?>