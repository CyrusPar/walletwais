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

        .profile-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }

        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #058240; /* Green border around the image */
        }

        .profile-card h5 {
            color: #058240;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile-card p {
            color: #666;
            margin: 5px 0;
        }

        .profile-card .fw-bold {
            color: #333;
        }

        .btn-logout {
            margin-top: 20px;
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #c9302c;
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
        <div class="profile-card">
            <img src="./public/img/defaultprofile.jpg" alt="Default Profile Image">
            <h5><?= htmlspecialchars($user['email']) ?></h5>
            <p><span class="fw-bold">User Code:</span> <?= htmlspecialchars($user['user_code']) ?></p>
        </div>
        <button class="btn-logout w-100" onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
