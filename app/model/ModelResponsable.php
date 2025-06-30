<?php

require_once 'Model.php';

class ModelResponsable
{
    public static function getProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT * FROM projet WHERE responsable = :responsable_id");
            $stmt->execute(['responsable_id' => $responsable_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function addProjet($label, $groupe)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->query("SELECT MAX(id) FROM projet");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result["MAX(id)"] + 1;

            $stmt = $db->prepare("
                INSERT INTO projet (id, label, responsable, groupe)
                VALUES (:id, :label, :responsable_id, :groupe)
            ");
            $stmt->execute([
                ':id' => $id,
                ':label' => $label,
                ':responsable_id' => $responsable_id,
                ':groupe' => $groupe
            ]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function listeExaminateurs()
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT * FROM personne WHERE role_examinateur = 1");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function addExaminateur($nom, $prenom)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->query("SELECT MAX(id) AS max_id FROM personne");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result['max_id'] + 1;

            $stmt = $db->prepare("
                INSERT INTO personne (
                    id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password
                ) VALUES (
                    :id, :nom, :prenom, 0, 1, 0, :login, 'secret'
                )
            ");

            return $stmt->execute([
                ':id' => $id,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':login' => strtolower($nom)
            ]);
        } catch (PDOException $e) {
            printf("<p>%s - %s</p>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getProjetsResponsable()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT id, label FROM projet WHERE responsable = :responsable_id");
            $stmt->execute(['responsable_id' => $responsable_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getExaminateursProjet($projet_id)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("
                SELECT DISTINCT p.id, p.nom, p.prenom
                FROM creneau c
                JOIN personne p ON c.examinateur = p.id
                WHERE c.projet = :projet_id
            ");
            $stmt->execute(['projet_id' => $projet_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getRDVProjet($id_projet)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT * FROM infordv WHERE projet_id = :id_projet ORDER BY creneau");
            $stmt->execute(['id_projet' => $id_projet]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getNombreProjets($responsable_id)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT COUNT(*) FROM projet WHERE responsable = :id");
            $stmt->execute(['id' => $responsable_id]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getRepartitionParGroupe($responsable_id)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("
        SELECT groupe, COUNT(*) AS nb 
        FROM projet 
        WHERE responsable = :id 
        GROUP BY groupe
    ");
            $stmt->execute(['id' => $responsable_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getTauxOccupationCreneaux($responsable_id)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("
        SELECT ROUND((SELECT COUNT(*) 
                      FROM rdv r 
                      JOIN creneau c ON r.creneau = c.id 
                      WHERE c.projet IN 
                          (SELECT id FROM projet WHERE responsable = :id)) 
                     * 100.0 / 
                     (SELECT COUNT(*) 
                      FROM creneau 
                      WHERE projet IN (SELECT id FROM projet WHERE responsable = :id)), 2) AS taux
    ");
            $stmt->execute(['id' => $responsable_id]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }

    public static function getEtudiantsSansRDV($responsable_id)
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("
        SELECT DISTINCT p.nom, p.prenom
        FROM personne p
        JOIN projet pr ON pr.groupe = p.id
        WHERE pr.responsable = :id
        AND p.id NOT IN (
            SELECT etudiant FROM rdv
        )
    ");
            $stmt->execute(['id' => $responsable_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());

            return NULL;
        }
    }
}