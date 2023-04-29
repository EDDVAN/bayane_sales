<?php 
/**
 * Testv Page Controller
 * @category  Controller
 */
class TestvController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "testv";
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
		$fields = array("id_vente", 
			"id_dossier", 
			"id_produit", 
			"date", 
			"promotion", 
			"prix_vente", 
			"condition_vente", 
			"statut", 
			"notaire", 
			"credit", 
			"accord", 
			"datecre", 
			"par", 
			"id_adm", 
			"date_adm", 
			"observation", 
			"id_vendeur", 
			"count");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				testv.id_vente LIKE ? OR 
				testv.id_dossier LIKE ? OR 
				testv.id_produit LIKE ? OR 
				testv.date LIKE ? OR 
				testv.promotion LIKE ? OR 
				testv.prix_vente LIKE ? OR 
				testv.condition_vente LIKE ? OR 
				testv.statut LIKE ? OR 
				testv.notaire LIKE ? OR 
				testv.credit LIKE ? OR 
				testv.accord LIKE ? OR 
				testv.datecre LIKE ? OR 
				testv.par LIKE ? OR 
				testv.id_adm LIKE ? OR 
				testv.date_adm LIKE ? OR 
				testv.observation LIKE ? OR 
				testv.id_vendeur LIKE ? OR 
				testv.count LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "testv/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("testv.id_vente", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Testv";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("testv/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
