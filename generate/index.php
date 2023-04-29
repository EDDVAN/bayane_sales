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

        $data = [
            'auth_vers' => $id_vente * 1000 + $count,
            'rib' => $rib,
            'cin' => $cin,
            'nom' => $nom,
            'prenom' => $prenom,
            'projet' => $projet,
            'adresse' => $adresse,
            'produit' => $num_produit,
            'zone' => $zone,
            'tranche' => $id_tranche,
            'type' => $libelle,
            'localite' => $localite,
            'm_num' => number_format($montant, 2) . 'DH',
            'm_alpha' => $f->format($montant) . ' Dirhams',
            'date_em' => $date_av,
            'date_exp' => $date_limite,
            'auth_user' => 'holder',
        ];
        $path = 'completed/' . (string)($id_vente * 1000 + $count) . '.pdf';
    }
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data['auth_user'] = $name;
    }
}
$pdf = new GeneratePdf;
$response = $pdf->generate($data, $path);

$query = 'update sales_db.co_recette SET locked = 1 WHERE id_recette = :idr;';
$stmt = $db->prepare($query);
$stmt->execute(['idr' => $id_recette]);

header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));
header('Pragma: public');
flush();
readfile($path, true);
die();
// header("Location: /bayane_sales/co_recette", TRUE, 301);
// exit();
