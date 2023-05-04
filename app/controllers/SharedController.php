<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * co_consistance_id_projet_option_list Model Action
     * @return array
     */
	function co_consistance_id_projet_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_projet AS value , id_projet AS label FROM co_projet ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_consistance_id_type_option_list Model Action
     * @return array
     */
	function co_consistance_id_type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_type_produit AS value,libelle AS label FROM co_type_produit";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_dossier_client_id_dossier_option_list Model Action
     * @return array
     */
	function co_dossier_client_id_dossier_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT d.id_dossier AS value, CONCAT(GROUP_CONCAT(c.cin SEPARATOR '/ '),'_',d.id_dossier) AS label FROM co_dossier_client d join co_client c on d.id_client = c.id_client  where d.etat = 0 group by d.id_dossier ORDER BY label";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_dossier_client_id_client_option_list Model Action
     * @return array
     */
	function co_dossier_client_id_client_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_client AS value,cin AS label FROM co_client";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_produit_id_consistance_option_list Model Action
     * @return array
     */
	function co_produit_id_consistance_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_consistance AS value,id_consistance AS label FROM co_consistance";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_recette_rib_option_list Model Action
     * @return array
     */
	function co_recette_rib_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT rib AS value,rib AS label FROM co_projet";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_recette_num_av_default_value Model Action
     * @return Value
     */
	function co_recette_num_av_default_value(){
		$db = $this->GetModel();
		$sqltext = "select ".$_GET['id_vente']."*1000 + count(*)+1 as label from co_recette where id_vente =".$_GET['id_vente'].";";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * co_vendeur_produit_id_vendeur_option_list Model Action
     * @return array
     */
	function co_vendeur_produit_id_vendeur_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM user";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_vendeur_produit_id_produit_option_list Model Action
     * @return array
     */
	function co_vendeur_produit_id_produit_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_produit AS value,num_produit AS label FROM co_produit";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_vente_id_dossier_option_list Model Action
     * @return array
     */
	function co_vente_id_dossier_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT d.id_dossier AS value, CONCAT(GROUP_CONCAT(c.cin SEPARATOR '/ '),'_',d.id_dossier) AS label FROM co_dossier_client d join co_client c on d.id_client = c.id_client  where d.etat = 0 group by d.id_dossier ORDER BY label";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_vente_id_produit_option_list Model Action
     * @return array
     */
	function co_vente_id_produit_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_produit AS value,num_produit AS label FROM co_produit";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_versement_CIN_option_list Model Action
     * @return array
     */
	function co_versement_CIN_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT cin AS value,cin AS label FROM co_client c 
join co_dossier_client d on c.id_client = d.id_client
join co_vente v on v.id_dossier = d.id_dossier
join co_recette r on r.id_vente = v.id_vente where r.id_recette =". $_GET['id_recette'];;
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_versement_id_recette_option_list Model Action
     * @return array
     */
	function co_versement_id_recette_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_recette AS value , id_recette AS label FROM co_recette ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_versement_CIN_option_list_2 Model Action
     * @return array
     */
	function co_versement_CIN_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT cin AS value,cin AS label FROM co_client c 
join co_dossier_client d on c.id_client = d.id_client
join co_vente v on v.id_dossier = d.id_dossier
join co_recette r on r.id_vente = v.id_vente where r.id_recette =". $_GET['id_recette']; ;
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * co_versement_CIN_default_value Model Action
     * @return Value
     */
	function co_versement_CIN_default_value(){
		$db = $this->GetModel();
		$sqltext = "select c.cin from co_client c join co_dossier_client d on c.id_client = d.id_client
join co_vente v on v.id_dossier = d.id_dossier
join co_recette r on r.id_vente = v.id_vente where r.id_recette =". $_GET['id_recette']; ;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * co_versement_montant_default_value Model Action
     * @return Value
     */
	function co_versement_montant_default_value(){
		$db = $this->GetModel();
		$sqltext = "select montant from co_recette where id_recette =" . $_GET['id_recette'];
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * user_name_value_exist Model Action
     * @return array
     */
	function user_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("name", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_user_role_id_option_list Model Action
     * @return array
     */
	function user_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_user_role_id_option_list_2 Model Action
     * @return array
     */
	function user_user_role_id_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT role_id AS value , role_name AS label FROM roles ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_covente Model Action
     * @return Value
     */
	function getcount_covente(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM co_vente";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_coclient Model Action
     * @return Value
     */
	function getcount_coclient(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM co_client";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_coproduit Model Action
     * @return Value
     */
	function getcount_coproduit(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM co_produit";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_coprojet Model Action
     * @return Value
     */
	function getcount_coprojet(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM co_projet";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
