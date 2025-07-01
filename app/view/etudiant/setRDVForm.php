<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Modifier un rendez-vous</h2>

    <?php if (empty($creneaux)): ?>
        <div class="alert alert-warning" role="alert">
            Aucun créneau disponible pour vos projets.
        </div>
    <?php else: ?>
        <form method="post" action="router.php?controller=etudiant&action=prendreRDVEtudiant" class="card p-4 shadow" style="max-width: 500px;">
            <div class="mb-3">
                <label for="creneauSelect" class="form-label">Choisissez un créneau disponible</label>
                <select class="form-select" id="creneauSelect" name="creneau_id" required>
                    <option disabled selected>-- Sélectionner un créneau --</option>
                    <?php foreach ($creneaux as $creneau): ?>
                        <option value="<?php echo $creneau['creneau_id']; ?>">
                            <?php echo $creneau['label']; ?> |
                            <?php echo $creneau['creneau']; ?> |
                            Examinateur: <?php echo $creneau['nom'] . ' ' . $creneau['prenom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Valider le rendez-vous</button>
        </form>
    <?php endif; ?>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>