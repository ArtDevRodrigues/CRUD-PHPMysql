<?php

$userId = $_POST['id'];
//Funcoes da tabela Notas
/*
idFunction
1-create
2-update
3-delete
    */
if ($_POST['idFunction'] == 1) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $query = "insert into note(title_,desc_,is_finished,user_id) value('{$title}','{$desc}',false,{$userId});";
    mysqli_query($mysqli, $query);

}elseif ($_POST['idFunction'] == 2) {
    $taskId = $_POST['idTask'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $isFin = boolval($_POST['isFin']);    
    $query = "update note set title_='$title',desc_='$desc',is_finished=$isFin where id_ = $taskId";
    mysqli_query($mysqli, $query);

}elseif($_POST['idFunction'] == 3) {
    $taskId = $_POST['idTask'];
    $query = "delete from note where id_ = $taskId";
    mysqli_query($mysqli, $query);
}

header("locate: /.?id=$userId")

?>