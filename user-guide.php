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
        <div class="d-flex justify-content-between align-items-center">
            <h5>User Guide</h5>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Analytics</h6>
            </div>
            <div class="card-body">
                <p>The analytics will show how much you paid in the individual bill or group bills.</p>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">My Bills</h6>
            </div>
            <div class="card-body">
                <p>My bills are individual bills that can be created by the user, located in the sidebar. Simply click the 'Bills' tab, and you will see the created bills. To create a bill, click the 'Add Bill' button.</p>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Group Bills</h6>
            </div>
            <div class="card-body">
                <p>Group bills are bills that can be shared with other users. To create a group bill, go to the sidebar and click the 'Group Bills' tab, where you will see the created group bills. To create a new group bill, click the 'Add Group Bill' button. To add users, click the 'View' button, and you will see the users associated with the bill. Click 'Add Member' to add a member, and after adding the member, click the 'Update' button. To update the percentage for each member, click the pen icon. You can also check each member's contributions by clicking the 'View' button under Contributions.</p>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Expense</h6>
            </div>
            <div class="card-body">
                <p>To pay the bills, simply click the expense and select whether you want to pay an Individual or Group Bill.</p>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">History</h6>
            </div>
            <div class="card-body">
                <p>In the history, you can see all the interactions you've made.</p>
            </div>
        </div>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>