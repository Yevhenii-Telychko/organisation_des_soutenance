<?php
require($root . '/app/view/fragment/header.html');
?>

<?php
include $root . '/app/view/fragment/menu.php';
?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Des examinateurs</h2>
        <?php if (!empty($success_msg)): ?>
            <div class="alert success_msg alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($success_msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($listeExaminateurs)): ?>
            <div class="table-responsive shadow">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-success">
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listeExaminateurs as $examinateur): ?>
                        <tr>
                            <td><?= htmlspecialchars($examinateur['nom']) ?></td>
                            <td><?= htmlspecialchars($examinateur['prenom']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert">
                Il n'y a pas de examinateurs pour le moment.
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