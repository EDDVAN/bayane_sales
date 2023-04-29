<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_vente_trace/add");
$can_edit = ACL::is_allowed("co_vente_trace/edit");
$can_view = ACL::is_allowed("co_vente_trace/view");
$can_delete = ACL::is_allowed("co_vente_trace/delete");
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
                    <h4 class="record-title"> Vente Trace</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("co_vente_trace/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Vente Trace 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('co_vente_trace'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_vente_trace'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_vente_trace'); ?>">
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
                            <div id="co_vente_trace-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-primary text-light">
                                            <tr>
                                                <th class="td-btn"></th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-id_vente"> Id Vente</th>
                                                <th  class="td-id_dossier"> Id Dossier</th>
                                                <th  class="td-id_produit"> Id Produit</th>
                                                <th  class="td-date"> Date</th>
                                                <th  class="td-promotion"> Promotion</th>
                                                <th  class="td-prix_vente"> Prix Vente</th>
                                                <th  class="td-condition_vente"> Condition Vente</th>
                                                <th  class="td-statut"> Statut</th>
                                                <th  class="td-notaire"> Notaire</th>
                                                <th  class="td-credit"> Credit</th>
                                                <th  class="td-accord"> Accord</th>
                                                <th  class="td-datecre"> Datecre</th>
                                                <th  class="td-par"> Par</th>
                                                <th  class="td-id_adm"> Id Adm</th>
                                                <th  class="td-date_adm"> Date Adm</th>
                                                <th  class="td-observation"> Observation</th>
                                                <th  class="td-user_trace"> User Trace</th>
                                                <th  class="td-date_trace"> Date Trace</th>
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
                                                <td class="page-list-action td-btn">
                                                    <div class="dropdown" >
                                                        <button data-toggle="dropdown" class="dropdown-toggle btn btn-primary btn-sm">
                                                            <i class="material-icons">menu</i> 
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($can_view){ ?>
                                                            <a class="dropdown-item" href="<?php print_link("co_vente_trace/view/$rec_id"); ?>">
                                                                <i class="material-icons">visibility</i> View 
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="dropdown-item" href="<?php print_link("co_vente_trace/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a  class="dropdown-item record-delete-btn" href="<?php print_link("co_vente_trace/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                <i class="material-icons">clear</i> Delete 
                                                            </a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="td-id"> <?php echo $data['id']; ?></td>
                                                <td class="td-id_vente">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_vente']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-id_dossier">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_dossier']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="id_dossier" 
                                                        data-title="Enter Id Dossier" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['id_dossier']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-id_produit">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_produit']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="id_produit" 
                                                        data-title="Enter Id Produit" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['id_produit']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-date">
                                                    <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['date']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-promotion">
                                                    <span <?php if($can_edit){ ?> data-step="0.1" 
                                                        data-value="<?php echo $data['promotion']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="promotion" 
                                                        data-title="Enter Promotion" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['promotion']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-prix_vente">
                                                    <span <?php if($can_edit){ ?> data-step="0.1" 
                                                        data-value="<?php echo $data['prix_vente']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="prix_vente" 
                                                        data-title="Enter Prix Vente" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['prix_vente']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-condition_vente">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['condition_vente']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="condition_vente" 
                                                        data-title="Enter Condition Vente" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['condition_vente']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-statut">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['statut']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-notaire">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['notaire']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-credit">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['credit']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="credit" 
                                                        data-title="Enter Credit" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['credit']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-accord">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['accord']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-datecre">
                                                    <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['datecre']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="datecre" 
                                                        data-title="Enter Datecre" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['datecre']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-par">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['par']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-id_adm">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_adm']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="id_adm" 
                                                        data-title="Enter Id Adm" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['id_adm']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-date_adm">
                                                    <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['date_adm']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="date_adm" 
                                                        data-title="Enter Date Adm" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['date_adm']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-observation">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['observation']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <td class="td-user_trace">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_trace']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="user_trace" 
                                                        data-title="Enter User Trace" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['user_trace']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-date_trace">
                                                    <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['date_trace']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("co_vente_trace/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="date_trace" 
                                                        data-title="Enter Date Trace" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['date_trace']; ?> 
                                                    </span>
                                                </td>
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
                                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("co_vente_trace/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
