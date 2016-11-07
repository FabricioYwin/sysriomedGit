<?php include 'cabecalho.php'; 
 include 'conecta.php';
 include 'banco-categoria.php'; 
 include 'logica-usuario.php';
 
 verificaUsuario();
 
    if(!isset($_COOKIE['usuario_logado'])) {
        header("Location: index.php?falhaDeSeguranca=true");
        die();
    }

$categorias = listaCategorias($conn); ?>

    <h3>Formulário de Cadastro de Material</h3> 
    <form action="adiciona-material.php" method="get">               
        <table class="table">
            <tr>            
                <td>Nome:</td>
                <td><input class="form-control" type="text" name="nome"></td>
            </tr>
            <tr>            
                <td>Preço:</td>
                <td><input class="form-control" type="number" name="preco" required></td>  
            </tr>
            <tr>
                <td>Categoria</td>
                <td>
                    <select name="categoria_id" class="form-control">
                    <?php foreach ($categorias as $categoria) : ?>
                        <option  value="<?=$categoria['id']?>">
                            <?php echo utf8_encode($categoria['nome']); ?>                            
                        </option>                               
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-warning pull-right" type="submit" name="cadastrar" value="Cadastrar"></td>            
            </tr>     
        </table>
    </form>
<?php include 'rodape.php'; 