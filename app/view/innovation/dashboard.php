<?php include $root . '/app/view/fragment/head.html'; ?>
<?php include $root . '/app/view/fragment/menu.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Tableau de bord</h2>

    <?php if ($_SESSION['roles']['responsable'] == 1): ?>
        <div class="row mb-4 text-center">
            <div class="col-md-4">
                <div class="alert alert-primary shadow">
                    <strong>Nombre total de projets :</strong><br><?php echo $nb_projets; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning shadow">
                    <strong>Taux de réservation :</strong><br><?php echo $taux; ?>%
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 p-4">
            <h5>Répartition des projets par taille de groupe</h5>
            <canvas id="groupeChart"></canvas>
        </div>

        <div class="card shadow p-4">
            <h5>Étudiants sans projet</h5>
            <?php if (empty($etudiants_sans_projet)): ?>
                <div class="alert alert-success">Tous les étudiants ont un rendez-vous !</div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($etudiants_sans_projet as $etudiant): ?>
                        <li class="list-group-item"><?= $etudiant['prenom'] ?> <?= $etudiant['nom'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Vous n'avez pas les droits pour accéder à ce tableau de bord.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: <?= json_encode(array_column($repartition, 'groupe')) ?>,
        datasets: [{
            label: 'Nombre de projets',
            data: <?= json_encode(array_column($repartition, 'nb')) ?>,
            backgroundColor: ['#4caf50', '#2196f3', '#ff9800', '#9c27b0', '#f44336'],
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        },
    };

    new Chart(document.getElementById('groupeChart'), config);
</script>

<?php include $root . '/app/view/fragment/footer.html'; ?>
