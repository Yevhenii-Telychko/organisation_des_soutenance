<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

    <div class="container mt-4">
        <div class="p-4 bg-success text-white rounded">
            <h1>Organisation des soutenances</h1>
            <p>Inventaire de vos compétences...</p>
        </div>

        <h2 class="mt-3 mb-3 text-danger">Ajouter une liste de créneaux à un projet</h2>

        <form action="router.php?action=addManyCreneauxExaminateur" method="post">
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
            <div class="mb-3">
                <label for="date" class="form-label">Quel jour ?</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Quelle heure ?</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="mb-3">
                <label for="nb_creneaux" class="form-label">Nombre de créneaux (1-10)</label>
                <input type="number" class="form-control" id="nb_creneaux" name="nb_creneaux" min="1" max="10" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

<?php include $root . '/app/view/fragment/footer.html'; ?>