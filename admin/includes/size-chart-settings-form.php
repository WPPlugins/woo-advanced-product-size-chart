<?php
/**
 * Provide a admin area form view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    size-chart-for-woocommerce
 * @subpackage size-chart-for-woocommerce/admin/includes
 */
global $pagenow;
if (empty($this->size_chart_settings)) {
    $this->size_chart_settings = get_option('size_chart_settings');
}
?>
<div class="wrap ajax_cart size-chart-setting">
    <fieldset class="custom-fieldset set-size-chart-fieldset set-size-chart-fieldset-container">
        <h1><?php _e('Size Chart Settings', $this->plugin_name); ?></h1>
        <h4><strong><?php _e('Default size chart template', $this->plugin_name); ?></strong></h4>
        <p><?php _e('This plugin have sample default size chart template, So you can direct apply to product or category.', $this->plugin_name); ?></p>
        <h4><strong><?php _e('Create your own size guide', $this->plugin_name); ?></strong></h4>
        <p><?php _e('This Plugin, you are able to customize/ clone the default size chart and create your own size guide for anything you imagine!', $this->plugin_name); ?></p>
        <h4><strong><?php _e('Comprehensive display', $this->plugin_name); ?> </strong></h4>
        <p><?php _e('Customers will be able to fully understand your product and buy it without making unnecessary questions regarding size.', $this->plugin_name); ?></p>
        <form method="post" action="<?php admin_url('admin.php?page=size_chart_setting_page'); ?>" enctype="multipart/form-data">
            <?php
            wp_nonce_field("size_chart_page");
            if ($pagenow == 'edit.php' && $_GET['page'] == 'size_chart_setting_page') {
                ?>
                <div id="size-chart-setting-fields">
                    <fieldset class="custom-fieldset set-size-chart-fieldset">
                        <legend class="scpro abpro"><?php _e('General Settings (Available in Pro Version)', $this->plugin_name); ?></legend>
                        <div class="setting-description"><p><?php _e('With this setting you can configure size chart table style like table head font color, table row color, table head background color etc.', $this->plugin_name); ?></p></div>
                        <table class="form-table">
                            <tr class="scpro">
                                <th><?php _e('Table Head Background Color', $this->plugin_name); ?></th>
                                <td>
                                    <img src="<?php echo plugins_url('images/colorpic.png', dirname(__FILE__)); ?>" />
                                </td>
                            </tr>
                            <tr  class="scpro">
                                <th><?php _e('Table Head Font Color', $this->plugin_name); ?></th>
                                <td>
                                    <img src="<?php echo plugins_url('images/colorpic.png', dirname(__FILE__)); ?>" />
                                </td>
                            </tr>
                            <tr class="scpro">
                                <th><?php _e('Table Even Row Color', $this->plugin_name); ?></th>
                                <td>
                                    <img src="<?php echo plugins_url('images/colorpic.png', dirname(__FILE__)); ?>" />
                                </td>
                            </tr>
                            <tr class="scpro">
                                <th><?php _e('Table Odd Raw Color', $this->plugin_name); ?></th>
                                <td>
                                    <img src="<?php echo plugins_url('images/colorpic.png', dirname(__FILE__)); ?>" />
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="custom-fieldset set-size-chart-fieldset">
                        <legend><?php _e('Global Settings', $this->plugin_name); ?></legend>
                        <div class="setting-description"><p><?php _e('With this setting you can add size chart label and it will same for all product size charts.', $this->plugin_name); ?></p></div>
                        <table class="form-table global-setting">
                            <tr>
                                <th><?php _e('Tab Label', $this->plugin_name); ?></th>
                                <td>
                                    <input type="text" name="size-chart-tab-label" value="<?php echo (isset($this->size_chart_settings['size-chart-tab-label']) && $this->size_chart_settings['size-chart-tab-label'] != '') ? $this->size_chart_settings['size-chart-tab-label'] : 'Woo Product Size Chart'; ?>"/>
                                </td>
                                <td><div class="setting-description"><?php _e('It is visible on product details page in the custom tab.', $this->plugin_name); ?></div></td>
                            </tr>
                            <tr>
                                <th><?php _e('Popup Label', $this->plugin_name); ?></th>
                                <td>
                                    <input type="text" name="size-chart-popup-label" value="<?php echo (isset($this->size_chart_settings['size-chart-popup-label']) && $this->size_chart_settings['size-chart-popup-label'] != '') ? $this->size_chart_settings['size-chart-popup-label'] : 'Woo Product Size Chart'; ?>"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="custom-fieldset set-size-chart-fieldset">
                        <legend class="scpro abpro"><?php _e('Pop Up Settings (Available in Pro Version)', $this->plugin_name); ?></legend>
                        <div class="scpro setting-description"><p><?php _e('With this setting you can configure size chart popup link position, color and you can apply custom class also.', $this->plugin_name); ?></p></div>
                        <table class="form-table">
                            <tr class="scpro">
                                <th><h4><?php _e('Chart Popup Label Position', $this->plugin_name); ?></h4></th>
                            <td>
                                <select name="size-chart-button-position" id="size-chart-button-position" disabled="">
                                    <option value="before-summary-text" <?php echo isset($this->size_chart_settings['size-chart-button-position']) && $this->size_chart_settings['size-chart-button-position'] == "before-summary-text" ? 'selected="selected"' : ''; ?> ><?php _e('Before Summary Text', $this->plugin_name); ?></option>
                                </select>
                            </td>
                            </tr> 
                            <tr class="scpro">
                                <th><?php _e('Label Text Color', $this->plugin_name); ?></th>
                                <td>
                                    <img src="<?php echo plugins_url('images/colorpic.png', dirname(__FILE__)); ?>" />
                                </td>
                            </tr>
                            <tr class="scpro">
                                <th><?php _e('Label Class', $this->plugin_name); ?></th>
                                <td>
                                    <input type="text" name="size-chart-button-class" value="" disabled=""/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <p class="submit">
                        <input type="submit" class="button-primary" name="size_chart_submit" value="<?php _e('Save Changes', $this->plugin_name) ?>" />   
                    </p>
                    </fieldset>
                </div>  

            <?php } ?>
        </form>