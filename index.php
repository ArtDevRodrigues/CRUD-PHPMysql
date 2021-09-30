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
        $userPass = $_POST['pass'];
        //echo "$userId";
        $canIn = false;
        
        include("taskDAO.php");

        // User
        $datasUser = null;
        $resultUser = null;
        if ($userId != null) {
            $sql1 = "select * from user_ where user_id = $userId";
            $resultUser = $mysqli->query($sql1);
            $datasUser = $resultUser->fetch_assoc();
            
        }
        $is_Users_ok = false;
        
        // Check user
        if ($userId == $datasUser['user_id'] & $userPass == $datasUser['user_pass']) {
            $canIn = true;
        };

        if ($resultUser != null & $canIn) {$is_Users_ok = true;}
        else {$is_Users_ok = false; }

        //Notes
        $is_Notes_ok = false;
        $sql2 = "select * from note where user_id = $userId";
        $resultNotes = $mysqli->query($sql2);
        if ($resultNotes != null & $canIn) {$is_Notes_ok = true;}
        else {$is_Notes_ok = false; }

    ?>
</head>
<body>
<!-- SingIn-->
<div class="modal fade" id="SingIn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Entrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="POST">
                <div class="modal-body">

                <input class="form-control" type="text" placeholder="Indentificador" name="id">
                <input class="form-control" type="password" size="20" placeholder="Senha" name="pass">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Entrar</button>
                </div>
        </form>
            </div>
        </div>
</div>
<!-- SingUp-->
<div class="modal fade" id="SingUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="POST">
                <div class="modal-body">

                <input class="form-control" type="text" placeholder="Indentificador" name="id">
                <input class="form-control" type="text" placeholder="Nome" name="name">
                <input class="form-control" type="password" size="20" placeholder="Senha" name="pass">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Cadastar</button>
                </div>
            </form>
            </div>
        </div>
</div>

<!-- CadTask-->
<div class="modal fade" id="CadTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
            <form action="index.php" method="POST">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nova Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <input class="form-control" type="text" placeholder="Titulo" name="title">
            <textarea class="form-control" name='desc' id='text' cols='50' rows='10'></textarea>
            <?php 
            echo "<input type='hidden' name='id' value='$userId'>"; 
            echo "<input type='hidden' name='pass' value='$userPass'>"; 
            echo "<input type='hidden' name='idFunction' value='1'><br>";?>
            
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
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-8"><h2>Lista de tarefas Pessoal Usuario(a): <?php echo $datasUser['user_name']; ?></h2></div>
                <div class="col"><form class="text-center" action="index.php" method="POST"><input  type='hidden' name='id' value=''><input type='hidden' name='pass' value=''><button class="btn btn-primary">  Sair   </button></form></div>
            </div>
        </div>
    <?php }else{ ?>

        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <h3 class="text-center">Entre em sua conta ou Crie uma</h3>
            </div>
            <div class="col"></div>
        </div>

        <?php }?>
    <div class="row justify-content-md-center">
        <hr>
        <?php if($is_Notes_ok == false){ ?>

            <div class="row">
                <div class="col"></div>
                <div class="col col-md-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SingIn">Entrar</button></div>
               
                <div class="col col-md-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SingUp">Cadastrar</button></div>
            </div>
        <?php }else{ ?>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-6 col-md-4"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CadTask">Adicionar uma nova tarefa</button></div>
            </div>
            <br>
            <!-- mostrando os dados -->
            <?php while ($dado = $resultNotes->fetch_assoc()){ ?>
                
            <div class="col col-lg-4 border border-3 p-2 mb-3 bg-secondary">
            <?php 
                $title = $dado['title_'];
                $desc = $dado['desc_'];
                $id = $dado['id_'];
            ?>
            
            <button class="btn btn-light container" style="height: 70%;" type="button" data-bs-toggle="modal" data-bs-target="#UpTask<?php echo $id;?>">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="offcanvas-title " id="offcanvasLabel"><?php echo "Titulo: $title";?></h5>              
                    </div>
                    <div class="modal-body" >
                        <?php echo "<p>Descricao: <br> $desc</p>";?>
                    </div>
                </div>
                </div>
            </button>
            <div class="modal fade" id="UpTask<?php echo $id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <form action="index.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Nova Nota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <?php
                                echo "<input class='form-control' type='text' placeholder='Titulo' name='title' value='$title'><br>";
                                echo "<input type='hidden' name='idFunction' value='2'><br>";
                                echo "<input type='hidden' name='id' value='$userId'>";
                                echo "<input type='hidden' name='pass' value='$userPass'>";
                                echo "<input type='hidden' name='idTask' value='$id'>";
                                echo "<textarea class='form-control' name='desc' cols='50' rows='10'>$desc</textarea><br>";
                                echo "<input type='checkbox' name='isFin' "?>
                                <?php if($dado['is_finished']){echo "checked";}?><?php echo">Finalizada <br>";
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
            <div >
                <form class="row" action="index.php" method="POST">
                    <?php
                    echo "<input type='hidden' name='idFunction' value='3'><br>";
                    echo "<input type='hidden' name='id' value='$userId'>";
                    echo "<input type='hidden' name='pass' value='$userPass'>";
                    echo "<input type='hidden' name='idTask' value='$id'>";?>
                    <input type="submit" class="btn btn-primary mb-3" name="Apagar" value="Apagar"> 
                </form>
            </div>
            </div>
            <?php } ?>
            <?php }?>
  </div>
</div>
</body>
</html>