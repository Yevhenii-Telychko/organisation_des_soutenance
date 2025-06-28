<?php include $root . '/app/view/fragment/header.html'; ?>
<?php include $root . '/app/view/fragment/menu.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Sélectionner un projet</h2>
        <form method="post" action="router.php?action=listeExaminateursPourProjet" class="card p-4 shadow mx-auto" style="max-width: 500px;">
            <div class="mb-3">
                <label for="projet" class="form-label">Choisissez un projet :</label>
                <select name="projet_id" id="projet" class="form-select" required>
                    <option value="" disabled selected>-- Sélectionnez --</option>
                    <?php foreach ($projets as $projet): ?>
                        <option value="<?= htmlspecialchars($projet['id']) ?>">
                            <?= htmlspecialchars($projet['label']) ?>
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