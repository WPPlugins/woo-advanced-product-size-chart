<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    size-chart-for-woocommerce
 * @subpackage size-chart-for-woocommerce/public/includes
 * @author     Multidots
 */
?>
<?php if (isset($chart_label) && $chart_label != '') { ?>
    <h3><?php echo $chart_label; ?></h3>
<?php } ?>
<?php
$post_data = get_post($chart_id);
if ($post_data->post_content) {
    $content = apply_filters('the_content', $post_data->post_content);
    echo '<div class="chart-content"><span>' . __('How to measure', $this->plugin_name) . '</span>' . $content . '</div>';
}
?>
<?php
$chart_image = get_post_meta($post_data->ID, 'primary-chart-image', true);
if ($chart_image):
    $chart_image = wp_get_attachment_image_src($chart_image, 'full');
    ?>
    <div class="chart-image">
        <img src="<?php echo esc_attr($chart_image[0]); ?> " alt="<?php esc_attr(__($post->post_title, $this->plugin_name)); ?>"
             title="<?php esc_attr($chart_label); ?>" />
    </div> 
<?php endif; ?>

<?php if (isset($chart_table)) { ?>
    <div class="chart-table">
        <?php $this->size_chart_display_table($chart_table); ?>
    </div>
<?php } ?>
