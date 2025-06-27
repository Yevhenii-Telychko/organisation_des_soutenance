<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow p-4" style="min-width: 350px; max-width: 400px;">
        <h3 class="text-center mb-4">Connexion</h3>
        <form method="post" action="router.php?action=login">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre login"
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"
                       required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Se connecter</button>
            </div>
        </form>
    </div>

</div>

<?php
include $root . '/app/view/fragment/footer.html';
?>

