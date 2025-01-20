<?php
// Assuming the request contains JSON data
$data = json_decode(file_get_contents("php://input"), true);
$filterBy = $data['filterBy'];
$date = $data['date'];

// Prepare the SQL query based on the selected filter
if ($filterBy === 'day') {
    $dateFilter = new DateTime($date);
    $dateStart = $dateFilter->format('Y-m-d 00:00:00');
    $dateEnd = $dateFilter->format('Y-m-d 23:59:59');

    // Assuming fetchBillsByDateRange() fetches bills between a start and end date
    $bills = $billsFacade->fetchBillsByDateRange($dateStart, $dateEnd);
} elseif ($filterBy === 'month') {
    $dateFilter = new DateTime($date);
    $dateStart = $dateFilter->format('Y-m-01 00:00:00');
    $dateEnd = $dateFilter->format('Y-m-t 23:59:59');

    // Assuming fetchBillsByDateRange() fetches bills between a start and end date
    $bills = $billsFacade->fetchBillsByDateRange($dateStart, $dateEnd);
} elseif ($filterBy === 'year') {
    $dateFilter = new DateTime($date);
    $dateStart = $dateFilter->format('Y-01-01 00:00:00');
    $dateEnd = $dateFilter->format('Y-12-31 23:59:59');

    // Assuming fetchBillsByDateRange() fetches bills between a start and end date
    $bills = $billsFacade->fetchBillsByDateRange($dateStart, $dateEnd);
}

// Prepare the data for the chart
$labels = [];
$expenses = [];
foreach ($bills as $bill) {
    $labels[] = $bill['Date'];  // Assuming 'Date' is the bill date
    $expenses[] = $bill['expense'];  // Assuming 'expense' is the expense amount
}

// Return data as JSON
echo json_encode([
    'labels' => $labels,
    'expenses' => $expenses
]);
?>
