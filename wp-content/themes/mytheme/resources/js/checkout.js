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




function applyFreeShipping() {
    var orderTotalElement = document.querySelector('.order-total .woocommerce-Price-amount');
    var shippingList = document.getElementById('shipping_method');

    if (orderTotalElement && shippingList) {
        var orderTotal = parseFloat(orderTotalElement.textContent.replace(',', '.'));
        if (orderTotal >= 1000) {
            var freeShippingOption = shippingList.querySelector('li:first-child');
            if (freeShippingOption) {
                while (shippingList.childNodes.length > 1) {
                    shippingList.removeChild(shippingList.lastChild);
                }
                var input = freeShippingOption.querySelector('input[type="radio"]');
                if (input) {
                    input.checked = true;
                }
            }
        }
    }
}

var observer = new MutationObserver(function(mutations) {
    applyFreeShipping();
});

var config = { childList: true, subtree: true };
observer.observe(document.body, config);

document.addEventListener('DOMContentLoaded', function() {
    applyFreeShipping();
});


document.addEventListener('DOMContentLoaded', function() {
    // Kontrollera om bilden redan finns innan du lägger till den igen
    if (!document.querySelector('.wpmc-tab-item.current.wpmc-billing img')) {
        var imagePath = 'https://slutprojekt1.test/wp-content/themes/mytheme/resources/images/Location.png';
        var imgElement = document.createElement('img');
        imgElement.src = imagePath;
        imgElement.alt = 'Locationikonen';
        var currentTabItem = document.querySelector('.wpmc-tab-item.current.wpmc-billing');
        // Lägg till bilden
        currentTabItem.insertBefore(imgElement, currentTabItem.firstChild);
        // Dölj numret om det finns
        var tabNumber = currentTabItem.querySelector('.wpmc-tab-number');
        if (tabNumber) {
            tabNumber.style.display = 'none';
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Kontrollera om bilden redan finns innan du lägger till den igen
    if (!document.querySelector('.wpmc-tab-item.wpmc-shipping img')) {
        var imagePath = 'https://slutprojekt1.test/wp-content/themes/mytheme/resources/images/Shipping.png';
        var imgElement = document.createElement('img');
        imgElement.src = imagePath;
        imgElement.alt = 'Shippingikonen';
        var shippingTabItem = document.querySelector('.wpmc-tab-item.wpmc-shipping');
        // Lägg till bilden
        shippingTabItem.insertBefore(imgElement, shippingTabItem.firstChild);
        // Dölj numret om det finns
        var tabNumber = shippingTabItem.querySelector('.wpmc-tab-number');
        if (tabNumber) {
            tabNumber.style.display = 'none';
        }
    }
});


document.addEventListener('DOMContentLoaded', function() {
    // Kontrollera om bilden redan finns innan du lägger till den igen
    if (!document.querySelector('.wpmc-tab-item[data-step-title="review"] img')) {
        var imagePath = 'https://slutprojekt1.test/wp-content/themes/mytheme/resources/images/Payment.png';
        var imgElement = document.createElement('img');
        imgElement.src = imagePath;
        imgElement.alt = 'Paymentikonen';
        var reviewTabItem = document.querySelector('.wpmc-tab-item[data-step-title="review"]');
        // Lägg till bilden
        reviewTabItem.insertBefore(imgElement, reviewTabItem.firstChild);
        // Dölj numret om det finns
        var tabNumber = reviewTabItem.querySelector('.wpmc-tab-number');
        if (tabNumber) {
            tabNumber.style.display = 'none';
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var productCount = document.querySelectorAll('.product').length;
    document.getElementById("product-count").textContent = productCount;
});