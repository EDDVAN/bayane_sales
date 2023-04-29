<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_produit/add");
$can_edit = ACL::is_allowed("co_produit/edit");
$can_view = ACL::is_allowed("co_produit/view");
$can_delete = ACL::is_allowed("co_produit/delete");
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
                    <h4 class="record-title">View Produit</h4>
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
                        $rec_id = (!empty($data['id_produit']) ? urlencode($data['id_produit']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_produit">
                                        <th class="title"> Id Produit: </th>
                                        <td class="value"> <?php echo $data['id_produit']; ?></td>
                                    </tr>
                                    <tr  class="td-num_produit">
                                        <th class="title"> Num Produit: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['num_produit']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="num_produit" 
                                                data-title="Enter Num Produit" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['num_produit']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_consistance">
                                        <th class="title"> Id Consistance: </th>
                                        <td class="value">
                                            <div class="inline-page">
                                                <a class="btn btn-secondary open-page-inline" href="<?php print_link("co_consistance/view/" . urlencode($data['id_consistance'])); ?>">
                                                    <i class="material-icons ">layers</i> <?php echo $data['co_consistance_id_consistance'] ?>
                                                </a>
                                                <div class="page-content reset-grids d-none animated fadeIn"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr  class="td-titre_foncier">
                                        <th class="title"> Titre Foncier: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['titre_foncier']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="titre_foncier" 
                                                data-title="Enter Titre Foncier" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['titre_foncier']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-facade">
                                        <th class="title"> Facade: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['facade']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="facade" 
                                                data-title="Enter Facade" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['facade']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-voie">
                                        <th class="title"> Voie: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['voie']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="voie" 
                                                data-title="Enter Voie" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['voie']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-orientation">
                                        <th class="title"> Orientation: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['orientation']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="orientation" 
                                                data-title="Enter Orientation" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['orientation']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-superficie">
                                        <th class="title"> Superficie: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-value="<?php echo $data['superficie']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="superficie" 
                                                data-title="Enter Superficie" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['superficie']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-prix_m2">
                                        <th class="title"> Prix M2: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-value="<?php echo $data['prix_m2']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="prix_m2" 
                                                data-title="Enter Prix M2" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['prix_m2']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-prix">
                                        <th class="title"> Prix: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-value="<?php echo $data['prix']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="prix" 
                                                data-title="Enter Prix" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['prix']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-etat">
                                        <th class="title"> Etat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['etat']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="etat" 
                                                data-title="Enter Etat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['etat']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date">
                                        <th class="title"> Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['date']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="date" 
                                                data-title="Enter Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-par">
                                        <th class="title"> Par: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['par']; ?>" 
                                                data-pk="<?php echo $data['id_produit'] ?>" 
                                                data-url="<?php print_link("co_produit/editfield/" . urlencode($data['id_produit'])); ?>" 
                                                data-name="par" 
                                                data-title="Enter Par" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['par']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("co_produit/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("co_produit/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
