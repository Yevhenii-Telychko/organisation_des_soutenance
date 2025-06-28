<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>
<div class="container mt-4">
    <div class="alert d-flex flex-column justify-content-center align-items-center alert-danger alert-dismissible fade show shadow" role="alert">
        <strong>Erreur :</strong> <?php echo $error; ?>
        <img src="<?= htmlspecialchars("../../../public/img/dog.gif") ?>" class="img-fluid rounded shadow" alt="Erreur image" />
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php
include $root . '/app/view/fragment/footer.html';
?>