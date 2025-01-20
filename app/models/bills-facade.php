<?php

class BillsFacade extends DBConnection
{

    function addBill($userCode, $billName)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_bills (user_code, bill_name) VALUES (?, ?)");
        $sql->execute([$userCode, $billName]);
        return $sql;
    }

    function fetchBill()
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_bills");
        $sql->execute();
        return $sql;
    }

    function fetchBillByCode($userCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_bills WHERE user_code = ?");
        $sql->execute([$userCode]);
        return $sql;
    }

    function fetchBillByBillId($billId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_bills WHERE id = ?");
        $sql->execute([$billId]);
        return $sql;
    }

    function updateBillWithExpense($userCode, $billName, $expense)
    {
        // Retrieve the current expense value
        $sql = $this->connect()->prepare("SELECT expense FROM tbl_bills WHERE user_code = :userCode AND id = :billName");
        $sql->bindParam(':userCode', $userCode);
        $sql->bindParam(':billName', $billName);
        $sql->execute();

        // Fetch the current expense value
        $currentExpense = $sql->fetchColumn();

        // Add the new expense to the current expense
        $newExpense = $currentExpense + $expense;

        // Update the bill with the new total expense
        $updateSql = $this->connect()->prepare("UPDATE tbl_bills SET expense = :newExpense WHERE user_code = :userCode AND id = :billName");
        $updateSql->bindParam(':newExpense', $newExpense);
        $updateSql->bindParam(':userCode', $userCode);
        $updateSql->bindParam(':billName', $billName);
        $updateSql->execute();

        return $updateSql;
    }


    function updateBill($billId, $billName)
    {
        $sql = $this->connect()->prepare("UPDATE tbl_bills SET bill_name = '$billName' WHERE id = '$billId'");
        $sql->execute();
        return $sql;
    }

    function deleteBill($billId)
    {
        $sql = $this->connect()->prepare("DELETE FROM tbl_bills WHERE id = ?");
        $sql->execute([$billId]);
        return $sql;
    }
}
