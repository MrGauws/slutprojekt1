jQuery(document).ready(function ($) {
    // Kontrollera om ajax_variabels är definierat
    if (typeof ajax_variabels !== 'undefined') {
        // Example AJAX request
        $.ajax({
            url: ajax_variabels.ajaxUrl,
            type: "POST",
            dataType: "json",
            data: {
                action: "mytheme_getbyajax",
                nonce: ajax_variabels.nonce,
            },
            success: function (response) {
                // Kontrollera om det finns någon respons
                if (response) {
                    console.log("Response from server:", response);
                } else {
                    console.log("Empty response received from server.");
                }
            },
            error: function (xhr, status, error) {
                // Hantera AJAX-fel
                console.error("AJAX error:", error);
            },
        });
    } else {
        console.error("ajax_variabels is not defined. Check if it's properly localized.");
    }
});