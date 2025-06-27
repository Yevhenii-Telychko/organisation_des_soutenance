<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>
<div class="container mt-4">
    <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
        <strong>Erreur :</strong> <?php echo $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php
include $root . '/app/view/fragment/footer.html';
?>