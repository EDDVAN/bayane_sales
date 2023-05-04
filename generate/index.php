<?php
if ((!isset($_GET['id_recette'])  || $_GET['id_recette'] == "") && (!isset($_GET['user'])  || $_GET['user'] == "")) {
    header("Location: /bayane_sales/co_recette", TRUE, 301);
    exit();
}

define('ACCESSCHECK', TRUE);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

require_once 'vendor/autoload.php';

use Classes\GeneratePDF;

require_once 'database.php';

$database = new Database();
$db = $database->initConnection();


function get_clients($id_dossier, $data, $db)
{
    $query = 'SELECT c.nom,c.prenom,c.cin,c.adresse FROM sales_db.co_client c join sales_db.co_dossier_client d on d.id_client = c.id_client WHERE d.id_dossier = :idd;';
    $stmt = $db->prepare($query);
    $stmt->execute(['idd' => $id_dossier]);
    // $row_count = $stmt->rowCount();
    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data['nom_' . $i] = $nom;
        $data['prenom_' . $i] = $prenom;
        $data['cin_' . $i] = $cin;
        $data['adresse_' . $i] = $adresse;
        $i++;
    }
    return $data;
}

function get_recettes($id_vente, $data, $db)
{
    $query = 'SELECT num_av,montant,date_valeur FROM sales_db.co_recette WHERE id_vente = :idv;';
    $stmt = $db->prepare($query);
    $stmt->execute(['idv' => $id_vente]);
    // $row_count = $stmt->rowCount();
    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data['auth_' . $i] = $num_av;
        $data['date_val_' . $i] = $date_valeur;
        $data['montant_' . $i] = $montant;
        $i++;
    }
    return $data;
}

function print_recette($db)
{
    $id_recette = $_GET['id_recette'];
    $id_user = $_GET['user'];

    $query = 'SELECT * FROM sales_db.v_auth_vers WHERE id_recette = :idr;';
    $stmt = $db->prepare($query);
    $stmt->execute(['idr' => $id_recette]);
    $row_count = $stmt->rowCount();

    $query2 = 'SELECT name FROM sales_db.user WHERE id = :idu;';
    $stmt2 = $db->prepare($query2);
    $stmt2->execute(['idu' => $id_user]);
    $row_count2 = $stmt2->rowCount();

    if ($row_count > 0 && $row_count2 > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            if (empty($titre_foncier))
                $superficie = $superficie . ' (provisiore)';
            $data = [
                'auth_vers' => $id_vente * 1000 + $count,
                'rib' => $rib,
                'projet' => $projet,
                'produit' => $num_produit,
                'zone' => $zone,
                'tranche' => $id_tranche,
                'type' => $libelle,
                'localite' => $localite,
                'm_num' => number_format($montant, 2) . 'DH',
                'm_alpha' => $f->format($montant) . ' Dirhams',
                'date_em' => $date_av,
                'date_exp' => $date_limite,
                'titre_foncier' => $titre_foncier,
                'prix_vente' => number_format($prix_vente, 2) . 'DH',
                'superficie' => $superficie,
            ];
            $data = get_clients($id_dossier, $data, $db);
            $path = 'completed/' . (string)($id_vente * 1000 + $count) . '.pdf';
        }
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $data['auth_user'] = $name . ' le ' . date("Y-m-d h:i");
        }
    }
    $pdf = new GeneratePdf;
    $response = $pdf->generate($data, $path);

    $query = 'update sales_db.co_recette SET locked = 1 WHERE id_recette = :idr;';
    $stmt = $db->prepare($query);
    $stmt->execute(['idr' => $id_recette]);
    return $path;
}

function print_resume($db)
{
    $id_vente = $_GET['id_vente'];
    $id_user = $_GET['user'];

    $query = 'SELECT * FROM sales_db.v_resume WHERE id_vente = :idv;';
    $stmt = $db->prepare($query);
    $stmt->execute(['idv' => $id_vente]);
    $row_count = $stmt->rowCount();

    $query2 = 'SELECT name FROM sales_db.user WHERE id = :idu;';
    $stmt2 = $db->prepare($query2);
    $stmt2->execute(['idu' => $id_user]);
    $row_count2 = $stmt2->rowCount();

    if ($row_count > 0 && $row_count2 > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            if (empty($titre_foncier))
                $superficie = $superficie . ' (provisiore)';
            $data = [
                'projet' => $projet,
                'produit' => $num_produit,
                'zone' => $zone,
                'tranche' => $id_tranche,
                'type' => $libelle,
                'localite' => $localite,
                'titre_foncier' => $titre_foncier,
                'superficie' => $superficie,
                'etat' => $etat,
                'prix_vente' => number_format($prix_vente, 2) . 'DH',
                'date_vente' => $date_vente,
            ];
            $data = get_clients($id_dossier, $data, $db);
            $data = get_recettes($id_vente, $data, $db);
            $path = 'completed/res_' . (string)($id_vente * 1000) . date("Y-m-d h:i") . '.pdf';
        }
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $data['user'] = $name . ' le ' . date("Y-m-d h:i");
        }
    }
    $pdf = new GeneratePdf;
    $response = $pdf->resume($data, $path);
    return $path;
}




if (!empty($_GET['id_recette']) && !empty($_GET['user'])) {
    $path =  print_recette($db);
} else if (!empty($_GET['id_vente']) && !empty($_GET['user'])) {
    $path = print_resume($db);
}
// else {
//     header("Location: /bayane_sales/co_recette", TRUE, 301);
//     exit();
// }


header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));
header('Pragma: public');
flush();
readfile($path, true);
die();
// header("Location: /bayane_sales/co_recette", TRUE, 301);
// exit();
