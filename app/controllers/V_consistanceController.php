<?php 
/**
 * V_consistance Page Controller
 * @category  Controller
 */
class V_consistanceController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_consistance";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("v_consistance.id_consistance", 
			"v_consistance.id_projet", 
			"co_projet.projet AS co_projet_projet", 
			"v_consistance.id_tranche", 
			"v_consistance.id_categorie", 
			"v_consistance.id_type", 
			"co_type_produit.libelle AS co_type_produit_libelle", 
			"v_consistance.superficie", 
			"v_consistance.par", 
			"user.name AS user_name", 
			"v_consistance.nombre", 
			"v_consistance.libre");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				v_consistance.id_consistance LIKE ? OR 
				v_consistance.id_projet LIKE ? OR 
				v_consistance.id_tranche LIKE ? OR 
				v_consistance.id_categorie LIKE ? OR 
				v_consistance.id_type LIKE ? OR 
				v_consistance.superficie LIKE ? OR 
				v_consistance.par LIKE ? OR 
				v_consistance.date LIKE ? OR 
				v_consistance.nombre LIKE ? OR 
				v_consistance.libre LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "v_consistance/search.php";
		}
		$db->join("co_projet", "v_consistance.id_projet = co_projet.id_projet", "INNER");
		$db->join("co_type_produit", "v_consistance.id_type = co_type_produit.id_type_produit", "INNER");
		$db->join("user", "v_consistance.par = user.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("v_consistance.id_consistance", ORDER_TYPE);
		}
		$db->where((empty($_GET['id_projet'])  ? "v_consistance.id_consistance > 0" : "v_consistance.id_projet=". $_GET['id_projet']));
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
				$record['superficie'] = approximate($record['superficie'],2);
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
		$page_title = $this->view->page_title = "Consistance";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("v_consistance/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
