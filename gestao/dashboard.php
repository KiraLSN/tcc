<?php
include('conexao.php');

$pdo_verifica = $conexao_pdo->prepare("select id from orientador WHERE nome = '".$usuario_['nome']."'");
                     $pdo_verifica->execute();
            while($fetch = $pdo_verifica->fetch()){
                $myid = $fetch['id'];
            }


$cont = 0;
$cont2 = 0;
$cont3 = 0;
$cont4 = 0;
$i = 0;
$projeto = array();
$andamento = array();


$pdo_verifica = $conexao_pdo->prepare("select status from aluno WHERE id_orientador = ".$myid."");
                     $pdo_verifica->execute();
            while($fetch = $pdo_verifica->fetch()){
                $status = $fetch['status'];
                if($status == 1){ //PROJETO EM ANDAMENTO
                    $cont = $cont+1;
                }
                if($status == 0){ //PROJETO PARADO
                    $cont2 = $cont2+1;
                }
                
                if($status == 3){ //PROJETO CANCELADO
                    $cont3 = $cont3+1;
                }
                if($status == 4){ //PROJETO CANCELADO
                    $cont4 = $cont4+1;
                }
                
            }


$pdo_verifica = $conexao_pdo->prepare("select * from aluno WHERE id_orientador = ".$myid." AND (status = 1 OR status = 0)  order by status desc");
                     $pdo_verifica->execute();
            while($fetch = $pdo_verifica->fetch()){
                $projeto[$i] = $fetch['nome'];
                $andamento[$i] = $fetch['cr'];
                
                $i = $i +1;
            }

?>

<section class="box conteudo conteudo-completo">
    <br>
    <article class="box box50" style="background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1">Seus Projetos Gerenciados</h1>
        </div>
        <div class="box_conteudo_">

            <canvas id="myChart" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Em Andamento', 'Parados', 'Cancelados', 'Entregues'],
                        datasets: [{
                            label: 'quantidade',
                            data: [<?= $cont; ?>, <?= $cont2;?>, <?= $cont3;?>, <?= $cont4;?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            </script>


        </div>
    </article>




    <article class="box box50" style="background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1">Projetos em Andamento</h1>
        </div>
        <div class="box_conteudo_">

            <canvas id="myChart2" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
            <script>
                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: ['<?= $projeto[0];?>', '<?= $projeto[1];?>', '<?= $projeto[2];?>'],
                        datasets: [{
                            label: 'quantidade',
                            data: [<?= $andamento[0]; ?>, <?= $andamento[1];?>, <?= $andamento[2];?>, <?= $cont4;?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {

                            xAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            </script>

        </div>
    </article>


    <article class="box box50 no-margim" style="background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1">Último acesso</h1>
        </div>
        <div class="box_conteudo_">
            <?php
      $aceso = new Read;
      $aceso->ExeRead('entradas', 'WHERE id_user=:url order by id desc LIMIT :limit OFFSET :offset', "url=" . $usuario_['id'] . "&limit=2&offset=0");
      if ($aceso->getRowCount() >= 1) :
        foreach ($aceso->getResult() as $acessos);
      endif;
      ?>
            <p>Data e hora: <?= Check::TimesData($acessos['data']); ?> - <?= $acessos['hora']; ?></p>
            <p>IP: <?= $acessos['ip']; ?></p>
            <p>Navegador: <?= $acessos['navegador']; ?></p>
        </div>
    </article>
    <div class="limpar"></div>
    <br>


    <article class="topo_azul_escuro cadastro ds-none" style="float: left; width: 100%">
        <div class="box_div_h1">
            <h1 class="box_h1">Enviar mensagem</h1>
        </div>
        <div class="box_conteudo_">
            <!--FORMULÁRIO DE CADASTRO-->
            <form class="form" method="post" name="mensagem" enctype="multipart/form-data">
                <div style="width: 68%; float: left">
                    <p class="texto_form">Titulo</p>
                    <input name="nome" type="text" required placeholder="Titulo" style=" width: 100%;" />
                    <p class="texto_form">Para:</p>
                    <select name="pessoa" required style="width: 100%;">
                        <?php
            $aceso->ExeRead('perfil', 'WHERE status=:url', "url=1");
            if ($aceso->getRowCount() >= 1) :
              foreach ($aceso->getResult() as $pessoas) :
            ?>
                        <option value="<?= $pessoas['id']; ?>"><?= $pessoas['nome']; ?> - <?= $pessoas['cargo']; ?></option>
                        <?php
              endforeach;
            endif;
            ?>
                    </select>
                    <p class="texto_form">Mensagem</p>
                    <textarea name="obs" class="tiny" style="width: 100%; height: 180px"></textarea>
                </div>


                <div style="width: 28%; float: right">

                    <p class="texto_form">Selecione arquivos</p>
                    <div class="box_content">
                        <div class="limpar"></div>
                        <div class="mensagem_imagem ds-none">
                            <p><b></b></p>
                        </div>
                        <label class="label">
                            <input type="file" name="user_thumb[]" multiple />
                        </label>

                        <div class="upload_bar m_top m_botton">
                            <div class="upload_progress ds-none">0%</div>
                        </div>
                        <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />

                    </div>
                </div>

                <div class="limpar"></div>
                <br>
                <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
                <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
                <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">Cadastrar</button>
                <div class="fl-right fechar_cadastro" style="width: 4%; cursor: pointer" data-balloon-length="medium" data-balloon="Fechar cadastro" data-balloon-pos="left">
                    <img class="fl-right" src="<?= HOME; ?>imagens_site/icone/fechar.png" title="Fechar cadastro">
                </div>
                <div class="limpar"></div>
            </form>
        </div>
        <div class="limpar"></div>
    </article>

    <div class="limpar"></div>
    <br>
</section>
