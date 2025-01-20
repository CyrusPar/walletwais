<?php

class ModelsFacade extends DBConnection
{

    function create($data)
    {
        $sql = $this->connect()->prepare("INSERT INTO dalira_table (data) VALUES (?)");
        $sql->execute([$data]);
        return $sql;
    }

    function read()
    {
        $sql = $this->connect()->prepare("SELECT * FROM dalira_table");
        $sql->execute();
        return $sql;
    }

    function update($data, $dataId)
    {
        $sql = $this->connect()->prepare("UPDATE dalira_table SET data = '$data' WHERE id = '$dataId'");
        $sql->execute();
        return $sql;
    }

    function delete($dataId)
    {
        $sql = $this->connect()->prepare("DELETE FROM dalira_table WHERE id = ?");
        $sql->execute([$dataId]);
        return $sql;
    }
}
