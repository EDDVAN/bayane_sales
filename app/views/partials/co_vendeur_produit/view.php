<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_vendeur_produit/add");
$can_edit = ACL::is_allowed("co_vendeur_produit/edit");
$can_view = ACL::is_allowed("co_vendeur_produit/view");
$can_delete = ACL::is_allowed("co_vendeur_produit/delete");
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
                    <h4 class="record-title">View  Co Vendeur Produit</h4>
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
                        $rec_id = (!empty($data['id_vendeur_produit']) ? urlencode($data['id_vendeur_produit']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_vendeur_produit">
                                        <th class="title"> Id Vendeur Produit: </th>
                                        <td class="value"> <?php echo $data['id_vendeur_produit']; ?></td>
                                    </tr>
                                    <tr  class="td-id_vendeur">
                                        <th class="title"> Id Vendeur: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/co_vendeur_produit_id_vendeur_option_list'); ?>' 
                                                data-value="<?php echo $data['id_vendeur']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="id_vendeur" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_vendeur']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_produit">
                                        <th class="title"> Id Produit: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/co_vendeur_produit_id_produit_option_list'); ?>' 
                                                data-value="<?php echo $data['id_produit']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="id_produit" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_produit']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_du">
                                        <th class="title"> Date Du: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_du']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="date_du" 
                                                data-title="Enter Date Du" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_du']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_au">
                                        <th class="title"> Date Au: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_au']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="date_au" 
                                                data-title="Enter Date Au" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_au']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-lieux">
                                        <th class="title"> Lieux: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['lieux']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="lieux" 
                                                data-title="Enter Lieux" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['lieux']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-etat">
                                        <th class="title"> Etat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['etat']; ?>" 
                                                data-pk="<?php echo $data['id_vendeur_produit'] ?>" 
                                                data-url="<?php print_link("co_vendeur_produit/editfield/" . urlencode($data['id_vendeur_produit'])); ?>" 
                                                data-name="etat" 
                                                data-title="Enter Etat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['etat']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("co_vendeur_produit/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("co_vendeur_produit/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
