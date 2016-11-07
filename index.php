<?php include 'headerLogin.php'; 
 include 'logica-usuario.php'; ?> 


 
<!-- Segurança oK -->    
<?php if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php
    unset($_SESSION["success"]);
} ?>
<!-- Falha de Segurança -->    
<?php if(isset($_SESSION["danger"])) { ?>
    <p class="alert-danger"><?= $_SESSION["danger"]?></p>
<?php
    unset($_SESSION["danger"]);
} ?>
        
        <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form class="form-horizontal" id="FormLogin" action="login.php" method="post">
                    <div class="form-group">
                        <?php if(usuarioEstaLogado()) { ?>
                        <p class="alert-success">Você está logado como <?= usuarioLogado() ?>. 
                            <a href="logout.php">Deslogar</a></p>
                        <?php } else { ?>
                        
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Entre com o seu Login">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Entre com a sua Senha">
                    </div>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-danger pull-right">Entrar</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
            <?php } 
            
include 'footerLogin.php'; ?>
       