<?php

$db_address = "localhost";
$db_user = "root"; 
$db_pass = "";
$db_testdb = "testdb";

$db = @new mysqli($db_address,$db_user,$db_pass,$db_testdb);
if(isset($_POST['submit']))
{
    if($db->connection_errno)
        {
        echo "error" .$db->connection_errno;
    }else
        {
        $anim = $_POST['new_animal'];
        $query = $db->query("INSERT INTO `zoo`(`animal`) VALUES ('$anim')");
        }
}

if(isset($_POST['submit_del']))
{
    if($db->connection_errno)
        {
        echo "error" .$db->connection_errno;
    }else
        {
        $del_anim = $_POST['del_animal'];
        $query = $db->query("DELETE FROM `zoo` WHERE `animal`='$del_anim'");
        }
}

if(isset($_POST['del_update']))
{   if(isset($_POST['ins_update']))
    {
    if($db->connection_errno)
        {
        echo "error" .$db->connection_errno;
        }else
            {
            $upd_del_anim = $_POST['del_update'];
            $upd_ins_anim = $_POST['ins_update'];
            $query = $db->query("UPDATE `zoo` SET `animal`='$upd_ins_anim' WHERE `animal`='$upd_del_anim'");
            }
    }
}

if($db->connection_errno)
{
    echo "error" .$db->connection_errno;
}else
{
    $query = $db->query("SELECT * FROM `zoo`");
    //$res = $query->fetch_assoc();
    echo '<table border="1">';
    while($row = $query->fetch_assoc())
    {
        echo '<tr>';
        echo '<td>';
        echo $row['id'];
        echo '</td>';

        echo '<td>';
        echo $row['animal'];
        echo '</td>';
        echo '</tr>';

        //echo $row['id'].'<br>';
    }
    echo '</table>';
    //var_dump($res); 
}

?>

<form method="post">
    <input type="text" name="new_animal">
    <input type="submit" value="Добавить" name="submit">
</form>

<form method="post">
    <input type="text" name="del_animal">
    <input type="submit" value="Удалить" name="submit_del">
</form>

<form method="post">
    <input type="text" name="del_update" placeholder="что заменить">
    <input type="text" name="ins_update" placeholder="чем заменить">
    <input type="submit" value="Заменить" name="submit_upd">
</form>