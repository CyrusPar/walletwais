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

    function filterBillsByWeek($userCode, $year, $month, $week) {
        // Calculate the start and end date of the selected week (Monday to Sunday)
        $startDate = new DateTime();
        $startDate->setISODate($year, $week);
        $startOfWeek = $startDate->format('Y-m-d');  // Get the start date of the week (Monday)
        
        $endDate = new DateTime();
        $endDate->setISODate($year, $week);
        $endOfWeek = $endDate->modify('+6 days')->format('Y-m-d');  // Get the end date of the week (Sunday)
    
        // Construct a date range for the selected month (first day to last day)
        $monthStart = new DateTime("$year-$month-01");
        $monthEnd = new DateTime($monthStart->format('Y-m-t'));  // Get the last day of the month
    
        // Ensure the start of the week and the month date range overlap
        $startOfWeekVar = max($startOfWeek, $monthStart->format('Y-m-d'));
        $endOfWeekVar = min($endOfWeek, $monthEnd->format('Y-m-d'));
    
        // If the start and end of the week don't align with the month boundaries, adjust accordingly
        if ($startOfWeekVar < $monthStart->format('Y-m-d')) {
            $startOfWeekVar = $monthStart->format('Y-m-d');  // Adjust if the start of the week is before the month
        }
        if ($endOfWeekVar > $monthEnd->format('Y-m-d')) {
            $endOfWeekVar = $monthEnd->format('Y-m-d');  // Adjust if the end of the week is after the month
        }
    
        // Add filtering only on the date range, no need to filter by month in SQL
        $sql = $this->connect()->prepare("SELECT * FROM tbl_bills 
                                          WHERE user_code = ? 
                                          AND Date BETWEEN ? AND ?");
        $sql->bindParam(1, $userCode);
        $sql->bindParam(2, $startOfWeekVar);
        $sql->bindParam(3, $endOfWeekVar);
    
        $sql->execute();
        return $sql->fetchAll();  // Return all results for the specified week within the selected month
    }
    
    
    
    
    

    
}
