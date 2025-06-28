<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>
<div class="container d-flex justify-content-center align-items-center mt-3 pb-4">
    <div class="card shadow p-4" style="min-width: 450px; ">
        <h3 class="text-center mb-4">Inscription</h3>
        <form method="post" action="router.php?action=examinateurSubmit">
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
</div>


<?php
include $root . '/app/view/fragment/footer.html';
?>
