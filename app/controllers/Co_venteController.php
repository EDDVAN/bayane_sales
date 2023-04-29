<?php 
/**
 * Co_vente Page Controller
 * @category  Controller
 */
class Co_venteController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "co_vente";
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
		$fields = array("co_vente.id_vente", 
			"co_vente.id_dossier", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_vente.id_produit", 
			"co_produit.num_produit AS co_produit_num_produit", 
			"co_vente.date", 
			"co_vente.prix_vente", 
			"co_vente.statut", 
			"co_vente.attachment");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				co_vente.id_vente LIKE ? OR 
				co_vente.id_dossier LIKE ? OR 
				co_vente.id_produit LIKE ? OR 
				co_vente.date LIKE ? OR 
				co_vente.promotion LIKE ? OR 
				co_vente.prix_vente LIKE ? OR 
				co_vente.condition_vente LIKE ? OR 
				co_vente.statut LIKE ? OR 
				co_vente.notaire LIKE ? OR 
				co_vente.credit LIKE ? OR 
				co_vente.accord LIKE ? OR 
				co_vente.datecre LIKE ? OR 
				co_vente.par LIKE ? OR 
				co_vente.id_adm LIKE ? OR 
				co_vente.date_adm LIKE ? OR 
				co_vente.observation LIKE ? OR 
				co_vente.dateliv LIKE ? OR 
				co_vente.attachment LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "co_vente/search.php";
		}
		$db->join("co_dossier_client", "co_vente.id_dossier = co_dossier_client.id_dossier", "INNER");
		$db->join("co_produit", "co_vente.id_produit = co_produit.id_produit", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("co_vente.id_vente", ORDER_TYPE);
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
				$record['prix_vente'] = approximate($record['prix_vente'],2);
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
		$page_title = $this->view->page_title = "Vente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("co_vente/list.php", $data); //render the full page
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
		$fields = array("co_vente.id_vente", 
			"co_vente.id_dossier", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_vente.id_produit", 
			"co_produit.num_produit AS co_produit_num_produit", 
			"co_vente.date", 
			"co_vente.promotion", 
			"co_vente.prix_vente", 
			"co_vente.condition_vente", 
			"co_vente.statut", 
			"co_vente.notaire", 
			"co_vente.credit", 
			"co_vente.accord", 
			"co_vente.par", 
			"user.name AS user_name", 
			"co_vente.observation", 
			"co_vente.attachment", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_dossier_client.id_client AS co_dossier_client_id_client", 
			"co_dossier_client.part_client AS co_dossier_client_part_client", 
			"co_dossier_client.etat AS co_dossier_client_etat");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("co_vente.id_vente", $rec_id);; //select record based on primary key
		}
		$db->join("co_produit", "co_vente.id_produit = co_produit.id_produit", "INNER");
		$db->join("user", "co_vente.par = user.id", "INNER");
		$db->join("co_dossier_client", "co_vente.id_dossier = co_dossier_client.id_dossier", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['prix_vente'] = approximate($record['prix_vente'],2);
			$page_title = $this->view->page_title = "View  Co Vente";
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
		return $this->render_view("co_vente/view.php", $record);
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
			$fields = $this->fields = array("id_dossier","id_produit","date","promotion","prix_vente","condition_vente","statut","notaire","credit","accord","datecre","par","id_adm","date_adm","observation","dateliv","attachment");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_dossier' => 'required',
				'id_produit' => 'required',
				'date' => 'required',
				'promotion' => 'numeric',
				'prix_vente' => 'required|numeric',
				'notaire' => 'numeric',
				'accord' => 'numeric',
				'par' => 'required',
			);
			$this->sanitize_array = array(
				'id_dossier' => 'sanitize_string',
				'id_produit' => 'sanitize_string',
				'date' => 'sanitize_string',
				'promotion' => 'sanitize_string',
				'prix_vente' => 'sanitize_string',
				'condition_vente' => 'sanitize_string',
				'notaire' => 'sanitize_string',
				'credit' => 'sanitize_string',
				'accord' => 'sanitize_string',
				'par' => 'sanitize_string',
				'observation' => 'sanitize_string',
				'attachment' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['statut'] = "provisoire";
$modeldata['datecre'] = date_now();
$modeldata['id_adm'] = USER_ID;
$modeldata['date_adm'] = datetime_now();
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("co_recette?id_vente=".$rec_id."");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Co Vente";
		$this->render_view("co_vente/add.php");
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
		$fields = $this->fields = array("id_vente","statut","notaire","credit","accord","observation","dateliv","attachment");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'notaire' => 'numeric',
				'accord' => 'numeric',
			);
			$this->sanitize_array = array(
				'notaire' => 'sanitize_string',
				'credit' => 'sanitize_string',
				'accord' => 'sanitize_string',
				'observation' => 'sanitize_string',
				'attachment' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['statut'] = "provisoire";
			if($this->validated()){
				$db->where("co_vente.id_vente", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("co_vente");
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
						return	$this->redirect("co_vente");
					}
				}
			}
		}
		$db->where("co_vente.id_vente", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Co Vente";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("co_vente/edit.php", $data);
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
		$fields = $this->fields = array("id_vente","statut","notaire","credit","accord","observation","dateliv","attachment");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'notaire' => 'numeric',
				'accord' => 'numeric',
			);
			$this->sanitize_array = array(
				'notaire' => 'sanitize_string',
				'credit' => 'sanitize_string',
				'accord' => 'sanitize_string',
				'observation' => 'sanitize_string',
				'attachment' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("co_vente.id_vente", $rec_id);;
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
		$db->where("co_vente.id_vente", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("co_vente");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function provisiore($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("co_vente.id_vente", 
			"co_vente.id_produit", 
			"co_produit.num_produit AS co_produit_num_produit", 
			"co_vente.id_dossier", 
			"co_dossier_client.id_dossier AS co_dossier_client_id_dossier", 
			"co_vente.date", 
			"co_vente.promotion", 
			"co_vente.prix_vente", 
			"co_vente.par", 
			"user.name AS user_name", 
			"CONCAT('Recetes') AS Recettes", 
			"co_vente.attachment", 
			"co_dossier_client.id_client AS co_dossier_client_id_client");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				co_vente.id_vente LIKE ? OR 
				co_vente.id_produit LIKE ? OR 
				co_vente.id_dossier LIKE ? OR 
				co_vente.date LIKE ? OR 
				co_vente.promotion LIKE ? OR 
				co_vente.prix_vente LIKE ? OR 
				co_vente.condition_vente LIKE ? OR 
				co_vente.statut LIKE ? OR 
				co_vente.notaire LIKE ? OR 
				co_vente.credit LIKE ? OR 
				co_vente.accord LIKE ? OR 
				co_vente.datecre LIKE ? OR 
				co_vente.par LIKE ? OR 
				co_vente.id_adm LIKE ? OR 
				co_vente.date_adm LIKE ? OR 
				co_vente.observation LIKE ? OR 
				co_vente.dateliv LIKE ? OR 
				co_vente.Recettes LIKE ? OR 
				co_vente.attachment LIKE ? OR 
				co_dossier_client.id_dossier LIKE ? OR 
				co_dossier_client.id_client LIKE ? OR 
				co_dossier_client.part_client LIKE ? OR 
				co_dossier_client.etat LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "co_vente/search.php";
		}
		$db->join("co_produit", "co_vente.id_produit = co_produit.id_produit", "INNER");
		$db->join("user", "co_vente.par = user.id", "INNER");
		$db->join("co_dossier_client", "co_vente.id_dossier = co_dossier_client.id_dossier", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("co_vente.id_vente", ORDER_TYPE);
		}
		$db->where(!empty($_GET['id_client']) ? "co_vente.statut='provisoire' AND co_vente.par=". USER_ID . " AND co_dossier_client.id_client=".$_GET['id_client'] : "co_vente.statut='provisoire' AND co_vente.par=". USER_ID);
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
		$page_title = $this->view->page_title = "Vente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("co_vente/provisiore.php", $data); //render the full page
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function definitive($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("co_vente.id_vente", 
			"co_vente.id_produit", 
			"co_produit.num_produit AS co_produit_num_produit", 
			"co_vente.id_dossier", 
			"co_vente.date", 
			"co_vente.promotion", 
			"co_vente.prix_vente", 
			"co_vente.par", 
			"user.name AS user_name", 
			"co_vente.dateliv", 
			"CONCAT('Recettes') AS Recettes", 
			"co_vente.attachment");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				co_vente.id_vente LIKE ? OR 
				co_vente.id_produit LIKE ? OR 
				co_vente.id_dossier LIKE ? OR 
				co_vente.date LIKE ? OR 
				co_vente.promotion LIKE ? OR 
				co_vente.prix_vente LIKE ? OR 
				co_vente.condition_vente LIKE ? OR 
				co_vente.statut LIKE ? OR 
				co_vente.notaire LIKE ? OR 
				co_vente.credit LIKE ? OR 
				co_vente.accord LIKE ? OR 
				co_vente.datecre LIKE ? OR 
				co_vente.par LIKE ? OR 
				co_vente.id_adm LIKE ? OR 
				co_vente.date_adm LIKE ? OR 
				co_vente.observation LIKE ? OR 
				co_vente.dateliv LIKE ? OR 
				CONCAT('Recettes') LIKE ? OR 
				co_vente.attachment LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "co_vente/search.php";
		}
		$db->join("co_produit", "co_vente.id_produit = co_produit.id_produit", "INNER");
		$db->join("user", "co_vente.par = user.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("co_vente.id_vente", ORDER_TYPE);
		}
		$db->where("statut='definitive' AND co_vente.par=". USER_ID . "");
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
		$page_title = $this->view->page_title = "Vente";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("co_vente/definitive.php", $data); //render the full page
	}
}
