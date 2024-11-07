// File: assets/js/admin-script.js

jQuery(document).ready(function($) {
    $('#pdfify-convert-button').on('click', function() {
        const url = $('#pdfify-url').val().trim();

        if (!url) {
            alert('Please enter a valid URL.');
            return;
        }

        // AJAX request to convert HTML to PDF
        $.post(pdfify_ajax.ajax_url, {
            action: 'pdfify_convert_url_to_pdf',
            url: url
        }, function(response) {
            if (response.success) {
                $('#pdf-download-link').html(`<a href="${response.data.pdf_url}" target="_blank" download>Click here to download your PDF</a>`);
            } else {
                alert('Error: ' + response.data.message);
            }
        });
    });
});
