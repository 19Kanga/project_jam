<?php
require_once __DIR__ . '/../models/feed_purchase.php';
require_once __DIR__ . '/../models/medical.php';
require_once __DIR__ . '/../models/purchases.php';
require_once __DIR__ . '/../config/database.php';

class ExportExpenseReportController {
    private $db;
    private $feedPurchaseController;
    private $medicalController;
    private $purchasesController;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->feedPurchaseController = new FeedPurchaseController();
        $this->medicalController = new MedicalController();
        $this->purchasesController = new PurchasesController();
    }

    public function exportToCSV() {
        $feedExpenses = $this->feedPurchaseController->getTotalFeedExpenses();
        $medicalExpenses = $this->medicalController->getTotalMedicalExpenses();
        $birdPurchases = $this->purchasesController->getTotalBirdPurchases();

        $filename = "expense_report_" . date('Y-m-d') . ".csv";
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen("php://output", "w");
        fputcsv($output, ['Category', 'Description', 'Date', 'Amount (INR)']);

        foreach ($feedExpenses['details'] as $feed) {
            fputcsv($output, ['Feed Purchase', $feed['feed_type'], $feed['purchase_date'], $feed['cost']]);
        }
        foreach ($medicalExpenses['details'] as $medical) {
            fputcsv($output, ['Medical', $medical['notes'], $medical['checkup_date'], $medical['cost']]);
        }
        foreach ($birdPurchases['details'] as $purchase) {
            fputcsv($output, ['Bird Purchase', $purchase['species'], $purchase['purchase_date'], $purchase['purchase_cost']]);
        }

        fclose($output);
        exit();
    }

    public function exportToPDF() {
        $feedExpenses = $this->feedPurchaseController->getTotalFeedExpenses();
        $medicalExpenses = $this->medicalController->getTotalMedicalExpenses();
        $birdPurchases = $this->purchasesController->getTotalBirdPurchases();

        // Initialize PDF (using TCPDF or FPDF)
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $html = '<h3>Expense Report</h3><table border="1"><thead><tr><th>Category</th><th>Description</th><th>Date</th><th>Amount (INR)</th></tr></thead><tbody>';

        foreach ($feedExpenses['details'] as $feed) {
            $html .= "<tr><td>Feed Purchase</td><td>{$feed['feed_type']}</td><td>{$feed['purchase_date']}</td><td>₹{$feed['cost']}</td></tr>";
        }
        foreach ($medicalExpenses['details'] as $medical) {
            $html .= "<tr><td>Medical</td><td>{$medical['notes']}</td><td>{$medical['checkup_date']}</td><td>₹{$medical['cost']}</td></tr>";
        }
        foreach ($birdPurchases['details'] as $purchase) {
            $html .= "<tr><td>Bird Purchase</td><td>{$purchase['species']}</td><td>{$purchase['purchase_date']}</td><td>₹{$purchase['purchase_cost']}</td></tr>";
        }

        $html .= '</tbody></table>';
        $pdf->writeHTML($html);
        $pdf->Output('expense_report.pdf', 'D');  // Download the PDF
        exit();
    }
}

$exportController = new ExportExpenseReportController();
if ($_GET['format'] == 'csv') {
    $exportController->exportToCSV();
} else if ($_GET['format'] == 'pdf') {
    $exportController->exportToPDF();
}
