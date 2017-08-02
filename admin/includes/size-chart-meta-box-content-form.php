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
// Add an nonce field so we can check for it later.
wp_nonce_field('size_chart_inner_custom_box', 'size_chart_inner_custom_box');

// Use get_post_meta to retrieve an existing value from the database.
$chart_label = get_post_meta($post->ID, 'label', true);
$chart_img = get_post_meta($post->ID, 'primary-chart-image', true);
$chart_position = get_post_meta($post->ID, 'position', true);
$chart_categories = (array) get_post_meta($post->ID, 'chart-categories', true);
$chart_table = get_post_meta($post->ID, 'chart-table', true);
$table_style = get_post_meta($post->ID, 'table-style', true);

// Display the form, using the current value.
?>
<div id="size-chart-meta-fields"> 
    <div id="field">
        <div class="field-title"><h4><?php _e('Label', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Chart Label', $this->plugin_name); ?></div>
        <div class="field-item"><input type="text" id="label" name="label" value="<?php echo esc_attr($chart_label); ?>" /></div>
    </div>

    <div id="field">
        <div class="field-title"><h4><?php _e('Primary Chart Image', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Add/Edit primary chart image below', $this->plugin_name); ?></div>
        <div class="field-item"> 
            <input type="hidden" name="primary-chart-image" id="primary-chart-image" value="<?php echo esc_attr($chart_img); ?>" /></div>
        <?php $img = wp_get_attachment_image_src($chart_img, 'thumbnail'); ?>
        <div id="field-image">
            <div class="field_image_box">
                <img src="<?php echo!empty($img[0]) ? $img[0] : plugins_url('images/chart-img-placeholder.jpg', dirname(__FILE__)); ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" class="<?php echo $post->ID; ?>"  id="meta_img" />

            <?php if (!empty($img[0])) { ?>
                <a id="<?php echo $post->ID; ?>" class="delete-chart-image"><img src="<?php echo plugins_url('images/close-icon.png', dirname(__FILE__)); ?>"/></a>
            <?php } ?>
                            </div>
        </div>
        <div class="field-item"><input type="button" id="meta-image-button" class="button" value="<?php _e('Upload', $this->plugin_name) ?>" /></div>
    </div>

    <div id="field">
        <div class="field-title"><h4><?php _e('Chart Categories', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Select categories for chart to appear on.', $this->plugin_name); ?></div>
        <div class="field-item">
            <select name="chart-categories[]" id="chart-categories" multiple="multiple" >
                <?php $term = get_terms('product_cat', array()); ?>
                <?php if ($term): foreach ($term as $cat) { ?>
                        <option value="<?php echo $cat->term_id; ?>" <?php echo in_array($cat->term_id, $chart_categories) ? 'selected="selected"' : ''; ?> ><?php _e($cat->name, $this->plugin_name); ?></option>
                    <?php } endif; ?>

            </select>
        </div>
    </div>
    <div style="clear:both"></div>         
    <div id="field">
        <div class="field-title"><h4><?php _e('Chart Position', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Select if the chart will display as a popup or as a additional tab', $this->plugin_name); ?></div>
        <div class="field-item">
            <select name="position" id="position">
                <option value="tab" <?php echo $chart_position == "tab" ? 'selected="selected"' : ''; ?> ><?php _e('Additional Tab', $this->plugin_name); ?></option>
                <option value="popup" <?php echo $chart_position == "popup" ? 'selected="selected"' : ''; ?>><?php _e('Modal Pop Up', $this->plugin_name); ?></option>
            </select>
        </div>
    </div>
    <div id="field">
        <div class="field-title"><h4><?php _e('Chart Table Style', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Chart Table Styles (Default Style)', $this->plugin_name); ?></div>
        <div class="field-item">
            <select name="table-style" id="table-style">
                <option value="default-style" <?php echo $table_style == "default-style" ? 'selected="selected"' : ''; ?> ><?php _e('Default Style', $this->plugin_name); ?></option>
                <option value="minimalistic" <?php echo $table_style == "minimalistic" ? 'selected="selected"' : ''; ?> ><?php _e('Minimalistic', $this->plugin_name); ?></option>
                <option value="classic" <?php echo $table_style == "classic" ? 'selected="selected"' : ''; ?> ><?php _e('Classic', $this->plugin_name); ?></option>
                <option value="modern" <?php echo $table_style == "modern" ? 'selected="selected"' : ''; ?>><?php _e('Modern', $this->plugin_name); ?></option>
                <option value="custom-style" disabled="" style="color:red"><?php _e('Custom Style (Avaible On Pro)', $this->plugin_name); ?></option>
            </select>
        </div>
    </div>
    <div id="field">
        <div class="field-title"><h4><?php _e('Chart Table', $this->plugin_name); ?></h4></div> 
        <div class="field-description"><?php _e('Add/Edit chart below', $this->plugin_name); ?></div>
        <div class="field-item">
            <textarea  id="chart-table" name="chart-table"><?php echo esc_attr($chart_table); ?></textarea></div>
    </div>
</div>