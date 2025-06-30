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
                            if($_SESSION['roles']['responsable']){
                                echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Responsable</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="router.php?action=listeProjetsResponsable">Liste de mes projets</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=addProjetFormResponsable">Ajout d\'un projet</a></li>
                                        <hr/>
                                        <li><a class="dropdown-item" href="router.php?action=listeExaminateursResponsable">Liste des examinateurs</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=addExaminateurFormResponsable">Ajout d\'un examinateur</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=selectProjetFormResponsable">Liste des examinateur d\'un projet</a></li>
                                        <hr/>
                                        <li><a class="dropdown-item" href="router.php?action=listeRDVProjetFormResponsable">Planning d\'un projet</a></li>
                                    </ul>
                                </li>
                                ';
                            }
                            if($_SESSION['roles']['examinateur']){
                                echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="router.php?action=listeProjetsExaminateur">Liste des projets</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=listeCreneauxExaminateur">Liste complète de mes créneaux</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=selectProjetFormExaminateur">Liste de mes créneaux pour un projet</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=addCreneauFormExaminateur">Ajouter un créneau à un projet</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=addManyCreneauxFormExaminateur">Ajouter des créneaux consécutifs</a></li>
                                    </ul>
                                </li>
                                ';
                            }
                            if($_SESSION['roles']['etudiant']){
                                echo '
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Étudiant</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="router.php?action=listeRDVEtudiant">Liste des RDV</a></li>
                                        <li><a class="dropdown-item" href="router.php?action=prendreRDVFormEtudiant">Prendre un RDV pour un projet</a></li>
                                    </ul>
                                </li>
                                ';
                            }
                            echo '<li class="nav-item px-2"><a class="nav-link" href="router.php?action=deconnexion">Deconnexion</a></li></ul>';
                        }else{
                            echo '
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="router.php?action=loginForm">Se connecter</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link" href="router.php?action=registerForm">S’inscrire</a>
                                </li>
                            </ul>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>