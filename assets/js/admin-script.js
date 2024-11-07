// JavaScript can be added here if needed for form validation or dynamic UI behavior
// File: assets/js/admin-script.js

jQuery(document).ready(function($) {
    $('#pdfify-convert-button').on('click', function() {
        // Capture entire page HTML content
        const htmlContent = document.documentElement.outerHTML;

        // AJAX request to send HTML to server for PDF conversion
        $.post(pdfify_ajax.ajax_url, {
            action: 'pdfify_convert_html_to_pdf',
            html_content: htmlContent
        }, function(response) {
            if (response.success) {
                $('#pdf-download-link').html(`<a href="${response.data.pdf_url}" download>Click here to download your PDF</a>`);
            } else {
                alert('Error generating PDF: ' + response.data.message);
            }
        });
    });
});
