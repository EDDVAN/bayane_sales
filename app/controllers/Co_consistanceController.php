<?php 
/**
 * Co_consistance Page Controller
 * @category  Controller
 */
class Co_consistanceController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "co_consistance";
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
		$fields = array("co_consistance.id_consistance", 
			"co_consistance.id_projet", 
			"co_projet.id_projet AS co_projet_id_projet", 
			"co_consistance.id_tranche", 
			"co_consistance.id_categorie", 
			"co_consistance.id_type", 
			"co_type_produit.libelle AS co_type_produit_libelle", 
			"co_consistance.nombre", 
			"co_consistance.superficie");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				co_consistance.id_consistance LIKE ? OR 
				co_consistance.id_projet LIKE ? OR 
				co_consistance.id_tranche LIKE ? OR 
				co_consistance.id_categorie LIKE ? OR 
				co_consistance.id_type LIKE ? OR 
				co_consistance.nombre LIKE ? OR 
				co_consistance.superficie LIKE ? OR 
				co_consistance.par LIKE ? OR 
				co_consistance.date LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "co_consistance/search.php";
		}
		$db->join("co_projet", "co_consistance.id_projet = co_projet.id_projet", "INNER");
		$db->join("co_type_produit", "co_consistance.id_type = co_type_produit.id_type_produit", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("co_consistance.id_consistance", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Consistances";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("co_consistance/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("co_consistance.id_consistance", 
			"co_consistance.id_projet", 
			"co_projet.projet AS co_projet_projet", 
			"co_consistance.id_tranche", 
			"co_consistance.id_categorie", 
			"co_consistance.id_type", 
			"co_type_produit.libelle AS co_type_produit_libelle", 
			"co_consistance.nombre", 
			"co_consistance.superficie", 
			"co_consistance.par", 
			"user.name AS user_name", 
			"co_consistance.date");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("co_consistance.id_consistance", $rec_id);; //select record based on primary key
		}
		$db->join("co_projet", "co_consistance.id_projet = co_projet.id_projet", "INNER");
		$db->join("co_type_produit", "co_consistance.id_type = co_type_produit.id_type_produit", "INNER");
		$db->join("user", "co_consistance.par = user.id", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['superficie'] = approximate($record['superficie'],2);
			$page_title = $this->view->page_title = "View Consistances";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("co_consistance/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_projet","id_tranche","id_categorie","id_type","nombre","par","date");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_projet' => 'required',
				'id_tranche' => 'required',
				'id_categorie' => 'required',
				'id_type' => 'required',
				'nombre' => 'required|numeric',
				'date' => 'required',
			);
			$this->sanitize_array = array(
				'id_projet' => 'sanitize_string',
				'id_tranche' => 'sanitize_string',
				'id_categorie' => 'sanitize_string',
				'id_type' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'date' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['par'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("co_consistance");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Co Consistance";
		$this->render_view("co_consistance/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_consistance","id_projet","id_tranche","id_categorie","id_type","nombre","par","date");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_projet' => 'required',
				'id_tranche' => 'required',
				'id_categorie' => 'required',
				'id_type' => 'required',
				'nombre' => 'required|numeric',
				'date' => 'required',
			);
			$this->sanitize_array = array(
				'id_projet' => 'sanitize_string',
				'id_tranche' => 'sanitize_string',
				'id_categorie' => 'sanitize_string',
				'id_type' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'date' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['par'] = USER_ID;
			if($this->validated()){
				$db->where("co_consistance.id_consistance", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("co_consistance");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("co_consistance");
					}
				}
			}
		}
		$db->where("co_consistance.id_consistance", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Co Consistance";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("co_consistance/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_consistance","id_projet","id_tranche","id_categorie","id_type","nombre","par","date");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_projet' => 'required',
				'id_tranche' => 'required',
				'id_categorie' => 'required',
				'id_type' => 'required',
				'nombre' => 'required|numeric',
				'date' => 'required',
			);
			$this->sanitize_array = array(
				'id_projet' => 'sanitize_string',
				'id_tranche' => 'sanitize_string',
				'id_categorie' => 'sanitize_string',
				'id_type' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'date' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("co_consistance.id_consistance", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("co_consistance.id_consistance", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("co_consistance");
	}
}
