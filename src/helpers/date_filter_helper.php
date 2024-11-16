
<?php
// Helper function to get a date range based on predefined options
function getDateRange($filterType) {
    $startDate = null;
    $endDate = null;

    switch ($filterType) {
        case 'today':
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
            break;

        case 'this_week':
            $startDate = date('Y-m-d', strtotime('monday this week'));
            $endDate = date('Y-m-d', strtotime('sunday this week'));
            break;

        case 'last_week':
            $startDate = date('Y-m-d', strtotime('monday last week'));
            $endDate = date('Y-m-d', strtotime('sunday last week'));
            break;

        case 'this_month':
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-t');
            break;

        case 'last_month':
            $startDate = date('Y-m-01', strtotime('first day of last month'));
            $endDate = date('Y-m-t', strtotime('last day of last month'));
            break;

        case 'this_year':
            $startDate = date('Y-01-01');
            $endDate = date('Y-12-31');
            break;

        case 'last_year':
            $startDate = date('Y-01-01', strtotime('first day of january last year'));
            $endDate = date('Y-12-31', strtotime('last day of december last year'));
            break;

        default:
            // Handle custom range if provided
            if (isset($filterType['start_date']) && isset($filterType['end_date'])) {
                $startDate = $filterType['start_date'];
                $endDate = $filterType['end_date'];
            }
            break;
    }

    return [$startDate, $endDate];
}

// Helper function to apply a date range filter to a query
function applyDateRangeFilter($query, $startDate, $endDate) {
    if ($startDate && $endDate) {
        $query .= " WHERE purchase_date BETWEEN :start_date AND :end_date";
    }
    return $query;
}

// Helper function to bind date parameters in prepared statement
function bindDateRange($stmt, $startDate, $endDate) {
    if ($startDate && $endDate) {
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
    }
}
?>
