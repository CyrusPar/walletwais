<?php

class UsersFacade extends DBConnection
{

    function register($userCode, $email, $password)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_users (user_code, email, password) VALUES (?, ?, ?)");
        $sql->execute([$userCode, $email, $password]);
        return $sql;
    }

    function fetchUserById($userId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_users WHERE id = ?");
        $sql->execute([$userId]);
        return $sql;
    }

    function verifyEmail($email)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_users WHERE email = ?");
        $sql->execute([$email]);
        $count = $sql->rowCount();
        return $count;
    }

    function verifyEmailPassword($email, $password)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_users WHERE email = ? AND password = ?");
        $sql->execute([$email, $password]);
        $count = $sql->rowCount();
        return $count;
    }

    function verifyUserCode($userCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_users WHERE user_code = ?");
        $sql->execute([$userCode]);
        $count = $sql->rowCount();
        return $count;
    }

    function login($email, $password)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_users WHERE email = ? AND password = ?");
        $sql->execute([$email, $password]);
        return $sql;
    }

    function addHistory($userCode, $message)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_history (user_code, message) VALUES (?, ?)");
        $sql->execute([$userCode, $message]);
        return $sql;
    }

    function fetchHistoryByUserCode($userCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_history WHERE user_code = ?");
        $sql->execute([$userCode]);
        return $sql;
    }

    /**
     * Update Wallet: Adds an amount to the user's wallet.
     * 
     * @param int $userId The ID of the user whose wallet will be updated.
     * @param float $amount The amount to add to the wallet.
     * @return bool True if the wallet was successfully updated, otherwise False.
     */
    function updateWallet($userId, $amount)
    {
        // First, fetch the current wallet balance.
        $sql = $this->connect()->prepare("SELECT wallet FROM tbl_users WHERE id = ?");
        $sql->execute([$userId]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $currentBalance = floatval($result['wallet']);
            $newBalance = $currentBalance + $amount;

            // Update the wallet with the new balance.
            $updateSql = $this->connect()->prepare("UPDATE tbl_users SET wallet = ? WHERE id = ?");
            $updateResult = $updateSql->execute([$newBalance, $userId]);

            return $updateResult;
        }

        return false;
    }

    function updateSavings($userId, $amount)
    {
        // First, fetch the current wallet balance.
        $sql = $this->connect()->prepare("SELECT savings FROM tbl_users WHERE id = ?");
        $sql->execute([$userId]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $currentBalance = floatval($result['savings']);
            $newBalance = $currentBalance + $amount;

            // Update the wallet with the new balance.
            $updateSql = $this->connect()->prepare("UPDATE tbl_users SET savings = ? WHERE id = ?");
            $updateResult = $updateSql->execute([$newBalance, $userId]);

            return $updateResult;
        }

        return false;
    }
    
    function fetchSavingsByUserId($userId)
    {
        // Query to fetch the savings from the tbl_users table for the given user ID
        $sql = $this->connect()->prepare("SELECT savings FROM tbl_users WHERE id = ?");
        $sql->execute([$userId]);
        
        // Fetch the result as an associative array
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        // If a result is found, return the savings value; otherwise, return 0
        return $result ? floatval($result['savings']) : 0;
    }
    

}
