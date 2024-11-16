
<?php
// Helper to export data to CSV
function exportCSV($filename, $data) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // If there's any data
    if (!empty($data)) {
        // Write header row
        fputcsv($output, array_keys($data[0]));

        // Write data rows
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    }

    fclose($output);
    exit();
}

// Helper to export data to PDF using TCPDF
require_once __DIR__ . '/../../vendor/autoload.php';  // Assuming TCPDF is installed using Composer

function exportPDF($filename, $data) {
    // Create new PDF instance
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Prepare HTML content
    $html = '<h3>Report</h3>';
    $html .= '<table border="1" cellpadding="5">';
    $html .= '<thead><tr>';

    // Add table headers
    if (!empty($data)) {
        foreach (array_keys($data[0]) as $header) {
            $html .= '<th>' . $header . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        // Add table rows
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . $cell . '</td>';
            }
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table>';

    // Write the HTML to PDF
    $pdf->writeHTML($html);
    
    // Output the PDF
    $pdf->Output($filename, 'D');  // D stands for Download
    exit();
}
?>
