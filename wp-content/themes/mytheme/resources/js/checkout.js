jQuery(document).ready(function($) {
    // Wait for the document to be fully loaded
    $(window).on('load', function() {
        // Find the table header with class "product-name" and text content "Product"
        $('th.product-name:contains("Product")').text('Summary');
    });


    $('#payment').appendTo('.right-column');


    $('input[type="radio"]').change(function() {
        $('.payment_methods.methods li').removeClass('active');
        if ($(this).is(':checked')) {
            $(this).closest('li').addClass('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var checkbox = document.getElementById("terms");

    checkbox.checked = true;
});


$(document).ready(function() {
    // Debounce function to prevent multiple executions
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    // Function to move the element
    var moveElement = debounce(function() {
        // Move the element
        $('#wc-stripe-payment-request-wrapper').css('margin-top', '500px');
    }, 200); // Adjust the debounce delay as needed

    // Execute the function when the document is ready
    moveElement();
});