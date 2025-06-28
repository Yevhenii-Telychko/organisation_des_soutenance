<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>
<div class="container d-flex justify-content-center align-items-center mt-3 pb-4">
    <div class="card shadow p-4" style="min-width: 450px; ">
        <h3 class="text-center mb-4">Inscription</h3>
        <form method="post" action="router.php?action=projetSubmit">
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


<?php
include $root . '/app/view/fragment/footer.html';
?>
