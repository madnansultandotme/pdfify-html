// File: admin/admin-page.php
<?php
function pdfify_html_admin_page() {
    ?>
    <div class="wrap">
        <h1>HTML to PDF Converter</h1>
        <button id="pdfify-convert-button" class="button button-primary">Generate PDF</button>
        <div id="pdf-download-link"></div>
    </div>
    <?php
}

function pdfify_html_admin_menu() {
    add_menu_page('PDFify HTML', 'PDFify HTML', 'manage_options', 'pdfify-html', 'pdfify_html_admin_page', 'dashicons-media-document', 100);
}
add_action('admin_menu', 'pdfify_html_admin_menu');
