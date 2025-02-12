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
            <h5>Group Budgeting</h5>
            <div>
                <a href="add-group.php" class="btn btn-secondary btn-sm w-100">+ Group</a>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Overview</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bill Name</th>
                                <th>Expense</th>
                                <th>Members</th>
                                <th>Contributions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetchGroupBillByCode = $groupBillsFacade->fetchGroupBillByUserCode($userCode);
                            foreach ($fetchGroupBillByCode as $bill) { ?>
                                <tr>
                                    <td><?= $bill["bill_name"] ?></td>
                                    <td><?= $bill["expense"] ?></td>
                                    <td><a href="group-members.php?group_id=<?= $bill['group_id'] ?>&bill_name=<?= $bill['bill_name'] ?>" class="text-decoration-none">View</a></td>
                                    <td><a href="group-contributions.php?bill_name=<?= $bill['bill_name'] ?>" class="text-decoration-none">View</a></td>
                                    <td>
                                        <a href="update-group.php?bill_id=<?= $bill["id"] ?>&bill_name=<?= $bill["bill_name"] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="delete-group-bill.php?user_code=<?= $userCode ?>&group_id=<?= $bill["group_id"] ?>&bill_name=<?= $bill["bill_name"] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
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