jQuery(document).ready(function($) {
    $('.woocommerce ul.products li.product').hover(function() {

        $(this).find('.product-overlay').fadeIn();

        $(this).find('.star-rating-overlay').fadeIn();
    }, function() {

        $(this).find('.product-overlay').fadeOut();

        $(this).find('.star-rating-overlay').fadeOut();
    });
});