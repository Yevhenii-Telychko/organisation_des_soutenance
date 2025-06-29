<?php

require_once 'Model.php';

class ModelExaminateur
{
    public static function getProjetsPourExaminateur($examinateur_id)
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
        WHERE creneau.examinateur = :id
        ORDER BY projet.label
    ");
        $stmt->execute(['id' => $examinateur_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMesRDV($examinateur_id)
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


}