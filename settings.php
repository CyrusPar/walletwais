<?php

include realpath(__DIR__ . '/app/layout/header.php');

$userId = 0;
if ($_SESSION['user_id']) {
    $userId = $_SESSION['user_id'];
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
        <h5>Settings</h5>
        <?php
        $fetchUserById = $usersFacade->fetchUserById($userId);
        foreach ($fetchUserById as $user) { ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="m-0">Profile</h6>
                </div>
                <div class="card-body">
                    <p>
                        <span class="fw-bold">Email:</span> <br> <?= $user["email"] ?> <br>
                        <span class="fw-bold">User Code:</span> <br> <?= $user["user_code"] ?>
                    </p>
                </div>
                <!-- <div class="card-footer">
                    <a href="#" class="btn btn-warning w-100">Update</a>
                </div> -->
            </div>
        <?php } ?>
        <div class="mt-3">
            <a href="logout.php" class="btn btn-danger w-100">Logout</a>
        </div>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>