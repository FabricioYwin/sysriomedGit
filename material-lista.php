<?php include 'cabecalho.php';
 include 'conect/conecta.php'; 
 include 'banco-material.php'; 
 include 'logica-usuario.php'; 
 ?>
<link rel="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
    $('#DT_Material_lista').DataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ registros por páginas",
            "zeroRecords": "Nenhum resultado encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum resultado disponível",
            "sSearch": "Pesquisar: ",
            "infoFiltered": "(Número _MAX_ total registros)",
            "processing": true,
        "serverSide": true,
            "ajax": "../scripts/script_busca.php",
        
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }});
});
        
    </script>

<?php if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php
    unset($_SESSION["success"]);
} ?>



<table class="table table-striped table-bordered" id="DT_Material_lista">
    <tr>
            <th>ID</th>
            <th>ID ITEM</th>
            <th>NOME</th>
            <th>TIPO</th>
            <th>N. SÉRIE</th>
            <th>CUSTO</th>
            <th>EDITAR</th>
        </tr>
    <?php
    $materiais = listaMateriais($conn);
    foreach ($materiais as $material): ?>
<!--    <form method="post">-->
        
        
        <tr>
            <td><?= $material['IdMat']; ?></td>
            <td><?= $material['IdItem']; ?></td>
            <td><?php echo utf8_encode($material['nome']); ?></td>
            <td><?php echo utf8_encode($material['tipo']); ?></td>
            <td><?php echo utf8_encode($material['nSerie']); ?></td>
            <td><?="R$ ".number_format($material['valorUnitario'], 2, ',', '.') ; ?></td>
            <td><a href="material-altera-formulario.php?IdItem=<?=$material['IdItem']; ?>" class="btn btn-warning">Alterar</a></td>
<!--            <td class="pull-right">
                <form action="remove-material.php" method="post">
                    <input type="hidden" name="id" value="<?//=$material['id']?>">
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-erase">&nbsp;Excluir</span></button>                    
                </form>
                <div class="pull-right">
                <a href="" class="btn btn-warning"><span class="glyphicon glyphicon-pencil">&nbsp;Editar</span></a>
                <a href="remove-material.php?id=<?//=$material['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-erase">&nbsp;Excluir</span></a>
                </div>
            </td>-->
        </tr>
    <!--</form>-->   
    <?php endforeach; ?>
</table>
<br />
<br />


 
 <?php include 'rodape.php'; ?>



