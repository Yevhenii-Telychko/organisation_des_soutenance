<?php

require_once 'Model.php';

class ModelInnovation
{
    public static function getNombreProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

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

    public static function getRepartitionParGroupe()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

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

    public static function getTauxOccupationCreneaux()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

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

    public static function getEtudiantsSansProjet()
    {
        try {
            $db = Model::getInstance();
            $stmt = $db->prepare("SELECT id, nom, prenom FROM personne WHERE role_etudiant = 1 AND id NOT IN (SELECT etudiant FROM rdv) ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}