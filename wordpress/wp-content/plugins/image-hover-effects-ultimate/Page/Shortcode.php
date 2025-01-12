<?php

namespace OXI_IMAGE_HOVER_PLUGINS\Page;

class Shortcode {

    /**
     * Database Parent Table
     *
     * @since 9.3.0
     */
    public $parent_table;

    /**
     * Database Import Table
     *
     * @since 9.3.0
     */
    public $child_table;

    /**
     * Database Import Table
     *
     * @since 9.3.0
     */
    public $import_table;

    /**
     * Define $wpdb
     *
     * @since 9.3.0
     */
    public $wpdb;

    use \OXI_IMAGE_HOVER_PLUGINS\Helper\Public_Helper;
    use \OXI_IMAGE_HOVER_PLUGINS\Helper\CSS_JS_Loader;

    /**
     * Constructor of Oxilab tabs Home Page
     *
     * @since 9.3.0
     */
    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $this->wpdb->prefix . 'image_hover_ultimate_style';
        $this->child_table = $this->wpdb->prefix . 'image_hover_ultimate_list';
        $this->import_table = $this->wpdb->prefix . 'oxi_div_import';
        $this->CSSJS_load();
        $this->Render();
    }

    public function CSSJS_load() {


        $this->manual_import_style();
        $this->admin_css_loader();
        $this->admin_home();
        $this->admin_rest_api();
        apply_filters('oxi-image-hover-plugin/admin_menu', TRUE);
    }

    /**
     * Admin Notice JS file loader
     * @return void
     */
    public function admin_rest_api() {
        wp_enqueue_script('oxi-image-hover-shortcode', OXI_IMAGE_HOVER_URL . '/assets/backend/js/shortcode.js', false, OXI_IMAGE_HOVER_TEXTDOMAIN);
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function safe_path($path) {

        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    public function manual_import_style() {
        if (!empty($_REQUEST['_wpnonce'])) {
            $nonce = $_REQUEST['_wpnonce'];
        }

        if (!empty($_POST['importdatasubmit']) && $_POST['importdatasubmit'] == 'Save') {
            if (!wp_verify_nonce($nonce, 'image-hover-effects-ultimate-import')) {
                die('You do not have sufficient permissions to access this page.');
            } else {
                if (apply_filters('oxi-image-hover-plugin-version', false) == TRUE):
                    if (isset($_FILES['importimagehoverultimatefile'])) :
                        $filename = $_FILES["importimagehoverultimatefile"]["name"];
                        $folder = $this->safe_path(OXI_IMAGE_HOVER_PATH . 'assets/export/');

                        if (is_file($folder . $filename)):
                            unlink($folder . $filename); // delete file
                        endif;

                        move_uploaded_file($_FILES['importimagehoverultimatefile']['tmp_name'], $folder . $filename);
                        $ImageApi = new \OXI_IMAGE_HOVER_PLUGINS\Classes\ImageApi;
                        $ImageApi->post_json_import($folder, $filename);

                        if (is_file($folder . $filename)):
                            unlink($folder . $filename); // delete file
                        endif;
                    endif;
                endif;
            }
        }
    }

    public function Render() {
        ?>
        <div class="oxi-addons-row">
            <?php
            $this->Admin_header();
            $this->created_shortcode();
            $this->create_new();
            ?>
        </div>
        <?php
    }

    public function Admin_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Image Hover › Shortcode</h1>
                <p>Collect Image Hover Shortcode, Edit, Delect, Clone or Export it. <button type="button" id="oxi-import-style" class="btn btn-info">Import Shortcode</button> </p>
            </div>
        </div>
        <?php
    }

    public function database_data() {
        return $this->wpdb->get_results("SELECT * FROM  $this->parent_table ORDER BY id DESC", ARRAY_A);
    }

    public function created_shortcode() {
        $return = _(' <div class="oxi-addons-row"> <div class="oxi-addons-row table-responsive abop" style="margin-bottom: 20px; opacity: 0; height: 0px">
                        <table class="table table-hover widefat oxi_addons_table_data" style="background-color: #fff; border: 1px solid #ccc">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 15%">Name</th>
                                    <th style="width: 10%">Templates</th>
                                    <th style="width: 30%">Shortcode</th>
                                    <th style="width: 40%">Edit Delete</th>
                                </tr>
                            </thead>
                            <tbody>');
        foreach ($this->database_data() as $value) {

            $effects = $this->effects_converter($value['style_name']);

            $id = $value['id'];
            $return .= _('<tr>');
            $return .= _('<td>' . $id . '</td>');
            $return .= _('<td>' . $this->name_converter($value['name']) . '</td>');
            $return .= _('<td>' . $this->name_converter($value['style_name']) . '</td>');
            $return .= _('<td><span>Shortcode &nbsp;&nbsp;<input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[iheu_ultimate_oxi id=&quot;' . $id . '&quot;]"></span> <br>'
                    . '<span>Php Code &nbsp;&nbsp; <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[iheu_ultimate_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>');
            $return .= _('<td> 
                        <button type="button" class="btn btn-success oxi-addons-style-clone"  style="float:left" oxiaddonsdataid="' . $id . '">Clone</button>
                        <a href="' . admin_url("admin.php?page=oxi-image-hover-ultimate&effects=$effects&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                       <form method="post" class="oxi-addons-style-delete">
                               <input type="hidden" name="oxideleteid" id="oxideleteid" value="' . $id . '">
                               <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="addonsdatadelete">Delete</button>  
                       </form>
                       <a href="' . esc_url_raw(rest_url()) . 'ImageHoverUltimate/v1/shortcode_export?styleid=' . $id . '"  title="Export"  class="btn btn-info" style="float:left; margin-left: 5px;">Export</a>
                </td>');
            $return .= _(' </tr>');
        }
        $return .= _('      </tbody>
                </table>
            </div>
            <br>
            <br></div>');
        echo $return;
    }

    public function create_new() {
        echo _('<div class="oxi-addons-row">
                        <div class="oxi-addons-col-1 oxi-import">
                            <div class="oxi-addons-style-preview">
                                <div class="oxilab-admin-style-preview-top">
                                    <a href="' . admin_url("admin.php?page=oxi-image-hover-ultimate") . '">
                                        <div class="oxilab-admin-add-new-item">
                                            <span>
                                                <i class="fas fa-plus-circle oxi-icons"></i>  
                                                Create New Image Hover
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>');

        echo _('<div class="modal fade" id="oxi-addons-style-create-modal" >
                        <form method="post" id="oxi-addons-style-modal-form">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">Image Hover Clone</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" form-group row">
                                            <label for="addons-style-name" class="col-sm-6 col-form-label" oxi-addons-tooltip="Give your Shortcode Name Here">Name</label>
                                            <div class="col-sm-6 addons-dtm-laptop-lock">
                                                <input class="form-control" type="text" value="" id="addons-style-name"  name="addons-style-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="oxistyleid" name="oxistyleid" value="">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade" id="oxi-addons-style-import-modal" >
                        <form method="post" id="oxi-addons-import-modal-form" enctype = "multipart/form-data">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">Import Form</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                             ' . (apply_filters('oxi-image-hover-plugin-version', false) == FALSE ? ' <a target="_blank" style"text-align:center" href="https://www.oxilab.org/downloads/image-hover-ultimate-pro/">**Works only with Pro Version</a><br> <br>' : '') . '
                                             <input class="form-control" type="file" name="importimagehoverultimatefile" accept=".json,application/json,.zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="importdatasubmit" id="importdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                               ' . wp_nonce_field("image-hover-effects-ultimate-import") . '
                        </form>
                    </div>    
                    
                ');
    }

}
