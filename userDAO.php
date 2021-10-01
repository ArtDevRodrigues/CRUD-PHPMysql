<?php
/*
idFunction
4-create
5-update - nao funcional
6-delete
    */
    if ( $idFun == 4) {
            
        $query = "insert into user_(user_name,user_pass) value('$userName','$userPass');";
        mysqli_query($mysqli, $query);
        $sql1 = "select * from user_ where user_name = '$userName';";
        $resultUser = $mysqli->query($sql1);
        $datasUser = $resultUser->fetch_assoc();
        $code = $datasUser['user_id'];
        $userId = $code;
        echo  "<script>alert('Usuario adicionado com sucesso utilise o ID: $code para entrar(Login)');</script>";
    
    }if ($idFun == 5) { 
           
        $query = "update user_ set user_name='$userName',user_pass='$userPass where user_id = $userId;";
        mysqli_query($mysqli, $query);
        
        echo  "<script>alert('Dados do Usuario alterados com sucesso');</script>";
    
    }if($idFun == 6) {
    
        $queryNote = "delete from note where user_id = $userId";
        mysqli_query($mysqli, $queryNote);
        $queryUser = "delete from user_ where user_id = $userId";
        mysqli_query($mysqli, $queryUser);
        echo  "<script>alert('Usuario e lista de Notas apaga com sucesso');</script>";
    }


?>
