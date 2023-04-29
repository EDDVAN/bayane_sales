<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("co_produit/add");
$can_edit = ACL::is_allowed("co_produit/edit");
$can_view = ACL::is_allowed("co_produit/view");
$can_delete = ACL::is_allowed("co_produit/delete");
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
                    <h4 class="record-title">Produits Libre</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("". isset($_GET['id_vente']) ? (!empty($_GET['id_vente']) ? "co_recette/add?id_vente=" . $_GET['id_vente'] : "co_recette/add") : "co_recette/add" ."") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Produit 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('co_produit/'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_produit'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('co_produit'); ?>">
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
                            <div id="co_produit-disponible-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-primary text-light">
                                            <tr>
                                                <th class="td-btn"></th>
                                                <th  <?php echo (get_value('orderby')=='num_produit' ? 'class="sortedby td-num_produit"' : null); ?>>
                                                    <?php Html :: get_field_order_link('num_produit', "Num Produit"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='id_consistance' ? 'class="sortedby td-id_consistance"' : null); ?>>
                                                    <?php Html :: get_field_order_link('id_consistance', "Consistance"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='titre_foncier' ? 'class="sortedby td-titre_foncier"' : null); ?>>
                                                    <?php Html :: get_field_order_link('titre_foncier', "Titre Foncier"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='facade' ? 'class="sortedby td-facade"' : null); ?>>
                                                    <?php Html :: get_field_order_link('facade', "Facade"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='voie' ? 'class="sortedby td-voie"' : null); ?>>
                                                    <?php Html :: get_field_order_link('voie', "Voie"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='orientation' ? 'class="sortedby td-orientation"' : null); ?>>
                                                    <?php Html :: get_field_order_link('orientation', "Orientation"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='superficie' ? 'class="sortedby td-superficie"' : null); ?>>
                                                    <?php Html :: get_field_order_link('superficie', "Superficie"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='prix_m2' ? 'class="sortedby td-prix_m2"' : null); ?>>
                                                    <?php Html :: get_field_order_link('prix_m2', "Prix M2"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='prix' ? 'class="sortedby td-prix"' : null); ?>>
                                                    <?php Html :: get_field_order_link('prix', "Prix"); ?>
                                                </th>
                                                <th  class="td-Vendre"> Vendre</th>
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
                                            $rec_id = (!empty($data['id_produit']) ? urlencode($data['id_produit']) : null);
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
                                                            <a class="dropdown-item" href="<?php print_link("co_produit/view/$rec_id"); ?>">
                                                                <i class="material-icons">visibility</i> View 
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="dropdown-item" href="<?php print_link("co_produit/edit/$rec_id"); ?>">
                                                                <i class="material-icons">edit</i> Edit
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_delete){ ?>
                                                            <a  class="dropdown-item record-delete-btn" href="<?php print_link("co_produit/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                <i class="material-icons">clear</i> Delete 
                                                            </a>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="td-num_produit">
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
                                                <td class="td-id_consistance">
                                                    <div class="inline-page">
                                                        <a class="btn btn-secondary open-page-inline" href="<?php print_link("co_consistance/view/" . urlencode($data['id_consistance'])); ?>">
                                                            <i class="material-icons ">layers</i> <?php echo $data['co_consistance_id_consistance'] ?>
                                                        </a>
                                                        <div class="page-content reset-grids d-none animated fadeIn"></div>
                                                    </div>
                                                </td>
                                                <td class="td-titre_foncier">
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
                                                <td class="td-facade">
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
                                                <td class="td-voie">
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
                                                <td class="td-orientation">
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
                                                <td class="td-superficie">
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
                                                <td class="td-prix_m2">
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
                                                <td class="td-prix">
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
                                                <td class="td-Vendre"> <a class="btn btn btn-primary my-1" href="/bayane_sales/co_vente/add?id_produit=<?php echo $data['id_produit'];?>&prix_vente=<?php echo intval(str_replace(',', '', $data['prix']));?>"><i class="material-icons ">keyboard_arrow_right</i>Vendre</a></td>
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
                                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("co_produit/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                                                                    <?php Html :: import_form('co_produit/import_data' , "Import Data", 'CSV'); ?>
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
