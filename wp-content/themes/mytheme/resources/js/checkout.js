jQuery(document).ready(function($) {
    // Wait for the document to be fully loaded
    $(window).on('load', function() {
        // Find the table header with class "product-name" and text content "Product"
        $('th.product-name:contains("Product")').text('Summary');
    });

    // Flytta #payment till .right-column
    $('#payment').appendTo('.right-column');

    // Lyssna på ändringar i radio-knappar och tillämpa aktiv klass
    $('input[type="radio"]').change(function() {
        $('.payment_methods.methods li').removeClass('active');
        if ($(this).is(':checked')) {
            $(this).closest('li').addClass('active');
        }
    });
});

