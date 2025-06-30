<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container d-flex justify-content-center align-items-center mt-3 pb-4">
    <div class="card shadow p-4" style="min-width: 450px; ">
        <h3 class="text-center mb-4">Inscription</h3>
        <form method="post" action="router.php?action=register">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" maxlength="40" required>
                <div class="form-text">Maximum 40 caractères</div>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" maxlength="40" required>
                <div class="form-text">Maximum 40 caractères</div>
            </div>

            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" maxlength="20" required>
                <div class="form-text">Maximum 20 caractères</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" maxlength="20" required>
                <div class="form-text">Maximum 20 caractères</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Rôles (vous pouvez en sélectionner plusieurs)</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" id="role_etudiant" value="etudiant">
                    <label class="form-check-label" for="role_etudiant">Étudiant</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" id="role_examinateur" value="examinateur">
                    <label class="form-check-label" for="role_examinateur">Examinateur</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" id="role_responsable" value="responsable">
                    <label class="form-check-label" for="role_responsable">Responsable</label>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">S’inscrire</button>
            </div>
        </form>
    </div>
</div>


<?php include $root . '/app/view/fragment/footer.html'; ?>
