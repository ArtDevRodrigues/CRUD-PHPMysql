<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.1-dist/css/bootstrap.css">
    <script src="bootstrap-5.0.1-dist/js/bootstrap.js"></script>
    <title>Agenda</title>
    <?php
        include("connection.php");
        
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


        //Notes
        $is_Notes_ok = false;
        $sql2 = "select * from note where user_id = $userId";
        $resultNotes = $mysqli->query($sql2);
        if ($resultNotes != null) {$is_Notes_ok = true;}
        else {$is_Notes_ok = false; }

        // User
        $sql1 = "select * from user_ where user_id = $userId";
        $is_Users_ok = false;
        $datasUser = null;
        $resultUser = $mysqli->query($sql1);
        if ($resultUser != null) {$is_Users_ok = true;$datasUser = $resultUser->fetch_assoc();}
        else {$is_Users_ok = false; }

        
    ?>
</head>
<body>
<!-- SingIn-->
<div class="modal fade" id="SingIn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="index.php" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Entrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input type="text" placeholder="Indentificador" name="id">
            <input type="text" placeholder="Senha" name="pass">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button class="btn btn-primary">Entrar</button>
            </div>
            </div>
        </div>
    </form>
</div>
<!-- SingUp-->
<div class="modal fade" id="SingUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="index.php" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input type="text" placeholder="Indentificador" name="id">
            <input type="text" placeholder="Nome" name="name">
            <input type="text" placeholder="Senha" name="pass">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button class="btn btn-primary">Cadastar</button>
            </div>
            </div>
        </div>
    </form>
</div>
<!-- SingUp-->
<div class="modal fade" id="SingUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="index.php" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input type="text" placeholder="Indentificador" name="id">
            <input type="text" placeholder="Nome" name="name">
            <input type="password" size="20" placeholder="Senha" name="pass">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button class="btn btn-primary">Cadastar</button>
            </div>
            </div>
        </div>
    </form>
</div>
<!-- CadTask-->
<div class="modal fade" id="CadTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <form action="cadTask.php" method="POST">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nova Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input type="text" placeholder="Titulo" name="title">
            <textarea name='desc' id='text' cols='20' rows='10'></textarea>
            <?php echo "<input type='hidden' name='id' value='$userId'>"; ?>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button class="btn btn-primary">Cadastar</button>
            </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <?php if ($is_Users_ok) {?>
        
        <div class="row">
            <div class="col"></div>
            <div class="col col-11">
                <h2>Lista de tarefas Pessoal Usuario(a) <?php echo $datasUser['user_name']; ?></h2>
            </div>
            <div class="col"><form action="index.php" method="POST"><input type='hidden' name='id' value=''><button class="btn btn-primary">Sair</button></form></div>
        </div>
    <?php }else{ ?>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <h3>Entre em sua conta ou Crie uma</h3>
            </div>
            <div class="col"></div>
        </div>

        <?php }?>
    <div class="row justify-content-md-center">
        <hr>
        <?php if($is_Notes_ok == false){ ?>

            <div class="row">
                <div class="col-10"></div>
                <div class="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SingIn">Entrar</button></div>
               
                <div class="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SingUp">Cadastrar</button></div>
            </div>
            
        <?php }else{ ?>
            <div class="row">
                <div class="col-10"></div>
                <div class="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CadTask">Adicionar uma nova tarefa</button></div>
            </div>
            <br>
            <?php while ($dado = $resultNotes->fetch_assoc()){ ?>
                <?php // for($i = 0; $i <= 6; $i++) { ?>
            <div class="col col-lg-2 border border-3 p-3 mb-2 bg-secondary text-white">
            <?php 
                $title = $dado['title_'];
                $desc = $dado['desc_'];
                $id = $dado['id_'];
            ?>
            <button type="button" data-bs-toggle="modal" data-bs-target="#UpTask<?php echo $id;?>">
            <div class="canvas canvas-start" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasLabel"><?php echo "<h6>Titulo: $title<h6>";?></h5>
                </div>
                <div class="offcanvas-body">
                <?php echo "<p>Descricao: <br> $desc</p>";?>
                </div>
            </div>
            </button>

            <div class="modal fade" id="UpTask<?php echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="cadTask.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Nova Nota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <?php
                                echo "<input type='text' placeholder='Titulo' name='title' value='$title'><br>";
                                echo "<input type='hyder' placeholder='Titulo' name='idFunction' value='$userId'><br>";
                                echo "<textarea name='desc' id='text' cols='20' rows='10'>$desc</textarea><br>";
                                echo "<input type='checkbox' placeholder='Titulo' name='finalizada' "?>
                                <?php if($dado['is_finished']){echo "checked";}?><?php echo">Finalizada ";
                            ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button class="btn btn-primary">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form action="upTask.php"></form>
            </div>
            <?php //}  ?>
            <?php } ?>
            <?php }?>
  </div>
</div>
</body>
</html>