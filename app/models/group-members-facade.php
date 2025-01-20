<?php

class GroupsMembersFacade extends DBConnection
{

    function addAdminMember($groupId, $userCode, $billName, $isAdmin)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_group_members (group_id, user_code, bill_name, is_admin) VALUES (?, ?, ?, ?)");
        $sql->execute([$groupId, $userCode, $billName, $isAdmin]);
        return $sql;
    }

    function addMember($groupId, $userCode, $billName)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_group_members (group_id, user_code, bill_name) VALUES (?, ?, ?)");
        $sql->execute([$groupId, $userCode, $billName]);
        return $sql;
    }

    function fetchGroupMembersByUserCodeBillName($userCode, $billName)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_members WHERE user_code = ? AND bill_name = ?");
        $sql->execute([$userCode, $billName]);
        return $sql;
    }

    function updatePercentage($groupId, $percentage)
    {
        $sql = $this->connect()->prepare("UPDATE tbl_group_members SET percentage = '$percentage' WHERE id = '$groupId'");
        $sql->execute();
        return $sql;
    }

    function fetchGroupBillByUserCode($userCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_members WHERE user_code = ?");
        $sql->execute([$userCode]);
        return $sql;
    }

    function fetchGroupMembersByBillName($billName)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_members WHERE bill_name = ?");
        $sql->execute([$billName]);
        return $sql;
    }

    function sumPercentage($billName)
    {
        $sql = $this->connect()->prepare("SELECT SUM(percentage) AS total_percentage FROM tbl_group_members WHERE bill_name = ?");
        $sql->execute([$billName]);

        // Fetch the result and return the sum of percentages
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result['total_percentage']; // Returns the summed percentage
    }

    function deleteGroup($groupId)
    {
        $sql = $this->connect()->prepare("DELETE FROM tbl_group_members WHERE id = ?");
        $sql->execute([$groupId]);
        return $sql;
    }

    function deleteGroupByGroupId($groupId)
    {
        $sql = $this->connect()->prepare("DELETE FROM tbl_group_members WHERE group_id = ?");
        $sql->execute([$groupId]);
        return $sql;
    }

    function updateBillWithExpense($userCode, $groupBillName, $expense)
    {
        // Retrieve the current contribution value
        $sql = $this->connect()->prepare("SELECT contribution FROM tbl_group_members WHERE user_code = :userCode AND id = :groupBillName");
        $sql->bindParam(':userCode', $userCode);
        $sql->bindParam(':groupBillName', $groupBillName);
        $sql->execute();

        // Fetch the current contribution value
        $currentContribution = $sql->fetchColumn();

        // Add the new expense to the current contribution
        $newContribution = $currentContribution + $expense;

        // Update the group member's contribution with the new total
        $updateSql = $this->connect()->prepare("UPDATE tbl_group_members SET contribution = :newContribution WHERE user_code = :userCode AND id = :groupBillName");
        $updateSql->bindParam(':newContribution', $newContribution);
        $updateSql->bindParam(':userCode', $userCode);
        $updateSql->bindParam(':groupBillName', $groupBillName);
        $updateSql->execute();

        return $updateSql;
    }
}
