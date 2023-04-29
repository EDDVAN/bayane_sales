<?php 
/**
 * Marches Page Controller
 * @category  Controller
 */
class MarchesController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "marches";
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
		$fields = array("id", 
			"annee", 
			"num_marche", 
			"objet", 
			"prestataire", 
			"responsable", 
			"num_aoo", 
			"statut_aoo", 
			"montant", 
			"date_os", 
			"delai", 
			"id_prestataire", 
			"id_docs", 
			"decomptes", 
			"reglement", 
			"statut", 
			"pourcentage", 
			"montant_variation", 
			"libelle_decompte", 
			"date_os_approbation", 
			"pole", 
			"marche_achat", 
			"type", 
			"convention", 
			"user", 
			"datec", 
			"date_maj", 
			"audite_par", 
			"date_ouverture", 
			"contrat_architecte", 
			"reference", 
			"alive", 
			"reception", 
			"reception_definitive", 
			"avenant_du", 
			"montant_actualise", 
			"avenant_du_libelle", 
			"id_convention", 
			"RIB");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				marches.id LIKE ? OR 
				marches.annee LIKE ? OR 
				marches.num_marche LIKE ? OR 
				marches.objet LIKE ? OR 
				marches.prestataire LIKE ? OR 
				marches.responsable LIKE ? OR 
				marches.num_aoo LIKE ? OR 
				marches.statut_aoo LIKE ? OR 
				marches.montant LIKE ? OR 
				marches.date_os LIKE ? OR 
				marches.delai LIKE ? OR 
				marches.id_prestataire LIKE ? OR 
				marches.id_docs LIKE ? OR 
				marches.decomptes LIKE ? OR 
				marches.reglement LIKE ? OR 
				marches.statut LIKE ? OR 
				marches.pourcentage LIKE ? OR 
				marches.montant_variation LIKE ? OR 
				marches.libelle_decompte LIKE ? OR 
				marches.date_os_approbation LIKE ? OR 
				marches.pole LIKE ? OR 
				marches.marche_achat LIKE ? OR 
				marches.type LIKE ? OR 
				marches.convention LIKE ? OR 
				marches.user LIKE ? OR 
				marches.datec LIKE ? OR 
				marches.date_maj LIKE ? OR 
				marches.audite_par LIKE ? OR 
				marches.date_ouverture LIKE ? OR 
				marches.contrat_architecte LIKE ? OR 
				marches.reference LIKE ? OR 
				marches.alive LIKE ? OR 
				marches.reception LIKE ? OR 
				marches.reception_definitive LIKE ? OR 
				marches.avenant_du LIKE ? OR 
				marches.montant_actualise LIKE ? OR 
				marches.avenant_du_libelle LIKE ? OR 
				marches.id_convention LIKE ? OR 
				marches.RIB LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "marches/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("marches.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Marches";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("marches/list.php", $data); //render the full page
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
		$fields = array("id", 
			"annee", 
			"num_marche", 
			"objet", 
			"prestataire", 
			"responsable", 
			"num_aoo", 
			"statut_aoo", 
			"montant", 
			"date_os", 
			"delai", 
			"id_prestataire", 
			"id_docs", 
			"decomptes", 
			"reglement", 
			"statut", 
			"pourcentage", 
			"montant_variation", 
			"libelle_decompte", 
			"date_os_approbation", 
			"pole", 
			"marche_achat", 
			"type", 
			"convention", 
			"user", 
			"datec", 
			"date_maj", 
			"audite_par", 
			"date_ouverture", 
			"contrat_architecte", 
			"reference", 
			"alive", 
			"reception", 
			"reception_definitive", 
			"avenant_du", 
			"montant_actualise", 
			"avenant_du_libelle", 
			"id_convention", 
			"RIB");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("marches.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Marches";
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
		return $this->render_view("marches/view.php", $record);
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
			$fields = $this->fields = array("annee","num_marche","objet","prestataire","responsable","num_aoo","statut_aoo","montant","date_os","delai","id_prestataire","id_docs","decomptes","reglement","statut","pourcentage","montant_variation","libelle_decompte","date_os_approbation","pole","marche_achat","type","convention","user","audite_par","date_ouverture","contrat_architecte","reference","alive","reception","reception_definitive","avenant_du","montant_actualise","avenant_du_libelle","id_convention","RIB");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'annee' => 'required|numeric',
				'num_marche' => 'required',
				'objet' => 'required',
				'prestataire' => 'required',
				'responsable' => 'required',
				'num_aoo' => 'required',
				'statut_aoo' => 'required',
				'montant' => 'required|numeric',
				'date_os' => 'required',
				'delai' => 'required|numeric',
				'id_prestataire' => 'required|numeric',
				'id_docs' => 'required',
				'decomptes' => 'required|numeric',
				'reglement' => 'required|numeric',
				'statut' => 'required',
				'pourcentage' => 'required|numeric',
				'montant_variation' => 'required|numeric',
				'libelle_decompte' => 'required',
				'date_os_approbation' => 'required',
				'pole' => 'required',
				'marche_achat' => 'required',
				'type' => 'required',
				'convention' => 'required',
				'user' => 'required',
				'audite_par' => 'required',
				'date_ouverture' => 'required',
				'contrat_architecte' => 'required',
				'reference' => 'required',
				'alive' => 'required|numeric',
				'reception' => 'required',
				'reception_definitive' => 'required',
				'avenant_du' => 'required|numeric',
				'montant_actualise' => 'required|numeric',
				'avenant_du_libelle' => 'required',
				'id_convention' => 'required|numeric',
				'RIB' => 'required',
			);
			$this->sanitize_array = array(
				'annee' => 'sanitize_string',
				'num_marche' => 'sanitize_string',
				'objet' => 'sanitize_string',
				'prestataire' => 'sanitize_string',
				'responsable' => 'sanitize_string',
				'num_aoo' => 'sanitize_string',
				'statut_aoo' => 'sanitize_string',
				'montant' => 'sanitize_string',
				'date_os' => 'sanitize_string',
				'delai' => 'sanitize_string',
				'id_prestataire' => 'sanitize_string',
				'id_docs' => 'sanitize_string',
				'decomptes' => 'sanitize_string',
				'reglement' => 'sanitize_string',
				'statut' => 'sanitize_string',
				'pourcentage' => 'sanitize_string',
				'montant_variation' => 'sanitize_string',
				'libelle_decompte' => 'sanitize_string',
				'date_os_approbation' => 'sanitize_string',
				'pole' => 'sanitize_string',
				'marche_achat' => 'sanitize_string',
				'type' => 'sanitize_string',
				'convention' => 'sanitize_string',
				'user' => 'sanitize_string',
				'audite_par' => 'sanitize_string',
				'date_ouverture' => 'sanitize_string',
				'contrat_architecte' => 'sanitize_string',
				'reference' => 'sanitize_string',
				'alive' => 'sanitize_string',
				'reception' => 'sanitize_string',
				'reception_definitive' => 'sanitize_string',
				'avenant_du' => 'sanitize_string',
				'montant_actualise' => 'sanitize_string',
				'avenant_du_libelle' => 'sanitize_string',
				'id_convention' => 'sanitize_string',
				'RIB' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("marches");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Marches";
		$this->render_view("marches/add.php");
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
		$fields = $this->fields = array("id","annee","num_marche","objet","prestataire","responsable","num_aoo","statut_aoo","montant","date_os","delai","id_prestataire","id_docs","decomptes","reglement","statut","pourcentage","montant_variation","libelle_decompte","date_os_approbation","pole","marche_achat","type","convention","user","audite_par","date_ouverture","contrat_architecte","reference","alive","reception","reception_definitive","avenant_du","montant_actualise","avenant_du_libelle","id_convention","RIB");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'annee' => 'required|numeric',
				'num_marche' => 'required',
				'objet' => 'required',
				'prestataire' => 'required',
				'responsable' => 'required',
				'num_aoo' => 'required',
				'statut_aoo' => 'required',
				'montant' => 'required|numeric',
				'date_os' => 'required',
				'delai' => 'required|numeric',
				'id_prestataire' => 'required|numeric',
				'id_docs' => 'required',
				'decomptes' => 'required|numeric',
				'reglement' => 'required|numeric',
				'statut' => 'required',
				'pourcentage' => 'required|numeric',
				'montant_variation' => 'required|numeric',
				'libelle_decompte' => 'required',
				'date_os_approbation' => 'required',
				'pole' => 'required',
				'marche_achat' => 'required',
				'type' => 'required',
				'convention' => 'required',
				'user' => 'required',
				'audite_par' => 'required',
				'date_ouverture' => 'required',
				'contrat_architecte' => 'required',
				'reference' => 'required',
				'alive' => 'required|numeric',
				'reception' => 'required',
				'reception_definitive' => 'required',
				'avenant_du' => 'required|numeric',
				'montant_actualise' => 'required|numeric',
				'avenant_du_libelle' => 'required',
				'id_convention' => 'required|numeric',
				'RIB' => 'required',
			);
			$this->sanitize_array = array(
				'annee' => 'sanitize_string',
				'num_marche' => 'sanitize_string',
				'objet' => 'sanitize_string',
				'prestataire' => 'sanitize_string',
				'responsable' => 'sanitize_string',
				'num_aoo' => 'sanitize_string',
				'statut_aoo' => 'sanitize_string',
				'montant' => 'sanitize_string',
				'date_os' => 'sanitize_string',
				'delai' => 'sanitize_string',
				'id_prestataire' => 'sanitize_string',
				'id_docs' => 'sanitize_string',
				'decomptes' => 'sanitize_string',
				'reglement' => 'sanitize_string',
				'statut' => 'sanitize_string',
				'pourcentage' => 'sanitize_string',
				'montant_variation' => 'sanitize_string',
				'libelle_decompte' => 'sanitize_string',
				'date_os_approbation' => 'sanitize_string',
				'pole' => 'sanitize_string',
				'marche_achat' => 'sanitize_string',
				'type' => 'sanitize_string',
				'convention' => 'sanitize_string',
				'user' => 'sanitize_string',
				'audite_par' => 'sanitize_string',
				'date_ouverture' => 'sanitize_string',
				'contrat_architecte' => 'sanitize_string',
				'reference' => 'sanitize_string',
				'alive' => 'sanitize_string',
				'reception' => 'sanitize_string',
				'reception_definitive' => 'sanitize_string',
				'avenant_du' => 'sanitize_string',
				'montant_actualise' => 'sanitize_string',
				'avenant_du_libelle' => 'sanitize_string',
				'id_convention' => 'sanitize_string',
				'RIB' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("marches.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("marches");
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
						return	$this->redirect("marches");
					}
				}
			}
		}
		$db->where("marches.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Marches";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("marches/edit.php", $data);
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
		$fields = $this->fields = array("id","annee","num_marche","objet","prestataire","responsable","num_aoo","statut_aoo","montant","date_os","delai","id_prestataire","id_docs","decomptes","reglement","statut","pourcentage","montant_variation","libelle_decompte","date_os_approbation","pole","marche_achat","type","convention","user","audite_par","date_ouverture","contrat_architecte","reference","alive","reception","reception_definitive","avenant_du","montant_actualise","avenant_du_libelle","id_convention","RIB");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'annee' => 'required|numeric',
				'num_marche' => 'required',
				'objet' => 'required',
				'prestataire' => 'required',
				'responsable' => 'required',
				'num_aoo' => 'required',
				'statut_aoo' => 'required',
				'montant' => 'required|numeric',
				'date_os' => 'required',
				'delai' => 'required|numeric',
				'id_prestataire' => 'required|numeric',
				'id_docs' => 'required',
				'decomptes' => 'required|numeric',
				'reglement' => 'required|numeric',
				'statut' => 'required',
				'pourcentage' => 'required|numeric',
				'montant_variation' => 'required|numeric',
				'libelle_decompte' => 'required',
				'date_os_approbation' => 'required',
				'pole' => 'required',
				'marche_achat' => 'required',
				'type' => 'required',
				'convention' => 'required',
				'user' => 'required',
				'audite_par' => 'required',
				'date_ouverture' => 'required',
				'contrat_architecte' => 'required',
				'reference' => 'required',
				'alive' => 'required|numeric',
				'reception' => 'required',
				'reception_definitive' => 'required',
				'avenant_du' => 'required|numeric',
				'montant_actualise' => 'required|numeric',
				'avenant_du_libelle' => 'required',
				'id_convention' => 'required|numeric',
				'RIB' => 'required',
			);
			$this->sanitize_array = array(
				'annee' => 'sanitize_string',
				'num_marche' => 'sanitize_string',
				'objet' => 'sanitize_string',
				'prestataire' => 'sanitize_string',
				'responsable' => 'sanitize_string',
				'num_aoo' => 'sanitize_string',
				'statut_aoo' => 'sanitize_string',
				'montant' => 'sanitize_string',
				'date_os' => 'sanitize_string',
				'delai' => 'sanitize_string',
				'id_prestataire' => 'sanitize_string',
				'id_docs' => 'sanitize_string',
				'decomptes' => 'sanitize_string',
				'reglement' => 'sanitize_string',
				'statut' => 'sanitize_string',
				'pourcentage' => 'sanitize_string',
				'montant_variation' => 'sanitize_string',
				'libelle_decompte' => 'sanitize_string',
				'date_os_approbation' => 'sanitize_string',
				'pole' => 'sanitize_string',
				'marche_achat' => 'sanitize_string',
				'type' => 'sanitize_string',
				'convention' => 'sanitize_string',
				'user' => 'sanitize_string',
				'audite_par' => 'sanitize_string',
				'date_ouverture' => 'sanitize_string',
				'contrat_architecte' => 'sanitize_string',
				'reference' => 'sanitize_string',
				'alive' => 'sanitize_string',
				'reception' => 'sanitize_string',
				'reception_definitive' => 'sanitize_string',
				'avenant_du' => 'sanitize_string',
				'montant_actualise' => 'sanitize_string',
				'avenant_du_libelle' => 'sanitize_string',
				'id_convention' => 'sanitize_string',
				'RIB' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("marches.id", $rec_id);;
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
		$db->where("marches.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("marches");
	}
}
