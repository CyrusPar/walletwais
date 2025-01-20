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

// Message variables to display alerts
$message = null;
$messageType = null;

if (isset($_POST['addAmount'])) {
    $amountToAdd = floatval($_POST['amount']);
    if ($amountToAdd > 0) {
        // Call the updateWallet method to add the amount to the wallet
        $updateResult = $usersFacade->updateWallet($userId, $amountToAdd);

        if ($updateResult) {
            $message = "Amount added successfully!";
            $messageType = "success";
        } else {
            $message = "Failed to add amount. Please try again.";
            $messageType = "danger";
        }
    } else {
        $message = "Invalid amount. Please enter a valid number.";
        $messageType = "danger";
    }
}

$fetchUserById = $usersFacade->fetchUserById($userId);
foreach ($fetchUserById as $user) { ?>

    <style>
        body {
            background-color: #058240;
        }
        .alert {
            margin-top: 20px;
        }

        .wallet-container {
            display: flex;
            flex-direction: column; /* Stack the card and button vertically */
            justify-content: flex-start; /* Align to the top */
            align-items: center; /* Horizontally center */
            height: 55vh;
            text-align: center;
            color: white;
            padding-top: 20px;
        }

        .wallet-card {
            background-color: #fff;
            color: #058240;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
            margin-top: 20px; /* Adjust the margin to move the card down a bit */
        }

        .wallet-card h2 {
            margin-bottom: 20px;
            font-size: 36px;
        }

        .wallet-card .amount {
            font-size: 40px;
            font-weight: bold;
        }

        .add-amount-btn {
            background-color: #058240;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
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

    <div class="app-body bg-light p-1">
        <!-- Alert Section (above the wallet card) -->
        <?php if ($message) { ?>
            <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <!-- Wallet Card Section -->
        <div class="wallet-container">
            <div class="wallet-card">
                <h2>Wallet</h2>
                <div class="amount"><?= number_format($user['wallet'], 2) ?> Php</div>
            </div>

            <!-- Add Amount Button (under the wallet card) -->
            <div class="d-flex justify-content-center">
                <button class="add-amount-btn" onclick="showAddAmountModal()">Add Amount</button>
            </div>
            <?php
            include 'budgeting.php';
            // Pass the userId to display the wallet and budgeting details
            displayBudgeting($userId);?>
        <?php include 'dailytracker.php';
            // Pass the userId to display the wallet and budgeting details
            dailyTracker($userId);?>
        </div>





    </div>

    <!-- Modal for Adding Amount -->
    <div id="addAmountModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
            <h5>Add Amount to Wallet</h5>
            <form method="POST" action="">
                <input type="number" name="amount" placeholder="Enter amount" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
                <button type="submit" name="addAmount" style="padding: 8px 16px; background-color: #058240; color: #fff; border: none; border-radius: 5px;">Add</button>
                <button type="button" onclick="hideAddAmountModal()" style="padding: 8px 16px; background-color: #ccc; color: #333; border: none; border-radius: 5px; margin-left: 10px;">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function showAddAmountModal() {
            document.getElementById('addAmountModal').style.display = 'flex';
        }

        function hideAddAmountModal() {
            document.getElementById('addAmountModal').style.display = 'none';
        }
    </script>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
