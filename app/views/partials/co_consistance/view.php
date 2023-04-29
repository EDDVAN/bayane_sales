<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_consistance/add");
$can_edit = ACL::is_allowed("co_consistance/edit");
$can_view = ACL::is_allowed("co_consistance/view");
$can_delete = ACL::is_allowed("co_consistance/delete");
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
                    <h4 class="record-title">View Consistance</h4>
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
                        $rec_id = (!empty($data['id_consistance']) ? urlencode($data['id_consistance']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_projet">
                                        <th class="title"> Projet: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-link page-modal" href="<?php print_link("co_projet/view/" . urlencode($data['id_projet'])) ?>">
                                                <?php echo $data['co_projet_projet'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_tranche">
                                        <th class="title"> Tranche: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $id_tranche); ?>' 
                                                data-value="<?php echo $data['id_tranche']; ?>" 
                                                data-pk="<?php echo $data['id_consistance'] ?>" 
                                                data-url="<?php print_link("co_consistance/editfield/" . urlencode($data['id_consistance'])); ?>" 
                                                data-name="id_tranche" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_tranche']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_categorie">
                                        <th class="title"> Categorie: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $id_categorie); ?>' 
                                                data-value="<?php echo $data['id_categorie']; ?>" 
                                                data-pk="<?php echo $data['id_consistance'] ?>" 
                                                data-url="<?php print_link("co_consistance/editfield/" . urlencode($data['id_consistance'])); ?>" 
                                                data-name="id_categorie" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_categorie']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_type">
                                        <th class="title"> Type: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-link page-modal" href="<?php print_link("co_type_produit/view/" . urlencode($data['id_type'])) ?>">
                                                <?php echo $data['co_type_produit_libelle'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-nombre">
                                        <th class="title"> Nombre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nombre']; ?>" 
                                                data-pk="<?php echo $data['id_consistance'] ?>" 
                                                data-url="<?php print_link("co_consistance/editfield/" . urlencode($data['id_consistance'])); ?>" 
                                                data-name="nombre" 
                                                data-title="Enter Nombre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nombre']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-superficie">
                                        <th class="title"> Superficie: </th>
                                        <td class="value"> <?php echo $data['superficie']; ?></td>
                                    </tr>
                                    <tr  class="td-par">
                                        <th class="title"> Par: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("user/view/" . urlencode($data['par'])) ?>">
                                                <i class="material-icons">visibility</i> <?php echo $data['user_name'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-date">
                                        <th class="title"> Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date']; ?>" 
                                                data-pk="<?php echo $data['id_consistance'] ?>" 
                                                data-url="<?php print_link("co_consistance/editfield/" . urlencode($data['id_consistance'])); ?>" 
                                                data-name="date" 
                                                data-title="Enter Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date']; ?> 
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
