<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Size_Chart_For_Woo_Product
 * @subpackage Size_Chart_For_Woo_Product/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Size_Chart_For_Woo_Product
 * @subpackage Size_Chart_For_Woo_Product/includes
 * @author     Multidots <inquiry@multidots.in>
 */
class Size_Chart_For_Woocommerce_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate($active_plugin) {

        /*         * **************** */
        // Welcome Screen  //
        /*         * **************** */
        global $wpdb, $woocommerce;
        global $jal_db_version;
        $jal_db_version = '1.0';
        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && !is_plugin_active_for_network('woocommerce/woocommerce.php')) {
            wp_die("<strong>Size Chart for WooCommerce</strong> Plugin requires <strong>WooCommerce</strong> <a href='" . get_admin_url(null, 'plugins.php') . "'>Plugins page</a>.");
        } else {
            
            $current_user = wp_get_current_user();
            $useremail = $current_user->user_email;

            $log_url = $_SERVER['HTTP_HOST'];
            $cur_date = date('Y-m-d');
            $url = '#';
            $response = wp_remote_post($url, array('method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array('user' => array('user_email' => $useremail, 'plugin_site' => $log_url, 'status' => 1, 'plugin_id' => '22', 'activation_date' => $cur_date)),
                'cookies' => array()));
            set_transient('_welcome_screen_activation_redirect_size_chart', true, 30);
        }
        add_option('jal_db_version', $jal_db_version);

        /*         * ****************** */
        // Default Template  // 
        /*         * ****************** */

        if (!get_option('default_size_chart')) {
            /* Get current user to assign a post */
            $user_id = get_current_user_id();
            /**
             *  Women T-shirt / Tops size chart Default Post
             */
            $women_top_chart_content = $active_plugin->size_chart_cloth_template_html_content('womens-tshirt');
            $women_top_post_arg = array(
                'post_author' => $user_id,
                'post_content' => $women_top_chart_content,
                'post_excerpt' => '',
                'post_type' => 'size-chart',
                'post_status' => 'publish',
                'post_title' => __("Women's T-shirt / Tops size chart"),
            );
            if ($post_id = wp_insert_post($women_top_post_arg)) {
                $active_plugin->size_chart_add_post_meta($post_id, 'womens-tshirt');
            }
            /**
             * LONG & SHORT SLEEVE T-SHIRTS & POLO SHIRTS
             */
            $tshirt_chart_content = $active_plugin->size_chart_cloth_template_html_content('tshirt-shirt');
            $tshirt_post_arg = array(
                'post_author' => $user_id,
                'post_content' => $tshirt_chart_content,
                'post_excerpt' => '',
                'post_type' => 'size-chart',
                'post_status' => 'publish',
                'post_title' => __("Men's T-Shirts & Polo Shirts Size Chart"),
            );
            if ($post_id = wp_insert_post($tshirt_post_arg)) {
                $active_plugin->size_chart_add_post_meta($post_id, 'tshirt-shirt');
            }
        }
        /* Add option for check default size chart */
        update_option('default_size_chart', 'true');
    }

    /*     * ********************************************************* */

    // *** 			Default Chart Content HTML  			*** //
    /*     * ********************************************************* */
    public function size_chart_cloth_template_html_content($template) {
        $content_html = '';
        $content_html .= '<div class="chart-container">
			<div class="chart-content">
				<div class="chart-content-list">';

        if ($template == 'womens-tshirt') {
            $content_html .= '<ul>
						 	<li><strong>Chest :</strong> Measure under your arms, around the fullest part of the your chest.</li>
 							<li><strong>Waist :</strong> Measure around your natural waistline, keeping the tape a bit loose.</li>
						</ul>';
        } elseif ($template == 'tshirt-shirt') {
            $content_html .= '<p>To choose the correct size for you, measure your body as follows:</p><ul>
						 	<li><strong>Chest :</strong> Measure around the fullest part, place the tape close under the arms and make sure the tape is flat across the back.</li>
						</ul>';
        }
        $content_html .='</div><div class="chart-content-image">';
        if ($template == 'womens-tshirt') {
            $content_html .= '<img class="alignnone size-medium alignright" src="' . plugins_url('admin/images/default-chart/women-t-shirt-top.png', dirname(__FILE__)) . '" alt="womens-tshirt" width="300" height="300" />';
        } elseif ($template == 'tshirt-shirt') {
            $content_html .= '<img class="alignnone size-medium alignright" src="' . plugins_url('admin/images/default-chart/mens-tshirts-and-polo-shirts.jpg', dirname(__FILE__)) . '" alt="tshirt-shirt-chart" width="300" height="300" />';
        }
        $content_html .='</div>
			</div>
		</div>';
        return $content_html;
    }

    /*     * ********************************************************* */

    // *** 			Default Chart Add Post Meta  			*** //
    /*     * ********************************************************* */

    public function size_chart_add_post_meta($post_id, $template) {
        if ($template == 'womens-tshirt') {
            $label = "Women's Sizes";
            $chart_table = stripcslashes('[["UK SIZE","BUST","BUST","WAIST","WAIST","HIPS","HIPS"],["","INCHES","CM","INCHES","CM","INCHES","CM"],["4","31","78","24","60","33","83.5"],["6","32","80.5","25","62.5","34","86"],["8","33","83","26","65","35","88.5"],["10","35","88","28","70","37","93.5"],["12","37","93","30","75","39","98.5"],["14","39","98","31","80","41","103.5"],["16","41","103","33","85","43","108.5"],["18","44","110.5","36","92.5","46","116"]]');
        } elseif ($template == 'tshirt-shirt') {
            $label = "T-Shirts & Polo Shirts";
            $chart_table = stripcslashes('[["TO FIT CHEST SIZE","INCHES","CM"],["XXXS","30-32","76-81"],["XXS","32-34","81-86"],["XS","34-36","86-91"],["S","36-38","91-96"],["M","38-40","96-101"],["L","40-42","101-106"],["XL","42-44","106-111"],["XXL","44-46","111-116"],["XXXL","46-48","116-121"]]');
        }
        update_post_meta($post_id, 'label', $label);
        update_post_meta($post_id, 'position', 'popup');
        update_post_meta($post_id, 'post_status', 'default');
        update_post_meta($post_id, 'chart-table', $chart_table);
    }

}
