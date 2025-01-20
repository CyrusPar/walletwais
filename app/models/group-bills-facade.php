<?php

class GroupBillsFacade extends DBConnection
{

    function addGroup($groupId, $userCode, $billName, $expense)
    {
        $sql = $this->connect()->prepare("INSERT INTO tbl_group_bills (group_id, user_code, bill_name, expense) VALUES (?, ?, ?, ?)");
        $sql->execute([$groupId, $userCode, $billName, $expense]);
        return $sql;
    }

    function fetchGroupBillById($groupId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_bills WHERE id = ?");
        $sql->execute([$groupId]);
        return $sql;
    }

    function deleteGroupBill($groupId)
    {
        $sql = $this->connect()->prepare("DELETE FROM tbl_group_bills WHERE group_id = ?");
        $sql->execute([$groupId]);
        return $sql;
    }

    function fetchGroupBillByUserCode($userCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_bills WHERE user_code = ?");
        $sql->execute([$userCode]);
        return $sql;
    }

    function fetchGroupBillByBillName($billName)
    {
        $sql = $this->connect()->prepare("SELECT * FROM tbl_group_bills WHERE bill_name = ?");
        $sql->execute([$billName]);
        return $sql;
    }

    function updateGroupBill($billId, $billName)
    {
        $sql = $this->connect()->prepare("UPDATE tbl_group_bills SET bill_name = '$billName' WHERE id = '$billId'");
        $sql->execute();
        return $sql;
    }

}
