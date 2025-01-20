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
        <div class="">
            <h5>Master Your Finances!</h5>
            <p>Learn how to track and save effectively.</p>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Set a Budget
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                                <p>7 Ways to Track Your Monthly Expenses <br> <small>By: NerdWallet</small></p>
                                <p>This article provides practical strategies for monitoring your spending, including categorizing expenses and building a budget.</p>
                                <a href="https://www.nerdwallet.com/article/finance/tracking-monthly-expenses">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>How to Track Your Monthly Expenses <br> <small>By: Ramsey Solutions</small></p>
                                <p>This guide outlines various methods for expense tracking, such as using budgeting apps and the envelope system, to help you manage your finances effectively.</p>
                                <a href="https://www.ramseysolutions.com/budgeting/how-to-track-expenses">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>How to Budget and Track Expenses Successfully</p>
                                <p>This video offers insights into organizing your spending using a budget planner, providing visual guidance on effective expense tracking.</p>
                                <a href="https://youtu.be/iQOQFDnRpcs?si=qCVx8t4h3IrtAx7r">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Track Daily Expenses
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                                <p>How to Stick to Your Budget: Track Your Spending <br> <small>By: AICPA</small></p>
                                <p>This article emphasizes the importance of daily expense tracking and offers practical tips to maintain your budget effectively. </p>
                                <a href="https://www.aicpa-cima.com/resources/article/how-to-stick-to-your-budget-track-your-spending">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>How to Track Your Expenses and Manage Your Finances</p>
                                <p>This video provides a step-by-step approach to daily expense tracking, helping you stay on top of your finances.</p>
                                <a href="https://youtu.be/IfpAjsytwy0?si=eG41gLNLf7avMDjQ">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>3 Easy Ways to Track Expenses for Beginners <br> <small>By: Frugal Living</small></p>
                                <p>This video introduces simple methods for beginners to monitor their daily spending habits.</p>
                                <a href="https://youtu.be/ZmthxqxuFQI?si=PJr5mGOS31QpmJPx">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Save Before Spending
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                                <p>Tips for Budgeting to Meet Your Financial Goals <br> <small>By: USAGov</small></p>
                                <p>This article provides strategies on prioritizing savings to achieve financial goals, emphasizing the importance of saving before spending.</p>
                                <a href="https://www.usa.gov/features/budgeting-to-meet-financial-goals">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>How I Manage My Personal Finances (in 5 minutes a week)</p>
                                <p>This video shares a personal approach to managing finances efficiently, highlighting the practice of saving before spending.</p>
                                <a href="https://youtu.be/aKKqvi6AsEw?si=J5P54LFHwX_n5Iky">Read More</a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <p>Ultimate Spending Tracker Guide & FREE Template!</p>
                                <p>This video offers a comprehensive guide on tracking spending and includes a free template to assist in managing expenses, promoting the habit of saving before spending.</p>
                                <a href="https://youtu.be/DDx0RiSyIXg?si=exYQCXnVSoNvFbL5">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>