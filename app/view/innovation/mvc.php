<?php
require($root . '/app/view/fragment/head.html');
include $root . '/app/view/fragment/menu.php';
?>

<div class="container mt-4">
    <div class="p-4 bg-success text-white rounded">
        <h1>Organisation des soutenances</h1>
        <p>Inventaire de vos compétences...</p>
    </div>

    <h2 class="mt-3 mb-3 text-danger">Router dynamique avec un autoload</h2>

    <p>Ce projet utilise un système de routage dynamique avec autoload pour charger les contrôleurs et les modèles nécessaires.</p>
    <p>Nous avons remplacé l'ancien routeur par quelque chose d'automatique, qui récupère directement l'ensemble des controllers avec les méthodes définies, tout en gérant les potentielles erreurs.</p>
    <p>Les avantages de ce nouveau routeur sont :</p>
    <ul>
        <li>De rendre le projet modulaire</li>
        <li>D'éviter les erreurs</li>
        <li>De gagner du temps</li>
    </ul>
    <p>Dans un premier temps, le fichier <code>autoload.php</code> va récupérer automatiquement nos Controllers et nos Models grâce aux chemins que nous avons définis. Puis, dans un second temps, le fichier <code>router.php</code> va récupérer les arguments GET et créer les routes tout en s'assurant qu'elles existent bien.</p>
    <br />
    <hr />
    <br />
    <p>Nous avons utilisé le <code>router.php</code> comme router principal avec cette nouvelle implémentation, et nous avons laissé le fichier <code>router2.php</code> pour l'ancien modèle.</p>
</div>

<?php include $root . '/app/view/fragment/footer.html'; ?>