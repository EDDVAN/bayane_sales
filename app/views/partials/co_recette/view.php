<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_recette/add");
$can_edit = ACL::is_allowed("co_recette/edit");
$can_view = ACL::is_allowed("co_recette/view");
$can_delete = ACL::is_allowed("co_recette/delete");
?>
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
                    <h4 class="record-title">View Recette</h4>
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
                        $rec_id = (!empty($data['id_recette']) ? urlencode($data['id_recette']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_recette">
                                        <th class="title"> Id Recette: </th>
                                        <td class="value"> <?php echo $data['id_recette']; ?></td>
                                    </tr>
                                    <tr  class="td-id_vente">
                                        <th class="title"> Id Vente: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_vente']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="id_vente" 
                                                data-title="Enter Id Vente" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_vente']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_av">
                                        <th class="title"> Date Av: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{altFormat: 'Y-m-d', enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_av']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="date_av" 
                                                data-title="Enter Date Av" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_av']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_limite">
                                        <th class="title"> Date Limite: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{altFormat: 'Y-m-d', enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_limite']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="date_limite" 
                                                data-title="Enter Date Limite" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_limite']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-num_av">
                                        <th class="title"> Num Av: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['num_av']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="num_av" 
                                                data-title="Enter Num Av" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['num_av']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-montant">
                                        <th class="title"> Montant: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-value="<?php echo $data['montant']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="montant" 
                                                data-title="Enter Montant" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['montant']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ref_versement">
                                        <th class="title"> Ref Versement: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ref_versement']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="ref_versement" 
                                                data-title="Enter Ref Versement" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ref_versement']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_valeur">
                                        <th class="title"> Date Valeur: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['date_valeur']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="date_valeur" 
                                                data-title="Enter Date Valeur" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_valeur']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rib">
                                        <th class="title"> Rib: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/co_recette_rib_option_list'); ?>' 
                                                data-value="<?php echo $data['rib']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="rib" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" <?php } ?>>
                                                <?php echo $data['rib']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ref_rapprochement">
                                        <th class="title"> Ref Rapprochement: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ref_rapprochement']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="ref_rapprochement" 
                                                data-title="Enter Ref Rapprochement" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ref_rapprochement']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-par">
                                        <th class="title"> Par: </th>
                                        <td class="value">
                                            <div class="inline-page">
                                                <a class="btn btn-link open-page-inline" href="<?php print_link("user/view/" . urlencode($data['par'])); ?>">
                                                    <?php echo $data['user_name'] ?>
                                                </a>
                                                <div class="page-content reset-grids d-none animated fadeIn"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_update">
                                        <th class="title"> Date Update: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['date_update']; ?>" 
                                                data-pk="<?php echo $data['id_recette'] ?>" 
                                                data-url="<?php print_link("co_recette/editfield/" . urlencode($data['id_recette'])); ?>" 
                                                data-name="date_update" 
                                                data-title="Enter Date Update" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_update']; ?> 
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("co_recette/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("co_recette/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="material-icons">clear</i> Delete
                                                </a>
                                                <?php } ?>
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
