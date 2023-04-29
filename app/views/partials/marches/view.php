<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Marches</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-annee">
                                        <th class="title"> Annee: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-num_marche">
                                        <th class="title"> Num Marche: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-objet">
                                        <th class="title"> Objet: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-prestataire">
                                        <th class="title"> Prestataire: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-responsable">
                                        <th class="title"> Responsable: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-num_aoo">
                                        <th class="title"> Num Aoo: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-statut_aoo">
                                        <th class="title"> Statut Aoo: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-montant">
                                        <th class="title"> Montant: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-date_os">
                                        <th class="title"> Date Os: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-delai">
                                        <th class="title"> Delai: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-id_prestataire">
                                        <th class="title"> Id Prestataire: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-id_docs">
                                        <th class="title"> Id Docs: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-decomptes">
                                        <th class="title"> Decomptes: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-reglement">
                                        <th class="title"> Reglement: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-statut">
                                        <th class="title"> Statut: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-pourcentage">
                                        <th class="title"> Pourcentage: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-montant_variation">
                                        <th class="title"> Montant Variation: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-libelle_decompte">
                                        <th class="title"> Libelle Decompte: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-date_os_approbation">
                                        <th class="title"> Date Os Approbation: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-pole">
                                        <th class="title"> Pole: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-marche_achat">
                                        <th class="title"> Marche Achat: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-type">
                                        <th class="title"> Type: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-convention">
                                        <th class="title"> Convention: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-user">
                                        <th class="title"> User: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-datec">
                                        <th class="title"> Datec: </th>
                                        <td class="value"> <?php echo $data['datec']; ?></td>
                                    </tr>
                                    <tr  class="td-date_maj">
                                        <th class="title"> Date Maj: </th>
                                        <td class="value"> <?php echo $data['date_maj']; ?></td>
                                    </tr>
                                    <tr  class="td-audite_par">
                                        <th class="title"> Audite Par: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-date_ouverture">
                                        <th class="title"> Date Ouverture: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-contrat_architecte">
                                        <th class="title"> Contrat Architecte: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-reference">
                                        <th class="title"> Reference: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-alive">
                                        <th class="title"> Alive: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-reception">
                                        <th class="title"> Reception: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-reception_definitive">
                                        <th class="title"> Reception Definitive: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-avenant_du">
                                        <th class="title"> Avenant Du: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-montant_actualise">
                                        <th class="title"> Montant Actualise: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-avenant_du_libelle">
                                        <th class="title"> Avenant Du Libelle: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-id_convention">
                                        <th class="title"> Id Convention: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-RIB">
                                        <th class="title"> Rib: </th>
                                        <td class="value">
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
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("marches/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("marches/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="material-icons">clear</i> Delete
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="material-icons">block</i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
