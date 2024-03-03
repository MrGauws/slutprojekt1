jQuery(document).ready(function($) {
    // Visa overlay och stjärnor när användaren hover över produktkortet
    $('.woocommerce ul.products li.product').hover(function() {
        // Visa overlay
        $(this).find('.product-overlay').fadeIn();
        // Visa stjärnor
        $(this).find('.star-rating-overlay').fadeIn();
    }, function() {
        // Dölj overlay
        $(this).find('.product-overlay').fadeOut();
        // Dölj stjärnor
        $(this).find('.star-rating-overlay').fadeOut();
    });
});