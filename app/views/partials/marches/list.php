<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Marches</h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("marches/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Marches 
                    </a>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('marches'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('marches'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('marches'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="marches-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-annee"> Annee</th>
                                                <th  class="td-num_marche"> Num Marche</th>
                                                <th  class="td-objet"> Objet</th>
                                                <th  class="td-prestataire"> Prestataire</th>
                                                <th  class="td-responsable"> Responsable</th>
                                                <th  class="td-num_aoo"> Num Aoo</th>
                                                <th  class="td-statut_aoo"> Statut Aoo</th>
                                                <th  class="td-montant"> Montant</th>
                                                <th  class="td-date_os"> Date Os</th>
                                                <th  class="td-delai"> Delai</th>
                                                <th  class="td-id_prestataire"> Id Prestataire</th>
                                                <th  class="td-id_docs"> Id Docs</th>
                                                <th  class="td-decomptes"> Decomptes</th>
                                                <th  class="td-reglement"> Reglement</th>
                                                <th  class="td-statut"> Statut</th>
                                                <th  class="td-pourcentage"> Pourcentage</th>
                                                <th  class="td-montant_variation"> Montant Variation</th>
                                                <th  class="td-libelle_decompte"> Libelle Decompte</th>
                                                <th  class="td-date_os_approbation"> Date Os Approbation</th>
                                                <th  class="td-pole"> Pole</th>
                                                <th  class="td-marche_achat"> Marche Achat</th>
                                                <th  class="td-type"> Type</th>
                                                <th  class="td-convention"> Convention</th>
                                                <th  class="td-user"> User</th>
                                                <th  class="td-datec"> Datec</th>
                                                <th  class="td-date_maj"> Date Maj</th>
                                                <th  class="td-audite_par"> Audite Par</th>
                                                <th  class="td-date_ouverture"> Date Ouverture</th>
                                                <th  class="td-contrat_architecte"> Contrat Architecte</th>
                                                <th  class="td-reference"> Reference</th>
                                                <th  class="td-alive"> Alive</th>
                                                <th  class="td-reception"> Reception</th>
                                                <th  class="td-reception_definitive"> Reception Definitive</th>
                                                <th  class="td-avenant_du"> Avenant Du</th>
                                                <th  class="td-montant_actualise"> Montant Actualise</th>
                                                <th  class="td-avenant_du_libelle"> Avenant Du Libelle</th>
                                                <th  class="td-id_convention"> Id Convention</th>
                                                <th  class="td-RIB"> Rib</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-id"><a href="<?php print_link("marches/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                    <td class="td-annee">
                                                        <span  data-value="<?php echo $data['annee']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="annee" 
                                                            data-title="Enter Annee" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['annee']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-num_marche">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="num_marche" 
                                                            data-title="Enter Num Marche" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['num_marche']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-objet">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="objet" 
                                                            data-title="Enter Objet" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['objet']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-prestataire">
                                                        <span  data-value="<?php echo $data['prestataire']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="prestataire" 
                                                            data-title="Enter Prestataire" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['prestataire']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-responsable">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="responsable" 
                                                            data-title="Enter Responsable" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['responsable']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-num_aoo">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="num_aoo" 
                                                            data-title="Enter Num Aoo" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['num_aoo']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-statut_aoo">
                                                        <span  data-value="<?php echo $data['statut_aoo']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="statut_aoo" 
                                                            data-title="Enter Statut Aoo" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['statut_aoo']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-montant">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['montant']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="montant" 
                                                            data-title="Enter Montant" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['montant']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-date_os">
                                                        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['date_os']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="date_os" 
                                                            data-title="Enter Date Os" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['date_os']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-delai">
                                                        <span  data-value="<?php echo $data['delai']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="delai" 
                                                            data-title="Enter Delai" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['delai']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-id_prestataire">
                                                        <span  data-value="<?php echo $data['id_prestataire']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="id_prestataire" 
                                                            data-title="Enter Id Prestataire" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['id_prestataire']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-id_docs">
                                                        <span  data-value="<?php echo $data['id_docs']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="id_docs" 
                                                            data-title="Enter Id Docs" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['id_docs']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-decomptes">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['decomptes']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="decomptes" 
                                                            data-title="Enter Decomptes" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['decomptes']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-reglement">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['reglement']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="reglement" 
                                                            data-title="Enter Reglement" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['reglement']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-statut">
                                                        <span  data-value="<?php echo $data['statut']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="statut" 
                                                            data-title="Enter Statut" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['statut']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-pourcentage">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['pourcentage']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="pourcentage" 
                                                            data-title="Enter Pourcentage" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['pourcentage']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-montant_variation">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['montant_variation']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="montant_variation" 
                                                            data-title="Enter Montant Variation" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['montant_variation']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-libelle_decompte">
                                                        <span  data-value="<?php echo $data['libelle_decompte']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="libelle_decompte" 
                                                            data-title="Enter Libelle Decompte" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['libelle_decompte']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-date_os_approbation">
                                                        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['date_os_approbation']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="date_os_approbation" 
                                                            data-title="Enter Date Os Approbation" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['date_os_approbation']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-pole">
                                                        <span  data-value="<?php echo $data['pole']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="pole" 
                                                            data-title="Enter Pole" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['pole']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-marche_achat">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="marche_achat" 
                                                            data-title="Enter Marche Achat" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['marche_achat']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-type">
                                                        <span  data-value="<?php echo $data['type']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="type" 
                                                            data-title="Enter Type" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['type']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-convention">
                                                        <span  data-value="<?php echo $data['convention']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="convention" 
                                                            data-title="Enter Convention" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['convention']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-user">
                                                        <span  data-value="<?php echo $data['user']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="user" 
                                                            data-title="Enter User" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['user']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-datec"> <?php echo $data['datec']; ?></td>
                                                    <td class="td-date_maj"> <?php echo $data['date_maj']; ?></td>
                                                    <td class="td-audite_par">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="audite_par" 
                                                            data-title="Enter Audite Par" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['audite_par']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-date_ouverture">
                                                        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['date_ouverture']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="date_ouverture" 
                                                            data-title="Enter Date Ouverture" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['date_ouverture']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-contrat_architecte">
                                                        <span  data-value="<?php echo $data['contrat_architecte']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="contrat_architecte" 
                                                            data-title="Enter Contrat Architecte" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['contrat_architecte']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-reference">
                                                        <span  data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="reference" 
                                                            data-title="Enter Reference" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="textarea" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['reference']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-alive">
                                                        <span  data-value="<?php echo $data['alive']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="alive" 
                                                            data-title="Enter Alive" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['alive']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-reception">
                                                        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['reception']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="reception" 
                                                            data-title="Enter Reception" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['reception']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-reception_definitive">
                                                        <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['reception_definitive']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="reception_definitive" 
                                                            data-title="Enter Reception Definitive" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['reception_definitive']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-avenant_du">
                                                        <span  data-value="<?php echo $data['avenant_du']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="avenant_du" 
                                                            data-title="Enter Avenant Du" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['avenant_du']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-montant_actualise">
                                                        <span  data-step="0.1" 
                                                            data-value="<?php echo $data['montant_actualise']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="montant_actualise" 
                                                            data-title="Enter Montant Actualise" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['montant_actualise']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-avenant_du_libelle">
                                                        <span  data-value="<?php echo $data['avenant_du_libelle']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="avenant_du_libelle" 
                                                            data-title="Enter Avenant Du Libelle" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['avenant_du_libelle']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-id_convention">
                                                        <span  data-value="<?php echo $data['id_convention']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="id_convention" 
                                                            data-title="Enter Id Convention" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['id_convention']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-RIB">
                                                        <span  data-value="<?php echo $data['RIB']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("marches/editfield/" . urlencode($data['id'])); ?>" 
                                                            data-name="RIB" 
                                                            data-title="Enter Rib" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" >
                                                            <?php echo $data['RIB']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("marches/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> View
                                                        </a>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("marches/edit/$rec_id"); ?>">
                                                            <i class="material-icons">edit</i> Edit
                                                        </a>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("marches/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                            <i class="material-icons">clear</i>
                                                            Delete
                                                        </a>
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="material-icons">block</i> No record found
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("marches/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="material-icons">clear</i> Delete Selected
                                                    </button>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">save</i> Export
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
