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
                    <h4 class="record-title">View  V Auth Vers</h4>
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
                        $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_versement">
                                        <th class="title"> Id Versement: </th>
                                        <td class="value"> <?php echo $data['id_versement']; ?></td>
                                    </tr>
                                    <tr  class="td-date_versement">
                                        <th class="title"> Date Versement: </th>
                                        <td class="value"> <?php echo $data['date_versement']; ?></td>
                                    </tr>
                                    <tr  class="td-date_valeur">
                                        <th class="title"> Date Valeur: </th>
                                        <td class="value"> <?php echo $data['date_valeur']; ?></td>
                                    </tr>
                                    <tr  class="td-cin">
                                        <th class="title"> Cin: </th>
                                        <td class="value"> <?php echo $data['cin']; ?></td>
                                    </tr>
                                    <tr  class="td-montant">
                                        <th class="title"> Montant: </th>
                                        <td class="value"> <?php echo $data['montant']; ?></td>
                                    </tr>
                                    <tr  class="td-ref_versement">
                                        <th class="title"> Ref Versement: </th>
                                        <td class="value"> <?php echo $data['ref_versement']; ?></td>
                                    </tr>
                                    <tr  class="td-ref_rapprochement">
                                        <th class="title"> Ref Rapprochement: </th>
                                        <td class="value"> <?php echo $data['ref_rapprochement']; ?></td>
                                    </tr>
                                    <tr  class="td-rib">
                                        <th class="title"> Rib: </th>
                                        <td class="value"> <?php echo $data['rib']; ?></td>
                                    </tr>
                                    <tr  class="td-num_produit">
                                        <th class="title"> Num Produit: </th>
                                        <td class="value"> <?php echo $data['num_produit']; ?></td>
                                    </tr>
                                    <tr  class="td-projet">
                                        <th class="title"> Projet: </th>
                                        <td class="value"> <?php echo $data['projet']; ?></td>
                                    </tr>
                                    <tr  class="td-localite">
                                        <th class="title"> Localite: </th>
                                        <td class="value"> <?php echo $data['localite']; ?></td>
                                    </tr>
                                    <tr  class="td-zone">
                                        <th class="title"> Zone: </th>
                                        <td class="value"> <?php echo $data['zone']; ?></td>
                                    </tr>
                                    <tr  class="td-nom">
                                        <th class="title"> Nom: </th>
                                        <td class="value"> <?php echo $data['nom']; ?></td>
                                    </tr>
                                    <tr  class="td-prenom">
                                        <th class="title"> Prenom: </th>
                                        <td class="value"> <?php echo $data['prenom']; ?></td>
                                    </tr>
                                    <tr  class="td-adresse">
                                        <th class="title"> Adresse: </th>
                                        <td class="value"> <?php echo $data['adresse']; ?></td>
                                    </tr>
                                    <tr  class="td-libelle">
                                        <th class="title"> Libelle: </th>
                                        <td class="value"> <?php echo $data['libelle']; ?></td>
                                    </tr>
                                    <tr  class="td-id_tranche">
                                        <th class="title"> Id Tranche: </th>
                                        <td class="value"> <?php echo $data['id_tranche']; ?></td>
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
