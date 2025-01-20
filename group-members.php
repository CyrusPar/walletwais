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

if ($_GET['group_id']) {
    $groupId = $_GET['group_id'];
}
if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
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
            <h5>Group Members</h5>
            <div>
                <a href="add-member.php?group_id=<?= $groupId ?>&bill_name=<?= $billName ?>" class="btn btn-secondary btn-sm w-100">+ Member</a>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0"><?= $billName ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Members</th>
                                <th>Percentage</th>
                                <th>To Pay</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetchGroupMembersByBillName = $groupMembersFacade->fetchGroupMembersByBillName($billName);
                            foreach ($fetchGroupMembersByBillName as $member) { ?>
                                <tr>
                                    <td><?= $member["user_code"] ?></td>
                                    <td><?= $member["percentage"] ?></td>
                                    <td>
                                        <?php
                                        $fetchGroupBillByBillName = $groupBillsFacade->fetchGroupBillByBillName($billName);
                                        foreach ($fetchGroupBillByBillName as $bill) {
                                            $toPay = $bill["expense"] * $member["percentage"] / 100;
                                            echo $toPay;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="update-percentage.php?group_id=<?= $member["id"] ?>&bill_name=<?= $member["bill_name"] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        <?php if ($member["is_admin"] == 0) { ?>
                                            <a href="delete-group-member.php?group_id=<?= $member["id"] ?>&bill_name=<?= $member["bill_name"] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>