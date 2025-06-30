<?php
require_once 'Model.php';

class ModelExaminateur
{
    public static function getProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $examinateur_id = $_SESSION['user_id'];

        $db = Model::getInstance();
        $stmt = $db->prepare("
            SELECT DISTINCT
                projet.id,
                projet.label,
                projet.groupe,
                resp.nom AS responsable_nom,
                resp.prenom AS responsable_prenom
            FROM projet
            JOIN creneau ON creneau.projet = projet.id
            JOIN personne resp ON projet.responsable = resp.id
            WHERE creneau.examinateur = :examinateur_id
            ORDER BY projet.label
        ");
        $stmt->execute(['examinateur_id' => $examinateur_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCreneaux()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $examinateur_id = $_SESSION['user_id'];

        $db = Model::getInstance();
        $stmt = $db->prepare("
            SELECT * FROM infocreneaux
            WHERE examinateur_id = :examinateur_id
            ORDER BY creneau
        ");
        $stmt->execute(['examinateur_id' => $examinateur_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCreneauxPourProjet($projet_id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $examinateur_id = $_SESSION['user_id'];

        $db = Model::getInstance();
        $stmt = $db->prepare("
            SELECT *
            FROM infocreneaux
            WHERE examinateur_id = :examinateur_id AND projet_id = :projet_id
            ORDER BY creneau
        ");
        $stmt->execute([
            'examinateur_id' => $examinateur_id,
            'projet_id' => $projet_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addCreneau($projet_id, $datime)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $examinateur_id = $_SESSION['user_id'];

        $db = Model::getInstance();
        $stmt = $db->query("SELECT MAX(id) FROM creneau");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result["MAX(id)"] + 1;

        $stmt = $db->prepare("
            INSERT INTO creneau (id, projet, examinateur, creneau)
            VALUES (:id, :projet_id, :examinateur_id, :datetime)
        ");
        $stmt->execute([
            'id' => $id,
            'projet_id' => $projet_id,
            'examinateur_id' => $examinateur_id,
            'datetime' => $datime
        ]);

        return $stmt->rowCount();
    }

    public static function addManyCreneaux($projet_id, $start_datetime, $nb_creneaux)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $examinateur_id = $_SESSION['user_id'];

        $db = Model::getInstance();
        $stmt = $db->query("SELECT MAX(id) FROM creneau");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result["MAX(id)"] + 1;

        $stmt = $db->prepare("
            INSERT INTO creneau (id, projet, examinateur, creneau)
            VALUES (:id, :projet_id, :examinateur_id, :datetime)
        ");

        $datetime = new DateTime($start_datetime);

        for ($i = 0; $i < $nb_creneaux; $i++) {
            $id++;
            $stmt->execute([
                'id' => $id,
                'projet_id' => $projet_id,
                'examinateur_id' => $examinateur_id,
                'datetime' => $datetime->format('Y-m-d H:i:s')
            ]);

            $datetime->modify('+1 hour');
        }

        return $stmt->rowCount();
    }
}