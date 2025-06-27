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

    public static function supprimerRDVPourProjet($etudiant_id, $projet_id)
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("DELETE FROM rdv WHERE etudiant = :etudiant AND creneau IN (SELECT id FROM creneau WHERE projet = :projet)");
        return $stmt->execute([
            'etudiant' => $etudiant_id,
            'projet' => $projet_id
        ]);
    }


    public static function reserverRDV($etudiant_id, $creneau_id)
    {
        $db = Model::getInstance();

        $stmt = $db->prepare("SELECT projet FROM creneau WHERE id = :id");
        $stmt->execute(['id' => $creneau_id]);
        $projet_id = $stmt->fetchColumn();

        self::supprimerRDVPourProjet($etudiant_id, $projet_id);

        $statement = $db->query("SELECT MAX(id) FROM rdv");
        $tuple = $statement->fetch();
        $id = $tuple['0'];
        $id++;

        $stmt = $db->prepare("INSERT INTO rdv (id, creneau, etudiant) 
                          VALUES (:id, :creneau, :etudiant)");
        return $stmt->execute(['id' => $id, 'creneau' => $creneau_id, 'etudiant' => $etudiant_id]);
    }


}