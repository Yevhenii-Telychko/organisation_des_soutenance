<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Liste des examinateurs d'un projet</h2>

    <form method="post" action="router.php?action=listeExaminateursProjetResponsable" class="card p-4 shadow" style="max-width: 500px;">
        <div class="mb-3">
            <label for="projet" class="form-label">Choisissez un projet :</label>
            <select name="projet_id" id="projet" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez --</option>
                <?php foreach ($projets as $projet): ?>
                    <option value="<?php echo $projet['id']; ?>">
                        <?php echo $projet['label']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Afficher les examinateurs</button>
        </div>
    </form>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>