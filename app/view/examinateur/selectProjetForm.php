<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Sélectionner un projet</h2>

    <?php if (!empty($listeProjets)): ?>
        <form action="router.php?controller=examinateur&action=listeCreneauxPourProjetExaminateur" method="post" class="card p-4 shadow" style="max-width: 500px;">
            <div class="mb-3">
                <label for="projet_id" class="form-label">Projet</label>
                <select class="form-select" id="projet_id" name="projet_id" required>
                    <?php foreach ($listeProjets as $projet): ?>
                        <option value="<?php echo $projet['id']; ?>">
                            <?php echo $projet['label']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Valider</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Vous n’êtes affecté à aucun projet actuellement en tant qu'examinateur.
        </div>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>