<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Modifier un rendez-vous</h4>
        </div>
        <div class="card-body">
            <?php if (empty($creneaux)): ?>
                <div class="alert alert-warning" role="alert">
                    Aucun créneau disponible pour vos projets.
                </div>
            <?php else: ?>
                <form method="post" action="router.php?action=prendreRDVSubmit">
                    <div class="mb-3">
                        <label for="creneauSelect" class="form-label">Choisissez un créneau disponible</label>
                        <select class="form-select" id="creneauSelect" name="creneau_id" required>
                            <option disabled selected>-- Sélectionner un créneau --</option>
                            <?php foreach ($creneaux as $creneau): ?>
                                <option value="<?= htmlspecialchars($creneau['creneau_id']) ?>">
                                    <?= htmlspecialchars($creneau['label']) ?> |
                                    <?= htmlspecialchars($creneau['creneau']) ?> |
                                    Examinateur: <?= htmlspecialchars($creneau['nom'] . ' ' . $creneau['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Valider le rendez-vous</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include $root . '/app/view/fragment/footer.html';
?>