<?php

require_once 'Model.php';

class ModelResponsable
{
    public static function listeProjets()
    {
        $db = Model::getInstance();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['user_id'];
        $stmt = $db->prepare("SELECT * FROM projet WHERE responsable = :id");
        $stmt->execute(['id' => $id]);;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addProjet($label, $responsable, $groupe)
    {
        $db = Model::getInstance();

        $statement = $db->query("SELECT MAX(id) FROM projet");
        $tuple = $statement->fetch();
        $id = $tuple['0'];
        $id++;

        $stmt = $db->prepare("INSERT INTO projet (id, label, responsable, groupe) VALUES (:id, :label, :responsable, :groupe)");
        return $stmt->execute([
            ':id' => $id,
            ':label' => $label,
            ':responsable' => $responsable,
            ':groupe' => $groupe
        ]);
    }

    public static function listeExaminateurs()
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("SELECT * FROM personne WHERE role_examinateur = 1");
        $stmt->execute();;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addExaminateur($nom, $prenom)
    {
        $db = Model::getInstance();
        $statement = $db->query("SELECT MAX(id) FROM personne");
        $tuple = $statement->fetch();
        $id = $tuple['0'];
        $id++;

        $stmt = $db->prepare("INSERT INTO personne (id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password) VALUES (:id, :nom, :prenom, 0,1,0, :nom,' ')");
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':login' => $nom,
        ]);
    }

    public static function getProjetsDuResponsable($id_responsable)
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("SELECT id, label FROM projet WHERE responsable = :id");
        $stmt->execute(['id' => $id_responsable]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getExaminateursPourProjet($projet_id)
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("
        SELECT DISTINCT p.id, p.nom, p.prenom
        FROM creneau c
        JOIN personne p ON c.examinateur = p.id
        WHERE c.projet = :projet_id
    ");
        $stmt->execute(['projet_id' => $projet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRDVPourProjet($id_projet)
    {
        $db = Model::getInstance();

        $stmt = $db->prepare("SELECT * FROM infordv WHERE projet_id = :id_projet ORDER BY creneau");

        $stmt->execute(['id_projet' => $id_projet]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}