<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_vente/add");
$can_edit = ACL::is_allowed("co_vente/edit");
$can_view = ACL::is_allowed("co_vente/view");
$can_delete = ACL::is_allowed("co_vente/delete");
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
                    <h4 class="record-title">View Vente</h4>
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
                        $rec_id = (!empty($data['id_vente']) ? urlencode($data['id_vente']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_vente">
                                        <th class="title"> Id Vente: </th>
                                        <td class="value"> <?php echo $data['id_vente']; ?></td>
                                    </tr>
                                    <tr  class="td-id_dossier">
                                        <th class="title"> Id Dossier: </th>
                                        <td class="value">
                                            <div class="inline-page">
                                                <a class="btn btn-light open-page-inline" href="<?php print_link("co_dossier_client/view/" . urlencode($data['id_dossier'])); ?>">
                                                    <i class="material-icons ">folder_shared</i> <?php echo $data['co_dossier_client_id_dossier'] ?>
                                                </a>
                                                <div class="page-content reset-grids d-none animated fadeIn"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_produit">
                                        <th class="title"> Id Produit: </th>
                                        <td class="value">
                                            <div class="inline-page">
                                                <a class="btn btn-light open-page-inline" href="<?php print_link("co_produit/view/" . urlencode($data['id_produit'])); ?>">
                                                    <i class="material-icons ">fullscreen</i> <?php echo $data['co_produit_num_produit'] ?>
                                                </a>
                                                <div class="page-content reset-grids d-none animated fadeIn"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr  class="td-date">
                                        <th class="title"> Date: </th>
                                        <td class="value"> <?php echo $data['date']; ?></td>
                                    </tr>
                                    <tr  class="td-promotion">
                                        <th class="title"> Promotion: </th>
                                        <td class="value"> <?php echo $data['promotion']; ?></td>
                                    </tr>
                                    <tr  class="td-prix_vente">
                                        <th class="title"> Prix Vente: </th>
                                        <td class="value"> <?php echo $data['prix_vente']; ?></td>
                                    </tr>
                                    <tr  class="td-condition_vente">
                                        <th class="title"> Condition Vente: </th>
                                        <td class="value"> <?php echo $data['condition_vente']; ?></td>
                                    </tr>
                                    <tr  class="td-statut">
                                        <th class="title"> Statut: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['statut']; ?>" 
                                                data-pk="<?php echo $data['id_vente'] ?>" 
                                                data-url="<?php print_link("co_vente/editfield/" . urlencode($data['id_vente'])); ?>" 
                                                data-name="statut" 
                                                data-title="Enter Statut" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['statut']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-notaire">
                                        <th class="title"> Notaire: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['notaire']; ?>" 
                                                data-pk="<?php echo $data['id_vente'] ?>" 
                                                data-url="<?php print_link("co_vente/editfield/" . urlencode($data['id_vente'])); ?>" 
                                                data-name="notaire" 
                                                data-title="Enter Notaire" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['notaire']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-credit">
                                        <th class="title"> Credit: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $credit); ?>' 
                                                data-value="<?php echo $data['credit']; ?>" 
                                                data-pk="<?php echo $data['id_vente'] ?>" 
                                                data-url="<?php print_link("co_vente/editfield/" . urlencode($data['id_vente'])); ?>" 
                                                data-name="credit" 
                                                data-title="Enter Credit" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="radiolist" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['credit']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-accord">
                                        <th class="title"> Accord: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['accord']; ?>" 
                                                data-pk="<?php echo $data['id_vente'] ?>" 
                                                data-url="<?php print_link("co_vente/editfield/" . urlencode($data['id_vente'])); ?>" 
                                                data-name="accord" 
                                                data-title="Enter Accord" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['accord']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-observation">
                                        <th class="title"> Observation: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['observation']; ?>" 
                                                data-pk="<?php echo $data['id_vente'] ?>" 
                                                data-url="<?php print_link("co_vente/editfield/" . urlencode($data['id_vente'])); ?>" 
                                                data-name="observation" 
                                                data-title="Enter Observation" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['observation']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-attachment">
                                        <th class="title"> Attachment: </th>
                                        <td class="value">
                                            <?php
                                            if ($data['attachment'])
                                            {
                                            $new_attach = explode(',',$data['attachment']);
                                            $i = 0;
                                            foreach($new_attach as $attach)
                                            {
                                            $i++;
                                            ?><a href="<?php echo $attach; ?>">Attachment <?php echo $i;?></a> <br><?php
                                                }
                                                }else
                                                {
                                                ?><span>No Attachment</span><?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr  class="td-co_dossier_client_id_dossier">
                                            <th class="title"> Co Dossier Client Id Dossier: </th>
                                            <td class="value"> <?php echo $data['co_dossier_client_id_dossier']; ?></td>
                                        </tr>
                                        <tr  class="td-co_dossier_client_part_client">
                                            <th class="title"> Co Dossier Client Part Client: </th>
                                            <td class="value"> <?php echo $data['co_dossier_client_part_client']; ?></td>
                                        </tr>
                                        <tr  class="td-co_dossier_client_etat">
                                            <th class="title"> Co Dossier Client Etat: </th>
                                            <td class="value"> <?php echo $data['co_dossier_client_etat']; ?></td>
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
                                                    <a class="btn btn-sm btn-info"  href="<?php print_link("co_vente/edit/$rec_id"); ?>">
                                                        <i class="material-icons">edit</i> Edit
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_delete){ ?>
                                                    <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("co_vente/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
