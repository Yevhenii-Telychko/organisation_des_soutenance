<?php include 'fragment/head.html'; ?>
<body>
<?php include 'fragment/menu.php'; ?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>
    <?php if (!empty($_SESSION['user_id'])): ?>
        <h2 class="mt-3 mb-3">Bienvenue <?php echo $_SESSION['surname'] . " " . $_SESSION['name']; ?> !</h2>
        <p>Voici vo(s) rôle(s) :</p>
        <ul>
            <?php
                $keys = array_keys($_SESSION['roles']);

                for ($i = 0; $i < count($_SESSION['roles']); $i++) {
                    if ($_SESSION['roles'][$keys[$i]] === 1) {
                        echo "<li>" .  ucfirst($keys[$i]) . "</li>";
                    }
                }
            ?>
        </ul>
    <?php else: ?>
        <h2 class="mt-3 mb-3">Bienvenue ! Vous n'êtes pas encore connecté.</h2>
    <?php endif; ?>
</div>

<?php include 'fragment/footer.html'; ?>
</body>
</html>