jQuery(document).ready(function($) {
    // Wait for the document to be fully loaded
    $(window).on('load', function() {
        // Find the table header with class "product-name" and text content "Product"
        $('th.product-name:contains("Product")').text('Summary');
    });
});

jQuery(document).ready(function($) {
    // Funktion för att ställa in bredden på review-order-tabellen
    function setReviewOrderTableWidth() {
        var parentWidth = $('.row').width();
        $('.woocommerce-checkout-review-order-table').css('width', parentWidth);
    }
    setReviewOrderTableWidth();

    // Lyssna på AJAX-evenemanget för att köra funktionen igen efter att AJAX har slutförts eftersom den första körs bort.
    $(document).ajaxComplete(function() {
        setReviewOrderTableWidth();
    });
});


