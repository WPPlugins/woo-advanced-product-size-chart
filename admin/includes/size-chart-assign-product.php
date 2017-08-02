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
// Use get_post to retrieve an existing value of chart 

$meta_query_args = array(
    'post_type' => 'product',
    'order' => 'DESC',
    'meta_key' => 'prod-chart',
    'orderby' => 'meta_value', //or 'meta_value_num'
    'meta_query' => array(
        array('key' => 'prod-chart',
            'value' => $post->ID
        )));
$posts_array = get_posts($meta_query_args);
?>
<div id="size-chart-meta-fields"> 
    <div id="assign-product">
        <div class="assign-item">
            <ul>
                <?php
                if (!empty($posts_array)) {
                    foreach ($posts_array as $prod) {
                        ?>
                        <li><a href="<?php echo get_edit_post_link($prod->ID); ?>"><?php _e(get_the_title($prod->ID), $this->plugin_name); ?></a></li>
                        <?php
                    }
                } else {
                    _e('No Product Assign', $this->plugin_name);
                }
                ?>
            </ul>
        </div>
    </div> 
</div>