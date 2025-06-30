<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Ajout d'un examinateur</h2>

    <form method="post" action="router.php?action=addExaminateurResponsable" class="card p-4 shadow" style="max-width: 500px;">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" maxlength="40" required>
            <div class="form-text">Maximum 40 caractères</div>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" maxlength="40" required>
            <div class="form-text">Maximum 40 caractères</div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">S’inscrire</button>
        </div>
    </form>
</div>


<?php
include $root . '/app/view/fragment/footer.html';
?>
