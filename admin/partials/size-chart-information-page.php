<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once('header/plugin-header.php');
global $wpdb;
$current_user = wp_get_current_user();
/*if (!get_option('wschart_plugin_notice_shown')) {
    ?>
    <div id="wschart_free_dialog" title="Basic dialog">
        <p><?php _e('Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free!', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></p>
        <p><input type="text" id="txt_user_sub_afrsm" class="regular-text" name="txt_user_sub_wschart" value="<?php echo $current_user->user_email; ?>"></p>
    </div>
    <?php } */?>

<div class="wschart-main-table res-cl">
    <h2><?php _e('Quick info', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></h2>
    <table class="table-outer">
        <tbody>
            <tr>
                <td class="fr-1"><?php _e('Product Type', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('WooCommerce Plugin', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Product Name', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e($plugin_name, SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Installed Version', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('Free Version', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?> <?php echo $plugin_version; ?></td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('License & Terms of use', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><a target="_blank"  href="http://t.signauxdeux.com/e1t/c/5/f18dQhb0SmZ58dDMPbW2n0x6l2B9nMJW7sM9dn7dK_MMdBzM2-04?t=https%3A%2F%2Fstore.multidots.com%2Fterms-conditions%2F&si=4973901068632064&pi=61378fda-f5e5-4125-c521-28a4597b13d6">
                    <?php _e('Click here', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></a> 
                    <?php _e('to view license and terms of use.', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>
                </td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Help & Support', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2 wschart-information">
                    <ul>
                        <li><a target="_blank" href="<?php echo site_url('wp-admin/admin.php?page=size_chart_get_started_page'); ?>"><?php _e('Quick Start', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></a></li>
                        <li><a target="_blank" href="#"><?php _e('Guide Documentation', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></a></li> 
                        <li><a target="_blank" href="http://t.signauxdeux.com/e1t/c/5/f18dQhb0SmZ58dDMPbW2n0x6l2B9nMJW7sM9dn7dK_MMdBzM2-04?t=https%3A%2F%2Fstore.multidots.com%2Fdotstore-support-panel%2F&si=4973901068632064&pi=61378fda-f5e5-4125-c521-28a4597b13d6"><?php _e('Support Forum', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="fr-1"><?php _e('Localization', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
                <td class="fr-2"><?php _e('English', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?>, <?php _e('Spanish', SIZE_CHART_PLUGIN_TEXT_DOMAIN); ?></td>
            </tr>

        </tbody>
    </table>
</div>
<?php require_once('header/plugin-sidebar.php'); ?>