<?php include 'logica-usuario.php'; ?>
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
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
         
    });    
  } );

  </script>
  
  
<script>
  $(function () {
    $('.dropdown-toggle').dropdown();
  }); 
</script>

      <style type="text/css">
          .col-lg-12{
              padding-bottom: 20px;
          }
      </style>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>..:: Rio Med ::..</title>

    <!-- Bootstrap com últimas compilações e minified CSS -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" media="all" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

      <script type="text/javascript">
          //acionamos o jquery para iniciar a paginação quando o documento estiver "pronto"
          $(document).ready(function() {
              //Pegamos o valor selecionado default no select id="qtd"
              var mostrar_por_pagina = $('#qtd').val();
              //quantidade de divs
              var numero_de_itens = $('#conteudo').children('.col-lg-3').size();
              //fazemos uma calculo simples para saber quantas paginas existiram
              var numero_de_paginas = Math.ceil(numero_de_itens / mostrar_por_pagina)
              //Colocamos a div class controls dentro da div id pagi
              $('#pagi').append('<div class=controls></div>
                  <input id=current_page type=hidden><input id=mostrar_por_pagina type=hidden>');
              $('#current_page').val(0);
              $('#mostrar_por_pagina').val(mostrar_por_pagina);
              //Criamos os links de navegação
              var nevagacao = '<li><a class="prev" onclick="anterior()">Prev</a></li>';
              var link_atual = 0;
              while (numero_de_paginas > link_atual) {
                  nevagacao += '<li><a class="page" onclick="ir_para_pagina(' + link_atual + ')" longdesc="'
                      + link_atual + '">' + (link_atual + 1) + '</a></li>';
                  link_atual++;
              }
              nevagacao += '<li><a class="proxima" onclick="proxima()">proxima</a></li>';
              //colocamos a nevegação dentro da div class controls
              $('.controls').html("<div class='paginacao'>\
        <ul class='pagination pagination-sm'>"+nevagacao+"</ul></div>");
              //atribuimos ao primeiro link a class active
              $('.controls .page:first').addClass('active');
              $('#conteudo').children().css('display', 'none');
              $('#conteudo').children().slice(0, mostrar_por_pagina).css('display', 'block');
          });
      </script>

      <script type="text/javascript">
          function ir_para_pagina(numero_da_pagina) {
              //Pegamos o número de itens definidos que seria exibido por página
              var mostrar_por_pagina = parseInt($('#mostrar_por_pagina').val(), 0);
              //pegamos  o número de elementos por onde começar a fatia
              inicia = numero_da_pagina * mostrar_por_pagina;
              //o número do elemento onde terminar a fatia
              end_on = inicia + mostrar_por_pagina;
              $('#conteudo').children().css('display', 'none').slice(inicia, end_on).css('display', 'block');
              $('.page[longdesc=' + numero_da_pagina+ ']').addClass('active')
                  .siblings('.active').removeClass('active');
              $('#current_page').val(numero_da_pagina);
          }

          function anterior() {
              nova_pagina = parseInt($('#current_page').val(), 0) - 1;
              //se houver um item antes do link ativo atual executar a função
              if ($('.active').prev('.page').length == true) {
                  ir_para_pagina(nova_pagina);
              }
          }

          function proxima() {
              nova_pagina = parseInt($('#current_page').val(), 0) + 1;
              //se houver um item após o link ativo atual executar a função
              if ($('.active').next('.page').length == true) {
                  ir_para_pagina(nova_pagina);
              }
          }
      </script>

      <script type="text/javascript">
          // Pegamos o evento change do select id="qtd" e remontamos toda a paginação default
          $( "#qtd" ).change(function() {
              //Removemos os "controles" de paginação
              $(".controls").remove();
              //Pegamos o valor selecionado
              var mostrar_por_pagina = this.value;
              //remontamos a paginação
              var numero_de_itens = $('#conteudo').children('.col-lg-3').size();
              var numero_de_paginas = Math.ceil(numero_de_itens / mostrar_por_pagina);
              //Colocamos a div class controls dentro da div id pagi
              $('#pagi').append('<div class=controls></div>
                  <input id=current_page type=hidden><input id=mostrar_por_pagina type=hidden>');
              $('#current_page').val(0);
              $('#mostrar_por_pagina').val(mostrar_por_pagina);
              //Criamos os links de navegação
              var nevagacao = '<li><a class="prev" onclick="previous()">Prev</a></li>';
              var link_atual = 0;
              while (numero_de_paginas > link_atual) {
                  nevagacao += '<li><a class="page" onclick="ir_para_pagina(' + link_atual + ')" longdesc="'
                      + link_atual + '">' + (link_atual + 1) + '</a></li>';
                  link_atual++;
              }
              nevagacao += '<li><a class="next" onclick="next()">Next</a></li>';
              //colocamos a navegação dentro da div class controls
              $('.controls').html("<div class='paginacao'>
                  <ul class='pagination pagination-sm'>"+nevagacao+"</ul></div>");
              $('.controls .page:first').addClass('active');
              $('#conteudo').children().css('display', 'none');
              $('#conteudo').children().slice(0, mostrar_por_pagina).css('display', 'block');

          });
      </script>
  </head>
  <body>
  
      <div class="container-fluid">
          <div class="well">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="index.php" alt="Sistema de OS - Rio Med" title="Sistema de OS - Rio Med">
                            <img src="imagens/logo-mini.png" class="img-responsive img-rounded">
                        </a>

                    </div>
                    <div class="col-sm-8 text-center"><h1>Sistema de OS - Rio Med</h1></div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="btn btn-group pull-right">
                        <a  href="material-lista.php" class="btn btn-danger">Lista de Materiais</a>
                        <!-- Inicio Menu DropDown -->
                        <button type="button" class="btn btn-danger">OS</button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="os-lista.php">Lista de OS</a></li>
                          <li><a href="custo-setor.php">Custo por Setor</a></li>
                        
                        </ul>
                        
                        

                        <a href="logout.php" class="btn btn-danger"><span class="glyphicon glyphicon-share-alt">&nbsp;Sair</span></a>

                    </div>
                </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="principal">

    