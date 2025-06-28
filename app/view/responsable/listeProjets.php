<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Mes projets</h2>
        <?php if (!empty($success_msg)): ?>
            <div class="alert success_msg alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($success_msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($listeProjets)): ?>
            <div class="table-responsive shadow">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-success">
                    <tr>
                        <th>Projet</th>
                        <th>Taille du groupe</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listeProjets as $projet): ?>
                        <tr>
                            <td><?= htmlspecialchars($projet['label']) ?></td>
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

<?php
include $root . '/app/view/fragment/footer.html';
?>