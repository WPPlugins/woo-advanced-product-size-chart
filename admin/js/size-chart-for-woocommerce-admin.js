/*
 * Custom Script file
 */

jQuery(document).ready(function ($) {

// ******************************************// 
// ** Select Box Script for Category ** 
// ******************************************// 	

    $('#chart-categories').select2(
        {
            maximumSelectionLength: 100
        });


// ******************************************// 
// ** Ajax for delete image ** 
// ******************************************//
    $("a.delete-chart-image").click(function () {
        post_id = $(this).attr('id');
        var data = {
            'action': 'size_chart_delete_image',
            'post_id': post_id
        };
        jQuery.post(ajaxurl, data, function (response) {
            alert('image Delete Succefully');
            $('#field-image img').attr('src', response);
            $('#field-image img').attr('width', '');
            $('#field-image img').attr('height', '');
            $('.delete-chart-image').css('display', 'none');

        });
    });
// ******************************************// 
// ** Preview Chart ** 
// ******************************************//
    $("a.preview_chart").click(function () {
        chart_id = $(this).attr('id');
        $('.size-chart-model').css('padding', '0');
        $('#wait').show();
        $('[data-remodal-id=modal]').html('');
        var data = {
            'action': 'size_chart_preview_post',
            'chart_id': chart_id
        };
        jQuery.post(ajaxurl, data, function (response) {
            $('#wait').hide();
            $('.size-chart-model').css('padding', '35px');
            $('[data-remodal-id=modal]').html(response);

        });
    });
    


});
(function ($) {
        jQuery(window).load(function () {
            $("#aec_dialog").dialog({
                modal: true, title: 'Subscribe To Our Newsletter', zIndex: 10000, autoOpen: true,
                width: '400', resizable: false,
                position: {my: "center", at: "center", of: window},
                dialogClass: 'dialogButtons',
                buttons: [
                    {
                        id: "subscribemeaecfree",
                        text: "Subscribe Me",
                        click: function () {
                            // $(obj).removeAttr('onclick');
                            // $(obj).parents('.Parent').remove();
                            var email_id = jQuery('#aec_txt_user_sub').val();
                            var data = {
                                'action': 'sc_add_plugin_user',
                                'email_id': email_id
                            };
                            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                            jQuery.post(ajaxurl, data, function (response) {
                                jQuery('#aec_dialog').html('<h2>You have been successfully subscribed');
                                jQuery(".ui-dialog-buttonpane").remove();
                            });
                        }
                    },
                    {
                        id: "aecNo",
                        text: "No, Remind Me Later",
                        click: function () {

                            jQuery(this).dialog("close");
                        }
                    },
                ]
            });

            jQuery("div.dialogButtons .ui-dialog-buttonset button").removeClass('ui-state-default');
            jQuery("div.dialogButtons .ui-dialog-buttonset button").addClass("button-primary woocommerce-save-button");

        });

    })(jQuery);