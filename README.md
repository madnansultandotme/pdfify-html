# PDFify HTML WordPress Plugin

PDFify HTML is a WordPress plugin that allows users to convert any webpage URL into a downloadable PDF. This plugin captures the HTML content of a specified URL, converts it into a PDF, and provides a download link once the conversion is complete.

---

## Features

1. **HTML to PDF Conversion**
   - Captures the HTML content of a specified webpage URL.
   - Sends the HTML content to the server for conversion.
   - Generates a downloadable PDF file for the user.

2. **User Input for URL**
   - Provides an input field where users can enter the URL of the page they want to convert to PDF.

3. **WordPress Dashboard Button Integration**
   - Adds a "Generate PDF" button in the WordPress admin interface.
   - Allows users to trigger the HTML to PDF conversion from the dashboard.

4. **Download PDF Button**
   - Displays a "Download PDF" button after the PDF is generated.
   - Resets the input field and hides the "Download PDF" button after the file is downloaded.

5. **Loader Display During PDF Generation**
   - Shows a loading screen to indicate that the PDF is being generated.
   - Disappears once the PDF is ready for download.

6. **Basic Security and Access Control**
   - Ensures only authorized users (logged-in admins) can access the HTML to PDF conversion feature.

---

## Project Structure

```plaintext
pdfify-html/
├── admin/
│   └── admin-page.php           # Core admin page logic for the WordPress dashboard.
├── assets/
│   ├── css/
│   │   └── admin-style.css       # Styles for the admin page and elements.
│   └── js/
│       └── admin-script.js       # JavaScript for handling user input, AJAX calls, and displaying the loader.
├── languages/                    # Language files for localization.
├── pdfify-html.php               # Main plugin file to initialize and load the plugin in WordPress.
├── README.md                     # Documentation for the plugin.
├── test.html                     # Sample HTML for testing conversion.
├── vendor/
│   ├── autoload.php              # Composer autoload file.
│   ├── dompdf/                   # DomPDF library for PDF conversion.
│   ├── masterminds/              # HTML5 parser library.
│   └── sabberworm/               # CSS parser library for DomPDF.
└── composer.json                 # Composer configuration file for dependencies.
