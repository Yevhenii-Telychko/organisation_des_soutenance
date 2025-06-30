<?php

require_once 'Model.php';

class ModelExaminateur
{
    public static function getProjets($examinateur_id)
    {
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

    public static function getCreneaux($examinateur_id)
    {
        $db = Model::getInstance();
        $stmt = $db->prepare("
            SELECT * FROM infocreneaux
            WHERE examinateur_id = :examinateur_id
            ORDER BY creneau
        ");
        $stmt->execute(['examinateur_id' => $examinateur_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCreneauxPourProjet($examinateur_id, $projet_id)
    {
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

    public static function addCreneau($examinateur_id, $projet_id, $datime)
    {
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

        return $stmt->rowCount() > 0;
    }
}