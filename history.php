<?php

include realpath(__DIR__ . '/app/layout/header.php');

$userId = 0;
if ($_SESSION['user_id']) {
    $userId = $_SESSION['user_id'];
}
if ($_SESSION['user_code']) {
    $userCode = $_SESSION['user_code'];
}

if ($userId == 0) {
    header("Location: splash.php");
}

$fetchUserById = $usersFacade->fetchUserById($userId);
foreach ($fetchUserById as $user) { ?>

    <style>
        body {
            background-color: #058240;
        }
        .table {
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            color: #333;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        #historySection {
            display: none; /* Initially hide the history section */
        }
        .show-button {
            background-color: #058240;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto; /* Centers the button */
            display: block;
            text-align: center;
        }
    </style>

    <?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>

    <div class="container">
        <div class="app-header d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <!-- Add Click Event to Toggle Sidebar -->
                <i class="bi bi-list text-light fs-1" id="sidebarToggle"></i>
            </div>
            <div class="d-flex align-items-center text-center">
                <p class="text-light m-0 ps-2 pt-1">Welcome <br> <span><?= substr($user['email'], 0, 8) . '***' ?></span></p>
            </div>
            <div></div>
        </div>
    </div>

    <div class="app-body bg-light p-3">
        <h5>History</h5>
        
        <!-- Table for History with Amount -->
        <h6>Paid History </h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Bill</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchHistoryByUserCode = $usersFacade->fetchHistoryByUserCode($userCode);
                $messagesWithoutAmount = []; // To store messages without amounts
                foreach ($fetchHistoryByUserCode as $history) {
                    $message = $history['message'];

                    // Regular expression to capture the bill name and amount
                    $pattern = '/named (\w+).*?amount of (\d+)/';
                    preg_match($pattern, $message, $matches);

                    // If an amount is found, process and display the data
                    if (!empty($matches[2])) {
                        $bill = $matches[1]; // Bill name extracted from the message
                        $amount = $matches[2]; // Amount extracted from the message
                        ?>
                        <tr>
                            <td><?= $bill ?></td>
                            <td><?= $amount ?></td>
                        </tr>
                    <?php } else {
                        // Otherwise, store the message in the array to display later
                        $messagesWithoutAmount[] = $message;
                    }
                } ?>
            </tbody>
        </table>

        <!-- Button for toggling history -->
        <h6>History </h6>
        <button class="show-button" onclick="toggleHistory()">Show All History</button>
        <div id="historySection">
            <ul>
                <?php foreach ($messagesWithoutAmount as $msg) { ?>
                    <li><?= $msg ?></li>
                <?php } ?>
            </ul>
        </div>
        <?php

        include 'historybills.php';
        historyTracker($userId);

        ?>
    </div>

    <script>
        function toggleHistory() {
            const historySection = document.getElementById('historySection');
            if (historySection.style.display === 'none' || historySection.style.display === '') {
                historySection.style.display = 'block'; // Show the section
            } else {
                historySection.style.display = 'none'; // Hide the section
            }
        }
    </script>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
