
<!DOCTYPE html>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>      
        $( function() {
    $( "#DataInicial" ).datepicker({
        dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
    });
    $( "#DataFinal" ).datepicker({
         dateFormat: 'dd/mm/yy',
             dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom']
         
    });    
  } );
  </script>
   
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>..:: Rio Med ::..</title>

    <!-- Bootstrap com últimas compilações e minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" media="all" />
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="css/estilo.css" rel="stylesheet" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div class="container-fluid">
          <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="index.php" alt="Sistema de OS - Rio Med" title="Sistema de OS - Rio Med">
                            <img src="imagens/logo-mini.png" class="img-responsive img-rounded">
<!--                            <img src="imagens/logo-mini.png" class="img-responsive img-rounded">-->
                        </a>

                    </div>
                    <div class="col-sm-8 text-center"><h1>Sistema de OS - Rio Med</h1></div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="btn btn-group pull-right">
                        <a  href="material-lista.php" class="btn btn-danger">Lista de Materiais</a>
                        <a href="os-lista.php" class="btn btn-danger">Lista de OS</a>

                        <a href="logout.php" class="btn btn-danger"><span class="glyphicon glyphicon-share-alt">&nbsp;Sair</span></a>

                    </div>
                </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="principal">

    