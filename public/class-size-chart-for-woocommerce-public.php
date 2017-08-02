<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    woo_advanced_product_size_chart
 * @subpackage woo_advanced_product_size_chart/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Size_Chart_For_Woo_Product
 * @subpackage woo_advanced_product_size_chart/public
 * @author     Multidots <inquiry@multidots.in>
 */
class Size_Chart_For_Woocommerce_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/size-chart-for-woocommerce-public.css', array(), $this->version, 'all');

        if (is_singular("product")) {
            wp_enqueue_style($this->plugin_name . "-jquery-modal", plugin_dir_url(__FILE__) . 'css/remodal.css', array(), $this->version, 'all');
            wp_enqueue_style($this->plugin_name . "-jquery-modal-default-theme", plugin_dir_url(__FILE__) . 'css/remodal-default-theme.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/size-chart-for-woocommerce-public.js', array('jquery'), $this->version, false);

        if (is_singular("product")) {
            wp_enqueue_script($this->plugin_name . "-jquery-modal", plugin_dir_url(__FILE__) . 'js/remodal.js', array('jquery'), $this->version, false);
        }
    }

    /**
     * chart table content
     *
     * @since    1.0.0
     * @param      string    $chart_content    display chart details with table
     */
    public function size_chart_display_table($chart_content) {
        $chart_table = json_decode($chart_content);
        if (!empty($chart_table)) {
            echo "<table id='size-chart'>";
            $i = 0;
            foreach ($chart_table as $chart) {

                echo "<tr>";
                for ($j = 0; $j < count($chart); $j++) {
                    if (!empty($chart[$j]) && $chart[$j] != "") {
                        echo ($i == 0) ? "<th>" . __($chart[$j], $this->plugin_name) . "</th>" : "<td>" . __($chart[$j], $this->plugin_name) . "</td>";
                    }
                }
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        }
    }

    /**
     * Check if product belongs to a category 
     *
     * @since    1.0.0
     */
    public function size_chart_id_by_category($id) {

        global $wpdb;
        $terms = wp_get_post_terms($id, 'product_cat');
        $chart_terms = array();
        if ($terms) {
            foreach ($terms as $term) {
                $chart_terms[] = $term->term_id;
            }
        }
        $args = array(
            'post_type' => 'size-chart',
            'posts_per_page' => '-1',
            'posts_status' => 'publish',
            'orderby' => 'ID',
            'order' => 'DESC',
        );
        $size_chart_category_array = get_posts($args);
        $cat_arr = array();
        $chart_id = '';
        if (!empty($size_chart_category_array)) {
            foreach ($size_chart_category_array as $chart_array) {
                $chart_categories = get_post_meta($chart_array->ID, 'chart-categories', true);
                if ($chart_categories):
                    foreach ($chart_categories as $key => $value) {
                        $cat_arr[$key] = $value;
                    }
                endif;
                if (!empty($chart_terms) && !empty($cat_arr)) {
                    if (array_intersect($cat_arr, $chart_terms)) {
                        $chart_id = $chart_array->ID;
                    }
                    if ($chart_id)
                        break;
                }
            }
        }
        return $chart_id;
    }

    /**
     * size chart product custom tab
     *
     * @since    1.0.0
     */
    public function size_chart_custom_product_tab($tabs) {
        global $post;
        $prod_id = get_post_meta($post->ID, 'prod-chart', true);
        if (isset($prod_id) && !empty($prod_id) && get_post_status($prod_id) != '' && 'publish' == get_post_status($prod_id)) {
            $chart_id = $prod_id;
        } else {
            $chart_id = $this->size_chart_id_by_category($post->ID);
        }
        $chart_label = get_post_meta($chart_id, 'label', true);
        $chart_position = get_post_meta($chart_id, 'position', true);

        if (!$chart_id)
            return;
        if ($chart_position == 'tab') {
            $size_chart_setting = get_option('size_chart_settings');
            if (isset($size_chart_setting) && !empty($size_chart_setting) && $size_chart_setting['size-chart-tab-label'] != '') {
                $tab_label = $size_chart_setting['size-chart-tab-label'];
            } else {
                $tab_label = $chart_label;
            }
            $tabs['custom_tab'] = array(
                'title' => __($tab_label, $this->plugin_name),
                'priority' => 50,
                'callback' => array($this, 'size_chart_custom_product_tab_content'),
            );

            return $tabs;
        }
    }

    /**
     * size chart new tab content
     *
     * @since    1.0.0
     */
    public function size_chart_custom_product_tab_content() {
        global $post;
        $prod_id = get_post_meta($post->ID, 'prod-chart', true);
        if (isset($prod_id) && !empty($prod_id) && get_post_status($prod_id) != '' && 'publish' == get_post_status($prod_id)) {
            $chart_id = $prod_id;
        } else {
            $chart_id = $this->size_chart_id_by_category($post->ID);
        }
        $chart_label = get_post_meta($chart_id, 'label', true);
        $chart_table = get_post_meta($chart_id, 'chart-table', true);
        if ($chart_id) {
            require("includes/size-chart-contents.php");
        }
    }

    /**
     * hook to display chart button
     *
     * @since    1.0.0
     */
    public function size_chart_popup_button() {
        global $post;
        $prod_id = get_post_meta($post->ID, 'prod-chart', true);
        if (isset($prod_id) && !empty($prod_id) && get_post_status($prod_id) != '' && 'publish' == get_post_status($prod_id)) {
            $chart_id = $prod_id;
        } else {
            $chart_id = $this->size_chart_id_by_category($post->ID);
        }
        $chart_label = get_post_meta($chart_id, 'label', true);
        $chart_position = get_post_meta($chart_id, 'position', true);
        $chart_table = get_post_meta($chart_id, 'chart-table', true);
        $chart_settings = get_option('size_chart_settings');
        if (!$chart_id)
            return;

        if ($chart_position == 'popup') {
            $size_chart_setting = get_option('size_chart_settings');
            if (isset($size_chart_setting) && !empty($size_chart_setting) && isset($size_chart_setting['size-chart-popup-label']) && $size_chart_setting['size-chart-popup-label'] != '') {
                $popup_label = $size_chart_setting['size-chart-popup-label'];
            } else {
                $popup_label = $chart_label;
            }
            ?>
            <div class="button-wrapper"><a class="sc_btn" href="#modal" id="chart-button"><?php _e($popup_label, $this->plugin_name); ?></a></div>
            <div class="remodal size-chart-model" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                <div class="chart-container">
                    <?php require("includes/size-chart-contents.php"); ?>
                </div>
            </div>
            <?php
        }
    }

    /**
     * check popu up button position
     *
     * @since    1.0.0
     */
    public function size_chart_popup_button_position() {
        $chart_settings = get_option('size_chart_settings');
        $position = $chart_settings['size-chart-button-position'];
        $position = isset($array['size-chart-button-position']) ? $array['size-chart-button-position'] : '';
        $hook = 'woocommerce_single_product_summary';
        $priority = 11;
        add_action($hook, array($this, 'size_chart_popup_button'), $priority);
    }

    public function size_chart_setting_custom_style() {
        global $post;
        if (isset($post) && !empty($post)) {
            $prod_id = get_post_meta($post->ID, 'prod-chart', true);
            if (isset($prod_id) && !empty($prod_id)) {
                $chart_id = $prod_id;
            } else {
                $chart_id = $this->size_chart_id_by_category($post->ID);
            }
            $table_style = get_post_meta($chart_id, 'table-style', true);
            $size_chart_setting = get_option('size_chart_settings');
            ?>
            <style type="text/css">
            <?php if ($table_style == 'minimalistic') { ?>
                    #size-chart tr:nth-child(2n+1){ background:none;}
                    .button-wrapper #chart-button{color:<?php echo (isset($size_chart_setting['size-chart-title-color']) && $size_chart_setting['size-chart-title-color'] != '') ? $size_chart_setting['size-chart-title-color'] : '#007acc'; ?>}
            <?php } elseif ($table_style == 'classic') { ?>
                    table#size-chart tr th{background:#000;;color:#fff;}
                    .button-wrapper #chart-button{color:<?php echo (isset($size_chart_setting['size-chart-title-color']) && $size_chart_setting['size-chart-title-color'] != '') ? $size_chart_setting['size-chart-title-color'] : '#007acc'; ?>}
            <?php } elseif ($table_style == 'modern') { ?>
                    table#size-chart tr th{background:none;;color:#000;}
                    table#size-chart,table#size-chart tr th, table#size-chart tr td{border:none;background:none;}
                    #size-chart tr:nth-child(2n+1){ background:#ebe9eb;}
                    .button-wrapper #chart-button{color:<?php echo (isset($size_chart_setting['size-chart-title-color']) && $size_chart_setting['size-chart-title-color'] != '') ? $size_chart_setting['size-chart-title-color'] : '#007acc'; ?>}
            <?php } else { ?>
                    table#size-chart tr th{background:#000;;color:#fff;}
                    #size-chart tr:nth-child(2n+1){ background:#ebe9eb;}
                    .button-wrapper #chart-button{color:<?php echo (isset($size_chart_setting['size-chart-title-color']) && $size_chart_setting['size-chart-title-color'] != '') ? $size_chart_setting['size-chart-title-color'] : '#007acc'; ?>}
            <?php } ?>
            </style>
            <?php
        }
    }

    /**
     * BN code added
     */
    function paypal_bn_code_filter($paypal_args) {
        $paypal_args['bn'] = 'Multidots_SP';
        return $paypal_args;
    }

}
