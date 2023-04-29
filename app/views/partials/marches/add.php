<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Marches</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="marches-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("marches/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="annee">Annee <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-annee"  value="<?php  echo $this->set_field_value('annee',""); ?>" type="number" placeholder="Enter Annee" step="1"  required="" name="annee"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="num_marche">Num Marche <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Enter Num Marche" id="ctrl-num_marche"  required="" rows="5" name="num_marche" class=" form-control"><?php  echo $this->set_field_value('num_marche',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="objet">Objet <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="Enter Objet" id="ctrl-objet"  required="" rows="5" name="objet" class=" form-control"><?php  echo $this->set_field_value('objet',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="prestataire">Prestataire <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-prestataire"  value="<?php  echo $this->set_field_value('prestataire',""); ?>" type="text" placeholder="Enter Prestataire"  required="" name="prestataire"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="responsable">Responsable <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <textarea placeholder="Enter Responsable" id="ctrl-responsable"  required="" rows="5" name="responsable" class=" form-control"><?php  echo $this->set_field_value('responsable',""); ?></textarea>
                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="num_aoo">Num Aoo <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <textarea placeholder="Enter Num Aoo" id="ctrl-num_aoo"  required="" rows="5" name="num_aoo" class=" form-control"><?php  echo $this->set_field_value('num_aoo',""); ?></textarea>
                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="statut_aoo">Statut Aoo <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-statut_aoo"  value="<?php  echo $this->set_field_value('statut_aoo',""); ?>" type="text" placeholder="Enter Statut Aoo"  required="" name="statut_aoo"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="montant">Montant <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-montant"  value="<?php  echo $this->set_field_value('montant',"0.00"); ?>" type="number" placeholder="Enter Montant" step="0.1"  required="" name="montant"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="date_os">Date Os <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input id="ctrl-date_os" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date_os',""); ?>" type="datetime" name="date_os" placeholder="Enter Date Os" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="delai">Delai <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-delai"  value="<?php  echo $this->set_field_value('delai',""); ?>" type="number" placeholder="Enter Delai" step="1"  required="" name="delai"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="id_prestataire">Id Prestataire <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-id_prestataire"  value="<?php  echo $this->set_field_value('id_prestataire',""); ?>" type="number" placeholder="Enter Id Prestataire" step="1"  required="" name="id_prestataire"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="id_docs">Id Docs <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-id_docs"  value="<?php  echo $this->set_field_value('id_docs',""); ?>" type="text" placeholder="Enter Id Docs"  required="" name="id_docs"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="decomptes">Decomptes <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-decomptes"  value="<?php  echo $this->set_field_value('decomptes',"0"); ?>" type="number" placeholder="Enter Decomptes" step="0.1"  required="" name="decomptes"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="reglement">Reglement <span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <input id="ctrl-reglement"  value="<?php  echo $this->set_field_value('reglement',"0"); ?>" type="number" placeholder="Enter Reglement" step="0.1"  required="" name="reglement"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="statut">Statut <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <input id="ctrl-statut"  value="<?php  echo $this->set_field_value('statut',"En cours"); ?>" type="text" placeholder="Enter Statut"  required="" name="statut"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="pourcentage">Pourcentage <span class="text-danger">*</span></label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <input id="ctrl-pourcentage"  value="<?php  echo $this->set_field_value('pourcentage',"0.00"); ?>" type="number" placeholder="Enter Pourcentage" step="0.1"  required="" name="pourcentage"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="montant_variation">Montant Variation <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-montant_variation"  value="<?php  echo $this->set_field_value('montant_variation',"0.00"); ?>" type="number" placeholder="Enter Montant Variation" step="0.1"  required="" name="montant_variation"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-4">
                                                                                                <label class="control-label" for="libelle_decompte">Libelle Decompte <span class="text-danger">*</span></label>
                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="">
                                                                                                    <input id="ctrl-libelle_decompte"  value="<?php  echo $this->set_field_value('libelle_decompte',""); ?>" type="text" placeholder="Enter Libelle Decompte"  required="" name="libelle_decompte"  class="form-control " />
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="date_os_approbation">Date Os Approbation <span class="text-danger">*</span></label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="input-group">
                                                                                                        <input id="ctrl-date_os_approbation" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date_os_approbation',""); ?>" type="datetime" name="date_os_approbation" placeholder="Enter Date Os Approbation" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                            <div class="input-group-append">
                                                                                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <label class="control-label" for="pole">Pole <span class="text-danger">*</span></label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="">
                                                                                                            <input id="ctrl-pole"  value="<?php  echo $this->set_field_value('pole',""); ?>" type="text" placeholder="Enter Pole"  required="" name="pole"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-4">
                                                                                                            <label class="control-label" for="marche_achat">Marche Achat <span class="text-danger">*</span></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="">
                                                                                                                <textarea placeholder="Enter Marche Achat" id="ctrl-marche_achat"  required="" rows="5" name="marche_achat" class=" form-control"><?php  echo $this->set_field_value('marche_achat',""); ?></textarea>
                                                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-4">
                                                                                                            <label class="control-label" for="type">Type <span class="text-danger">*</span></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="">
                                                                                                                <input id="ctrl-type"  value="<?php  echo $this->set_field_value('type',""); ?>" type="text" placeholder="Enter Type"  required="" name="type"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-4">
                                                                                                                <label class="control-label" for="convention">Convention <span class="text-danger">*</span></label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-8">
                                                                                                                <div class="">
                                                                                                                    <input id="ctrl-convention"  value="<?php  echo $this->set_field_value('convention',""); ?>" type="text" placeholder="Enter Convention"  required="" name="convention"  class="form-control " />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-4">
                                                                                                                    <label class="control-label" for="user">User <span class="text-danger">*</span></label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <div class="">
                                                                                                                        <input id="ctrl-user"  value="<?php  echo $this->set_field_value('user',""); ?>" type="text" placeholder="Enter User"  required="" name="user"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="audite_par">Audite Par <span class="text-danger">*</span></label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="">
                                                                                                                            <textarea placeholder="Enter Audite Par" id="ctrl-audite_par"  required="" rows="5" name="audite_par" class=" form-control"><?php  echo $this->set_field_value('audite_par',""); ?></textarea>
                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="date_ouverture">Date Ouverture <span class="text-danger">*</span></label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="input-group">
                                                                                                                            <input id="ctrl-date_ouverture" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date_ouverture',""); ?>" type="datetime" name="date_ouverture" placeholder="Enter Date Ouverture" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                                                <div class="input-group-append">
                                                                                                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-4">
                                                                                                                            <label class="control-label" for="contrat_architecte">Contrat Architecte <span class="text-danger">*</span></label>
                                                                                                                        </div>
                                                                                                                        <div class="col-sm-8">
                                                                                                                            <div class="">
                                                                                                                                <input id="ctrl-contrat_architecte"  value="<?php  echo $this->set_field_value('contrat_architecte',""); ?>" type="text" placeholder="Enter Contrat Architecte"  required="" name="contrat_architecte"  class="form-control " />
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <label class="control-label" for="reference">Reference <span class="text-danger">*</span></label>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-8">
                                                                                                                                <div class="">
                                                                                                                                    <textarea placeholder="Enter Reference" id="ctrl-reference"  required="" rows="5" name="reference" class=" form-control"><?php  echo $this->set_field_value('reference',""); ?></textarea>
                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <label class="control-label" for="alive">Alive <span class="text-danger">*</span></label>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-8">
                                                                                                                                <div class="">
                                                                                                                                    <input id="ctrl-alive"  value="<?php  echo $this->set_field_value('alive',"1"); ?>" type="number" placeholder="Enter Alive" step="1"  required="" name="alive"  class="form-control " />
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-sm-4">
                                                                                                                                    <label class="control-label" for="reception">Reception <span class="text-danger">*</span></label>
                                                                                                                                </div>
                                                                                                                                <div class="col-sm-8">
                                                                                                                                    <div class="input-group">
                                                                                                                                        <input id="ctrl-reception" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('reception',""); ?>" type="datetime" name="reception" placeholder="Enter Reception" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                                                            <div class="input-group-append">
                                                                                                                                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-sm-4">
                                                                                                                                        <label class="control-label" for="reception_definitive">Reception Definitive <span class="text-danger">*</span></label>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-sm-8">
                                                                                                                                        <div class="input-group">
                                                                                                                                            <input id="ctrl-reception_definitive" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('reception_definitive',""); ?>" type="datetime" name="reception_definitive" placeholder="Enter Reception Definitive" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                                                                                                <div class="input-group-append">
                                                                                                                                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-group ">
                                                                                                                                    <div class="row">
                                                                                                                                        <div class="col-sm-4">
                                                                                                                                            <label class="control-label" for="avenant_du">Avenant Du <span class="text-danger">*</span></label>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-8">
                                                                                                                                            <div class="">
                                                                                                                                                <input id="ctrl-avenant_du"  value="<?php  echo $this->set_field_value('avenant_du',"0"); ?>" type="number" placeholder="Enter Avenant Du" step="1"  required="" name="avenant_du"  class="form-control " />
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div class="form-group ">
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="col-sm-4">
                                                                                                                                                <label class="control-label" for="montant_actualise">Montant Actualise <span class="text-danger">*</span></label>
                                                                                                                                            </div>
                                                                                                                                            <div class="col-sm-8">
                                                                                                                                                <div class="">
                                                                                                                                                    <input id="ctrl-montant_actualise"  value="<?php  echo $this->set_field_value('montant_actualise',"0.00"); ?>" type="number" placeholder="Enter Montant Actualise" step="0.1"  required="" name="montant_actualise"  class="form-control " />
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <div class="form-group ">
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-sm-4">
                                                                                                                                                    <label class="control-label" for="avenant_du_libelle">Avenant Du Libelle <span class="text-danger">*</span></label>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-sm-8">
                                                                                                                                                    <div class="">
                                                                                                                                                        <input id="ctrl-avenant_du_libelle"  value="<?php  echo $this->set_field_value('avenant_du_libelle',""); ?>" type="text" placeholder="Enter Avenant Du Libelle"  required="" name="avenant_du_libelle"  class="form-control " />
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <div class="form-group ">
                                                                                                                                                <div class="row">
                                                                                                                                                    <div class="col-sm-4">
                                                                                                                                                        <label class="control-label" for="id_convention">Id Convention <span class="text-danger">*</span></label>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="col-sm-8">
                                                                                                                                                        <div class="">
                                                                                                                                                            <input id="ctrl-id_convention"  value="<?php  echo $this->set_field_value('id_convention',"0"); ?>" type="number" placeholder="Enter Id Convention" step="1"  required="" name="id_convention"  class="form-control " />
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group ">
                                                                                                                                                    <div class="row">
                                                                                                                                                        <div class="col-sm-4">
                                                                                                                                                            <label class="control-label" for="RIB">Rib <span class="text-danger">*</span></label>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="col-sm-8">
                                                                                                                                                            <div class="">
                                                                                                                                                                <input id="ctrl-RIB"  value="<?php  echo $this->set_field_value('RIB',""); ?>" type="text" placeholder="Enter Rib"  required="" name="RIB"  class="form-control " />
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                                                                                                    <div class="form-ajax-status"></div>
                                                                                                                                                    <button class="btn btn-primary" type="submit">
                                                                                                                                                        Submit
                                                                                                                                                        <i class="material-icons">send</i>
                                                                                                                                                    </button>
                                                                                                                                                </div>
                                                                                                                                            </form>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </section>
