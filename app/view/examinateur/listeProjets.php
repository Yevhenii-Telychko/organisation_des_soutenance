<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Liste des projets de <?php echo $_SESSION['surname'] . " " . $_SESSION['name']; ?></h2>

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
                        <td><?php echo $projet['label']; ?></td>
                        <td><?php echo $projet['responsable_prenom'] . " " . $projet['responsable_nom']; ?></td>
                        <td><?php echo $projet['groupe']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Vous n’êtes affecté à aucun projet actuellement en tant qu'examinateur.
        </div>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>
