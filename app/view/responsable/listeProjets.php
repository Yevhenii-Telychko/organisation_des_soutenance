<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Liste des projets de <?php echo $_SESSION['surname'] . " " . $_SESSION['name']; ?></h2>

    <?php if (!empty($success_msg)): ?>
        <div class="alert success_msg alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($listeProjets)): ?>
        <div class="table-responsive shadow">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-success">
                <tr>
                    <th>Label</th>
                    <th>Responsable</th>
                    <th>Taille du groupe</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listeProjets as $projet): ?>
                    <tr>
                        <td><?= htmlspecialchars($projet['label']) ?></td>
                        <td><?php echo $_SESSION['name'] . " " . $_SESSION['surname'] ?></td>
                        <td><?= htmlspecialchars($projet['groupe']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Vous n’avez aucun projet pour le moment.
        </div>
    <?php endif; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alerts = document.querySelectorAll('.success_msg');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }, 2000);
        });
    });
</script>

<?php include $root . '/app/view/fragment/footer.html'; ?>