<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("v_vente/add");
$can_edit = ACL::is_allowed("v_vente/edit");
$can_view = ACL::is_allowed("v_vente/view");
$can_delete = ACL::is_allowed("v_vente/delete");
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
                    <h4 class="record-title">Produits Vendu</h4>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('v_vente/'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('v_vente'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('v_vente'); ?>">
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
                            <div id="v_vente-vendu-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-primary text-light">
                                            <tr>
                                                <th  class="td-id_vente"> Id Vente</th>
                                                <th  <?php echo (get_value('orderby')=='num_produit' ? 'class="sortedby td-num_produit"' : null); ?>>
                                                    <?php Html :: get_field_order_link('num_produit', "Num Produit"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='id_consistance' ? 'class="sortedby td-id_consistance"' : null); ?>>
                                                    <?php Html :: get_field_order_link('id_consistance', "Consistance"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='id_dossier' ? 'class="sortedby td-id_dossier"' : null); ?>>
                                                    <?php Html :: get_field_order_link('id_dossier', "Dossier"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='co_client_nom' ? 'class="sortedby td-co_client_nom"' : null); ?>>
                                                    <?php Html :: get_field_order_link('co_client_nom', "Nom"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='co_client_prenom' ? 'class="sortedby td-co_client_prenom"' : null); ?>>
                                                    <?php Html :: get_field_order_link('co_client_prenom', "Prenom"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='co_client_cin' ? 'class="sortedby td-co_client_cin"' : null); ?>>
                                                    <?php Html :: get_field_order_link('co_client_cin', "CIN"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='date' ? 'class="sortedby td-date"' : null); ?>>
                                                    <?php Html :: get_field_order_link('date', "Date"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='prix_vente' ? 'class="sortedby td-prix_vente"' : null); ?>>
                                                    <?php Html :: get_field_order_link('prix_vente', "Prix Vente"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='notaire' ? 'class="sortedby td-notaire"' : null); ?>>
                                                    <?php Html :: get_field_order_link('notaire', "Notaire"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='credit' ? 'class="sortedby td-credit"' : null); ?>>
                                                    <?php Html :: get_field_order_link('credit', "Credit"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='accord' ? 'class="sortedby td-accord"' : null); ?>>
                                                    <?php Html :: get_field_order_link('accord', "Accord"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='superficie' ? 'class="sortedby td-superficie"' : null); ?>>
                                                    <?php Html :: get_field_order_link('superficie', "Superficie"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='recettes' ? 'class="sortedby td-recettes"' : null); ?>>
                                                    <?php Html :: get_field_order_link('recettes', "Authorisation de Versement"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='versement' ? 'class="sortedby td-versement"' : null); ?>>
                                                    <?php Html :: get_field_order_link('versement', "Versement"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='id_adm' ? 'class="sortedby td-id_adm"' : null); ?>>
                                                    <?php Html :: get_field_order_link('id_adm', "Id Adm"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='date_adm' ? 'class="sortedby td-date_adm"' : null); ?>>
                                                    <?php Html :: get_field_order_link('date_adm', "Date Adm"); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='observation' ? 'class="sortedby td-observation"' : null); ?>>
                                                    <?php Html :: get_field_order_link('observation', "Observation"); ?>
                                                </th>
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
                                            $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <td class="td-id_vente">
                                                    <a size="sm" class="btn btn-link page-modal" href="<?php print_link("co_vente/view/" . urlencode($data['id_vente'])) ?>">
                                                        <i class="material-icons ">move_to_inbox</i> <?php echo $data['co_vente_id_vente'] ?>
                                                    </a>
                                                </td>
                                                <td class="td-num_produit"> <?php echo $data['num_produit']; ?></td>
                                                <td class="td-id_consistance">
                                                    <div class="inline-page">
                                                        <a class="btn btn-secondary open-page-inline" href="<?php print_link("co_consistance/view/" . urlencode($data['id_consistance'])); ?>">
                                                            <i class="material-icons ">layers</i> <?php echo $data['co_consistance_id_consistance'] ?>
                                                        </a>
                                                        <div class="page-content reset-grids d-none animated fadeIn"></div>
                                                    </div>
                                                </td>
                                                <td class="td-id_dossier">
                                                    <div class="inline-page">
                                                        <a class="btn btn-secondary open-page-inline" href="<?php print_link("co_dossier_client/view/" . urlencode($data['id_dossier'])); ?>">
                                                            <i class="material-icons ">folder_shared</i> <?php echo $data['co_dossier_client_id_dossier'] ?>
                                                        </a>
                                                        <div class="page-content reset-grids d-none animated fadeIn"></div>
                                                    </div>
                                                </td>
                                                <td class="td-co_client_nom">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['co_client_nom']; ?>" 
                                                        data-pk="<?php echo $data[''] ?>" 
                                                        data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                        data-name="nom" 
                                                        data-title="Enter Nom" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['co_client_nom']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-co_client_prenom">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['co_client_prenom']; ?>" 
                                                        data-pk="<?php echo $data[''] ?>" 
                                                        data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                        data-name="prenom" 
                                                        data-title="Enter Prenom" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['co_client_prenom']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-co_client_cin">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['co_client_cin']; ?>" 
                                                        data-pk="<?php echo $data[''] ?>" 
                                                        data-url="<?php print_link("co_client/editfield/" . urlencode($data['id_client'])); ?>" 
                                                        data-name="cin" 
                                                        data-title="Enter Cin" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['co_client_cin']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-date"> <?php echo $data['date']; ?></td>
                                                <td class="td-prix_vente"> <?php echo $data['prix_vente']; ?></td>
                                                <td class="td-notaire"> <?php echo $data['notaire']; ?></td>
                                                <td class="td-credit"> <?php echo $data['credit']; ?></td>
                                                <td class="td-accord"> <?php echo $data['accord']; ?></td>
                                                <td class="td-superficie"> <?php echo $data['superficie']; ?></td>
                                                <td class="td-recettes"><a href="/bayane_sales/co_recette?id_vente=<?php echo $data['id_vente']; ?>"><i class="material-icons ">featured_play_list</i> <?php echo $data['recettes']?></a></td>
                                                <td class="td-versement"><a href="/bayane_sales/co_versement?id_vente=<?php echo $data['id_vente']; ?>"><i class="material-icons ">move_to_inbox</i> <?php echo $data['versement']?></a></td>
                                                <td class="td-id_adm"> <?php echo $data['id_adm']; ?></td>
                                                <td class="td-date_adm"> <?php echo $data['date_adm']; ?></td>
                                                <td class="td-observation"> <?php echo $data['observation']; ?></td>
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
