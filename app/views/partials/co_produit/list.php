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
    <div  class="">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav nav-justified nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-1-Page1" role="tab" aria-selected="true">
                                        DISPONIBLE
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page2" role="tab" aria-selected="true">
                                        EN COURS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page3" role="tab" aria-selected="true">
                                        VENDU
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("co_produit/disponible?limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page2" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("v_vente/reserve?limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page3" role="tabpanel">
                                    <div class=" ">
                                        <?php  
                                        $this->render_page("v_vente/vendu?limit_count=20"); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
