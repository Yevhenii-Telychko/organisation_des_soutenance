<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger"><?php $rdvs ? "Liste des RDV du projet " . $rdvs[0]['projet_label'] : "" ?></h2>

    <?php if (!empty($rdvs)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Examinateur</th>
                    <th>Creneau</th>
                    <th>Étudiant</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rdvs as $rdv): ?>
                    <tr>
                        <td><?php echo $rdv['examinateur_prenom']; ?> <?php echo $rdv['examinateur_nom']; ?></td>
                        <td><?php echo $rdv['creneau']; ?></td>
                        <td><?php echo $rdv['etudiant_prenom']; ?> <?php echo $rdv['etudiant_nom']; ?></td>
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
