<?php

require_once 'Model.php';

class ModelEtudiant
{
    public static function getListeRDV()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['user_id'];

        try {
            $database = Model::getInstance();
            $stmt = $database->prepare("SELECT * FROM infordv WHERE etudiant_id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getProjetsPourEtudiant($etudiant_id)
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("SELECT projet_id FROM infordv WHERE etudiant_id = :id");
        $stmt->execute(['id' => $etudiant_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getCreneauxDisponibles($projets)
    {
        $db = Model::getInstance();

        if (empty($projets)) return [];
        $placeholders = [];
        $params = [];
        foreach ($projets as $i => $id) {
            $ph = ":p$i";
            $placeholders[] = $ph;
            $params[$ph] = $id;
        }

        $inClause = implode(',', $placeholders);

        $stmt = $db->prepare("
        SELECT * FROM infocreneaux 
        WHERE creneau_id NOT IN (SELECT creneau FROM rdv)
          AND projet_id IN ($inClause)
    ");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function reserverRDV($etudiant_id, $creneau_id)
    {
        $db = Model::getInstance();


        $stmt = $db->prepare("SELECT projet FROM creneau WHERE id = :id");
        $stmt->execute(['id' => $creneau_id]);
        $projet_id = $stmt->fetchColumn();


        $stmt = $db->prepare("
        SELECT rdv.id 
        FROM rdv 
        JOIN creneau ON rdv.creneau = creneau.id 
        WHERE rdv.etudiant = :etudiant AND creneau.projet = :projet
    ");
        $stmt->execute([
            'etudiant' => $etudiant_id,
            'projet' => $projet_id
        ]);
        $rdv_id = $stmt->fetchColumn();

        if ($rdv_id) {
            $stmt = $db->prepare("UPDATE rdv SET creneau = :new_creneau WHERE id = :rdv_id");
            return $stmt->execute([
                'new_creneau' => $creneau_id,
                'rdv_id' => $rdv_id
            ]);
        }
    }


}