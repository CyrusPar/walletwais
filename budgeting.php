<?php
function displayBudgeting($userId) {
    global $usersFacade;

    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        $walletValue = $user['wallet'];
        $dailyValue = $walletValue / 31;
        $weeklyValue = $walletValue / 4;
        ?>
        <div class="wcontainer">
            <div class="wcard">
                <h2>Budgeting Suggestion</h2>
                <div class="wbreakdown">
                    <div class="breakdown-item">
                        <h4>Daily</h4>
                        <p><?= number_format($dailyValue, 2) ?> Php</p>
                    </div>
                    <div class="breakdown-item">
                        <h4>Weekly</h4>
                        <p><?= number_format($weeklyValue, 2) ?> Php</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<style>
    .wcontainer {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 20px;
    }

    .wcard {
        background-color: #fff;
        color: #058240;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 600px;
    }

    .wcard h2 {
        margin-bottom: 20px;
        font-size: 33px;
    }

    .wcard .amount {
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .wbreakdown {
        display: flex;
        justify-content: space-around;
    }

    .breakdown-item {
        width: 45%;
        padding: 10px;
        background-color: #f1f1f1;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .breakdown-item h4 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .breakdown-item p {
        font-size: 20px;
        font-weight: bold;
    }
</style>
