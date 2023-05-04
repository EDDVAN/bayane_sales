<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="material-icons ">home</i>'
		),
		
		array(
			'path' => 'co_projet', 
			'label' => 'Projet', 
			'icon' => ''
		),
		
		array(
			'path' => 'co_produit', 
			'label' => 'Produit', 
			'icon' => ''
		),
		
		array(
			'path' => '', 
			'label' => 'Client', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'co_dossier_client', 
			'label' => 'Dossier Client', 
			'icon' => ''
		),
		
		array(
			'path' => 'co_client', 
			'label' => 'Client', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'co_vente', 
			'label' => 'Vente', 
			'icon' => ''
		),
		
		array(
			'path' => '', 
			'label' => 'Parametrage', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'co_type_produit', 
			'label' => 'Type Produit', 
			'icon' => ''
		),
		
		array(
			'path' => 'co_vente_trace', 
			'label' => 'Vente Trace', 
			'icon' => ''
		),
		
		array(
			'path' => 'user', 
			'label' => 'Users', 
			'icon' => ''
		),
		
		array(
			'path' => 'co_vendeur_produit', 
			'label' => 'Vendeur Produit', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'plan', 
			'label' => 'Map', 
			'icon' => ''
		)
	);
		
	
	
			public static $id_tranche = array(
		array(
			"value" => "0", 
			"label" => "TR1", 
		),
		array(
			"value" => "1", 
			"label" => "TR2", 
		),
		array(
			"value" => "2", 
			"label" => "TR3", 
		),
		array(
			"value" => "3", 
			"label" => "TR4", 
		),);
		
			public static $id_categorie = array(
		array(
			"value" => "0", 
			"label" => "CAT1", 
		),
		array(
			"value" => "1", 
			"label" => "CAT2", 
		),
		array(
			"value" => "2", 
			"label" => "CAT3", 
		),
		array(
			"value" => "3", 
			"label" => "CAT4", 
		),);
		
			public static $id_statut = array(
		array(
			"value" => "0", 
			"label" => "En Cours", 
		),
		array(
			"value" => "1", 
			"label" => "Achevé", 
		),
		array(
			"value" => "2", 
			"label" => "Titré", 
		),);
		
			public static $credit = array(
		array(
			"value" => "0", 
			"label" => "Non", 
		),
		array(
			"value" => "1", 
			"label" => "Oui", 
		),);
		
}