
<?php
function pdfify_html_admin_page() {
    ?>
    <div class="wrap">
    <h1>PDFify HTML - Convert HTML to PDF</h1>
    <input type="text" id="pdfify-url" placeholder="Enter the URL to convert to PDF" />
    <button id="pdfify-convert-button">Generate PDF</button>
    <div id="pdf-download-link"></div>
    </div>

    <?php
}

function pdfify_html_admin_menu() {
    add_menu_page('PDFify HTML', 'PDFify HTML', 'manage_options', 'pdfify-html', 'pdfify_html_admin_page', 'dashicons-media-document', 100);
}
add_action('admin_menu', 'pdfify_html_admin_menu');
