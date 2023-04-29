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
                    <h4 class="record-title">View  Madecompte</h4>
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
                                    <tr  class="td-id_marche">
                                        <th class="title"> Id Marche: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['id_marche']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="id_marche" 
                                                data-title="Enter Id Marche" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['id_marche']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_attachement">
                                        <th class="title"> Id Attachement: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['id_attachement']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="id_attachement" 
                                                data-title="Enter Id Attachement" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['id_attachement']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-numedeco">
                                        <th class="title"> Numedeco: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['numedeco']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="numedeco" 
                                                data-title="Enter Numedeco" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['numedeco']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dt_reception">
                                        <th class="title"> Dt Reception: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['dt_reception']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="dt_reception" 
                                                data-title="Enter Dt Reception" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dt_reception']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-montant">
                                        <th class="title"> Montant: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['montant']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
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
                                    <tr  class="td-montant_net">
                                        <th class="title"> Montant Net: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['montant_net']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="montant_net" 
                                                data-title="Enter Montant Net" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['montant_net']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dt_regl">
                                        <th class="title"> Dt Regl: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['dt_regl']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="dt_regl" 
                                                data-title="Enter Dt Regl" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dt_regl']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dt_etablissement">
                                        <th class="title"> Dt Etablissement: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['dt_etablissement']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="dt_etablissement" 
                                                data-title="Enter Dt Etablissement" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dt_etablissement']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-echeance">
                                        <th class="title"> Echeance: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['echeance']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="echeance" 
                                                data-title="Enter Echeance" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['echeance']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-etat">
                                        <th class="title"> Etat: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['etat']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="etat" 
                                                data-title="Enter Etat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['etat']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-montant_rg">
                                        <th class="title"> Montant Rg: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['montant_rg']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="montant_rg" 
                                                data-title="Enter Montant Rg" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['montant_rg']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-revision_prix">
                                        <th class="title"> Revision Prix: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['revision_prix']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="revision_prix" 
                                                data-title="Enter Revision Prix" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['revision_prix']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-penalite">
                                        <th class="title"> Penalite: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['penalite']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="penalite" 
                                                data-title="Enter Penalite" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['penalite']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-retenue">
                                        <th class="title"> Retenue: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['retenue']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="retenue" 
                                                data-title="Enter Retenue" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['retenue']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tva_four">
                                        <th class="title"> Tva Four: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['tva_four']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tva_four" 
                                                data-title="Enter Tva Four" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tva_four']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tva_rg">
                                        <th class="title"> Tva Rg: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['tva_rg']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tva_rg" 
                                                data-title="Enter Tva Rg" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tva_rg']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tva_penalite">
                                        <th class="title"> Tva Penalite: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['tva_penalite']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tva_penalite" 
                                                data-title="Enter Tva Penalite" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tva_penalite']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dt_saisie">
                                        <th class="title"> Dt Saisie: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['dt_saisie']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="dt_saisie" 
                                                data-title="Enter Dt Saisie" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dt_saisie']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_user">
                                        <th class="title"> Id User: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['id_user']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("madecompte/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="id_user" 
                                                data-title="Enter Id User" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['id_user']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("madecompte/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("madecompte/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
