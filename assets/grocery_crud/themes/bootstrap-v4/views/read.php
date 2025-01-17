<?php
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/bootstrap/bootstrap.min.css');
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/elusive-icons/css/elusive-icons.min.css');
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/common.css');
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/general.css');
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/add-edit-form.css');
$this->set_css($this->default_theme_path.'/bootstrap-v4/css/main.css');

if ($this->config->environment == 'production') {
    $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/build/js/global-libs.min.js');
} else {
    $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/jquery.form.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/common/cache-library.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/common/common.js');
}

include(__DIR__ . '/common_javascript_vars.php');
?>
<div class="crud-form" data-unique-hash="<?php echo $unique_hash; ?>">
    <div class="container gc-container" style="margin:0 !important;">
        <div class="row">
            <div class="col-md-12">
                <div class="table-label">
                    <div class="floatL l5">
                        <?php echo $this->l('list_view'); ?> <?php echo $subject?>
                    </div>
                    <div class="floatR r5 gc-full-width">
                        <i class="fa fa-expand el el-resize-full"></i>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-container table-container">
                    <?php echo form_open( $update_url, 'method="post" id="crudForm"  enctype="multipart/form-data" class="form-horizontal"'); ?>

                    <?php foreach($fields as $field) { ?>
                        <div class="form-group gcrud-form-group">
                            <label class="col-sm-3 control-label">
                                <?php echo $input_fields[$field->field_name]->display_as?>:
                            </label>
                            <div class="col-sm-9 read-row">
                                <?php echo $input_fields[$field->field_name]->input; ?>
                            </div>
                        </div>
                    <?php }?>

                    <?php if(!empty($hidden_fields)){?>
                        <!-- Start of hidden inputs -->
                        <?php
                        foreach($hidden_fields as $hidden_field){
                            echo $hidden_field->input;
                        }
                        ?>
                        <!-- End of hidden inputs -->
                    <?php } ?>
                    <?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
                    <div class="form-group gcrud-form-group">
                        <div id='report-error' class='report-div error'></div>
                        <div id='report-success' class='report-div success'></div>
                    </div>

                    <div class="form-group gcrud-form-group">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php 	if(!$this->unset_back_to_list) { ?>
                                <button class="btn btn-secondary cancel-button" type="button" onclick="window.location = '<?php echo $list_url; ?>'" >
                                    <i class="el el-return-key"></i>
                                    <?php echo $this->l('form_back_to_list'); ?>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var validation_url = '<?php echo $validation_url?>';
    var list_url = '<?php echo $list_url?>';

    var message_alert_edit_form = "<?php echo $this->l('alert_edit_form')?>";
    var message_update_error = "<?php echo $this->l('update_error')?>";
</script>