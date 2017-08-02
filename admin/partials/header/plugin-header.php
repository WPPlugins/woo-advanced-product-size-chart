<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$plugin_name = SIZE_CHART_PLUGIN_NAME;
$plugin_version = SIZE_CHART_PLUGIN_VERSION;
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <header class="dots-header">
            <div class="dots-logo-main">
                <img  src="<?php echo SIZE_CHART_PLUGIN_URL . '/admin/images/Advanced-Product-Size-Charts.png'; ?>">
            </div>
            <div class="dots-header-right">
                <div class="logo-detail">
                    <strong><?php _e($plugin_name, SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?> </strong>
                    <span>Free Version <?php echo $plugin_version; ?> </span>
                </div>
                <div class="button-dots">
                    <span class="support_dotstore_image"><a  target = "_blank" href="https://store.multidots.com/woocommerce-advanced-product-size-charts" > 
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . 'admin/images/upgrade_new.png'; ?>"></a>
                    </span>
                    <span class="support_dotstore_image"><a  target = "_blank" href="https://store.multidots.com/dotstore-support-panel/" > 
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . '/admin/images/support_new.png'; ?>"></a>
                    </span>

                </div>
            </div>

            <?php
            global $pagenow;
            $size_charts_lists = '';
            $size_charts_add_menu_enable = '';
            $size_chart_settings_page = '';
            $get_started_about_plugin_setting_menu_enable = '';
            $dots_about_plugin_introduction = '';
            $dotpremium_get_started_menu_enable = '';
            $about_plugin_setting_menu_enable = '';
            $size_charts_list = '';
            $premium_version = '';


            if ((isset($_GET['post_type']) && $_GET['post_type'] == 'size-chart') && $pagenow === 'edit.php' || $pagenow === 'post.php') {
                $size_charts_list = "active";
            }
            if ((isset($_GET['post_type']) && $_GET['post_type'] == 'size-chart') && 'post-new.php' === $pagenow) {

                $size_charts_add_menu_enable = "active";
            }
            if (!empty($_GET['page']) && $_GET['page'] == 'size_chart_setting_page') {
                $size_chart_settings_page = "active";
            }
//            if (!empty($_GET['page']) && $_GET['page'] == 'size-chart-premium') {
//                $premium_version = "active";
//            }
            if (isset($_GET['page']) && !empty($_GET['page']) && ($_GET['page'] == 'size_chart_get_started_page' || $_GET['page'] == 'size-chart-information')) {
                $about_plugin_setting_menu_enable = "active";
            }
            if (!empty($_GET['page']) && $_GET['page'] == 'size_chart_get_started_page') {
                $dotpremium_get_started_menu_enable = "active";
            }
            if (!empty($_GET['page']) && $_GET['page'] == 'size-chart-information') {
                $dots_about_plugin_introduction = "active";
            }
            $siteTabPath = 'wp-admin/edit.php?post_type=size-chart&tab=';
            ?>
            <div class="dots-menu-main">

                <nav>
                    <ul>
                        <li>
                            <a class="dotstore_plugin <?php echo $size_charts_list; ?>"  href="<?php echo site_url('wp-admin/edit.php?post_type=size-chart'); ?>"><?php _e('Size Charts'); ?></a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php echo $size_charts_add_menu_enable; ?>"  href="<?php echo site_url('wp-admin/post-new.php?post_type=size-chart'); ?>"><?php _e('Add New'); ?></a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php echo $size_chart_settings_page; ?>" href="<?php echo home_url('/wp-admin/edit.php?post_type=size-chart&page=size_chart_setting_page'); ?>"><?php _e('Settings') ?></a>
                        </li>
                        <!--                        <li>

                            <a class="dotstore_plugin <?php // echo $premium_version;  ?>"  href="<?php // echo home_url('/wp-admin/admin.php?page=size-chart-premium');  ?>"> <?php // _e('Premium Version');  ?></a>
                        </li>-->
                        <li>
                            <a class="dotstore_plugin <?php echo $about_plugin_setting_menu_enable; ?>"  href="<?php echo home_url('/wp-admin/admin.php?page=size_chart_get_started_page'); ?>">About Plugin</a>
                            <ul class="sub-menu">
                                <li><a  class="dotstore_plugin <?php echo $dotpremium_get_started_menu_enable; ?>" href="<?php echo home_url('/wp-admin/admin.php?page=size_chart_get_started_page'); ?>">Getting Started</a></li>
                                <li><a class="dotstore_plugin <?php echo $dots_about_plugin_introduction; ?>" href="<?php echo home_url('/wp-admin/admin.php?page=size-chart-information'); ?>">Quick Info</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dotstore_plugin " href="#">Dotstore</a>
                            <ul class="sub-menu">

                                <li><a target="_blank" href="https://store.multidots.com/woocommerce-plugins/">WooCommerce Plugins</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/wordpress-plugins/">Wordpress Plugins</a></li><br>
                                <li><a target="_blank" href="https://store.multidots.com/free-wordpress-plugins/">Free Plugins</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/themes/">Free Themes</a></li>
                                <li><a target="_blank" href="https://store.multidots.com/dotstore-support-panel/">Contact Support</a></li>
                            </ul>
                        </li>
                    </ul>

                    </li>

                    </ul>
                </nav>

            </div>
        </header>