<?php
/*
Plugin Name: PDFify HTML
Plugin URI: https://example.com/pdfify-html   // Replace with your actual plugin page URL
Description: PDFify HTML is a WordPress plugin developed by Team Zeppelin that allows users to convert HTML content into PDF files, preserving original layout, styling, and design for seamless sharing, archiving, or printing. This plugin is ideal for anyone looking to generate accurate, high-quality PDF versions of web pages or HTML content.
Version: 1.0.0
Author: Muhammad Adnan Sultan & Team Zeppelin
Author URI: https://example.com/team-zeppelin   // Replace with a team page or author link
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: pdfify-html
Domain Path: /languages

This plugin, PDFify HTML, was developed by Team Zeppelin as part of a mission to simplify HTML-to-PDF conversions within WordPress. With built-in support for complex layouts, images, and styles, PDFify HTML enables WordPress users to easily produce professional-quality PDFs from any HTML content.

Copyright (c) 2024 Team Zeppelin

PDFify HTML is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

PDFify HTML is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
defined('ABSPATH') || exit;

// Include necessary files and dependencies
require_once plugin_dir_path(__FILE__) . 'admin/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Enqueue assets for both front-end and admin pages
function pdfify_html_enqueue_assets() {
    wp_enqueue_style('pdfify-html-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('pdfify-html-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), null, true);

    // Localize script with AJAX URL
    wp_localize_script('pdfify-html-admin-script', 'pdfify_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'pdfify_html_enqueue_assets');
add_action('wp_enqueue_scripts', 'pdfify_html_enqueue_assets');

// Register AJAX action
add_action('wp_ajax_pdfify_convert_url_to_pdf', 'pdfify_convert_url_to_pdf');

// HTML to PDF Conversion function
function pdfify_convert_url_to_pdf() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    // Get URL from AJAX request
    $url = isset($_POST['url']) ? esc_url_raw($_POST['url']) : '';

    if (empty($url)) {
        wp_send_json_error(['message' => 'No URL provided']);
    }

    // Use cURL to fetch HTML content from the provided URL
    $html_content = file_get_contents($url);

    if (!$html_content) {
        wp_send_json_error(['message' => 'Could not retrieve HTML content']);
    }

    // Initialize Dompdf and convert HTML to PDF
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->loadHtml($html_content);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Save the PDF to the uploads directory
    $upload_dir = wp_upload_dir();
    $pdf_path = $upload_dir['path'] . '/pdfify_html_' . time() . '.pdf';
    file_put_contents($pdf_path, $dompdf->output());

    $pdf_url = $upload_dir['url'] . '/pdfify_html_' . time() . '.pdf';
    wp_send_json_success(['pdf_url' => $pdf_url]);
}
?>
