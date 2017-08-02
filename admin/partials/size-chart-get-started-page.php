<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once('header/plugin-header.php');
global $wpdb;
$current_user = wp_get_current_user();
/* if (!get_option('wschart_free_plugin_notice_shown')) {
  ?>
  <div id="wschart_free_dialog">
  <p><?php _e('Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free!', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></p>
  <p><input type="text" id="txt_user_sub_wschart_free" class="regular-text" name="txt_user_sub_wschart_free" value="<?php echo $current_user->user_email; ?>"></p>
  </div>
  <?php } */
?>

<div class="wschart-main-table res-cl">
    <h2><?php _e('Thanks For Installing Woocommerce Advanced Product Size Chart', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></h2>
    <table class="table-outer">
        <tbody>
            <tr>
                <td class="fr-2">
                    <p class="block gettingstarted"><strong><?php _e('Getting Started', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?> </strong></p>
                    <p class="block textgetting">
                        <?php _e('WooCommerce Advanced Product Size Charts allows you to assign ready-to-use default size chart templates to the product or Create Custom Size Chart for any of your WooCommerce products. You can also clone existing size chart templates and create your own size charts and assign them to a category or specific products.', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>
                    </p>
                    <p class="block textgetting">
                        <?php _e('You can edit any of the size charts available in the plugin, preview or clone them.', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>

                        <span class="gettingstarted">
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . 'admin/images/Getting_Started_01.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('For each size chart, you can add label, chart image, categories for which you want the chart to appear, chart position (modal popup/additional tab on product page) and table style.', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>

                        <span class="gettingstarted">
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . 'admin/images/Getting_Started_02.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('For each size chart, you can create your custom chart table (with as many rows and columns you would like to include)', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>

                        <span class="gettingstarted">
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . 'admin/images/Getting_Started_03.png'; ?>">
                        </span>
                    </p>
                    <p class="block textgetting">
                        <?php _e('Plugin settings offers the option to change the label of size chart tab and modal popup, which is displayed in product page.)', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>

                        <span class="gettingstarted">
                            <img src="<?php echo SIZE_CHART_PLUGIN_URL . 'admin/images/Getting_Started_04.png'; ?>">
                        </span>
                    </p>

                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php require_once('header/plugin-sidebar.php'); ?>