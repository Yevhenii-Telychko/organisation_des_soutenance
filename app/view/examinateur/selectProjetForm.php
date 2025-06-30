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

    <form action="router.php?action=listeCreneauxPourProjetExaminateur" method="post">
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
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>