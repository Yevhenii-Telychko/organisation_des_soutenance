<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Prendre un rendez-vous</h2>
    <form method="post" action="router.php?action=prendreRDVSubmit">
        <div class="mb-3">
            <label for="creneau_id" class="form-label">Sélectionnez un créneau</label>
            <select name="creneau_id" id="creneau_id" class="form-select" required>
                <?php foreach ($creneaux as $c): ?>
                    <option value="<?= $c['creneau_id'] ?>">
                        <?= htmlspecialchars($c['creneau']) ?> — Projet: <?= htmlspecialchars($c['label']) ?> — Examinateur: <?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Réserver</button>
        </div>
    </form>
</div>

<?php
include $root . '/app/view/fragment/footer.html';
?>