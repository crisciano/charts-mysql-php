<?php
// incluir o php para se conectar com o banco 
include "php/conecta.php";
// seleciona o banco
$banco = @mysql_select_db($db,$conexao);    ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!--==============================primeiro grafico=====================================-->
    <!--=============================== grafico pizza =====================================-->

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        // grafico 1 
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Cadastros','Inativos','Ativos'],

          //for para pegar os registros do banco...
              <?php for ($i=1; $i <= 45 ; $i++) { 
                $sql23 = @mysql_query("SELECT DISTINCT * FROM `contatos` WHERE (CAST(`registro` AS DATE) = '2015-04-".$i."')"); //não esta em uso
                $sql24 = @mysql_query("SELECT `ativo` FROM `contatos` WHERE `ativo` = '1' && (CAST(`registro` AS DATE) = '2015-04-".$i."')");
                $sql25 = @mysql_query("SELECT `ativo` FROM `contatos` WHERE `ativo` = '0' && (CAST(`registro` AS DATE) = '2015-04-".$i."')");
                if (mysql_num_rows($sql23)!=0 && mysql_num_rows($sql24)!=0 && mysql_num_rows($sql25)!=0) {
                      $sql_conta23 = mysql_num_rows($sql23); 
                      $sql_conta24 = mysql_num_rows($sql24);
                      $sql_conta25 = mysql_num_rows($sql25); ?>

                [<?php  echo $i;?>,<?php echo $sql_conta23;?>,<?php echo $sql_conta25; ?>,<?php echo $sql_conta24; ?>], 

              <?php 
                      //fecha o if 
                    } 
                   //fecha o for   
                 }      
              ?> 
              // fecha var do gráfico...
              ]);

      //var grafico 1
      //titulo e as dimensões da janela do gráfico
      var options = {width: 700,height: 300,title: 'Registros diarios.'};
      // var que indica onde o gráfico irá aparecer 
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
      }

    </script>
    <!--===============================segundo grafico=====================================-->
    <!--=============================== grafico pizza =====================================-->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
          ['Campanhas', 'Registros'],
          <?php 
              $sql55 = @mysql_query("SELECT `campanha` FROM `contatos` WHERE `campanha` ='FB-sementrada'");
              $sql56 = @mysql_query("SELECT `campanha` FROM `contatos` WHERE `campanha` ='FB-entrada'");
              $sql57 = @mysql_query("SELECT `campanha` FROM `contatos` WHERE `campanha` ='FB-parcela'");              
              $sql58 = @mysql_query("SELECT `campanha` FROM `contatos` WHERE `campanha` ='clt'");
              $sql59 = @mysql_query("SELECT `campanha` FROM `contatos` WHERE `campanha` =''");
              $sql_conta55 = mysql_num_rows($sql55);
              $sql_conta56 = mysql_num_rows($sql56);
              $sql_conta57 = mysql_num_rows($sql57);
              $sql_conta58 = mysql_num_rows($sql58);
              $sql_conta59 = mysql_num_rows($sql59);
          ?>

          ['FB-parcela',   <?php echo $sql_conta57; ?>],
          ['FB-sementrada',<?php echo $sql_conta55; ?>],
          ['CTL',          <?php echo $sql_conta58; ?>],
          ['FB-entrada',   <?php echo $sql_conta56; ?>],
          ['S-campanha',   <?php echo $sql_conta59; ?>]
        ]);

        //var grafico 2
        //titulo e as dimensões da janela do gráfico
        var options1 = {width: 700,height: 300,title: 'Campanhas'};
        // var que indica onde o gráfico irá aparecer 
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data1, options1);
      }

    </script>
  </head>
  <body>
    <!-- =========div do primeiro gráfico======================= -->
    <div id="chart_div" style="width: 700px; height: 300px;"></div>
    <!-- =========div do segundo gráfico ======================= -->
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>