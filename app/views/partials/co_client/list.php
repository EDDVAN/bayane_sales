<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_client/add");
$can_edit = ACL::is_allowed("co_client/edit");
$can_view = ACL::is_allowed("co_client/view");
$can_delete = ACL::is_allowed("co_client/delete");
?>
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
                    <h4 class="record-title">Clients</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("co_client/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Client 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('co_client'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_client'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_client'); ?>">
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
                            <div id="co_client-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-primary text-light">
                                            <tr>
                                                <th class="td-btn"></th>
                                                <th  class="td-id_client"> Client</th>
                                                <th  <?php echo (get_value('orderby')=='nom' ? 'class="sortedby td-nom"' : null); ?>>
                                                    <?php Html :: get_field_order_link('nom', "Nom"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='prenom' ? 'class="sortedby td-prenom"' : null); ?>>
                                                    <?php Html :: get_field_order_link('prenom', "Prenom"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='cin' ? 'class="sortedby td-cin"' : null); ?>>
                                                    <?php Html :: get_field_order_link('cin', "Cin"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='mobile' ? 'class="sortedby td-mobile"' : null); ?>>
                                                    <?php Html :: get_field_order_link('mobile', "Mobile"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='email' ? 'class="sortedby td-email"' : null); ?>>
                                                    <?php Html :: get_field_order_link('email', "Email"); ?>
                                                </th>
                                                <th  class="td-adresse"> Adresse</th>
                                                <th  <?php echo (get_value('orderby')=='date_naissance' ? 'class="sortedby td-date_naissance"' : null); ?>>
                                                    <?php Html :: get_field_order_link('date_naissance', "Date Naissance"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='adresse2' ? 'class="sortedby td-adresse2"' : null); ?>>
                                                    <?php Html :: get_field_order_link('adresse2', "Adresse 2"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='telephone' ? 'class="sortedby td-telephone"' : null); ?>>
                                                    <?php Html :: get_field_order_link('telephone', "Telephone"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='associer' ? 'class="sortedby td-associer"' : null); ?>>
                                                    <?php Html :: get_field_order_link('associer', "Associer"); ?>
                                                </th>
                                                <th  class="td-Create_Dossier"> Create Dossier</th>
                                                <th  class="td-attachment"> Attachment</th>
                                                <th  class="td-Vente"> Vente</th>
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
                                            $rec_id = (!empty($data['id_client']) ? urlencode($data['id_client']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <td class="page-list-action td-btn">
                                                    <div class="dropdown" >
                                                        <button data-toggle="dropdown" class="dropdown-toggle btn btn-primary btn-sm">
                                                            <i class="material-icons">menu</i> 
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($can_view){ ?>
                                                            <a class="dropdown-item" href="<?php print_link("co_client/view/$rec_id"); ?>">
                                                                <i class="material-icons">visibility</i> View 
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="dropdown-item" href="<?php print_link("co_client/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a  class="dropdown-item record-delete-btn" href="<?php print_link("co_client/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                <i class="material-icons">clear</i> Delete 
                                                            </a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="td-id_client"> <?php echo $data['id_client']; ?></td>
                                                <td class="td-nom">
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
                                                <td class="td-prenom">
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
                                                <td class="td-cin"> <a href="/bayane_sales/co_dossier_client?id_client=<?php echo $data['id_client'];?>"><?php echo $data['cin']; ?></a></td>
                                                <td class="td-mobile">
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
                                                <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
                                                <td class="td-adresse">
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
                                                <td class="td-date_naissance">
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
                                                <td class="td-adresse2">
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
                                                <td class="td-telephone"><a href="<?php print_link("tel:$data[telephone]") ?>"><?php echo $data['telephone']; ?></a></td>
                                                <td class="td-associer">
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
                                                <td class="td-Create_Dossier"> <a class="btn btn btn-primary my-1" href="/bayane_sales/co_dossier_client/add?id_client=<?php echo $data['id_client'];?>"><i class="material-icons ">keyboard_arrow_right</i> Add Dossier</a></td>
                                                <td class="td-attachment"><?php
                                                    if ($data['attachment'])
                                                    {
                                                    $new_attach = explode(',',$data['attachment']);
                                                    $i = 0;
                                                    foreach($new_attach as $attach)
                                                    {
                                                    $i++;
                                                    ?><a href="<?php echo $attach; ?>"><i class="material-icons ">file_download</i> Attachment <?php echo $i;?></a> <br><?php
                                                        }
                                                        }else
                                                        {
                                                        ?><span>No Attachment</span><?php
                                                        }
                                                    ?></td>
                                                    <td class="td-Vente"> <a class="btn btn btn-primary my-1" href="co_vente?id_client=<?php echo $data['id_client'];?>"><i class="material-icons ">keyboard_arrow_right</i> Vente</a></td>
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
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("co_client/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="material-icons">clear</i> Delete Selected
                                                    </button>
                                                    <?php } ?>
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
