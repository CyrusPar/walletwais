<?php
function getWeekStartEndDates($date) {
    $dt = new DateTime($date);
    $dt->modify('Monday this week');
    $startDate = $dt->format('Y-m-d');
    $dt->modify('Sunday this week');
    $endDate = $dt->format('Y-m-d');
    return [$startDate, $endDate];
}

function historyTracker($userId, $startDate = null, $endDate = null) {
    global $usersFacade, $billsFacade;

    if (!$startDate || !$endDate) {
        $currentDate = new DateTime();
        $currentDate->modify('this week');
        $startDate = $currentDate->format('Y-m-d');
        $endDate = (new DateTime($startDate))->modify('Sunday this week')->format('Y-m-d');
    }

    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        ?>
        <div style="background-color: #058240; color: white; padding: 10px; margin-top: 20px; border-radius: 8px;">
            <h2 style="text-align: center; margin: 0;">HISTORY OF PROCESSED BILLS</h2>
        </div>
        <div style="margin-top: 20px;">
            <?php if (!empty($fetchBillsByCode)) { ?>
                <table style="width: 100%; border-collapse: collapse; color: #058240; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #d9f1e4; text-align: center;">
                            <th style="padding: 10px; border: 1px solid #058240; text-align: center;">Bill Name</th>
                            <th style="padding: 10px; border: 1px solid #058240; text-align: center;">Expense</th>
                            <th style="padding: 10px; border: 1px solid #058240; text-align: center;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fetchBillsByCode as $bill) { ?>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #058240;"><?= htmlspecialchars($bill['bill_name']) ?></td>
                                <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= number_format((float) $bill['expense'], 2) ?> Php</td>
                                <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= htmlspecialchars($bill['Date']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p style="color: #058240;">No bills found for this user within the selected week.</p>
            <?php } ?>
        </div>
        <?php
    }
}

if (isset($_GET['selectedDate'])) {
    $selectedDate = $_GET['selectedDate'];
    list($startDate, $endDate) = getWeekStartEndDates($selectedDate);
    historyTracker($userId, $startDate, $endDate);
}
?>
