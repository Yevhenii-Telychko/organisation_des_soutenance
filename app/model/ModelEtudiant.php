<?php
require_once 'Model.php';

class ModelEtudiant
{
    public static function getRDV()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $etudiant_id = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT * FROM infordv WHERE etudiant_id = :etudiant_id");
            $stmt->execute(['etudiant_id' => $etudiant_id]);

            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $etudiant_id = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT projet_id FROM infordv WHERE etudiant_id = :etudiant_id");
            $stmt->execute(['etudiant_id' => $etudiant_id]);

            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getCreneauxDisponibles($projets)
    {
        if (empty($projets)) return [];

        $placeholders = [];
        $params = [];
        foreach ($projets as $i => $id) {
            $ph = ":p$i";
            $placeholders[] = $ph;
            $params[$ph] = $id;
        }

        $inClause = implode(',', $placeholders);

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("
                SELECT * FROM infocreneaux 
                WHERE creneau_id NOT IN (SELECT creneau FROM rdv)
                  AND projet_id IN ($inClause)
            ");
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function setRDV($creneau_id)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_etudiant = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT projet FROM creneau WHERE id = :id");
            $stmt->execute(['id' => $creneau_id]);
            $projet_id = $stmt->fetchColumn();

            $stmt = $db->prepare("
                SELECT rdv.id 
                FROM rdv 
                JOIN creneau ON rdv.creneau = creneau.id 
                WHERE rdv.etudiant = :id_etudiant AND creneau.projet = :projet
            ");
            $stmt->execute([
                'id_etudiant' => $id_etudiant,
                'projet' => $projet_id
            ]);
            $rdv_id = $stmt->fetchColumn();

            if ($rdv_id) {
                $stmt = $db->prepare("UPDATE rdv SET creneau = :new_creneau WHERE id = :rdv_id");

                return $stmt->execute([
                    'new_creneau' => $creneau_id,
                    'rdv_id' => $rdv_id
                ]);
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }
}