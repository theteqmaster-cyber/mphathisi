<?php
/**
 * Secure CV Download Endpoint
 * Serves the compiled single-page PDF with correct headers.
 */

$pdfPath = __DIR__ . '/../assets/cv.pdf';

if (file_exists($pdfPath)) {
    // Clear output buffer to prevent any corrupt bytes
    if (ob_get_level()) {
        ob_end_clean();
    }
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Mphathisi_Ndlovu_CV.pdf"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdfPath));
    
    // Read and output the file contents
    readfile($pdfPath);
    exit;
} else {
    // HTTP 404 response if the file was not found
    header("HTTP/1.1 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "<p>The requested CV document is not available. Please verify the asset path.</p>";
    exit;
}
