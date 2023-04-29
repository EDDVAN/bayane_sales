<?php 
/**
 * V_vente Page Controller
 * @category  Controller
 */
class V_venteController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_vente";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function reserve($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("v_vente.id_vente", 
			"co_vente.id_vente AS co_vente_id_vente", 
			"v_vente.num_produit", 
			"v_vente.id_consistance", 
			"co_consistance.id_consistance AS co_consistance_id_consistance", 
			"v_vente.id_dossier", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_client.nom AS co_client_nom", 
			"co_client.prenom AS co_client_prenom", 
			"co_client.cin AS co_client_cin", 
			"v_vente.statut", 
			"v_vente.date", 
			"v_vente.prix_vente", 
			"v_vente.notaire", 
			"v_vente.credit", 
			"v_vente.accord", 
			"v_vente.superficie", 
			"v_vente.recettes", 
			"v_vente.versement", 
			"v_vente.id_adm", 
			"v_vente.date_adm", 
			"v_vente.observation");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_vente.id_vente LIKE ? OR 
				v_vente.num_produit LIKE ? OR 
				v_vente.id_consistance LIKE ? OR 
				v_vente.id_dossier LIKE ? OR 
				co_client.nom LIKE ? OR 
				co_client.prenom LIKE ? OR 
				co_client.cin LIKE ? OR 
				v_vente.statut LIKE ? OR 
				v_vente.date LIKE ? OR 
				v_vente.prix_vente LIKE ? OR 
				v_vente.notaire LIKE ? OR 
				v_vente.credit LIKE ? OR 
				v_vente.accord LIKE ? OR 
				v_vente.superficie LIKE ? OR 
				v_vente.recettes LIKE ? OR 
				v_vente.versement LIKE ? OR 
				v_vente.id_adm LIKE ? OR 
				v_vente.date_adm LIKE ? OR 
				v_vente.observation LIKE ? OR 
				co_dossier_client.id_dossier LIKE ? OR 
				co_dossier_client.id_client LIKE ? OR 
				co_dossier_client.part_client LIKE ? OR 
				co_client.id_client LIKE ? OR 
				co_client.mobile LIKE ? OR 
				co_client.email LIKE ? OR 
				co_client.adresse LIKE ? OR 
				co_client.date_naissance LIKE ? OR 
				co_client.adresse2 LIKE ? OR 
				co_client.telephone LIKE ? OR 
				co_client.associer LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_vente/search.php";
		}
		$db->join("co_vente", "v_vente.id_vente = co_vente.id_vente", "INNER");
		$db->join("co_consistance", "v_vente.id_consistance = co_consistance.id_consistance", "INNER");
		$db->join("co_dossier_client", "v_vente.id_dossier = co_dossier_client.id_dossier", "INNER");
		$db->join("co_client", "co_dossier_client.id_client = co_client.id_client", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_vente.id_vente", ORDER_TYPE);
		}
		$db->where(!empty($_GET['id_consistance']) ? "v_vente.statut='provisoire' AND v_vente.id_consistance=".$_GET['id_consistance'] : "v_vente.statut='provisoire'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['prix_vente'] = approximate($record['prix_vente'],2);
$record['superficie'] = approximate($record['superficie'],2);
$record['recettes'] = approximate($record['recettes'],2);
$record['versement'] = approximate($record['versement'],2);
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "V Vente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_vente/reserve.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function vendu($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("v_vente.id_vente", 
			"co_vente.id_vente AS co_vente_id_vente", 
			"v_vente.num_produit", 
			"v_vente.id_consistance", 
			"co_consistance.id_consistance AS co_consistance_id_consistance", 
			"v_vente.id_dossier", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_client.nom AS co_client_nom", 
			"co_client.prenom AS co_client_prenom", 
			"co_client.cin AS co_client_cin", 
			"v_vente.date", 
			"v_vente.prix_vente", 
			"v_vente.notaire", 
			"v_vente.credit", 
			"v_vente.accord", 
			"v_vente.superficie", 
			"v_vente.recettes", 
			"v_vente.versement", 
			"v_vente.id_adm", 
			"v_vente.date_adm", 
			"v_vente.observation");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_vente.id_vente LIKE ? OR 
				v_vente.num_produit LIKE ? OR 
				v_vente.id_consistance LIKE ? OR 
				v_vente.id_dossier LIKE ? OR 
				co_client.nom LIKE ? OR 
				co_client.prenom LIKE ? OR 
				co_client.cin LIKE ? OR 
				v_vente.statut LIKE ? OR 
				v_vente.date LIKE ? OR 
				v_vente.prix_vente LIKE ? OR 
				v_vente.notaire LIKE ? OR 
				v_vente.credit LIKE ? OR 
				v_vente.accord LIKE ? OR 
				v_vente.superficie LIKE ? OR 
				v_vente.recettes LIKE ? OR 
				v_vente.versement LIKE ? OR 
				v_vente.id_adm LIKE ? OR 
				v_vente.date_adm LIKE ? OR 
				v_vente.observation LIKE ? OR 
				co_dossier_client.id_dossier LIKE ? OR 
				co_dossier_client.id_client LIKE ? OR 
				co_dossier_client.part_client LIKE ? OR 
				co_client.id_client LIKE ? OR 
				co_client.mobile LIKE ? OR 
				co_client.email LIKE ? OR 
				co_client.adresse LIKE ? OR 
				co_client.date_naissance LIKE ? OR 
				co_client.adresse2 LIKE ? OR 
				co_client.telephone LIKE ? OR 
				co_client.associer LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_vente/search.php";
		}
		$db->join("co_vente", "v_vente.id_vente = co_vente.id_vente", "INNER");
		$db->join("co_consistance", "v_vente.id_consistance = co_consistance.id_consistance", "INNER");
		$db->join("co_dossier_client", "v_vente.id_dossier = co_dossier_client.id_dossier", "INNER");
		$db->join("co_client", "co_dossier_client.id_client = co_client.id_client", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_vente.id_vente", ORDER_TYPE);
		}
		$db->where(!empty($_GET['id_consistance']) ? "v_vente.statut='definitive' AND v_vente.id_consistance=".$_GET['id_consistance'] : "v_vente.statut='definitive'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['prix_vente'] = approximate($record['prix_vente'],2);
$record['superficie'] = approximate($record['superficie'],2);
$record['recettes'] = approximate($record['recettes'],2);
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "V Vente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_vente/vendu.php", $data); //render the full page
	}
}
