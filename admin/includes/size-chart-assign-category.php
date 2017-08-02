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
// Use get_post_meta to retrieve an existing value of chart 1 from the database.
$cat_id = get_post_meta($post->ID, 'chart-categories', true);
?>
<div id="size-chart-meta-fields"> 
    <div id="assign-category">

        <div class="assign-item">
            <?php $term = get_terms('product_cat', array()); ?>
            <ul>
                <?php
                if (!empty($cat_id)) {
                    if (!empty($term)) {
                        foreach ($term as $cat) {
                            if (in_array($cat->term_id, $cat_id)) {
                                ?>
                                <li><?php _e($cat->name, $this->plugin_name); ?></li>

                            <?php
                            }
                        }
                    }
                } else {
                    _e('No Category Assign', $this->plugin_name);
                }
                ?>
            </ul>   
        </div>
    </div> 
</div>