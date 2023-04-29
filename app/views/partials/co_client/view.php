<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_client/add");
$can_edit = ACL::is_allowed("co_client/edit");
$can_view = ACL::is_allowed("co_client/view");
$can_delete = ACL::is_allowed("co_client/delete");
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
                    <h4 class="record-title">View Client</h4>
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
                        $rec_id = (!empty($data['id_client']) ? urlencode($data['id_client']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_client">
                                        <th class="title"> Id Client: </th>
                                        <td class="value"> <?php echo $data['id_client']; ?></td>
                                    </tr>
                                    <tr  class="td-nom">
                                        <th class="title"> Nom: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nom']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="nom" 
                                                data-title="Enter Nom" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nom']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-prenom">
                                        <th class="title"> Prenom: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['prenom']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="prenom" 
                                                data-title="Enter Prenom" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['prenom']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cin">
                                        <th class="title"> Cin: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cin']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="cin" 
                                                data-title="Enter Cin" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['cin']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-mobile">
                                        <th class="title"> Mobile: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['mobile']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="mobile" 
                                                data-title="Enter Mobile" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['mobile']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['email']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="email" 
                                                data-title="Enter Email" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['email']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-adresse">
                                        <th class="title"> Adresse: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['adresse']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="adresse" 
                                                data-title="Enter Adresse" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['adresse']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_naissance">
                                        <th class="title"> Date Naissance: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_naissance']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="date_naissance" 
                                                data-title="Enter Date Naissance" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_naissance']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-adresse2">
                                        <th class="title"> Adresse 2: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['adresse2']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="adresse2" 
                                                data-title="Enter Adresse2" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['adresse2']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-telephone">
                                        <th class="title"> Telephone: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['telephone']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="telephone" 
                                                data-title="Enter Telephone" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['telephone']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-associer">
                                        <th class="title"> Associer: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['associer']; ?>" 
                                                data-pk="<?php echo $data['id_client'] ?>" 
                                                data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                data-name="associer" 
                                                data-title="Enter Associer" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['associer']; ?> 
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
                                                    <a class="btn btn-sm btn-info"  href="<?php print_link("co_client/edit/$rec_id"); ?>">
                                                        <i class="material-icons">edit</i> Edit
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_delete){ ?>
                                                    <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("co_client/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
