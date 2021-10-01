<?php
//Funcoes da tabela Notas
/*
idFunction
1-create
2-update
3-delete
    */
if ($idFun == 1) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $query = "insert into note(title_,desc_,is_finished,user_id) value('$title','$desc',false,$userId);";
    mysqli_query($mysqli, $query);
    echo  "<script>alert('Adicionada com sucesso');</script>";

}if ($idFun == 2) {
    
    $taskId = $_POST['idTask'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $isFin = null;
    if($_POST['isFin'] == "on"){$isFin = "true";}else{$isFin = "false";}
    $query = "update note set title_='$title',desc_='$desc',is_finished=$isFin where id_ = $taskId";
    mysqli_query($mysqli, $query);
    echo  "<script>alert('Alterado com sucesso');</script>";

}if($idFun == 3) {
    $taskId = $_POST['idTask'];
    $query = "delete from note where id_ = $taskId";
    mysqli_query($mysqli, $query);
    echo  "<script>alert('Apagado com sucesso');</script>";
}

?>