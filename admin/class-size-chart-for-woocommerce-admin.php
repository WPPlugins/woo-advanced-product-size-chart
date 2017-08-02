<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    woo_advanced_product_size_chart
 * @subpackage woo_advanced_product_size_chart/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    woo_advanced_product_size_chart
 * @subpackage woo_advanced_product_size_chart/admin
 * @author     Multidots <inquiry@multidots.in>
 */
class Size_Chart_For_Woocommerce_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Size_Chart_For_Woocommerce_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Size_Chart_For_Woocommerce_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_style($this->plugin_name . "-jquery-editable-style", plugin_dir_url(__FILE__) . 'css/jquery.edittable.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . "-select2", plugin_dir_url(__FILE__) . 'css/select2.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . "main-style", plugin_dir_url(__FILE__) . 'css/style.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/size-chart-for-woocommerce-admin.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . "-jquery-modal", plugin_dir_url(__FILE__) . 'css/remodal.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . "-jquery-modal-default-theme", plugin_dir_url(__FILE__) . 'css/remodal-default-theme.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Size_Chart_For_Woocommerce_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Size_Chart_For_Woocommerce_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script($this->plugin_name . "-jquery-editable-js", plugin_dir_url(__FILE__) . 'js/jquery.edittable.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . "-jquery-select2", plugin_dir_url(__FILE__) . 'js/select2.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/size-chart-for-woocommerce-admin.js', array('jquery', 'wp-color-picker'), $this->version, false);
        wp_enqueue_script($this->plugin_name . "-jquery-modal", plugin_dir_url(__FILE__) . 'js/remodal.js', array('jquery'), $this->version, false);
    }

    /**
     * Register a new post type called chart
     *
     * @since    1.0.0
     */
    public function size_chart_register_post_type_chart() {
        $labels = array(
            'name' => __('Size Charts', $this->plugin_name),
            'singular_name' => __('Size Charts', $this->plugin_name),
            'menu_name' => __('Size Charts', $this->plugin_name),
            'name_admin_bar' => __('Size Charts', $this->plugin_name),
            'add_new' => __('Add New', $this->plugin_name),
            'add_new_item' => __('Add New Size Charts', $this->plugin_name),
            'new_item' => __('New Size Charts', $this->plugin_name),
            'edit_item' => __('Edit Size Charts', $this->plugin_name),
            'view_item' => __('View Size Charts', $this->plugin_name),
            'all_items' => __('All Size Charts', $this->plugin_name),
            'search_items' => __('Search Size Charts', $this->plugin_name),
            'parent_item_colon' => __('Parent Size Charts:', $this->plugin_name),
            'not_found' => __('No chart found.', $this->plugin_name),
            'not_found_in_trash' => __('No charts found in Trash.', $this->plugin_name)
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', $this->plugin_name),
            'public' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => FALSE,
            'query_var' => true,
            'rewrite' => false,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon' => plugin_dir_url(__FILE__) . 'images/menu-icon.png',
            'supports' => array('title', 'editor')
        );
        register_post_type('size-chart', $args);
    }

    /**
     * Adds the meta box container.
     *
     * @since    1.0.0
     */
    public function size_chart_add_meta_box($post_type) {

        $post_types_chart = array('size-chart', 'product');   //limit meta box to chart post type
        if (in_array($post_type, $post_types_chart)) {

            // chart setting meta box
            add_meta_box('chart-settings', __('Size Chart Settings', $this->plugin_name), array($this, 'size_chart_meta_box_content'), 'size-chart', 'advanced', 'high'
            );
            //meta box to select chart in product page	
            add_meta_box('additional-chart', __('Select Size Chart', $this->plugin_name), array($this, 'size_chart_select_chart'), 'product', 'side', 'default'
            );
            //meta box to List of assign category	
            add_meta_box('chart-assign-category', __('Assign Category', $this->plugin_name), array($this, 'size_chart_assign_category'), 'size-chart', 'side', 'default'
            );
            //meta box to List of assign Product	
            add_meta_box('chart-assign-product', __('Assign Product', $this->plugin_name), array($this, 'size_chart_assign_product'), 'size-chart', 'side', 'default'
            );
        }
    }

    /**
     * Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function size_chart_meta_box_content($post) {

        require_once('includes/size-chart-meta-box-content-form.php');
    }

    /**
     *  Meta Box content to select chart on product page.
     *
     * @param WP_Post $post The post object.
     */
    public function size_chart_select_chart($post) {

        require_once('includes/size-chart-select-chart-form.php');
    }

    /**
     *  Meta Box content to assign category list.
     *
     * @param WP_Post $post The post object.
     */
    public function size_chart_assign_category($post) {

        require_once('includes/size-chart-assign-category.php');
    }

    /**
     *  Meta Box content to assign category list.
     *
     * @param WP_Post $post The post object.
     */
    public function size_chart_assign_product($post) {

        require_once('includes/size-chart-assign-product.php');
    }

    /**
     * Save the meta when the chart post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function size_chart_content_meta_save($post_id) {

        // Check if our nonce is set.
        if (!isset($_POST['size_chart_inner_custom_box']))
            return $post_id;

        $nonce = $_POST['size_chart_inner_custom_box'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'size_chart_inner_custom_box'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('size-chart' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        // Sanitize the user input.
        $chart_label = sanitize_text_field($_POST['label']);
        $chart_img = sanitize_text_field($_POST['primary-chart-image']);
        $chart_position = sanitize_text_field($_POST['position']);
        $chart_categories = (isset($_POST['chart-categories'])) ? $_POST['chart-categories'] : '';
        $chart_table = sanitize_text_field($_POST['chart-table']);
        $table_style = sanitize_text_field($_POST['table-style']);
        /* save the data  */
        update_post_meta($post_id, 'label', $chart_label);
        update_post_meta($post_id, 'primary-chart-image', $chart_img);
        update_post_meta($post_id, 'position', $chart_position);
        update_post_meta($post_id, 'chart-categories', $chart_categories);
        update_post_meta($post_id, 'chart-table', $chart_table);
        update_post_meta($post_id, 'table-style', $table_style);
    }

    /**
     * Save the meta when the product is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function product_select_size_chart_save($post_id) {

        // Check if our nonce is set.
        if (!isset($_POST['size_chart_select_custom_box']))
            return $post_id;

        $nonce = $_POST['size_chart_select_custom_box'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'size_chart_select_custom_box'))
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        // Check the user's permissions.
        if ('product' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id))
                return $post_id;
        } else {

            if (!current_user_can('edit_post', $post_id))
                return $post_id;
        }

        /* save the data  */

        if (isset($_POST['prod-chart'])) {
            $chart_id = sanitize_text_field($_POST['prod-chart']);
            update_post_meta($post_id, 'prod-chart', $chart_id);
            return;
        }
    }

    /**
     * Loads the image iframe
     */
    public function size_chart_meta_image_enqueue() {
        global $typenow;
        if ($typenow == 'size-chart') {
            wp_enqueue_media();

            // Registers and enqueues the required javascript.
            wp_register_script('meta-box-image', plugin_dir_url(__FILE__) . '/js/images-frame.js', array('jquery'));
            wp_localize_script('meta-box-image', 'meta_image', array(
                'title' => __('Upload an Image', $this->plugin_name),
                'button' => __('Use this image', $this->plugin_name),
                    )
            );
            wp_enqueue_script('meta-box-image');
        }
    }

    /**
     * Register admin menu for the plugin
     * @since      1.0.0
     */
    public function size_chart_menu() {

        global $GLOBALS;
        if (empty($GLOBALS['admin_page_hooks']['dots_store'])) {
            add_menu_page(
                    'DotStore Plugins', 'DotStore Plugins', 'NULL', 'dots_store', array($this, 'size_chart_get_started_page'), plugin_dir_url(__FILE__) . 'images/menu-icon.png', 25
            );
        }
        add_submenu_page('dots_store', 'Woo Advanced Product Size Chart', 'Woo Advanced Product Size Chart', 'manage_options', 'size_chart_get_started_page', array($this, 'size_chart_get_started_page'));
        add_submenu_page('dots_store', 'Introduction', 'Introduction', 'manage_options', 'size-chart-information', array($this, 'size_chart_information_page'));
        add_submenu_page('dots_store', 'Get Started', 'Get Started', 'manage_options', 'size-chart-get-started', array($this, 'size_chart_get_started_page'));
        add_submenu_page('dots_store', 'Premium Version', 'Premium Version', 'manage_options', 'size-chart-premium', array($this, 'premium_version_size_chart_page'));
        $settings = add_submenu_page('edit.php?post_type=size-chart', 'Settings', __('Settings', $this->plugin_name), 'manage_options', 'size_chart_setting_page', array($this, 'size_chart_settings_form'));
        add_action("load-{$settings}", array($this, 'size_chart_settings_page'));

//        $settings = add_submenu_page('dots_store', 'Settings', __('Settings', $this->plugin_name), 'manage_options', 'size_chart_setting_page', array($this, 'size_chart_settings_form'));
        add_action("load-{$settings}", array($this, 'size_chart_settings_page'));
    }

    public function size_chart_remove_admin_submenus() {
        remove_submenu_page('dots_store', 'size-chart-information');
        remove_submenu_page('dots_store', 'size-chart-premium');
        remove_submenu_page('dots_store', 'size-chart-get-started');
    }

    public function size_chart_get_started_page() {
        require_once('partials/size-chart-get-started-page.php');
    }

    public function premium_version_size_chart_page() {
        require_once('partials/size-chart-premium-version-page.php');
    }

    public function size_chart_information_page() {
        require_once('partials/size-chart-information-page.php');
    }

    public function remove_custom_post_size_chart_admin_menu() {
        remove_menu_page('edit.php?post_type=size-chart');
    }

    public function size_chart_custom_plugin_header() {
        global $post_type, $pagenow;
        if ((isset($_GET['post_type']) && $_GET['post_type'] == 'size-chart')) :
            include_once('partials/header/plugin-header.php');

        endif;
    }

    public function size_chart_menu_active() {
        $screen = get_current_screen();
//        echo '<pre>';
//        print_r($screen->id);
//        echo '</pre>';
        if (!empty($screen) && ($screen->id == 'admin_page_size_chart_setting_page' || $screen->id == 'dotstore-plugins_page_size-chart-premium' || $screen->id == 'dotstore-plugins_page_size-chart-information')) {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#toplevel_page_dots_store').addClass('wp-has-current-submenu wp-menu-open menu-top menu-top-first').removeClass('wp-not-current-submenu');
                    $('#toplevel_page_dots_store > a').addClass('wp-has-current-submenu current').removeClass('wp-not-current-submenu');
                    $('li#menu-posts').removeClass('wp-not-current-submenu wp-has-current-submenu wp-menu-open current');
                    $('li.mine').css('display', 'none');
                    $('li.publish').css('display', 'none');
                    $('a[href="admin.php?page=size_chart_get_started_page"]').parent().addClass('current');

                });
            </script>
            <style type="text/css">.page-title-action{ display:none; }</style>
            <?php
        }
        if (!empty($screen) && ($screen->id == 'edit-size-chart' || $screen->id == 'size-chart')) {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#toplevel_page_dots_store').addClass('wp-has-current-submenu wp-menu-open menu-top menu-top-first').removeClass('wp-not-current-submenu');
                    $('#toplevel_page_dots_store > a').addClass('wp-has-current-submenu current').removeClass('wp-not-current-submenu');
                    $('li#menu-posts').removeClass('wp-not-current-submenu wp-has-current-submenu wp-menu-open current');
                    $('li.mine').css('display', 'none');
                    $('li.publish').css('display', 'none');
                    $('a[href="admin.php?page=size_chart_get_started_page"]').parent().addClass('current');
                });
            </script>
            <style type="text/css">.page-title-action{ display:none; }</style>
            <?php
        }
    }

    /**
     *  size chart settings form
     * @since      1.0.0
     */
    public function size_chart_settings_form() {

        include_once('includes/size-chart-settings-form.php');
    }

    /**
     *  size chart settings and redirection
     * @since      1.0.0
     */
    public function size_chart_settings_page() {
        if (isset($_POST["size_chart_submit"]) && isset($_GET['page']) == 'size_chart_setting_page') {
            $this->size_chart_settings = array();

            $this->size_chart_settings['size-chart-button-position'] = isset($_POST['size-chart-button-position']) ? $_POST['size-chart-button-position'] : '';
            $this->size_chart_settings['size-chart-title-color'] = isset($_POST['size-chart-title-color']) ? $_POST['size-chart-title-color'] : '';
            $this->size_chart_settings['size-chart-table-head-color'] = isset($_POST['size-chart-table-head-color']) ? $_POST['size-chart-table-head-color'] : '';
            $this->size_chart_settings['size-chart-table-head-font-color'] = isset($_POST['size-chart-table-head-font-color']) ? $_POST['size-chart-table-head-font-color'] : '';
            $this->size_chart_settings['size-chart-tab-label'] = isset($_POST['size-chart-tab-label']) ? $_POST['size-chart-tab-label'] : 'Woo Product Size Chart';
            $this->size_chart_settings['size-chart-popup-label'] = !empty($_POST['size-chart-popup-label']) ? $_POST['size-chart-popup-label'] : 'Woo Product Size Chart';
            $this->size_chart_settings['size-chart-button-class'] = !empty($_POST['size-chart-button-class']) ? $_POST['size-chart-button-class'] : '';
            $this->size_chart_settings['size-chart-table-row-even-color'] = isset($_POST['size-chart-table-row-even-color']) ? $_POST['size-chart-table-row-even-color'] : '';
            $this->size_chart_settings['size-chart-table-row-odd-color'] = isset($_POST['size-chart-table-row-odd-color']) ? $_POST['size-chart-table-row-odd-color'] : '';

            //update option
            update_option("size_chart_settings", $this->size_chart_settings);
            ?>
            <div class="updated"><p><strong><?php _e('settings saved.', $this->plugin_name); ?></strong></p></div>
            <?php
        }
    }

    public function size_chart_plugin_introduction_free() {
        $plugin_name = SIZE_CHART_PLUGIN_NAME;
        $plugin_version = SIZE_CHART_PLUGIN_VERSION;
        $current_user = wp_get_current_user();
//        if (!get_option('wcodd_dialog_plugin_notice_shown')) {
//            echo '<div id="wcodd_dialog"> <p> Be the first to get latest updates and exclusive content straight to your email inbox. </p> <p><input type="text" id="txt_user_sub_pvcp" class="regular-text" name="txt_user_sub_pvcp" value="' . $current_user->user_email . '"></p></div>';
//        }
//        
        ?>
        <div class="wcodd-table-main res-cl">
            <h2>Quick info</h2>
            <table class="wcodd-tableouter">
                <tbody>
                    <tr>
                        <td class="fr-1">Product Type</td>
                        <td class="fr-2">WooCommerce Plugin</td>
                    </tr>
                    <tr>
                        <td class="fr-1">Product Name</td>
                        <td class="fr-2"><?php echo $plugin_name; ?></td>
                    </tr>
                    <tr>
                        <td class="fr-1">Installed Version</td>
                        <td class="fr-2"><?php echo $plugin_version; ?></td>
                    </tr>
                    <tr>
                        <td class="fr-1">License & Terms of use</td>
                        <td class="fr-2"> <a target="_blank"  href=" https://store.multidots.com/terms-conditions/">Click here</a> to view license and terms of use.</td>
                    </tr>
                    <tr>
                        <td class="fr-1">Help & Support</td>
                        <td class="fr-2">
                            <ul class="help-support">
                                <li><a href="<?php echo site_url('wp-admin/admin.php?page=wc_order_delivery_date_pro&tab=get-started-dots-about-plugin-settings'); ?>">Quick Start Guide</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/docs/plugins/woocommerce-order-delivery-date/">Documentation</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/dotstore-support-panel/">Support Forum</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="fr-1">Localization</td>
                        <td class="fr-2">English, Spanish</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * chart table content
     *
     * @since    1.0.0
     * @param      string $chart_content display chart details with table
     */
    public function size_chart_display_table($chart_content) {
        $chart_table = json_decode($chart_content);
        if (!empty($chart_table)) {
            echo "<table id='size-chart'>";
            $i = 0;
            foreach ($chart_table as $chart) {
                echo "<tr>";
                for ($j = 0; $j < count($chart); $j++) {

                    echo ($i == 0) ? "<th>" . __($chart[$j], $this->plugin_name) . "</th>" : "<td>" . __($chart[$j], $this->plugin_name) . "</td>";
                }
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        }
    }

    /*
     * Function creates post duplicate as a draft and redirects then to the edit post screen
     */

    public function size_chart_duplicate_post() {
        global $wpdb;
        $post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
        $post = get_post($post_id);
        $cntCoty = get_post_meta($post_id, 'clone-cnt', true);
        if (isset($cntCoty) && $cntCoty != '') {
            $cnt = $cntCoty + 1;
        } else {
            $cnt = 0;
        }
        update_post_meta($post_id, 'clone-cnt', $cnt);
        $count_clone = get_post_meta($post_id, 'clone-cnt', true);
        $current_user = wp_get_current_user();
        $clone_post_author = $current_user->ID;
        $count = isset($count_clone) && $count_clone != 0 ? '(' . $count_clone . ')' : '';
        if (isset($post) && !empty($post)) {

            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status' => $post->ping_status,
                'post_author' => $clone_post_author,
                'post_content' => $post->post_content,
                'post_excerpt' => $post->post_excerpt,
                'post_name' => $post->post_name,
                'post_parent' => $post->post_parent,
                'post_password' => $post->post_password,
                'post_status' => 'draft',
                'post_title' => $post->post_title . ' - Copy' . $count,
                'post_type' => $post->post_type,
                'to_ping' => $post->to_ping,
                'menu_order' => $post->menu_order
            );

            /*
             * insert the clone post 
             */
            $clone_post_id = wp_insert_post($args);
            /*
             * duplicate all post meta
             */
            $chart_post_meta = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
            if (count($chart_post_meta) != 0) {
                $sql_ins = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                foreach ($chart_post_meta as $chart_meta) {
                    if ($chart_meta->meta_key != 'post_status' && $chart_meta->meta_key != 'clone-cnt') {
                        $meta_key = $chart_meta->meta_key;
                        $meta_value = addslashes($chart_meta->meta_value);
                        $sql_sel[] = "SELECT " . $clone_post_id . ", '" . $meta_key . "', '" . $meta_value . "'";
                    }
                }
                $sql_ins .= implode(" UNION ALL ", $sql_sel);
                $wpdb->query($sql_ins);
            }
            wp_redirect(admin_url('post.php?action=edit&post=' . $clone_post_id));
            exit;
        } else {
            wp_die('could not find post: ' . $post_id);
        }
    }

    /*
     * Function creates post preview */

    public function size_chart_preview_post() {
        $chart_id = $_REQUEST['chart_id'];
        if (isset($chart_id) && $chart_id != '') {
            $size_chart_setting = get_option('size_chart_settings');
            $table_style = get_post_meta($chart_id, 'table-style', true);
            $chart_label = get_post_meta($chart_id, 'label', true);
            $chart_table = get_post_meta($chart_id, 'chart-table', true);
            $chart_position = get_post_meta($chart_id, 'position', true);
            ?>
            <style type="text/css">
            <?php if ($table_style == 'style-1') { ?>
                    #size-chart tr:nth-child(2n+1) {
                        background: none;
                    }

            <?php } elseif ($table_style == 'style-2') { ?>
                    #size-chart tr:nth-child(2n+1) {
                        background: #ebe9eb;
                    }

            <?php } elseif ($table_style == 'custom-style') { ?>
                    table#size-chart tr:first-child {
                        background: <?php echo (isset($size_chart_setting['size-chart-table-head-color']) && $size_chart_setting['size-chart-table-head-color'] != '') ? $size_chart_setting['size-chart-table-head-color'] : '#000'; ?>;
                        color: <?php echo (isset($size_chart_setting['size-chart-table-head-font-color']) && $size_chart_setting['size-chart-table-head-font-color'] != '') ? $size_chart_setting['size-chart-table-head-font-color'] : '#fff'; ?>;
                    }

                    #size-chart tr:nth-child(even) {
                        background: <?php echo (isset($size_chart_setting['size-chart-table-row-even-color']) && $size_chart_setting['size-chart-table-row-even-color'] != '') ? $size_chart_setting['size-chart-table-row-even-color'] : '#fff'; ?>
                    }

                    #size-chart tr:nth-child(odd) {
                        background: <?php echo (isset($size_chart_setting['size-chart-table-row-odd-color']) && $size_chart_setting['size-chart-table-row-odd-color'] != '') ? $size_chart_setting['size-chart-table-row-odd-color'] : '#ebe9eb'; ?>
                    }

                    }
            <?php } else { ?>
                    table#size-chart tr:first-child {
                        background: #000;;
                        color: #fff;
                    }

                    #size-chart tr:nth-child(2n+1) {
                        background: #ebe9eb;
                    }

            <?php } ?>
            </style>
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div class="chart-container">
                <?php require("includes/size-chart-contents.php"); ?>
            </div>
            <?php
        } else {
            echo 'No Result Found';
        }
        wp_die();
    }

    public function size_chart_preview_dialog_box() {
        ?>
        <div id="wait"><img src=<?php echo plugins_url('admin/images/loader.gif', dirname(__FILE__)); ?> width="64"
                            height="64"/><br>Loading..
        </div>
        <div class="remodal size-chart-model" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title"
             aria-describedby="modal1Desc">
        </div>
        <?php
    }

    /**
     * Manage Size Chart Type And Action
     */
    public function size_chart_column($columns) {
        $new_columns = (is_array($columns)) ? $columns : array();
        unset($new_columns['date']);
        $new_columns['size-chart-type'] = __('Size Chart Type', $this->plugin_name);
        $new_columns['action'] = __('Action', $this->plugin_name);
        return $new_columns;
    }

    /**
     * Manage Size Chart Column
     */
    public function size_chart_manage_column($column) {
        global $post;
        switch ($column) {
            case 'size-chart-type' :
                $size_chart_type = get_post_meta($post->ID, 'post_status', true);
                if (isset($size_chart_type) && $size_chart_type == 'default') {
                    $type = __('Default Template', $this->plugin_name);
                } else {
                    $type = __('Custom Template', $this->plugin_name);
                }
                echo $type;
                break;
            case 'action' :
                echo '<a href="admin.php?action=size_chart_duplicate_post&amp;post=' . $post->ID . '" class="clone-chart" title="' . __('Clone', $this->plugin_name) . '" rel="permalink"></a><a id="' . $post->ID . '"  href="#modal" class="preview_chart" title="' . __('Preview', $this->plugin_name) . '" rel="permalink"></a>';
                break;
        }
    }

    public function size_chart_delete_image() {
        $post_id = $_REQUEST['post_id'];
        update_post_meta($post_id, 'primary-chart-image', '');
        echo plugins_url('admin/images/chart-img-placeholder.jpg', dirname(__FILE__));
        wp_die();
    }

    /**
     * Size Chart welcome page
     *
     */
    public function welcome_screen_do_activation_redirect() {
        // if no activation redirect
        if (!get_transient('_welcome_screen_activation_redirect_size_chart')) {
            return;
        }
        // Delete the redirect transient
        delete_transient('_welcome_screen_activation_redirect_size_chart');
        // if activating from network, or bulk
        if (is_network_admin() || isset($_GET['activate-multi'])) {
            return;
        }
        // Redirect to size chart welcome  page
        wp_safe_redirect(add_query_arg(array('page' => 'size_chart_get_started_page'), admin_url('admin.php')));
    }


    public function wp_add_plugin_userfn_size_chart_free() {


        $email_id = (isset($_POST["email_id"]) && !empty($_POST["email_id"])) ? $_POST["email_id"] : '';
        $log_url = $_SERVER['HTTP_HOST'];
        $cur_date = date('Y-m-d');
        $request_url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/wp-add-plugin-users.php';
        if (!empty($email_id)) {
            $request_response = wp_remote_post($request_url, array('method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array('user' => array('plugin_id' => '44', 'user_email' => $email_id, 'plugin_site' => $log_url, 'status' => 1, 'activation_date' => $cur_date)),
                'cookies' => array()));
        }
        update_option('size_chart_plugin_notice_shown', 'true');
    }

    public function add_plugin_update_message_row_aec($plugin_file, $plugin_data, $status) {

        $ver = get_option('size_chart_latest_version');
        if (isset($ver) && !empty($ver)) {
            $latest_var = '<a href="#">View version details&nbsp;' . $ver . '</a>';
        }
        echo '<tr class="plugin-update-tr active"><td colspan="3"><div class="update-message">There is a new version of Size Chart for WooCommerce available&nbsp;' . $latest_var . '</div></td></tr>';
    }

    public function size_chart_publish_button_disable($hook_suffix) {
        if ('post.php' == $hook_suffix) {
            global $post;
            $post_status = get_post_meta($post->ID, 'post_status', true);
            if ('size-chart' == $post->post_type && isset($post_status) && $post_status == 'default') {
                ?>
                <script type="text/javascript">
                    window.onload = function() {
                        jQuery("#title").prop("disabled", true);
                    };
                </script>
                <?php
            }
        }
    }

    public function size_chart_remove_row_actions($actions) {
        global $post;
        $post_status = get_post_meta($post->ID, 'post_status', true);
        if ($post->post_type == 'size-chart' && isset($post_status) && $post_status == 'default') {
            unset($actions['inline hide-if-no-js']);
        }
        unset($actions['view']);
        return $actions;
    }

    public function size_chart_filter_default_template() {
        global $typenow, $wpdb;
        $post_type = 'size-chart';
        $current = isset($_GET['default_template']) ? $_GET['default_template'] : '';
        if ($typenow == $post_type) {
            ?>
            <select name="default_template" id="issue">
                <option value=""><?php _e('Show All Template', $this->plugin_name); ?></option>
                <option value="hide-default" <?php echo $current == 'hide-default' ? ' selected="selected"' : ''; ?>><?php _e('Hide Default Template', $this->plugin_name); ?></option>
            </select>
            <?php
        }
    }

    public function size_chart_filter_default_template_query($query) {
        global $pagenow;
        if (is_admin() && $pagenow == 'edit.php' &&
                isset($_GET['post_type']) && $_GET['post_type'] == 'size-chart' &&
                isset($_GET['default_template']) && !empty($_GET['default_template'])
        ) {
            set_query_var('meta_query', array(array('key' => 'post_status', 'value' => 'default', 'compare' => 'NOT EXISTS')));
        }
    }

    public function size_chart_selected_chart_delete($post_id) {
        global $wpdb;
        if (isset($post_id) && !empty($post_id) && get_post_type($post_id) == 'size-chart') {
            $sql = "SELECT post_id  FROM $wpdb->postmeta where meta_key='prod-chart' AND meta_value=" . $post_id;
            $result = $wpdb->get_results($sql);
            if (!empty($result)) {
                foreach ($result as $value) {
                    delete_post_meta($value->post_id, 'prod-chart', $post_id);
                }
            }
        }
    }
    /*
     * review section
     */
    function size_chart_admin_footer_review() {
        echo 'If you like <strong>Woocommerce Advanced Product Size Chart </strong> plugin, please leave us ★★★★★ ratings on <a href="https://wordpress.org/support/plugin/woo-advanced-product-size-chart/reviews/#new-post" target="_blank">WordPress</a>.';
    }

}
