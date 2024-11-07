// File: assets/js/admin-script.js

jQuery(document).ready(function($) {
    // Add loader HTML
    $('body').append('<div id="pdfify-loader" style="display: none;">Loading...</div>');

    $('#pdfify-convert-button').on('click', function() {
        const url = $('#pdfify-url').val().trim();

        if (!url) {
            alert('Please enter a valid URL.');
            return;
        }

        // Show loader and hide download link initially
        $('#pdfify-loader').show();
        $('#pdf-download-link').html('');

        // AJAX request to convert HTML to PDF
        $.post(pdfify_ajax.ajax_url, {
            action: 'pdfify_convert_url_to_pdf',
            url: url
        }, function(response) {
            // Hide loader once the response is received
            $('#pdfify-loader').hide();

            if (response.success) {
                // Display download link and set click event for reset
                $('#pdf-download-link').html(`
                    <a id="pdf-download" href="${response.data.pdf_url}" target="_blank" download>Click here to download your PDF</a>
                `);

                // Reset form and hide download link on download click
                $('#pdf-download').on('click', function() {
                    $('#pdfify-url').val('');             // Clear input field
                    $('#pdf-download-link').html('');     // Hide download link
                });
            } else {
                alert('Error: ' + response.data.message);
            }
        }).fail(function() {
            // Hide loader if there's an error
            $('#pdfify-loader').hide();
            alert('An error occurred while processing your request.');
        });
    });
});
