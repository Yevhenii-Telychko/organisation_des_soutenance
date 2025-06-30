<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Liste des créneaux pour le projet <?php echo $listeCreneaux[0]['label'] ?></h2>

    <?php if (!empty($listeCreneaux)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Créneau</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listeCreneaux as $creneau): ?>
                    <tr>
                        <td><?php echo $creneau['creneau']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Aucun créneau disponible pour ce projet.
        </div>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>