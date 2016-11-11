<?php 
    include 'cabecalho.php';
    include 'conect/conecta.php';
    include 'banco-usuario.php'; 
    include 'banco-os.php';
    include 'logica-usuario.php';
 ?>


<?php if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php
    unset($_SESSION["success"]);
} ?>
<div class="container-fluid">
        <div class="row">
            <form method="post" action="">
                <div class="col-lg-1"> 
                    <label for="DataInicial">Data Inicial</label>
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="DataInicial1" name="DataInicial">
                </div>
                <div class="col-lg-1">
                    <label for="DataFinal">Data Final</label>  
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="DataFinal2" name="DataFinal">
                </div>
                <div class="col-lg-1 pull-right">
                    <button class="btn btn-warning">Consultar</button>  
                </div>
            </form>
        </div>
</div>
    

