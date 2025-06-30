<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Ajout d'un projet</h2>

    <div class="card shadow p-4" style="max-width: 450px;">
        <form method="post" action="router.php?controller=responsable&action=addProjetResponsable">
            <div class="mb-3">
                <label for="label" class="form-label">Label du projet</label>
                <input type="text" class="form-control" id="label" name="label" placeholder="Label" maxlength="60" required>
                <div class="form-text">Maximum 40 caractères</div>
            </div>

            <div class="mb-3">
                <label for="groupe" class="form-label">Taille du groupe</label>
                <select class="form-select" id="groupe" name="groupe" required>
                    <option disabled selected value="">-- Choisir une taille --</option>
                    <option value="1">1 personne</option>
                    <option value="2">2 personnes</option>
                    <option value="3">3 personnes</option>
                    <option value="4">4 personnes</option>
                    <option value="5">5 personnes</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">S’inscrire</button>
            </div>
        </form>
    </div>
</div>


<?php include $root . '/app/view/fragment/footer.html'; ?>
