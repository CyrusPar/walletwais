<?php
function displayBudgeting($userId) {
    global $usersFacade; // Assuming $usersFacade is defined elsewhere

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        ?>
        <div class="wallet-container">
            <div class="wallet-card">
                <h2>Wallet</h2>
                <div class="amount"><?= number_format($user['wallet'], 2) ?> Php</div>
            </div>
        </div>
        <?php
    }
}
?>
