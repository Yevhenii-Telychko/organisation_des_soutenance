<header>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="router.php?action=mainView">TELYCHKO LASSASSEIGNE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                    if(!empty($_SESSION['user_id'])){
                        echo '<span>| '.$_SESSION['name'].' '.$_SESSION['surname'].' |</span><ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                        echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="router.php?controller=innovation&action=originalFunctionInnovation">Proposez une fonctionnalité originale</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=innovation&action=mvcFunctionInnovation">Proposez une amélioration du code MVC</a></li>
                                </ul>
                            </li>
                        ';

                        if($_SESSION['roles']['responsable']){
                            echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Responsable</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=listeProjetsResponsable">Liste de mes projets</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=addProjetFormResponsable">Ajout d\'un projet</a></li>
                                    <hr/>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=listeExaminateursResponsable">Liste des examinateurs</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=addExaminateurFormResponsable">Ajout d\'un examinateur</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=selectProjetFormResponsable">Liste des examinateur d\'un projet</a></li>
                                    <hr/>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=listeRDVProjetFormResponsable">Planning d\'un projet</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=responsable&action=dashboard">Dashboard</a></li>
                                </ul>
                            </li>
                            ';
                        }
                        if($_SESSION['roles']['examinateur']){
                            echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="router.php?controller=examinateur&action=listeProjetsExaminateur">Liste des projets</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=examinateur&action=listeCreneauxExaminateur">Liste complète de mes créneaux</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=examinateur&action=selectProjetFormExaminateur">Liste de mes créneaux pour un projet</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=examinateur&action=addCreneauFormExaminateur">Ajouter un créneau à un projet</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=examinateur&action=addManyCreneauxFormExaminateur">Ajouter des créneaux consécutifs</a></li>
                                </ul>
                            </li>
                            ';
                        }
                        if($_SESSION['roles']['etudiant']){
                            echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Étudiant</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="router.php?controller=etudiant&action=listeRDVEtudiant">Liste des RDV</a></li>
                                    <li><a class="dropdown-item" href="router.php?controller=etudiant&action=prendreRDVFormEtudiant">Prendre un RDV pour un projet</a></li>
                                </ul>
                            </li>
                            ';
                        }
                        echo '<li class="nav-item px-2"><a class="nav-link" href="router.php?controller=connexion&action=deconnexion">Deconnexion</a></li></ul>';
                    } else {
                        echo '
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item px-2">
                                <a class="nav-link" href="router.php?controller=connexion&action=loginForm">Se connecter</a>
                            </li>
                            <li class="nav-item px-2">
                                <a class="nav-link" href="router.php?controller=connexion&action=registerForm">S’inscrire</a>
                            </li>
                        </ul>
                        ';
                    }
                ?>
            </div>
        </div>
    </nav>
</header>