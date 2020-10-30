<?php
require('../poo/app/Config.inc.php');
$sessao = new Session;
$dataHora = date('d/m/Y - H:i:s');
$hora = date('H:i:s');
$data = date('d/m/Y');
$dataStamp2 = date('Y-m-d');
$dataStanp = date('Y/m/d');
$dataStanpHora = date('Y/m/d - H:i:s');

$mkt = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 10, date('Y'));
$dataexpira = date('Y-m-d', $mkt);

/* * ******************************************************************************************************
  FUNÇÃO PARA VALIDAR E ENVIAR E-MAIL
 * ****************************************************************************************************** */

function sendMail($assunto, $mensagem, $remetente, $nomeRemetente, $destino, $nomeDestino, $reply = NULL, $replyNome = NULL, $anexo_pasta = NULL)
{

  require_once('../poo/app/Library/PHPMailer/PHPMailerAutoload.php'); //Include pasta/classe do PHPMailer

  $mail = new PHPMailer(); //INICIA A CLASSE
  $mail->IsSMTP(); //Habilita envio SMPT
  $mail->SMTPAuth = true; //Ativa email autenticado
  $mail->IsHTML(true);

  $mail->Host = '' . MAILHOST . ''; //Servidor de envio
  $mail->Port = '' . MAILPORT . ''; //Porta de envio
  $mail->Username = '' . MAILUSER . ''; //email para smtp autenticado
  $mail->Password = '' . MAILPASS . ''; //seleciona a porta de envio

  $mail->From = utf8_decode($remetente); //remtente
  $mail->FromName = utf8_decode($nomeRemetente); //remtetene nome

  if ($anexo_pasta != NULL) {
    $mail->AddAttachment($anexo_pasta); //Enviar anexo
  }

  if ($reply != NULL) {
    $mail->AddReplyTo(utf8_decode($reply), utf8_decode($replyNome));
  }

  $mail->Subject = utf8_decode($assunto); //assunto
  $mail->Body = utf8_decode($mensagem); //mensagem
  $mail->AddAddress(utf8_decode($destino), utf8_decode($nomeDestino)); //email e nome do destino

  if ($mail->Send()) {
    return true;
  } else {
    return false;
  }
}

switch ($_POST['acao']) {
    //===============================================================================================================================
    // LOGAR NO SISTEMA
    //===============================================================================================================================
  case 'login':
    $c['login'] = $_POST['email'];
    $c['senha'] = $_POST['senha'];
    $c['nav'] = $_POST['nav'];
    $c['ip'] = $_POST['ip'];

    if (Check::Email($c['login'])) :
      if (in_array('', $c)) {
        echo '3';
      } else {
        $read = new Read;
        $read->ExeRead('orientador', 'WHERE email = :email AND senha = :senha', "email=" . $c['login'] . "&senha=" . $c['senha'] . "");
        if ($read->getRowCount() >= 1) :
          foreach ($read->getResult() as $resultado);
          if ($resultado['status'] == '3' || $resultado['status'] == '2') :
            echo '5';
          else :
            $Dados = [
              'data' => $dataStamp2,
              'hora' => $hora,
              'id_user' => $resultado['id'],
              'ip' => $c['ip'],
              'navegador' => $c['nav'],
            ];

            $Cadastra = new Create;
            $Cadastra->ExeCreate('entradas', $Dados);
            $_SESSION['usuario'] = $resultado['id'];
            echo '1';
          endif;
        else :
          echo '2';
        endif;
      } else :
      echo '6';
    endif;
    break;
    //===============================================================================================================================
    // ESQUECI MINHA SENHA 
    //===============================================================================================================================       
  case 'senha':
    $c['email'] = $_POST['email'];
    if (in_array('', $c)) {
      echo '3';
    } else {
      $read = new Read;
      $read->ExeRead('orientador', 'WHERE email = :email', "email=" . $c['email'] . "");
      if ($read->getRowCount() >= 1) :
        foreach ($read->getResult() as $resultado);

        $c['mensagem'] = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <style type="text/css">
                body{background:#f0f0f0;}
            </style>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Bem vindo ao Pegasus</title>
        </head>
        <body>
            <br><br>
            <center>
            <div style="clear: both !important;"></div>
            <a href="' . HOME . '" style="" target="_blank" title="' . SITENOME . '">
                <img src="' . HOME . 'imagens_site/logo2.png" width="450" title="' . SITENOME . '" alt="' . SITENOME . '" />
            </a>
        </center>
        <br>
        <div style="clear: both !important;"></div>
        <table style="background-color: #fff; padding: 30px;" width="580" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td>
                    <h2>Olá ' . $resultado['nome'] . '</h2>
                    Este e-mail foi solicitado para lembra o seu e-mail e a sua senha.<br/><br/>
                    Seu e-mail cadastrado: ' . $resultado['email'] . '<br/>
                    Sua senha cadastrada: ' . $resultado['senha'] . '<br/>
                    Para acessar o sistema entre no link abaixo:<br>
                   <a href="' . HOME . '" title="Acesso o sistema">Acessar o sistema pegasus: ' . HOME . '</a>
                </td>
            </tr>
        </table>
        <br>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">' . date('Y') . ' - ' . SITENOME . '</p>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">
        <a href="' . HOME . '" target="_blank" style=" color: #848484;" title="' . SITENOME . '">' . HOME . '</a>
        </p>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">E-mail enviado em: ' . date('d/m/Y - H:i:s') . '</p>
        <div style="clear: both !important;"></div></div>
</boby>
</html>';


        $email_senha = array(
          "Assunto" => "Recuperar senha", // Assunto do e-mail.
          "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
          "RemetenteNome" => SITENOME, //Nome da pessoa que enviou.
          "RemetenteEmail" => EMAILSUPORTE, //E-mail da pessoa que enviou.
          "DestinoNone" => $resultado['nome'], //Nome da pessoa que vai receber.
          "DestinoEmail" => $c['email'] //Email da pessoa que esta recebendo.
        );

        $enviar_envio = sendMail($email_senha['Assunto'], $c['mensagem'], $email_senha['RemetenteEmail'], $email_senha['RemetenteNome'], $email_senha['DestinoEmail'], $email_senha['DestinoNone'], $reply = NULL, $replyNome = NULL, $anexo_pasta = NULL);

        if ($enviar_envio) :
          echo '1';
        else :
          echo '4';
        endif;
      else :
        echo '2';
      endif;
    }
    break;
    //===============================================================================================================================
    // USUÁRIOS
    //===============================================================================================================================         
  case 'cad_usuario':

    $c['nome'] = $_POST['nome'];
    $c['email'] = $_POST['email'];
    $c['cargo'] = $_POST['cargo'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $c['acesso'] = $_POST['acesso'];
    $c['id'] = $_POST['id'];
    $senha = Check::NewPass('5', false, true, true);

    if (in_array('', $c)) {
      echo '3';
    } else {

      //buscar igual
      $igual = new Read;
      $igual->ExeRead('perfil', 'WHERE nome = :cnpj or email = :email and status=1', "cnpj=" . $c['nome'] . "&email=" . $c['email'] . "");
      if (!$igual->getRowCount() >= 1) :

        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :

          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], 'perfil', '500', 'foto_perfil', '500');
          $foto = $upload->getResult();
        else :
          $foto = '';
        endif;

        $Dados = [
          'id_cadastrante' => $c['id'],
          'nome' => $c['nome'],
          'cargo' => $c['cargo'],
          'email' => $c['email'],
          'tel' => $tel,
          'cel' => $cel,
          'senha' => $senha,
          'data_cad' => $dataStamp2,
          'status' => '1',
          'avatar' => $foto,
        ];

        $Cadastra = new Create;
        $Cadastra->ExeCreate('perfil', $Dados);
        if ($Cadastra->getResult()) :


          foreach ($c['acesso'] as $valor) {

            $Dadosw = [
              'id_perfil' => $Cadastra->getResult(),
              'permissao' => $valor,
            ];

            $Cadastra__ = new Create;

            $Cadastra__->ExeCreate('permissao', $Dadosw);
          }



          $c['mensagem'] = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <style type="text/css">
                body{background:#f0f0f0;}
            </style>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Bem vindo</title>
        </head>
        <body>
            <br><br>
            <center>
            <div style="clear: both !important;"></div>
            <a href="' . HOME . '" style="" target="_blank" title="' . SITENOME . '">
                <img src="' . HOME . 'imagens_site/logo2.png" width="450" title="' . SITENOME . '" alt="' . SITENOME . '" />
            </a>
        </center>
        <br>
        <div style="clear: both !important;"></div>
        <table style="background-color: #fff; padding: 30px;" width="580" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td>
                    <h2>Olá ' . $c['nome'] . '</h2>
                    Bem vindo ao Pegasus, O projeto ' . NOMECLIENTE . ' lhe deu permissão para acessar seu painel de controle, as informações de acesso esta abaixo!<br/><br/>
                    E-mail de acesso: ' . $c['email'] . '<br/>
                    Senha de acesso: ' . $senha . '<br/><br/>
                    Aconselhamos que você altere sua senha no primeiro acesso.<br>
                    Para acessar o sistema entre no link abaixo:<br>
                   <a href="' . HOME . '" title="Acesso o sistema">Acessar o sistema pegasus: ' . HOME . '</a>

                </td>
            </tr>
        </table>
        <br>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">' . date('Y') . ' - ' . SITENOME . '</p>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">
        <a href="' . HOME . '" target="_blank" style=" color: #848484;" title="' . SITENOME . '">' . HOME . '</a>
        </p>
        <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">E-mail enviado em: ' . date('d/m/Y - H:i:s') . '</p>
        <div style="clear: both !important;"></div></div>
</boby>
</html>';

          $email_senha = array(
            "Assunto" => "Bem vindo ao Pegasus", // Assunto do e-mail.
            "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
            "RemetenteNome" => SITENOME, //Nome da pessoa que enviou.
            "RemetenteEmail" => EMAILSUPORTE, //E-mail da pessoa que enviou.
            "DestinoNone" => $c['nome'], //Nome da pessoa que vai receber.
            "DestinoEmail" => $c['email'] //Email da pessoa que esta recebendo.
          );

          $enviar_envio = sendMail($email_senha['Assunto'], $email_senha['Mensagem'], $email_senha['RemetenteEmail'], $email_senha['RemetenteNome'], $email_senha['DestinoEmail'], $email_senha['DestinoNone'], $reply = NULL, $replyNome = NULL, $anexo_pasta = NULL);

          if ($enviar_envio) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      else :
        echo '5';
      endif;
    }
    break;
  case 'editar_usuario_perfil':

    $c['nome'] = $_POST['nome'];
    $c['email'] = $_POST['email'];
    $c['senha'] = $_POST['senha'];
    $cargo = $_POST['cargo'];
    $tel = $_POST['tel'];
    $c['cel'] = $_POST['cel'];
    $c['id_usuario'] = $_POST['id_usuario'];

    //VERICIAR CAMPOS VAZIOS
    if (in_array('', $c)) :
      echo '3';
    else :

      //VERIFICANDO SE JÁ ESTA CADASTRADO
      $igual = new Read;
      $igual->ExeRead('perfil', 'WHERE id = :id ', "id=" . $c['id_usuario'] . "");
      foreach ($igual->getResult() as $resultado);

      //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
      if (isset($_FILES['user_thumb'])) :

        if ($_FILES['user_thumb']['type'] == 'image/jpeg' || $_FILES['user_thumb']['type'] == 'image/png') :
        else :
          echo '11';
          exit();
          break;
        endif;

        //print_r($_FILES['user_thumb']['size']);

        if ($_FILES['user_thumb']['size'] >= '4000000') :
          echo '8';
          exit();
          break;
        else :
        endif;

        $upload = new Upload('../imagens_site/');
        //-----------------imagem, nome, tamanho, pasta----------------//
        $upload->Image($_FILES['user_thumb'], 'perfil', '500', 'foto_perfil', '500');
        $foto = $upload->getResult();
      else :
        $foto = $resultado['avatar'];
      endif;


      $Dados = [
        'id_cadastrante' => $c['id_usuario'],
        'nome' => $c['nome'],
        'cargo' => $cargo,
        'email' => $c['email'],
        'tel' => $tel,
        'cel' => $c['cel'],
        'senha' => $c['senha'],
        'avatar' => $foto,
      ];

      $updade = new Update;
      $updade->ExeUpdate('perfil', $Dados, "WHERE id = :id", "id=" . $c['id_usuario'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    endif;
    break;
  case 'identificar_usuario':
    $c['id'] = $_POST['id'];

    if (in_array('', $c)) {
      echo '3';
    } else {
      //VERIFICAR SE EXISTE E ALIMENTAR O FORMULÁRIO
      $read = new Read;
      $read->ExeRead('perfil', 'WHERE id = :id', "id=" . $c['id'] . "");
      if ($read->getRowCount() >= 1) :
        foreach ($read->getResult() as $resultado);
?>
        <script>
          jQuery(function($) {
            $("#alt_celular").mask("(99)99999-9999");
            $("#alt_tel").mask("(99)99999-9999");
          });
        </script>
        <form class="form_linha" method="post" name="editar_usuario">
          <h1 class="topo_modal">Alterar perfil</h1>
          <div style="width: 75%; float: left">
            <div class="box box50">
              <p class="texto_form">Nome completo</p>
              <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;" value="<?= $resultado['nome']; ?>" />
            </div>
            <div class="box box50 no-margim">
              <p class="texto_form">E-mail válido</p>
              <input name="email" type="email" required placeholder="E-mail válido" style=" width: 100%;" value="<?= $resultado['email']; ?>" />
            </div>
            <div class="limpar"></div>
            <div class="box box33">
              <p class="texto_form">Telefone</p>
              <input name="tel" type="text" required placeholder="Telefone" id="alt_celular" style=" width: 100%;" value="<?= $resultado['tel']; ?>" />
            </div>
            <div class="box box33">
              <p class="texto_form">Celular</p>
              <input name="cel" type="text" required placeholder="Celular" id="alt_tel" style=" width: 100%;" value="<?= $resultado['cel']; ?>" />
            </div>
            <div class="box box33 no-margim">
              <p class="texto_form">Cargo</p>
              <input name="cargo" type="text" required placeholder="Cargo na empresa" style=" width: 100%;" value="<?= $resultado['cargo']; ?>" />
            </div>
            <div class="limpar"></div>
            <p class="texto_form">Permissão</p>
            <p class="texto_form">Selecione apenas as permissões que gostaria que este usuário utilizasse.</p>
            <br>
            <?php
            $read->ExeRead('permissao', 'WHERE id_perfil = :id', "id=" . $c['id'] . "");

            if ($read->getRowCount() >= 1) :

              foreach ($read->getResult() as $examinado) :

                $arr2[] = $examinado['permissao'];

              endforeach;

            else :

              $arr2[] = '';

            endif;
            ?>
            <div class="box box-media">
              <?php
              if (dashboard == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('1', $arr2) ? "checked" : ""); ?> type="checkbox" value="1" id="coding1_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding1_" name="1">
                    <p class="labelterm">Página inicial</p>
                  </label>
                </div>
              <?php
              endif;

              if (depoimentos == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('2', $arr2) ? "checked" : ""); ?> type="checkbox" value="2" id="coding2_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding2_" name="2">
                    <p class="labelterm">Depoimentos</p>
                  </label>
                </div>
              <?php
              endif;

              if (arquivos == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('3', $arr2) ? "checked" : ""); ?> type="checkbox" value="3" id="coding3_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding3_" name="3">
                    <p class="labelterm">Sistema de arquvos</p>
                  </label>
                </div>
              <?php
              endif;

              if (newsletter == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('4', $arr2) ? "checked" : ""); ?> type="checkbox" value="4" id="coding4_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding4_" name="4">
                    <p class="labelterm">Newsletter</p>
                  </label>
                </div>
              <?php
              endif;

              if (sac == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('5', $arr2) ? "checked" : ""); ?> type="checkbox" value="5" id="coding5_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding5_" name="5">
                    <p class="labelterm">SAC</p>
                  </label>
                </div>
              <?php
              endif;

              if (cadastrar_usuario == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('6', $arr2) ? "checked" : ""); ?> type="checkbox" value="6" id="coding6_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding6_" name="6">
                    <p class="labelterm">Perfil</p>
                  </label>
                </div>
              <?php
              endif;
              ?>
            </div>

            <div class="box box-media">
              <?php
              if (cliente == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('7', $arr2) ? "checked" : ""); ?> type="checkbox" value="7" id="coding7_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding7_" name="7">
                    <p class="labelterm">Empresa</p>
                  </label>
                </div>
              <?php
              endif;

              if (cliente_usuario == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('8', $arr2) ? "checked" : ""); ?> type="checkbox" value="8" id="coding8_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding8_" name="8">
                    <p class="labelterm">Contatos na empresa</p>
                  </label>
                </div>
              <?php
              endif;

              if (blog == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('9', $arr2) ? "checked" : ""); ?> type="checkbox" value="9" id="coding9_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding9_" name="9">
                    <p class="labelterm">Blog</p>
                  </label>
                </div>
              <?php
              endif;

              if (crm == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('10', $arr2) ? "checked" : ""); ?> type="checkbox" value="10" id="coding10_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding10_" name="10">
                    <p class="labelterm">CRM</p>
                  </label>
                </div>
              <?php
              endif;

              if (agenda == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('11', $arr2) ? "checked" : ""); ?> type="checkbox" value="11" id="coding11_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding11_" name="11">
                    <p class="labelterm">Agenda</p>
                  </label>
                </div>
              <?php
              endif;

              if (orientador == 'ON') :
              ?>
                <div class="mylabel">
                  <input name="acesso[]" <?= (in_array('12', $arr2) ? "checked" : ""); ?> type="checkbox" value="12" id="coding12_">
                  <div class="slidinggroove"></div>
                  <label class="mylabel" for="coding12_" name="12">
                    <p class="labelterm">Orientador</p>
                  </label>
                </div>
              <?php
              endif;
              ?>
            </div>

            <div class="box box-media no-margim">

            </div>
          </div>


          <div style="width: 23%; float: right">

            <p class="texto_form"></p>
            <?php
            if ($resultado['avatar'] == '') :
              echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
            else :
              echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['avatar'] . '" default="' . HOME . 'imagens_site/' . $resultado['avatar'] . '">';
            endif;
            ?>
            <div class="box_content">
              <div class="limpar"></div>
              <div class="mensagem_imagem ds-none">
                <p><b></b></p>
              </div>
              <span class="legend">Foto (500x500px, JPG ou PNG):</span>
              <div class="limpar" style=" margin-bottom: 2%"></div>
              <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label>
              <input id='selecao-arquivo2' type="file" name="user_thumb" class="wc_loadimage upload" />

              <div class="upload_bar m_top m_botton">
                <div class="upload_progress ds-none">0%</div>
              </div>
              <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />

            </div>
          </div>

          <div class="limpar"></div>
          <br>
          <input type="hidden" name="id_usuario" value="<?= $resultado['id']; ?>" />
          <input type="hidden" name="acao" value="editar_usuario" />
          <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
          <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
            <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
          </button>
          <div class="limpar"></div>
        </form>
    <?php
      else :
        echo '1';
      endif;
    }
    break;
  case 'editar_usuario':

    $c['nome'] = $_POST['nome'];
    $c['email'] = $_POST['email'];
    $c['cargo'] = $_POST['cargo'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    $c['acesso'] = $_POST['acesso'];
    //$c['permissao'] = $_POST['permissao'];
    //$c['id'] = $_POST['id'];
    $c['id_usuario'] = $_POST['id_usuario'];

    //VERICIAR CAMPOS VAZIOS
    if (in_array('', $c)) :
      echo '3';
    else :

      //VERIFICANDO SE JÁ ESTA CADASTRADO
      $igual = new Read;
      $igual->ExeRead('perfil', 'WHERE id = :id ', "id=" . $c['id_usuario'] . "");
      foreach ($igual->getResult() as $resultado);
      //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
      if (isset($_FILES['user_thumb'])) :

        $upload = new Upload('../imagens_site/');
        //-----------------imagem, nome, tamanho, pasta----------------//
        $upload->Image($_FILES['user_thumb'], 'perfil', '500', 'foto_perfil', '500');
        $foto = $upload->getResult();
      else :
        $foto = $resultado['avatar'];
      endif;

      $delete = new Delete;

      $delete->ExeDelete('permissao', "WHERE id_perfil = :id", 'id=' . $c['id_usuario'] . '');



      foreach ($c['acesso'] as $valor) {

        $Dadosw = [
          'id_perfil' => $c['id_usuario'],
          'permissao' => $valor,
        ];

        $Cadastra__ = new Create;

        $Cadastra__->ExeCreate('permissao', $Dadosw);
      }

      $Dados = [
        'tel' => $tel,
        'cel' => $cel,
        'nome' => $c['nome'],
        'cargo' => $c['cargo'],
        'email' => $c['email'],
        'avatar' => $foto,
      ];

      $updade = new Update;
      $updade->ExeUpdate('perfil', $Dados, "WHERE id = :id", "id=" . $c['id_usuario'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    endif;
    break;
  case 'ex_usuario':
    $c['id'] = $_POST['del'];

    if (in_array('', $c)) {
      echo '3';
    } else {
      $Dados = [
        'status' => '2',
      ];

      $updade = new Update;
      $updade->ExeUpdate('perfil', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    }
    break;
    //===============================================================================================================================
    //SLIDE SHOW
    //===============================================================================================================================         
  case 'slide':

    $c['manual'] = $_FILES['manual'];
    $endereco = $_POST['url'];
    $c['titulo'] = $_POST['nome'];
    if (in_array('', $c)) :
      echo '3';
    else :
      $upload = new Upload('../imagens_site/');
      //-----------------imagem, nome, tamanho, pasta----------------//
      $upload->Image($c['manual'], 'imagem-slide', '1200', '', '350');
      if (!$upload->getResult()) :
        echo '2';
      else :
        $Dados = [
          'titulo' => $c['titulo'],
          'imagem' => $upload->getResult(),
          'url' => $endereco,
          'status' => '1',
          'data' => $dataStamp2,
          'hora' => $hora,
        ];
        $Cadastra = new Create;
        $Cadastra->ExeCreate('slide', $Dados);
        if ($Cadastra->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
    endif;
    break;
  case 'slide_status':
    $c['id'] = $_POST['id'];
    if (in_array('', $c)) :
      echo '3';
    else :

      $ultimo = new Read;
      $ultimo->ExeRead('slide', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      if ($resultado['status'] == '1') :
        $statis = '2';
      else :
        $statis = '1';
      endif;

      $Dados = [
        'status' => $statis,
      ];

      $updade = new Update;
      $updade->ExeUpdate('slide', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    endif;
    break;
  case 'ex_slide':
    $c['id'] = $_POST['del'];

    if (in_array('', $c)) {
      echo '3';
    } else {

      $delete = new Delete;
      $delete->ExeDelete('slide', "WHERE id = :id", 'id=' . $c['id'] . '');
      if ($delete->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    }
    break;
    //===============================================================================================================================
    // CUPOM
    //===============================================================================================================================         
  case 'cad_cupom':
    $c['codigo'] = $_POST['codigo'];
    $c['porcentagem'] = $_POST['porcentagem'];
    $c['quantidade'] = $_POST['quantidade'];
    $c['data_inicial'] = $_POST['data_inicial'];
    $c['data_fim'] = $_POST['data_fim'];
    if (in_array('', $c)) :
      echo '3';
    else :

      //VERIFICANDO SE JÁ ESTA CADASTRADO
      $igual = new Read;
      $igual->ExeRead('cupom', 'WHERE codigo = :id', "id=" . $c['codigo'] . "");
      if (!$igual->getRowCount() >= 1) :


        $Dados = [
          'codigo' => $c['codigo'],
          'porcentagem' => $c['porcentagem'],
          'quantidade' => $c['quantidade'],
          'status' => '1',
          'data_inicial' => Check::Datastamp($c['data_inicial']),
          'data_fim' => Check::Datastamp($c['data_fim']),
          'data_cad' => $dataStamp2,
          'hora_cad' => $hora,
        ];
        $Cadastra = new Create;
        $Cadastra->ExeCreate('cupom', $Dados);
        if ($Cadastra->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      else :
        echo '4';
      endif;
    endif;
    break;
    //===============================================================================================================================
    // TAXA 
    //===============================================================================================================================         
  case 'sobrepreco':

    $c['taxa'] = $_POST['taxa'];

    $Dados = [
      'taxa' => $c['taxa'],
    ];

    $updade = new Update;
    $updade->ExeUpdate('configuracao', $Dados, "WHERE id = :id", "id=1");
    if ($updade->getResult()) :
      echo '1';
    else :
      echo '2';
    endif;
    break;
    //===============================================================================================================================
    //DEPOIMENTO
    //===============================================================================================================================         
  case 'depoimento':
    $empresa = $_POST['empresa'];
    $c['nome'] = $_POST['nome'];
    $c['txt'] = $_POST['txt'];
    if (in_array('', $c)) :
      echo '3';
    else :

      if (isset($_FILES['user_thumb'])) :
        $upload = new Upload('../imagens_site/');
        //-----------------imagem, nome, tamanho, pasta----------------//
        $upload->Image($_FILES['user_thumb'], md5($c['nome'] . $dataHora), '500', 'depoimento', '500');
        $foto = $upload->getResult();
      endif;

      $Dados = [
        'nome' => $c['nome'],
        'empresa' => $empresa,
        'txt' => $c['txt'],
        'avatar' => $foto,
        'data_cad' => $dataStamp2,
        'hora_cad' => $hora,
        'status' => '1',
      ];
      $Cadastra = new Create;
      $Cadastra->ExeCreate('depoimento', $Dados);
      if ($Cadastra->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    endif;
    break;
  case 'depoimento_status_alt':
    $c['id'] = $_POST['id'];
    if (in_array('', $c)) :
      echo '3';
    else :

      $ultimo = new Read;
      $ultimo->ExeRead('depoimento', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      if ($resultado['status'] == '1') :
        $statis = '2';
      else :
        $statis = '1';
      endif;

      $Dados = [
        'status' => $statis,
      ];

      $updade = new Update;
      $updade->ExeUpdate('depoimento', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    endif;
    break;
  case 'ex_depoimento':
    $c['id'] = $_POST['del'];

    if (in_array('', $c)) {
      echo '3';
    } else {

      $Dados = [
        'status' => '3',
      ];

      $updade = new Update;
      $updade->ExeUpdate('depoimento', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    }
    break;
  case 'depoimento_status':
    $c['id'] = $_POST['id'];

    $ultimo = new Read;
    $ultimo->ExeRead('depoimento', "WHERE id = :id", 'id=' . $c['id'] . '');
    foreach ($ultimo->getResult() as $resultado);
    ?>
    <form class=" form_linha" method="post" name="depoimento_alt">
      <h1 class="topo_modal">Alterar depoimento</h1>
      <div class="box box80">
        <div class="box box50" style="">
          <p class="texto_form">Nome</p>
          <input name="nome" type="text" required placeholder="Nome" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
        </div>
        <div class="box box50 no-margim">
          <p class="texto_form">Empresa</p>
          <input name="empresa" type="text" required placeholder="Empresa" value="<?= $resultado['empresa']; ?>" style="width: 100%" />
        </div>
        <div class="limpar"></div>
        <textarea name="txt" id="" rows="5" placeholder="Depoimento" style=" width: 100%; height: 100px"><?= $resultado['txt']; ?></textarea>
      </div>

      <div class="box box20 no-margim">

        <p class="texto_form"></p>
        <?php
        if ($resultado['avatar'] == '') :
          echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
        else :
          echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['avatar'] . '" default="' . HOME . 'imagens_site/' . $resultado['avatar'] . '">';
        endif;
        ?>
        <div class="box_content">
          <div class="limpar"></div>
          <div class="mensagem_imagem ds-none">
            <p><b></b></p>
          </div>
          <span class="legend">Foto (500x500px, JPG ou PNG):</span>
          <div class="limpar" style=" margin-bottom: 2%"></div>
          <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label>
          <input id='selecao-arquivo2' type="file" name="user_thumb" class="wc_loadimage" />
          <div class="limpar"></div>

          <div class="upload_bar m_top m_botton">
            <div class="upload_progress ds-none">0%</div>
          </div>
          <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
        </div>

      </div>

      <div class="limpar"></div>
      <br>
      <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
      <input type="hidden" name="acao" value="depoimento_alt" />
      <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
      <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 9%;">
        <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
      </button>
      <div class="limpar"></div>
    </form>
    <?php
    break;
  case 'depoimento_alt':

    $c['nome'] = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $c['txt'] = $_POST['txt'];
    $c['id'] = $_POST['id'];

    if (in_array('', $c)) {
      echo '3';
    } else {

      $ultimo = new Read;
      $ultimo->ExeRead('depoimento', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
      if (isset($_FILES['user_thumb'])) :

        $upload = new Upload('../imagens_site/');
        //-----------------imagem, nome, tamanho, pasta----------------//
        $upload->Image($_FILES['user_thumb'], md5($c['nome'] . $dataHora), '500', 'depoimento', '500');
        $foto = $upload->getResult();
      else :
        $foto = $resultado['avatar'];
      endif;

      $Dados = [
        'nome' => $c['nome'],
        'empresa' => $empresa,
        'txt' => $c['txt'],
        'avatar' => $foto,
      ];

      $updade = new Update;
      $updade->ExeUpdate('depoimento', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
    }
    break;
    //===============================================================================================================================
    // BUSCAR O CEP
    //=============================================================================================================================== 
  case 'busca_cep':
    $cep = $_POST['cep'];

    $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
    $dados['sucesso'] = (string) $reg->resultado;
    $dados['rua'] = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
    $dados['bairro'] = (string) $reg->bairro;
    $dados['cidade'] = (string) $reg->cidade;
    $dados['estado'] = (string) $reg->uf;

    if ($dados['sucesso'] == '1') :
      echo json_encode($dados);
    else :
      echo '2';
    endif;
    break;
    //===============================================================================================================================
    // BUSCAR CLIENTES
    //=============================================================================================================================== 
  case 'busca_cliente':
    $c['busca_loja'] = $_POST['busca_loja'];
    $c['busca_text'] = $_POST['busca_text'];
    if (in_array('', $c)) {
      echo '3';
    } else {
      if ($c['busca_loja'] == '1') :
        $tabela = 'nome';
      elseif ($c['busca_loja'] == '2') :
        $tabela = 'email';
      elseif ($c['busca_loja'] == '3') :
        $tabela = 'cpf_cnpj_c';
      endif;

      //VERIFICANDO
      $area = new Read;
      $area->ExeRead('cliente', "WHERE ((`" . $tabela . "` LIKE '%" . $c['busca_text'] . "%') OR ('%" . $c['busca_text'] . "%'))");
      if ($area->getRowCount() >= 1) :
        echo '<p class="fl-left relt">' . $area->getRowCount() . ' resultado(s) encontrado(s).</p><br><br>';
    ?>
        <script type="text/javascript" src="<?= HOME; ?>js/sorttable.js"></script>
        <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
        <table class="lista_base_tabela sortable">
          <!--<caption></caption>-->
          <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
            <th width="9%" style=" text-align: center; padding: 1%;">Imagem</th>
            <th width="25%" style=" text-align: center; padding: 1%;">Nome</th>
            <th width="20%" style=" text-align: center; padding: 1%;">E-mail</th>
            <th width="15%" style=" text-align: center; padding: 1%;">CPF ou CNPJ</th>
            <th width="15%" style=" text-align: center; padding: 1%;">Celular</th>
            <th width="19%" style=" text-align: center; padding: 1%;"></th>
            <th width="1%" style="padding: 0%;"></th>
            <th width="1%" style="padding: 0%"></th>
          </tr>
          <div class="limpar"></div>
          <?php
          foreach ($area->getResult() as $listagem_) :
            if ($listagem_['avatar'] == '') :
              $avatar = Check::Imagem('../imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
            else :
              $avatar = '<img src="' . SITE . 'imagens_site/' . $listagem_['avatar'] . '" title="' . $listagem_['nome'] . '"width="500"/>';
            endif;
          ?>
            <tr class="lista_tabela">
              <td width="9%"><?= $avatar; ?></td>
              <td width="25%"><?= $listagem_['nome']; ?></td>
              <td width="20%"><?= $listagem_['email']; ?></td>
              <td width="15%"><?= $listagem_['cpf_cnpj_c']; ?></td>
              <td width="15%"><?= $listagem_['cel']; ?></td>
              <td width="19%"></td>
              <td width="1%">
                <div class="btn btn_green email_cliente" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="medium" data-balloon="Enviar e-mail" data-balloon-pos="up">
                  <figure class="icon-envelope6"></figure>
                </div>
              </td>
              <td width="1%">
                <div class="id_cliente_alt btn btn_blue" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Alterar" data-balloon-pos="up">
                  <figure class="icon-repeat"></figure>
                </div>
              </td>
              <div class="limpar"></div>
            </tr>
        <?php
          endforeach;
        else :
          echo '<br><div class="list" style="color: #000; font-size: 1.1em;"><center>Desculpe, não encontramos nenhuma ocorrência com esses parametros, tente novamente.</center></div> <br>';
        endif;
        ?>
        <div class="limpar"></div>
        </table>
      <?php
    }
    break;
    //===============================================================================================================================
    // EXIBIR FORMULARIO DE DE CONTATO DO CLIENTE
    //===============================================================================================================================
  case 'email_cliente':
    $c['id'] = $_POST['id'];

    $ultimo = new Read;
    $ultimo->ExeRead('clientes', "WHERE id = :id", 'id=' . $c['id'] . '');
    foreach ($ultimo->getResult() as $resultado);
      ?>
      <script type="text/javascript" src="<?= HOME; ?>poo/app/Library/tinymce/js/tinymce/tinymce.min.js"></script>

      <form class="form" method="post" name="email_cliente_form" style=" width: 80%; margin: 0 auto;">
        <div style="width: 100%; float: left">
          <p style=" margin-bottom: 2.5%; color: #fff; font-weight: 600; padding: 1%; padding-top: 1.4%; border-bottom: 1px solid #f1f1f1; border-top: 1px solid #f1f1f1">
            <i class="fa fa-envelope-o" style=" font-size: 1.4em; margin-right: 1%; margin-top: -0.75%;"></i>
            Enviar e-mail para <?= $resultado['nome']; ?>
          </p>
          <script type="text/javascript">
            tinymce.init({
              selector: "textarea#elm2",
              theme: "modern",
              height: 200,
              relative_urls: false,
              remove_script_host: false,
              plugins: [
                "advlist autolink lists charmap print preview hr pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
                "table contextmenu directionality emoticons paste textcolor"
              ],
              toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor | preview code ",
              toolbar2: "",
              image_advtab: true,
              style_formats: [{
                  title: 'Bold text',
                  inline: 'b'
                },
                {
                  title: 'Red text',
                  inline: 'span',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Red header',
                  block: 'h1',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Example 1',
                  inline: 'span',
                  classes: 'example1'
                },
                {
                  title: 'Example 2',
                  inline: 'span',
                  classes: 'example2'
                },
                {
                  title: 'Table styles'
                },
                {
                  title: 'Table row 1',
                  selector: 'tr',
                  classes: 'tablerow1'
                }
              ],
              external_filemanager_path: "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/",
              filemanager_title: "Responsive Filemanager",
              external_plugins: {
                "filemanager": "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/plugin.min.js"
              }
            });
          </script>
          <p class="texto_form" style=" color: #fff;">Titulo do e-mail</p>
          <input name="titulo" type="text" required placeholder="Titulo do e-mail" style=" width: 100%;" value="" />
          <p class="texto_form" style=" color: #fff;">Descrição do e-mail (Obrigatório)</p>
          <textarea id="elm2" name="txt" rows="8" style=" width: 100%;"></textarea>
          <div class="limpar"></div>
          <br>
          <input type="hidden" value="<?= $resultado['id']; ?>" name="id" />
          <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
          <div class="limpar"></div>
          <button class="btn btn_green fl-left" style=" width: 18%; float: right; font-size: 0.8em;"><i class="fa fa-envelope" style=" font-size: 1.3em; margin-right: 1%; margin-top: -1.7%;"></i> Enviar e-mail</button>
          <div class="limpar"></div>
        </div>
      </form>
      <?php
      break;
      //===============================================================================================================================
      // ENVIAR E-MAIL PARA O CLIENTE.
      //===============================================================================================================================
    case 'email_cliente_form':
      $c['id'] = $_POST['id'];
      $c['titulo'] = $_POST['titulo'];
      $c['txt'] = $_POST['txt'];

      if (!$c['txt'] == '') :

        $ultimo = new Read;
        $ultimo->ExeRead('clientes', "WHERE id = :id", 'id=' . $c['id'] . '');
        foreach ($ultimo->getResult() as $resultado);

        $c['mensagem'] = '
                        <!DOCTYPE html>
                            <html lang="pt-br">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                    <meta name="viewport" content="width=device-width, initial-scale=1"/>
                                    <title>E-mail</title>
                                </head>
                                <body>
                                    <style type="text/css">
                                        body{background:#f0f0f0;}
                                    </style>
                                <center>
                                    
                                    <br><br>
                                </center>
                                    <div style="width: 70%; margin-left: 15%; padding: 15px; background-color: #fff; float: left">
                                        <h1 style=" margin-top: 0; font-size: 1.3em;">Olá, ' . $resultado['nome'] . '!</h1>
                                         ' . $c['txt'] . '
                                        <p>Foi enviado em: ' . $dataHora . '</p>
                                    </div>
                                <div style="clear: both !important;"></div>
                                    <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">' . date('Y') . ' - ' . NOMECLIENTE . '</p>
                                    <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">
                                    <a href="' . SITE . '" target="_blank" style=" color: #848484;" title="' . NOMECLIENTE . '">' . SITE . '</a>
                                    </p>
                                    <p style="text-align: center; color: #848484; font-size: 0.8em; margin-bottom: 5px">E-mail enviado em: ' . $dataHora . '</p>
                                    <div style="clear: both !important;"></div>
                                </body>
                            </html>';

        $email_senha = array(
          "Assunto" => $c['titulo'], // Assunto do e-mail.
          "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
          "RemetenteNome" => NOMECLIENTE, //Nome da pessoa que enviou.
          "RemetenteEmail" => EMAILATENDIMENTO, //E-mail da pessoa que enviou.
          "DestinoNone" => $resultado['nome'], //Nome da pessoa que vai receber.
          "DestinoEmail" => $resultado['email'] //Email da pessoa que esta recebendo.
        );

        $enviar_envio = sendMail(
          $email_senha['Assunto'],
          $email_senha['Mensagem'],
          $email_senha['RemetenteEmail'],
          $email_senha['RemetenteNome'],
          $email_senha['DestinoEmail'],
          $email_senha['DestinoNone'],
          $email_senha['RemetenteEmail'],
          $replyNome = NULL,
          $anexo_pasta = NULL
        );
      ?>
        <div class="mensagem mensagem_success">
          <span style=" font-weight: 600;">E-mail enviado com sucesso!</span>
          <p>O cliente recebeu sua mensagem.</p>
        </div>
      <?php
      else :
        echo '2';
      endif;
      break;
      //===============================================================================================================================
      // EXCLUIR ARQUIVOS
      //===============================================================================================================================
    case 'remove_arquivo':
      $c['id'] = $_POST['del'];

      if (in_array('', $c)) {
        echo '3';
      } else {

        $delete = new Delete;
        $delete->ExeDelete('cliente_arquivo', "WHERE id = :id", 'id=' . $c['id'] . '');
        if ($delete->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      }
      break;
      //===============================================================================================================================
      // EMPRESA
      //===============================================================================================================================
    case 'modal_usuario_empresa':
      $c['id'] = $_POST['id'];
      ?>
      <div class="" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Contatos da empresa</h1>
        <script>
          $('.cadastrar_modal').click(function() {
            $('.lista_atual_modal').slideUp(function() {
              $('.lista_nova_usuario_modal').slideDown();
            });
            return false;
          });
          $('.voltar_lista_modal').click(function() {
            $('.lista_nova_usuario_modal').slideUp(function() {
              $('.lista_atual_modal').slideDown();
            });
            return false;
          });
        </script>
        <div class="box_conteudo_ lista_atual_modal">
          <!--LISTA DE CADASTRADOS-->
          <?php
          $listagem = new Read;
          $listagem->ExeRead('cliente_contato', 'where id_cliente = ' . $c['id'] . ' and status <> 3');
          echo '<a href="" class="btn btn_green fl-right cadastrar_modal" style=" width: 17%; margin-top: -2%;"><figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.6%; margin-right: 2%;"></figure> Cadastrar novo contato</a><div class="limpar"></div>';
          if ($listagem->getRowCount() >= 1) :
          ?>
            <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
            <script type="text/javascript" src="<?= HOME; ?>js/sorttable.js"></script>
            <table class="lista_base_tabela sortable">
              <!--<caption></caption>-->
              <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                <th width="9%" style=" text-align: center; padding: 1%;">Avatar</th>
                <th width="30%" style=" text-align: center; padding: 1%;">Nome</th>
                <th width="15%" style=" text-align: center; padding: 1%;">Empresa</th>
                <th width="15%" style=" text-align: center; padding: 1%;">E-mail</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Senha</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Telefone</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Status</th>
                <th width="1%" style="padding: 0%;"></th>
                <th width="1%" style="padding: 0%"></th>
              </tr>
              <div class="limpar"></div>
              <?php
              foreach ($listagem->getResult() as $listagem_) :

                $listagem->ExeRead('cliente', 'WHERE id = :id', "id=" . $listagem_['id_cliente'] . "");
                foreach ($listagem->getResult() as $empresa);

                if ($listagem_['avatar'] == '') :
                  $avatar = Check::Imagem('../imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
                else :
                  $avatar = Check::Imagem('../imagens_site/' . $listagem_['avatar'] . '', $listagem_['nome'], '500', '500', '');
                endif;
              ?>
                <tr class="lista_tabela">
                  <td width="9%"><?= $avatar; ?></td>
                  <td width="30%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                  <td width="15%"><?= $empresa['nome']; ?></td>
                  <td width="15%"><?= $listagem_['email']; ?></td>
                  <td width="10%"><?= $listagem_['senha']; ?></td>
                  <td width="10%"><?= $listagem_['tel']; ?></td>
                  <td width="10%">
                    <?php
                    if ($listagem_['status'] == '1') :
                    ?>
                      <p style=" color: green">Ativo</p>
                    <?php
                    else :
                    ?>
                      <p style=" color: red">Inativo</p>
                    <?php
                    endif;
                    ?>
                  </td>
                  <!-- <td width="1%">
                   <div class="btn btn_red excluir_modal" data-excluir="ex_usuario" id="<? //= $listagem_['id']; 
                                                                                        ?>" style="" data-balloon-length="small" data-balloon="Alterar status" data-balloon-pos="up">
                      <i class="fa fa-times icone-funcao"></i>
                   </div>
               </td> 
                <td width="2%"> 
                   <div class="btn btn_blue" id="<? //= $listagem_['id']; 
                                                  ?>" style=" " data-balloon-length="small" data-balloon="Alterar status" data-balloon-pos="up">
                      <i class="fas fa-exchange-alt"></i>
                   </div>
                </td>-->
                  <td width="2%">
                    <div class="id_usuario_alt btn btn_green" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Alterar" data-balloon-pos="up">
                      <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                    </div>
                  </td>
                  <div class="limpar"></div>
                </tr>
            <?php
              endforeach;
            else :
              echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há contatos cadastrados!</center></div>';
            endif;
            ?>
            <div class="limpar"></div>
            </table>
            <br>
        </div>
        <div class="limpar"></div>
        <div class="lista_nova_modal ds-none"></div>
        <div class="lista_nova_usuario_modal ds-none">
          <script>
            $("#contato_empresa").mask("(99)99999999");
            $("#contato_empresa2").mask("(99)99999999");
          </script>
          <form class="form_linha" method="post" name="cad_cliente_usuario">
            <div class="box box80">
              <div class="box box50" style=" margin-top: -0.3%">
                <p class="texto_form">Nome</p>
                <input name="nome" type="text" required placeholder="Nome" style=" width: 100%;" />
              </div>
              <div class="box box50 no-margim">
                <p class="texto_form">Cargo</p>
                <input name="cargo" type="text" required placeholder="Cargo" style="width: 100%" />
              </div>
              <div class="limpar"></div>
              <div class="box box33">
                <p class="texto_form">E-mail</p>
                <input name="email" type="text" required placeholder="E-mail" style=" width: 100%;" />
              </div>
              <div class="box box33">
                <p class="texto_form">Telefone</p>
                <input name="tel" type="text" required placeholder="Telefone" id="contato_empresa" style=" width: 100%;" />
              </div>
              <div class="box box33 no-margim">
                <p class="texto_form">Telefone</p>
                <input name="tel2" type="text" placeholder="Telefone" id="contato_empresa2" style=" width: 100%;" />
              </div>
              <div class="limpar"></div>
              <p class="texto_form">Observações</p>
              <textarea name="obs" id="" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"></textarea>
            </div>

            <div class="box box20 no-margim">
              <p class="texto_form">Foto do contato</p>
              <img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="<?= HOME; ?>imagens_fixas/sem_imagem.jpg" default="<?= HOME; ?>imagens_fixas/sem_imagem.jpg">
              <div class="box_content">
                <div class="limpar"></div>
                <div class="mensagem_imagem ds-none">
                  <p><b></b></p>
                </div>
                <span class="legend">Foto (500x500px, JPG ou PNG):</span>
                <div class="limpar" style=" margin-bottom: 2%"></div>
                <label class="label_file" for='selecao-arquivo'>Selecionar um arquivo</label>
                <input id='selecao-arquivo' type="file" name="user_thumb" class="wc_loadimage" />
                <div class="limpar"></div>

                <div class="upload_bar m_top m_botton">
                  <div class="upload_progress ds-none">0%</div>
                </div>
                <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />

              </div>
            </div>

            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id" value="<?= $_SESSION['usuario']; ?>" />
            <input type="hidden" name="empresa" value="<?= $c['id']; ?>" />
            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 3%">
              <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar
            </button>
            <div class="btn btn_blue fl-left voltar_lista_modal" style="font-size: 0.8em; margin-right: 1%">
              <figure class="icon-arrow-back" style="margin-top: -6%;"></figure> Voltar a lista
            </div>
            <div class="limpar"></div>
          </form>
        </div>
        <div class="limpar"></div>
      </div>
    <?php
      break;
    case 'cad_cliente_usuario':

      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $cargo = $_POST['cargo'];
      $c['empresa'] = $_POST['empresa'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $obs = $_POST['obs'];
      $senha = Check::NewPass('5', false, true, true);

      if (in_array('', $c)) {
        echo '3';
      } else {

        //buscar igual
        $igual = new Read;
        $igual->ExeRead('cliente_contato', 'WHERE email = :email and status=1', "email=" . $c['email'] . "");
        if (!$igual->getRowCount() >= 1) :

          //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
          if (isset($_FILES['user_thumb'])) :

            $upload = new Upload('../imagens_site/');
            //-----------------imagem, nome, tamanho, pasta----------------//
            $upload->Image($_FILES['user_thumb'], 'perfil', '500', 'foto_cliente', '500');
            $foto = $upload->getResult();
          else :
            $foto = '';
          endif;

          $Dados = [
            'id_cliente' => $c['empresa'],
            'nome' => $c['nome'],
            'cargo' => $cargo,
            'tel' => $tel,
            'tel2' => $tel2,
            'email' => $c['email'],
            'senha' => $senha,
            'obs' => $obs,
            'data' => $dataStamp2,
            'hora' => $hora,
            'status' => '1',
            'token' => md5($c['nome'] . $c['email'] . $senha),
            'avatar' => $foto,
          ];

          $Cadastra = new Create;
          $Cadastra->ExeCreate('cliente_contato', $Dados);
          if ($Cadastra->getResult()) :

            // $igual->ExeRead('cliente', 'WHERE id = :id', "id=" . $c['empresa'] . "");
            // foreach ($igual->getResult() as $empresa);   
            // $igual->ExeRead('cliente', 'WHERE id = :id', "id=" . $c['empresa'] . "");
            // foreach ($igual->getResult() as $empresa);   
            $c['mensagem'] = $variavel_x = file_get_contents("" . SITE . "email_cad_sac&value=" . base64_encode($Cadastra->getResult()) . "");

            $email_senha = array(
              "Assunto" => "Bem-vindo a central de atendimento da Casa dos Sites", // Assunto do e-mail.
              "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
              "RemetenteNome" => "Casa dos sites", //Nome da pessoa que enviou.
              "RemetenteEmail" => EMAILSUPORTE, //E-mail da pessoa que enviou.
              "DestinoNone" => $c['nome'], //Nome da pessoa que vai receber.
              "DestinoEmail" => $c['email'] //Email da pessoa que esta recebendo.
            );


            $enviar_envio = sendMail($email_senha['Assunto'], $email_senha['Mensagem'], $email_senha['RemetenteEmail'], $email_senha['RemetenteNome'], $email_senha['DestinoEmail'], $email_senha['DestinoNone'], $reply = NULL, $replyNome = NULL, $anexo_pasta = NULL);

            if ($enviar_envio) :
              echo '1';
            else :
              echo '2';
            endif;
          else :
            echo '4';
          endif;
        else :
          echo '5';
        endif;
      }
      break;
    case 'id_usuario_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('cliente_contato', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        $("#mascara_celular22").mask("(99)99999-9999");
        $("#mascara_telefone22").mask("(99)99999-9999");
        $("#mascara_telefone23").mask("(99)99999-9999");
      </script>
      <form class="form_linha" method="post" name="editar_cliente_usuario" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar contato da empresa</h1>
        <div class="box box80">
          <div class="box box50" style="">
            <p class="texto_form">Nome</p>
            <input name="nome" type="text" required placeholder="Nome" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Cargo</p>
            <input name="cargo" type="text" required placeholder="Cargo" value="<?= $resultado['cargo']; ?>" style="width: 100%" />
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">E-mail</p>
            <input name="email" type="text" placeholder="E-mail" value="<?= $resultado['email']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33">
            <p class="texto_form">Telefone</p>
            <input name="tel" type="text" required placeholder="Telefone" value="<?= $resultado['tel']; ?>" id="mascara_celular22" style=" width: 100%;" />
          </div>
          <div class="box box33 no-margim">
            <p class="texto_form">Telefone</p>
            <input name="tel2" type="text" placeholder="Telefone" value="<?= $resultado['tel2']; ?>" id="mascara_telefone22" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Senha</p>
            <input name="senha" type="text" placeholder="Senha" required value="<?= $resultado['senha']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Status (obrigatório)</p>
            <select name="status" required class="" style="width: 100%;">
              <option <?= ($resultado['status'] == '1' ? "selected" : ""); ?> value="1">Ativo</option>
              <option <?= ($resultado['status'] == '2' ? "selected" : ""); ?> value="2">Inativo</option>
            </select>
          </div>

          <div class="limpar"></div>
          <textarea name="obs" rows="5" placeholder="Observações" style=" width: 100%; height: 100px"><?= $resultado['obs']; ?></textarea>
        </div>


        <div class="box box20 no-margim">

          <p class="texto_form"></p>
          <?php
          if ($resultado['avatar'] == '') :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
          else :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['avatar'] . '" default="' . HOME . 'imagens_site/' . $resultado['avatar'] . '">';
          endif;
          ?>
          <div class="box_content">
            <div class="limpar"></div>
            <div class="mensagem_imagem ds-none">
              <p><b></b></p>
            </div>
            <span class="legend">Foto (500x500px, JPG ou PNG):</span>
            <div class="limpar" style=" margin-bottom: 2%"></div>
            <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label>
            <input id='selecao-arquivo2' type="file" name="user_thumb" class="wc_loadimage" />
            <div class="limpar"></div>

            <div class="upload_bar m_top m_botton">
              <div class="upload_progress ds-none">0%</div>
            </div>
            <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
          </div>

        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="empresa" value="<?= $resultado['id_cliente']; ?>" />
        <input type="hidden" name="acao" value="editar_cliente_usuario" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 9%;">
          <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
        </button>
        <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'editar_cliente_usuario':

      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $cargo = $_POST['cargo'];
      $c['empresa'] = $_POST['empresa'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $obs = $_POST['obs'];
      $senha = $_POST['senha'];
      $id = $_POST['id'];
      $status = $_POST['status'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('cliente_contato', 'WHERE id = :id', "id=" . $id . "");
        foreach ($igual->getResult() as $resultado);


        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :

          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], 'perfil', '500', 'foto_cliente', '500');
          $foto = $upload->getResult();
        else :
          $foto = '';
        endif;

        $Dados = [
          'id_cliente' => $c['empresa'],
          'nome' => $c['nome'],
          'cargo' => $cargo,
          'tel' => $tel,
          'tel2' => $tel2,
          'email' => $c['email'],
          'senha' => $senha,
          'obs' => $obs,
          'status' => $status,
          'avatar' => $foto,
        ];
        $updade = new Update;
        $updade->ExeUpdate('cliente_contato', $Dados, "WHERE id = :id", "id=" . $id . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'cad_portolio':
      $c2['id'] = $_POST['id'];
    ?>
      <h1 class="topo_modal">Portfólio</h1>
      <div class="box box100" style="padding: 1%; width: 100%">
        <script>
          $('.abrir_novo').click(function() {
            $('.alterados_portifolio').slideUp(function() {
              $('.novo_portifolio').slideDown();
            });
          });
        </script>

        <?php
        $ultimo2 = new Read;
        $ultimo2->ExeRead('portfolio', "WHERE id_cliente = :id", 'id=' . $c2['id'] . '');
        if ($ultimo2->getResult()) :
        ?>
          <div class="final__dropdown fl-left">
            <button class="final__dropdown__hover">
              <figure class="icon-th-menu" style="margin-top: -29%"></figure>
            </button>
            <div class="final__dropdown__menu b-shadow">
              <?php
              foreach ($ultimo2->getResult() as $resultado2) :
                echo '<a class="ale_portolio_" style="cursor: pointer; width: 100%; margin-bottom: 1%; text-align: left; color: #fff;" id="' . $resultado2['id'] . '">' . $resultado2['tipo'] . '</a>';
              endforeach;
              ?>
            </div>
          </div>
          <div class="btn btn_green abrir_novo fl-left" style="padding: 1.12% 2%; margin-left: 2%;">Cadastrar portfólio</div>
        <?php
        else :
          echo '<div style="cursor: pointer; width: 100%; margin-bottom: 1%; text-align: left; color: #fff;"class="">Não há projeto cadastrado</div>';
        endif;
        ?>
      </div>
      <div class="box box100 no-margim alterados_portifolio" style=" width: 100%"></div>
      <div class="box box100 no-margim novo_portifolio" style=" width: 100%">
        <script>
          jQuery(function($) {
            $("#mascara_celular22").mask("(99)99999-9999");
            $("#mascara_telefone22").mask("(99)99999-9999");
            $("#mascara_telefone23").mask("(99)99999-9999");
            tinymce.init({
              selector: "textarea#elm4",
              theme: "modern",
              height: 300,
              menubar: false,
              relative_urls: false,
              remove_script_host: false,
              plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
              ],
              toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image media | responsivefilemanager | forecolor backcolor | print preview code ",
              toolbar2: "",
              image_advtab: true,
              style_formats: [{
                  title: 'Bold text',
                  inline: 'b'
                },
                {
                  title: 'Red text',
                  inline: 'span',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Red header',
                  block: 'h1',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Example 1',
                  inline: 'span',
                  classes: 'example1'
                },
                {
                  title: 'Example 2',
                  inline: 'span',
                  classes: 'example2'
                },
                {
                  title: 'Table styles'
                },
                {
                  title: 'Table row 1',
                  selector: 'tr',
                  classes: 'tablerow1'
                }
              ],
              external_filemanager_path: "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/",
              filemanager_title: "Responsive Filemanager",
              external_plugins: {
                "filemanager": "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/plugin.min.js"
              }
            });
          });
          $("select").select2();
        </script>
        <form class="form_linha" method="post" name="cad_portfolionovo" enctype="multipart/form-data">
          <div class="box box80">
            <div class="box box100" style=' width: 100%'>
              <p class="texto_form">Tipo do serviço</p>
              <select name="tipo" required class="" style="width: 100%;">
                <option value="Site com painel de controle">Site com painel de controle</option>
                <option value="Vitrine de produto ou serviço com painel de controle">Vitrine de produto ou serviço com painel de controle</option>
                <option value="E-commerce com painel de controle">E-commerce com painel de controle</option>
                <option value="Blog com painel de controle">Blog com painel de controle</option>
                <option value="Hotsite ou Landing Page">Hotsite ou Landing Page</option>
                <option value="Sistema online ou intranet">Sistema online ou intranet</option>
              </select>
            </div>
            <div class="limpar"></div>

            <div class="box box50">
              <p class="texto_form">Depoimento</p>
              <select name="depoimento" class="" style="width: 100%;">
                <option value="">Não há depoimento</option>
                <?php
                $ultimo2->ExeRead('depoimento');
                foreach ($ultimo2->getResult() as $resultado_depo2) :
                ?>
                  <option value="<?= $resultado_depo2['id']; ?>"><?= $resultado_depo2['nome']; ?> - <?= $resultado_depo2['empresa']; ?></option>
                <?php
                endforeach;
                ?>
              </select>
            </div>
            <div class="box box50 no-margim">
              <p class="texto_form">Endereço completo do projeto</p>
              <input name="url" type="text" required placeholder="Endereço completo do projeto" value="" style=" width: 100%;" />
            </div>
            <div class="limpar"></div>
            <div class="box box20">
              <p class="texto_form">Design Responsivo</p>
              <select name="responsivo" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="box box20">
              <p class="texto_form">HTML5</p>
              <select name="html5" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="box box20">
              <p class="texto_form">CSS</p>
              <select name="css" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="box box20">
              <p class="texto_form">Javascript</p>
              <select name="java" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="box box20 no-margim">
              <p class="texto_form">PHP</p>
              <select name="php" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
            <div class="limpar"></div>

            <div class="box box20">
              <p class="texto_form">Jquery/Ajax</p>
              <select name="jquery" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="box box20">
              <p class="texto_form">Api externas</p>
              <select name="api" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="box box20">
              <p class="texto_form">SEO</p>
              <select name="seo" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="box box20">
              <p class="texto_form">SMO</p>
              <select name="smo" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>



            <div class="box box20 no-margim">
              <p class="texto_form">Mysql</p>
              <select name="mysql" required class="" style="width: 100%;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div class="limpar"></div>

            <div class="box box20">
              <p class="texto_form">Status</p>
              <select name="status" required class="" style="width: 100%;">
                <option value="1">Aparecer no site</option>
                <option value="2">Não aparecer no site</option>
              </select>
            </div>
            <div class="box box20">
              <p class="texto_form">Site online</p>
              <select name="site_online" required class="" style="width: 100%;">
                <option value="1">Sim</option>
                <option value="2">Não</option>
              </select>
            </div>
            <div class="limpar"></div>
            <br>
            <textarea name="obs" id="elm4" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"></textarea>
          </div>


          <div class="box box20">

            <p class="texto_form">Capa</p>
            <img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="<?= HOME; ?>imagens_fixas/sem_imagem.jpg" default="<?= HOME; ?>imagens_fixas/sem_imagem.jpg">
            <div class="box_content">
              <div class="limpar"></div>
              <div class="mensagem_imagem ds-none">
                <p><b></b></p>
              </div>
              <span class="legend">Foto (800x418px, JPG ou PNG):</span>
              <div class="limpar" style=" margin-bottom: 2%"></div>
              <label class="label_file" for='selecao-arquivo4'>Selecionar um arquivo</label>
              <input id='selecao-arquivo4' type="file" name="user_thumb" class="wc_loadimage" />
              <div class="limpar"></div>

              <div class="upload_bar m_top m_botton">
                <div class="upload_progress ds-none">0%</div>
              </div>
              <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
            </div>
            <br>

            <span class="legend">Foto completa</span>
            <div class="limpar" style=" margin-bottom: 2%"></div>
            <label class="label_file" for='selecao-arquivo5'>Selecionar um arquivo</label>
            <input id='selecao-arquivo5' type="file" name="img_documento" class="wc_loadimage" />
            <div class="limpar"></div>


            <div class="limpar"></div>
            <br>

            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id" value="<?= $c2['id']; ?>" />
            <input type="hidden" name="acao" value="capa_larga" />

            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 80%">
              <figure class="icon-pencil-square-o" style=" font-size: 1.2em; margin-top: -2%; margin-right: 1%;"></figure> Cadastrar
            </button>
            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <div class="limpar"></div>
        </form>
        <div class="limpar"></div>
      </div>
      </div>
    <?php
      break;
    case 'cad_portfolionovo':
      $c['tipo'] = $_POST['tipo'];
      $depoimento = $_POST['depoimento'];
      $url = $_POST['url'];
      $responsivo = $_POST['responsivo'];
      $html5 = $_POST['html5'];
      $css = $_POST['css'];
      $java = $_POST['java'];
      $php = $_POST['php'];
      $jquery = $_POST['jquery'];
      $seo = $_POST['seo'];
      $smo = $_POST['smo'];
      $mysql = $_POST['mysql'];
      $status = $_POST['status'];
      $api = $_POST['api'];
      $obs = $_POST['obs'];
      $c['id'] = $_POST['id'];
      $site_online = $_POST['site_online'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :
          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], md5($c['id'] . $c['tipo'] . 'avatar'), '800', 'foto_portfolio', '418');
          $foto = $upload->getResult();
        else :
          $foto = '';
        endif;



        if (isset($_FILES['img_documento'])) :
          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['img_documento'], md5($c['id'] . $c['tipo'] . 'capa_larga'), '800', 'foto_portfolio');
          $foto2 = $upload->getResult();
        else :
          $foto2 = '';
        endif;

        $Dados = [
          'id_cliente' => $c['id'],
          'txt' => $obs,
          'tipo' => $c['tipo'],
          'html5' => $html5,
          'css' => $css,
          'java' => $java,
          'php' => $php,
          'mysql' => $mysql,
          'jquery' => $jquery,
          'api' => $api,
          'seo' => $seo,
          'smo' => $smo,
          'responsivo' => $responsivo,
          'url' => $url,
          'capa' => $foto,
          'capa_larga' => $foto2,
          'id_depoimento' => $depoimento,
          'status' => $status,
          'data' => $dataStamp2,
          'hora' => $hora,
          'id_usuario' => $_SESSION['usuario'],
          'token' => md5($c['tipo'] . $c['id']),
          'site_online' => $site_online,
        ];
        $Cadastra = new Create;
        $Cadastra->ExeCreate('portfolio', $Dados);
        if ($Cadastra->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'ale_portolio_':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('portfolio', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        jQuery(function($) {
          $("#mascara_celular22").mask("(99)99999-9999");
          $("#mascara_telefone22").mask("(99)99999-9999");
          $("#mascara_telefone23").mask("(99)99999-9999");
          tinymce.init({
            selector: "textarea#elm8",
            theme: "modern",
            height: 300,
            menubar: false,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
              "advlist autolink link image lists charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
              "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image media | responsivefilemanager | forecolor backcolor | print preview code ",
            toolbar2: "",
            image_advtab: true,
            style_formats: [{
                title: 'Bold text',
                inline: 'b'
              },
              {
                title: 'Red text',
                inline: 'span',
                styles: {
                  color: '#ff0000'
                }
              },
              {
                title: 'Red header',
                block: 'h1',
                styles: {
                  color: '#ff0000'
                }
              },
              {
                title: 'Example 1',
                inline: 'span',
                classes: 'example1'
              },
              {
                title: 'Example 2',
                inline: 'span',
                classes: 'example2'
              },
              {
                title: 'Table styles'
              },
              {
                title: 'Table row 1',
                selector: 'tr',
                classes: 'tablerow1'
              }
            ],
            external_filemanager_path: "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {
              "filemanager": "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/plugin.min.js"
            }
          });
        });
        $("select").select2();
      </script>
      <form class="form_linha" method="post" name="cad_portfolioo" enctype="multipart/form-data">
        <div class="box box80">
          <div class="box box100" style=' width: 100%'>
            <p class="texto_form">Tipo do serviço</p>
            <select name="tipo" required class="" style="width: 100%;">
              <option <?= ($resultado['tipo'] == 'Site com painel de controle' ? "selected" : ""); ?> value="Site com painel de controle">Site com painel de controle</option>
              <option <?= ($resultado['tipo'] == 'Vitrine de produto ou serviço com painel de controle' ? "selected" : ""); ?> value="Vitrine de produto ou serviço com painel de controle">Vitrine de produto ou serviço com painel de controle</option>
              <option <?= ($resultado['tipo'] == 'E-commerce com painel de controle' ? "selected" : ""); ?> value="E-commerce com painel de controle">E-commerce com painel de controle</option>
              <option <?= ($resultado['tipo'] == 'Blog com painel de controle' ? "selected" : ""); ?> value="Blog com painel de controle">Blog com painel de controle</option>
              <option <?= ($resultado['tipo'] == 'Hotsite ou Landing Page' ? "selected" : ""); ?> value="Hotsite ou Landing Page">Hotsite ou Landing Page</option>
              <option <?= ($resultado['tipo'] == 'Sistema online ou intranet' ? "selected" : ""); ?> value="Sistema online ou intranet">Sistema online ou intranet</option>
            </select>
          </div>
          <div class="limpar"></div>

          <div class="box box50">
            <p class="texto_form">Depoimento</p>
            <select name="depoimento" class="" style="width: 100%;">
              <option <?= ($resultado['id_depoimento'] == '' ? "selected" : ""); ?> value="">Não há depoimento</option>
              <?php
              $ultimo->ExeRead('depoimento');
              foreach ($ultimo->getResult() as $resultado_depo) :
              ?>
                <option <?= ($resultado['id_depoimento'] == $resultado_depo['id'] ? "selected" : ""); ?> value="<?= $resultado_depo['id']; ?>"><?= $resultado_depo['nome']; ?> - <?= $resultado_depo['empresa']; ?></option>
              <?php
              endforeach;
              ?>
            </select>
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Endereço completo do projeto</p>
            <input name="url" type="text" required placeholder="Endereço completo do projeto" value="<?= $resultado['url']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box20">
            <p class="texto_form">Design Responsivo</p>
            <select name="responsivo" required class="" style="width: 100%;">
              <option <?= ($resultado['responsivo'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['responsivo'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['responsivo'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['responsivo'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['responsivo'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['responsivo'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['responsivo'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['responsivo'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['responsivo'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['responsivo'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>
          <div class="box box20">
            <p class="texto_form">HTML5</p>
            <select name="html5" required class="" style="width: 100%;">
              <option <?= ($resultado['html5'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['html5'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['html5'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['html5'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['html5'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['html5'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['html5'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['html5'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['html5'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['html5'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>
          <div class="box box20">
            <p class="texto_form">CSS</p>
            <select name="css" required class="" style="width: 100%;">
              <option <?= ($resultado['css'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['css'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['css'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['css'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['css'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['css'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['css'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['css'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['css'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['css'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="box box20">
            <p class="texto_form">Javascript</p>
            <select name="java" required class="" style="width: 100%;">
              <option <?= ($resultado['java'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['java'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['java'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['java'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['java'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['java'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['java'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['java'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['java'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['java'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="box box20 no-margim">
            <p class="texto_form">PHP</p>
            <select name="php" required class="" style="width: 100%;">
              <option <?= ($resultado['php'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['php'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['php'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['php'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['php'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['php'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['php'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['php'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['php'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['php'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>
          <div class="limpar"></div>

          <div class="box box20">
            <p class="texto_form">Jquery/Ajax</p>
            <select name="jquery" required class="" style="width: 100%;">
              <option <?= ($resultado['jquery'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['jquery'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['jquery'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['jquery'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['jquery'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['jquery'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['jquery'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['jquery'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['jquery'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['jquery'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="box box20">
            <p class="texto_form">Api externas</p>
            <select name="api" required class="" style="width: 100%;">
              <option <?= ($resultado['api'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['api'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['api'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['api'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['api'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['api'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['api'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['api'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['api'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['api'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="box box20">
            <p class="texto_form">SEO</p>
            <select name="seo" required class="" style="width: 100%;">
              <option <?= ($resultado['seo'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['seo'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['seo'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['seo'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['seo'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['seo'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['seo'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['seo'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['seo'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['seo'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="box box20">
            <p class="texto_form">SMO</p>
            <select name="smo" required class="" style="width: 100%;">
              <option <?= ($resultado['smo'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['smo'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['smo'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['smo'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['smo'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['smo'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['smo'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['smo'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['smo'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['smo'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>



          <div class="box box20 no-margim">
            <p class="texto_form">Mysql</p>
            <select name="mysql" required class="" style="width: 100%;">
              <option <?= ($resultado['mysql'] == '1' ? "selected" : ""); ?> value="1">1</option>
              <option <?= ($resultado['mysql'] == '2' ? "selected" : ""); ?> value="2">2</option>
              <option <?= ($resultado['mysql'] == '3' ? "selected" : ""); ?> value="3">3</option>
              <option <?= ($resultado['mysql'] == '4' ? "selected" : ""); ?> value="4">4</option>
              <option <?= ($resultado['mysql'] == '5' ? "selected" : ""); ?> value="5">5</option>
              <option <?= ($resultado['mysql'] == '6' ? "selected" : ""); ?> value="6">6</option>
              <option <?= ($resultado['mysql'] == '7' ? "selected" : ""); ?> value="7">7</option>
              <option <?= ($resultado['mysql'] == '8' ? "selected" : ""); ?> value="8">8</option>
              <option <?= ($resultado['mysql'] == '9' ? "selected" : ""); ?> value="9">9</option>
              <option <?= ($resultado['mysql'] == '10' ? "selected" : ""); ?> value="10">10</option>
            </select>
          </div>

          <div class="limpar"></div>

          <div class="box box20">
            <p class="texto_form">Status</p>
            <select name="status" required class="" style="width: 100%;">
              <option <?= ($resultado['status'] == '1' ? "selected" : ""); ?> value="1">Aparecer no site</option>
              <option <?= ($resultado['status'] == '2' ? "selected" : ""); ?> value="2">Não aparecer no site</option>
            </select>
          </div>
          <div class="box box20">
            <p class="texto_form">Site online</p>
            <select name="site_online" required class="" style="width: 100%;">
              <option <?= ($resultado['site_online'] == '1' ? "selected" : ""); ?> value="1">Sim</option>
              <option <?= ($resultado['site_online'] == '2' ? "selected" : ""); ?> value="2">Não</option>
            </select>
          </div>
          <div class="limpar"></div>
          <br>
          <textarea name="obs" id="elm8" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"><?= $resultado['txt']; ?></textarea>
        </div>


        <div class="box box20 no-margim">

          <p class="texto_form"></p>
          <?php
          if ($resultado['capa'] == '') :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
          else :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['capa'] . '" default="' . HOME . 'imagens_site/' . $resultado['capa'] . '">';
          endif;
          ?>
          <div class="box_content">
            <div class="limpar"></div>
            <div class="mensagem_imagem ds-none">
              <p><b></b></p>
            </div>
            <span class="legend">Foto (800x418px, JPG ou PNG):</span>
            <div class="limpar" style=" margin-bottom: 2%"></div>
            <label class="label_file" for='selecao-arquivo4'>Selecionar um arquivo</label>
            <input id='selecao-arquivo4' type="file" name="user_thumb" class="wc_loadimage" />
            <div class="limpar"></div>

            <div class="upload_bar m_top m_botton">
              <div class="upload_progress ds-none">0%</div>
            </div>
            <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
          </div>
          <br>

          <span class="legend">Foto completa</span>
          <div class="limpar" style=" margin-bottom: 2%"></div>
          <label class="label_file" for='selecao-arquivo5'>Selecionar um arquivo</label>
          <input id='selecao-arquivo5' type="file" name="img_documento" class="wc_loadimage" />
          <div class="limpar"></div>

          <a href="<?= HOME; ?>imagens_site/<?= $resultado['capa_larga']; ?>" target="_blank" style=" width: 100%"><i class="fas fa-laptop"></i> Imagem completa</a>
          <div class="limpar"></div>
          <br>
          <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 60%;">
            <figure class="icon-pencil-square-o" style=" font-size: 1.2em; margin-top: -2%; margin-right: 1%;"></figure> Alterar
          </button>
          <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="capa_larga" />


        <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'cad_portfolioo':

      $c['tipo'] = $_POST['tipo'];
      $depoimento = $_POST['depoimento'];
      $url = $_POST['url'];
      $responsivo = $_POST['responsivo'];
      $html5 = $_POST['html5'];
      $css = $_POST['css'];
      $java = $_POST['java'];
      $php = $_POST['php'];
      $jquery = $_POST['jquery'];
      $seo = $_POST['seo'];
      $smo = $_POST['smo'];
      $mysql = $_POST['mysql'];
      $status = $_POST['status'];
      $api = $_POST['api'];
      $obs = $_POST['obs'];
      $c['id'] = $_POST['id'];
      $site_online = $_POST['site_online'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('portfolio', 'WHERE id = :id ', "id=" . $c['id'] . "");
        foreach ($igual->getResult() as $resultado);

        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :
          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], md5($c['id'] . $c['tipo'] . 'avatar'), '800', 'foto_portfolio', '418');
          $foto = $upload->getResult();
        else :
          $foto = $resultado['capa'];
        endif;



        if (isset($_FILES['img_documento'])) :
          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['img_documento'], md5($c['id'] . $c['tipo'] . 'capa_larga'), '800', 'foto_portfolio');
          $foto2 = $upload->getResult();
        else :
          $foto2 = $resultado['capa_larga'];
        endif;

        $Dados = [
          'txt' => $obs,
          'tipo' => $c['tipo'],
          'html5' => $html5,
          'css' => $css,
          'java' => $java,
          'php' => $php,
          'mysql' => $mysql,
          'jquery' => $jquery,
          'api' => $api,
          'seo' => $seo,
          'smo' => $smo,
          'responsivo' => $responsivo,
          'url' => $url,
          'capa' => $foto,
          'capa_larga' => $foto2,
          'id_depoimento' => $depoimento,
          'status' => $status,
          'data' => $dataStamp2,
          'hora' => $hora,
          'token' => md5($c['tipo'] . $c['id']),
          'site_online' => $site_online,
        ];

        $updade = new Update;
        $updade->ExeUpdate('portfolio', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'ex_empresa':
      $c['id'] = $_POST['del'];
      if (in_array('', $c)) :
        echo '3';
      else :
        $Dados = [
          'status' => '3',
        ];
        $updade = new Update;
        $updade->ExeUpdate('cliente', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'cad_cliente':

      $c['nome'] = $_POST['nome'];
      $nome_empresa = $_POST['nome'];
      $c['cnpj_cpf'] = $_POST['cnpj_cpf'];
      $ie = $_POST['ie'];
      $im = $_POST['im'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $tel3 = $_POST['tel3'];
      $obs = $_POST['obs'];
      $cep = $_POST['cep'];
      $logado = $_POST['rua'];
      $numero = $_POST['numero'];
      $bairro = $_POST['bairro'];
      $municipio = $_POST['cidade'];
      $estado = $_POST['estado'];
      $complemento = $_POST['complemento'];
      $categoria = $_POST['categoria'];
      $origem = $_POST['origem'];
      $token_empre = md5($c['nome'] . $c['cnpj_cpf'] . '1');

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('cliente', 'WHERE cnpj_cpf = :id2', "id2=" . $c['cnpj_cpf'] . "");
        if (!$igual->getRowCount() >= 1) :


          //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
          if (isset($_FILES['user_thumb'])) :

            $upload = new Upload('../imagens_site/');
            //-----------------imagem, nome, tamanho, pasta----------------//
            $upload->Image($_FILES['user_thumb'], md5($c['nome'] . $c['cnpj_cpf'] . $data), '500', 'clientes', '500');
            $foto = $upload->getResult();
          else :
            $foto = '';
          endif;

          $dados = array(
            "nome" => $c['nome'],
            "cnpj_cpf" => $c['cnpj_cpf'],
            "ie" => $ie,
            "im" => $im,
            "logo" => $foto,
            "tel" => $tel,
            "tel2" => $tel2,
            "tel3" => $tel3,
            "obs" => $obs,
            "logado" => $logado,
            "numero" => $numero,
            "complemento" => $complemento,
            "cep" => $cep,
            "bairro" => $bairro,
            "municipio" => $municipio,
            "estado" => $estado,
            "token" => $token_empre,
            "email" => '',
            "data" => $dataStamp2,
            "hora" => $hora,
            "status" => '1',
            "propaganda" => '2',
            "nome_empresa" => $nome_empresa,
            "sexo" => '',
            "data_nasc" => '',
            "senha" => '',
            "tipo" => '1',
            "origem" => $origem,
            "categoria" => $categoria,
            "id_usuario" => $_SESSION['usuario'],
          );
          $Cadastra = new Create;
          $Cadastra->ExeCreate('cliente', $dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'id_cliente_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('cliente', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        jQuery(function($) {
          $("#mascara_celular22").mask("(99)99999-9999");
          $("#mascara_telefone22").mask("(99)99999-9999");
          $("#mascara_telefone23").mask("(99)99999-9999");
          //$(".js-example-basic-single").select2({ dropdownParent: "#modal-container" });
          $("select").select2();
        });
      </script>
      <form class="form_linha" method="post" name="editar_cliente" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar empresa</h1>
        <div class="limpar"></div>
        <div class="box box80">
          <div class="box box50">
            <p class="texto_form">Nome fantasia</p>
            <input name="nome" type="text" required placeholder="Nome fantasia" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Nome da empresa</p>
            <input name="nome_empresa" type="text" placeholder="Nome da empresa" value="<?= $resultado['nome_empresa']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">CNPJ ou CPF</p>
            <input name="cnpj_cpf" type="text" required value="<?= $resultado['cnpj_cpf']; ?>" placeholder="Seu CPF ou CNPJ (obrigatório)" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' style="width: 100%" />
          </div>
          <div class="box box33">
            <p class="texto_form">Inscrição estadual</p>
            <input name="ie" type="text" placeholder="Inscrição estadual" value="<?= $resultado['ie']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33 no-margim">
            <p class="texto_form">Inscrição municipal</p>
            <input name="im" type="text" placeholder="Inscrição municipal" value="<?= $resultado['im']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">Telefone</p>
            <input name="tel" type="text" required placeholder="Telefone" value="<?= $resultado['tel']; ?>" id="mascara_telefone2" style=" width: 100%;" />
          </div>
          <div class="box box33">
            <p class="texto_form">Telefone</p>
            <input name="tel2" type="text" placeholder="Telefone" value="<?= $resultado['tel2']; ?>" id="mascara_celular2" style=" width: 100%;" />
          </div>
          <div class="box box33 no-margim">
            <p class="texto_form">Telefone</p>
            <input name="tel3" type="text" placeholder="Telefone" value="<?= $resultado['tel3']; ?>" id="mascara_celular3" style=" width: 100%;" />
          </div>

          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Categoria</p>
            <select name="categoria" required style="width: 100%;">
              <option <?= ($resultado['categoria'] == '1' ? "selected" : ""); ?> value="1">Cliente efetivo</option>
              <option <?= ($resultado['categoria'] == '2' ? "selected" : ""); ?> value="2">Cliente em potencial</option>
              <option <?= ($resultado['categoria'] == '3' ? "selected" : ""); ?> value="3">Concorrente</option>
              <option <?= ($resultado['categoria'] == '4' ? "selected" : ""); ?> value="4">Fornecedor</option>
              <option <?= ($resultado['categoria'] == '5' ? "selected" : ""); ?> value="5">Parceiro</option>
            </select>
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Origem</p>
            <select name="origem" required style="width: 100%;">
              <option <?= ($resultado['origem'] == '1' ? "selected" : ""); ?> value="1">Site</option>
              <option <?= ($resultado['origem'] == '2' ? "selected" : ""); ?> value="2">Telefone/Celular</option>
              <option <?= ($resultado['origem'] == '3' ? "selected" : ""); ?> value="3">Formulário de contato</option>
              <option <?= ($resultado['origem'] == '4' ? "selected" : ""); ?> value="4">Whatsapp</option>
              <option <?= ($resultado['origem'] == '5' ? "selected" : ""); ?> value="5">E-mail</option>
              <option <?= ($resultado['origem'] == '6' ? "selected" : ""); ?> value="6">Facebook</option>
              <option <?= ($resultado['origem'] == '7' ? "selected" : ""); ?> value="7">Instagram</option>
              <option <?= ($resultado['origem'] == '8' ? "selected" : ""); ?> value="8">Twitter</option>
            </select>
          </div>
          <div class="limpar"></div>
          <p class="legenda_form">Endereço completo</p>
          <div class="box box-completa">
            <input name="cep" class="cep_cad_parsa" type="text" placeholder="Seu CEP *" value="<?= $resultado['cep']; ?>" id="csp mascara_cep" style=" width: 99%;" />
            <div class="load2" style=" display: none"></div>
          </div>
          <div class="box box70">
            <input name="rua" type="text" placeholder="Rua, Avenida" value="<?= $resultado['logado']; ?>" id="logradourop" style=" width: 100%;" />
          </div>
          <div class="box box30 no-margim">
            <input name="numero" type="text" placeholder="Nº" value="<?= $resultado['numero']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>

          <div class="box box-completa">
            <input name="complemento" type="text" placeholder="Complemento" value="<?= $resultado['complemento']; ?>" style=" width: 99%;" />
          </div>
          <div class="limpar"></div>

          <div class="box box35">
            <input name="bairro" type="text" placeholder="Bairro" value="<?= $resultado['bairro']; ?>" id="bairrop" style=" width: 100%;" />
          </div>
          <div class="box box35">
            <input name="cidade" type="text" placeholder="Cidade" value="<?= $resultado['municipio']; ?>" id="localidadep" style=" width: 100%;" />
          </div>

          <div class="box box30 no-margim">
            <input name="estado" type="text" placeholder="Estado" value="<?= $resultado['estado']; ?>" id="ufp" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Status (obrigatório)</p>
            <select name="status" required class="js-example-basic-single" style="width: 100%;">
              <option <?= ($resultado['status'] == '1' ? "selected" : ""); ?> value="1">Ativo</option>
              <option <?= ($resultado['status'] == '2' ? "selected" : ""); ?> value="2">Inativo</option>
            </select>
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Propaganda</p>
            <select name="propaganda" required class="js-example-basic-single" style="width: 100%;">
              <option <?= ($resultado['propaganda'] == '1' ? "selected" : ""); ?> value="1">Aparecer no site</option>
              <option <?= ($resultado['propaganda'] == '2' ? "selected" : ""); ?> value="2">Não aparecer no site</option>
            </select>
          </div>
          <div class="limpar"></div>
          <textarea name="obs" id="elm4" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"><?= $resultado['obs']; ?></textarea>
        </div>


        <div class="box box20 no-margim">

          <?php
          if ($resultado['logo'] == '') :
            echo '<img class="user_thumb" style="width: 100%; border: 1px solid #000;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
          else :
            echo '<img class="user_thumb" style="width: 100%; border: 1px solid #000;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['logo'] . '" default="' . HOME . 'imagens_site/' . $resultado['logo'] . '">';
          endif;
          ?>
          <div class="box_content">
            <div class="limpar"></div>
            <div class="mensagem_imagem ds-none">
              <p><b></b></p>
            </div>
            <p class="texto_form">Foto (500x500px, JPG ou PNG):</p>
            <div class="limpar" style=" margin-bottom: 2%"></div>
            <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label>
            <input id='selecao-arquivo2' type="file" name="user_thumb" class="wc_loadimage" />
            <div class="limpar"></div>
            <div class="upload_bar m_top m_botton">
              <div class="upload_progress ds-none">0%</div>
            </div>
            <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
            <div class="limpar"></div>
            <br> <br>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
              <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
            </button>
          </div>
          <br>
          <div class="limpar"></div>
          <br>

        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="editar_cliente" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <div class="limpar"></div>
      </form>
      <?php
      break;
    case 'editar_cliente':

      $c['nome'] = $_POST['nome'];
      $nome_empresa = $_POST['nome_empresa'];
      $id = $_POST['id'];
      $c['cnpj_cpf'] = $_POST['cnpj_cpf'];
      $ie = $_POST['ie'];
      $im = $_POST['im'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $tel3 = $_POST['tel3'];
      $obs = $_POST['obs'];
      $cep = $_POST['cep'];
      $logado = $_POST['rua'];
      $numero = $_POST['numero'];
      $bairro = $_POST['bairro'];
      $municipio = $_POST['cidade'];
      $estado = $_POST['estado'];
      $status = $_POST['status'];
      $propaganda = $_POST['propaganda'];
      $complemento = $_POST['complemento'];
      $categoria = $_POST['categoria'];
      $origem = $_POST['origem'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('cliente', 'WHERE id = :id', "id=" . $id . "");
        foreach ($igual->getResult() as $resultado);


        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :

          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], md5($c['cnpj_cpf'] . $hora), '500', 'clientes', '500');
          $foto = $upload->getResult();
        else :
          $foto = $resultado['logo'];
        endif;

        $dados = array(
          "nome" => $c['nome'],
          "cnpj_cpf" => $c['cnpj_cpf'],
          "ie" => $ie,
          "im" => $im,
          "logo" => $foto,
          "tel" => $tel,
          "tel2" => $tel2,
          "tel3" => $tel3,
          "obs" => $obs,
          "logado" => $logado,
          "numero" => $numero,
          "complemento" => $complemento,
          "cep" => $cep,
          "bairro" => $bairro,
          "municipio" => $municipio,
          "estado" => $estado,
          "status" => $status,
          "propaganda" => $propaganda,
          "origem" => $origem,
          "categoria" => $categoria,
        );
        $updade = new Update;
        $updade->ExeUpdate('cliente', $dados, "WHERE id = :id", "id=" . $id . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
      //===============================================================================================================================
      // BLOG
      //===============================================================================================================================       
    case 'blog':

      $c['titulo'] = $_POST['titulo'];
      $c['lingua'] = $_POST['lingua'];
      $c['chamada'] = $_POST['chamada'];
      $c['categoria'] = $_POST['categoria'];
      $txt = $_POST['txt'];
      $video = $_POST['video'];
      $c['status'] = $_POST['status'];
      $c['id'] = $_POST['id'];

      if (in_array('', $c)) {
        echo '3';
      } else {

        $url = Check::Name($c['titulo']);

        //buscar igual
        $igual = new Read;
        $igual->ExeRead('noticia', 'WHERE url = :url', "url=" . $url . "");
        if (!$igual->getRowCount() >= 1) :

          //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
          if (isset($_FILES['user_thumb'])) :

            $upload = new Upload('../imagens_site/');
            //-----------------imagem, nome, tamanho, pasta----------------//
            $upload->Image($_FILES['user_thumb'], $url, '800', 'noticia', '418');
            $foto = $upload->getResult();
          else :
            $foto = '';
          endif;

          $Dados = [
            'titulo' => $c['titulo'],
            'chamada' => $c['chamada'],
            'texto' => $txt,
            'video' => $video,
            'capa' => $foto,
            'visita' => '0',
            'data' => $dataStamp2,
            'hora' => $hora,
            'status' => $c['status'],
            'url' => $url,
            'usuario' => $c['id'],
            'data_inicio' => '',
            'data_fim' => '',
            'categoria' => $c['categoria'],
            'lingua' => $c['lingua'],
          ];
          $Cadastra = new Create;
          $Cadastra->ExeCreate('noticia', $Dados);
          if ($Cadastra->getResult()) :
            Sitemap::geraSitemap();
            Sitemap::geraRss();

            echo '1';
          else :
            echo '4';
          endif;
        else :
          echo '5';
        endif;
      }
      break;
    case 'id_noticia':
      $c['id'] = $_POST['id'];

      if (in_array('', $c)) {
        echo '3';
      } else {
        //VERIFICAR SE EXISTE E ALIMENTAR O FORMULÁRIO
        $read = new Read;
        $read->ExeRead('noticia', 'WHERE id = :id', "id=" . $c['id'] . "");
        if ($read->getRowCount() >= 1) :
          foreach ($read->getResult() as $resultado);
      ?>
          <script type="text/javascript">
            tinymce.init({
              selector: "textarea#elm2",
              theme: "modern",
              height: 300,
              menubar: true,
              relative_urls: false,
              //remove_script_host: false,
              //inline: true,
              plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager source code"
              ],
              toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image media | responsivefilemanager | forecolor backcolor | print preview code | source code",
              toolbar2: "",
              image_advtab: true,
              style_formats: [{
                  title: 'Bold text',
                  inline: 'b'
                },
                {
                  title: 'Red text',
                  inline: 'span',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Red header',
                  block: 'h1',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Example 1',
                  inline: 'span',
                  classes: 'example1'
                },
                {
                  title: 'Example 2',
                  inline: 'span',
                  classes: 'example2'
                },
                {
                  title: 'Table styles'
                },
                {
                  title: 'Table row 1',
                  selector: 'tr',
                  classes: 'tablerow1'
                }
              ],
              external_filemanager_path: "" + urlbase + "poo/app/Library/tinymce/js/filemanager/",
              filemanager_title: "Responsive Filemanager",
              external_plugins: {
                "filemanager": "" + urlbase + "poo/app/Library/tinymce/js/filemanager/plugin.min.js"
              }
            });
          </script>
          <form class="form_linha" method="post" name="editar_noticia">
            <h1 class="topo_modal">Alterar post</h1>
            <div class="box box80">
              <div class="box box33">
                <p class="texto_form">Titulo</p>
                <input name="nome" type="text" value="<?= $resultado['titulo']; ?>" required placeholder="Titulo" style=" width: 100%;" />
              </div>
              <div class="box  box33">
                <p class="texto_form">Língua</p>
                <select name="lingua" required class="js-example-basic-single" style="width: 100%;">
                  <option <?= ($resultado['lingua'] == 'pt' ? "selected" : ""); ?> value="pt">Português</option>
                  <!-- <option <? //= ( $resultado['lingua'] == 'usa' ? "selected" : "" ); 
                                ?> value="usa">Inglês</option>
                <option <? //= ( $resultado['lingua'] == 'es' ? "selected" : "" ); 
                        ?> value="es">Espanhol</option> -->
                </select>
              </div>
              <div class="box box33 no-margim">
                <p class="texto_form">Categoria</p>
                <select name="categoria" required class="js-example-basic-single" style="width: 100%;">
                  <?php
                  $corretor = new Read;
                  $corretor->ExeRead('noticia_categoria', 'WHERE status = "1"');
                  if ($corretor->getRowCount() >= 1) :
                    foreach ($corretor->getResult() as $examinado) :
                  ?>
                      <option <?= ($resultado['categoria'] == $examinado['id'] ? "selected" : ""); ?> value="<?= $examinado['id']; ?>"><?= $examinado['nome']; ?></option>
                  <?php
                    endforeach;
                  else :
                    echo ' <option value="">Não há categoria cadastrada!</option> ';
                  endif;
                  ?>
                </select>
              </div>
              <div class="limpar"></div>
              <div class="box box-completa">
                <p class="texto_form">Chamada da notícia</p>
                <textarea name="chamada" rows="5" style=" width: 100%" required placeholder="Chamada da notícia"><?= $resultado['chamada']; ?></textarea>
              </div>
              <div class="limpar"></div>
              <div class="box box50">
                <p class="texto_form">Vídeo do youtube (Apenas o código)</p>
                <input name="video" type="text" placeholder="Vídeo do youtube (Apenas o código)" value="<?= $resultado['video']; ?>" style=" width: 100%;" />
              </div>
              <div class="box box50 no-margim">
                <p class="texto_form">Status</p>
                <select name="status" required class="" style="width: 100%;">
                  <option <?= ($resultado['status'] == '1' ? "selected" : ""); ?> value="1">Ativo</option>
                  <option <?= ($resultado['status'] == '2' ? "selected" : ""); ?> value="2">Inativo</option>
                </select>
              </div>
              <div class="limpar"></div>
              <div class="box box-completa">
                <p class="texto_form">Notícia completa</p>
                <textarea id="elm2" name="txt" rows="10" style=" width: 100%"><?= $resultado['texto']; ?></textarea>
              </div>
              <div class="limpar"></div>
            </div>


            <div class="box box20">
              <p class="texto_form"></p>
              <?php
              if ($resultado['capa'] == '') :
                echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
              else :
                echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['capa'] . '" default="' . HOME . 'imagens_site/' . $resultado['capa'] . '">';
              endif;
              ?>
              <div class="box_content">
                <div class="limpar"></div>
                <div class="mensagem_imagem ds-none">
                  <p><b></b></p>
                </div>
                <div class="limpar" style=" margin-bottom: 2%"></div>
                <label class="label_file" for='selecao-arquivo5'>Selecionar um arquivo</label>
                <input id='selecao-arquivo5' type="file" name="user_thumb" class="wc_loadimage" />
                <div class="limpar"></div>
                <div class="upload_bar m_top m_botton">
                  <div class="upload_progress ds-none">0%</div>
                </div>
                <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
                <div class="limpar"></div>
                <br>
                <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
                  <figure class="icon-pencil-square-o" style=" font-size: 1.2em; margin-top: -2%;"></figure> Alterar
                </button>
              </div>
            </div>

            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id_noticia" value="<?= $resultado['id']; ?>" />
            <input type="hidden" name="acao" value="editar_noticia" />

            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <div class="limpar"></div>
          </form>
      <?php
        else :
          echo '1';
        endif;
      }
      break;
    case 'editar_noticia':

      $c['nome'] = $_POST['nome'];
      $c['lingua'] = $_POST['lingua'];
      $c['chamada'] = $_POST['chamada'];
      $c['categoria'] = $_POST['categoria'];
      $txt = $_POST['txt'];
      $video = $_POST['video'];
      $c['status'] = $_POST['status'];
      $c['id_noticia'] = $_POST['id_noticia'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('noticia', 'WHERE id = :id ', "id=" . $c['id_noticia'] . "");
        foreach ($igual->getResult() as $resultado);

        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :

          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], 'noticia_' . $resultado['url'] . '', '800', 'noticia', '418');
          $foto = $upload->getResult();
        else :
          $foto = $resultado['capa'];
        endif;

        $Dados = [
          'titulo' => $c['nome'],
          'chamada' => $c['chamada'],
          'texto' => $txt,
          'video' => $video,
          'capa' => $foto,
          'status' => $c['status'],
          'categoria' => $c['categoria'],
          'lingua' => $c['lingua'],
        ];

        $updade = new Update;
        $updade->ExeUpdate('noticia', $Dados, "WHERE id = :id", "id=" . $c['id_noticia'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'status_blog':
      $c['id'] = $_POST['id'];
      if (in_array('', $c)) :
        echo '3';
      else :
        $ultimo = new Read;
        $ultimo->ExeRead('noticia', "WHERE id = :id", 'id=' . $c['id'] . '');
        foreach ($ultimo->getResult() as $resultado);
        if ($resultado['status'] == '1') :
          $statis = '2';
        else :
          $statis = '1';
        endif;
        $Dados = [
          'status' => $statis,
        ];
        $updade = new Update;
        $updade->ExeUpdate('noticia', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
      //===============================================================================================================================
      // CATEGORIA BLOG
      //===============================================================================================================================         
    case 'categoria_blog':
      $c['nome'] = $_POST['nome'];
      $c['lingua'] = $_POST['lingua'];
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('noticia_categoria', 'WHERE nome = :id and status <> 3 ', "id=" . $c['nome'] . "");
        if (!$igual->getRowCount() >= 1) :


          $Dados = [
            'nome' => $c['nome'],
            'status' => '1',
            'lingua' => $c['lingua'],
          ];
          $Cadastra = new Create;
          $Cadastra->ExeCreate('noticia_categoria', $Dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'alt_categoria_blog':
      $c['id'] = $_POST['id'];
      $c['nome'] = $_POST['nome'];
      $c['lingua'] = $_POST['lingua'];

      $Dados = [
        'nome' => $c['nome'],
        'lingua' => $c['lingua'],
      ];
      $updade = new Update;
      $updade->ExeUpdate('noticia_categoria', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
      break;
    case 'status_categoria':
      $c['id'] = $_POST['id'];
      if (in_array('', $c)) :
        echo '3';
      else :
        $ultimo = new Read;
        $ultimo->ExeRead('noticia_categoria', "WHERE id = :id", 'id=' . $c['id'] . '');
        foreach ($ultimo->getResult() as $resultado);
        if ($resultado['status'] == '1') :
          $statis = '2';
        else :
          $statis = '1';
        endif;
        $Dados = [
          'status' => $statis,
        ];
        $updade = new Update;
        $updade->ExeUpdate('noticia_categoria', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'status_delete':
      $c['id'] = $_POST['id'];
      if (in_array('', $c)) :
        echo '3';
      else :
        $Dados = [
          'status' => '3',
        ];
        $updade = new Update;
        $updade->ExeUpdate('noticia_categoria', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'id_form_cat':
      $c['id'] = $_POST['id'];
      $ultimo = new Read;
      $ultimo->ExeRead('noticia_categoria', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
      ?>
      <form class="form_linha" method="post" name="alt_categoria_blog">
        <p class="texto_form">Nome da categoria</p>
        <input name="nome" type="text" required placeholder="Nome da categoria" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
        <p class="texto_form">Língua</p>
        <select name="lingua" required class="" style="width: 100%;">
          <option <?= ($resultado['lingua'] == 'pt' ? "selected" : ""); ?> value="pt">Português</option>
          <!--<option <? //= ( $resultado['lingua'] == 'usa' ? "selected" : "" ); 
                      ?> value="usa">Inglês</option>-->
          <!--!<option <? //= ( $resultado['lingua'] == 'es' ? "selected" : "" ); 
                        ?> value="es">Espanhol</option>-->
        </select>
        <div class="limpar" style=" margin-bottom: 5%"></div>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
          <figure class="icon-save2" style="margin-top: -6%;"></figure> Alterar
        </button>
        <input name="id" type="hidden" value="<?= $c['id']; ?>" />
      </form>
      <?php
      break;
      //===============================================================================================================================
      // CRM
      //===============================================================================================================================    
    case 'crm':
      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $tipo_contato = $_POST['tipo_contato'];
      $tipo_servico = $_POST['tipo_servico'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $cel = $_POST['cel'];
      $nome_empresa = $_POST['nome_empresa'];
      $url_site = $_POST['url_site'];
      $facebook = $_POST['facebook'];
      $instagram = $_POST['instagram'];
      $twitter = $_POST['twitter'];
      $txt = $_POST['txt'];
      $id = $_POST['id'];

      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('crm_contato', 'WHERE email = :id', "id=" . $c['email'] . "");
        if (!$igual->getRowCount() >= 1) :

          $Dados = [
            'nome' => $c['nome'],
            'tipo_contato' => $tipo_contato,
            'tel' => $tel,
            'cel' => $cel,
            'tel2' => $tel2,
            'email' => $c['email'],
            'data' => $dataStamp2,
            'nome_empresa' => $nome_empresa,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'twitter' => $twitter,
            'url_site' => $url_site,
            'obs_empresa' => $txt,
            'status_final' => '1',
            'id_usuario' => $id,
            'hora' => $hora,
            'token' => md5($c['nome'] . $c['email'] . $hora . $tipo_contato . $tipo_servico),
            'tipo_servico' => $tipo_servico,
          ];
          $Cadastra = new Create;
          $Cadastra->ExeCreate('crm_contato', $Dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'id_crm':
      $c['id'] = $_POST['id'];

      if (in_array('', $c)) {
        echo '3';
      } else {
        //VERIFICAR SE EXISTE E ALIMENTAR O FORMULÁRIO
        $read = new Read;
        $read->ExeRead('crm_contato', 'WHERE id = :id', "id=" . $c['id'] . "");
        if ($read->getRowCount() >= 1) :
          foreach ($read->getResult() as $resultado);
      ?>
          <script type="text/javascript">
            tinymce.init({
              selector: "textarea#elm4",
              theme: "modern",
              height: 300,
              menubar: false,
              relative_urls: false,
              remove_script_host: false,
              plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
              ],
              toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image media | responsivefilemanager | forecolor backcolor | print preview code ",
              toolbar2: "",
              image_advtab: true,
              style_formats: [{
                  title: 'Bold text',
                  inline: 'b'
                },
                {
                  title: 'Red text',
                  inline: 'span',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Red header',
                  block: 'h1',
                  styles: {
                    color: '#ff0000'
                  }
                },
                {
                  title: 'Example 1',
                  inline: 'span',
                  classes: 'example1'
                },
                {
                  title: 'Example 2',
                  inline: 'span',
                  classes: 'example2'
                },
                {
                  title: 'Table styles'
                },
                {
                  title: 'Table row 1',
                  selector: 'tr',
                  classes: 'tablerow1'
                }
              ],
              external_filemanager_path: "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/",
              filemanager_title: "Responsive Filemanager",
              external_plugins: {
                "filemanager": "<?= HOME; ?>poo/app/Library/tinymce/js/filemanager/plugin.min.js"
              }
            });
            $("#telefone_crm4").mask("(99)99999999");
            $("#telefone_crm5").mask("(99)99999999");
            $("#telefone_crm6").mask("(99)99999999");
          </script>
          <form class="form_linha" method="post" name="editar_crm">
            <h1 class="topo_modal">Alterar contato de venda</h1>
            <div class="box box100" style=" width: 100%">
              <div class="box box50">
                <p class="texto_form">Nome</p>
                <input name="nome" type="text" required placeholder="Nome" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
              </div>
              <div class="box box50 no-margim">
                <p class="texto_form">E-mail</p>
                <input name="email" type="email" required placeholder="E-mail" value="<?= $resultado['email']; ?>" style=" width: 100%;" />
              </div>
              <div class="limpar"></div>
              <div class="box box20">
                <p class="texto_form">Origem do contato</p>
                <select name="tipo_contato" required class="" style="width: 100%;">
                  <option <?= ($resultado['tipo_contato'] == '1' ? "selected" : ""); ?> value="1">E-mail</option>
                  <option <?= ($resultado['tipo_contato'] == '2' ? "selected" : ""); ?> value="2">Telefone</option>
                  <option <?= ($resultado['tipo_contato'] == '3' ? "selected" : ""); ?> value="3">Celular</option>
                  <option <?= ($resultado['tipo_contato'] == '4' ? "selected" : ""); ?> value="4">Facebook</option>
                  <option <?= ($resultado['tipo_contato'] == '5' ? "selected" : ""); ?> value="5">Twitter</option>
                  <option <?= ($resultado['tipo_contato'] == '6' ? "selected" : ""); ?> value="6">Instagram</option>
                  <option <?= ($resultado['tipo_contato'] == '7' ? "selected" : ""); ?> value="7">Chat do site</option>
                  <option <?= ($resultado['tipo_contato'] == '8' ? "selected" : ""); ?> value="8">Formuário do site</option>
                  <option <?= ($resultado['tipo_contato'] == '9' ? "selected" : ""); ?> value="9">Vendedor</option>
                  <option <?= ($resultado['tipo_contato'] == '10' ? "selected" : ""); ?> value="10">Parceiros</option>
                  <option <?= ($resultado['tipo_contato'] == '11' ? "selected" : ""); ?> value="11">Pessoalmente na loja</option>
                  <option <?= ($resultado['tipo_contato'] == '12' ? "selected" : ""); ?> value="12">Outros</option>
                </select>
              </div>
              <div class="box box20">
                <p class="texto_form">Tipo do serviço</p>
                <select name="tipo_servico" required class="" style="width: 100%;">
                  <option <?= ($resultado['tipo_servico'] == '1' ? "selected" : ""); ?> value="1">Site comercial</option>
                  <option <?= ($resultado['tipo_servico'] == '2' ? "selected" : ""); ?> value="2">Hotsite</option>
                  <option <?= ($resultado['tipo_servico'] == '3' ? "selected" : ""); ?> value="3">Hospedagem</option>
                  <option <?= ($resultado['tipo_servico'] == '4' ? "selected" : ""); ?> value="4">E-mail marketing</option>
                  <option <?= ($resultado['tipo_servico'] == '5' ? "selected" : ""); ?> value="5">Portal</option>
                  <option <?= ($resultado['tipo_servico'] == '6' ? "selected" : ""); ?> value="6">Blog</option>
                  <option <?= ($resultado['tipo_servico'] == '7' ? "selected" : ""); ?> value="7">Desenvolvimento anual</option>
                  <option <?= ($resultado['tipo_servico'] == '8' ? "selected" : ""); ?> value="8">Analise do site do cliente</option>
                  <option <?= ($resultado['tipo_servico'] == '9' ? "selected" : ""); ?> value="9">E-commercer</option>
                  <option <?= ($resultado['tipo_servico'] == '10' ? "selected" : ""); ?> value="10">Outros</option>
                </select>
              </div>
              <div class="box box20">
                <p class="texto_form">Telefone</p>
                <input name="tel" type="text" placeholder="Telefone" value="<?= $resultado['tel']; ?>" id="telefone_crm4" style=" width: 100%;" />
              </div>
              <div class="box box20">
                <p class="texto_form">Telefone</p>
                <input name="tel2" type="text" placeholder="Telefone" value="<?= $resultado['tel2']; ?>" id="telefone_crm5" style=" width: 100%;" />
              </div>
              <div class="box box20 no-margim">
                <p class="texto_form">Celular</p>
                <input name="cel" type="text" placeholder="Celular" value="<?= $resultado['cel']; ?>" id="telefone_crm6" style=" width: 100%;" />
              </div>
              <div class="limpar"></div>
              <div class="box box50">
                <p class="texto_form">Nome empresa</p>
                <input name="nome_empresa" type="text" placeholder="Nome empresa" value="<?= $resultado['nome_empresa']; ?>" style=" width: 100%;" />
              </div>
              <div class="box box50 no-margim">
                <p class="texto_form">Endereço do site</p>
                <input name="url_site" type="text" placeholder="Endereço do site" value="<?= $resultado['url_site']; ?>" style=" width: 100%;" />
              </div>
              <div class="limpar"></div>

              <div class="box box33">
                <p class="texto_form">Facebook</p>
                <input name="facebook" type="text" placeholder="Facebook" value="<?= $resultado['facebook']; ?>" style=" width: 100%;" />
              </div>
              <div class="box box33">
                <p class="texto_form">Instagram</p>
                <input name="instagram" type="text" placeholder="Instagram" value="<?= $resultado['instagram']; ?>" style=" width: 100%;" />
              </div>
              <div class="box box33 no-margim">
                <p class="texto_form">Twitter</p>
                <input name="twitter" type="text" placeholder="Twitter" value="<?= $resultado['twitter']; ?>" style=" width: 100%;" />
              </div>
              <div class="limpar"></div>
              <div class="box box-completa">
                <p class="texto_form">Observações</p>
                <textarea id="elm4" name="txt" rows="10" style=" width: 100%"><?= $resultado['obs_empresa']; ?></textarea>
              </div>
            </div>
            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id_crm" value="<?= $resultado['id']; ?>" />
            <input type="hidden" name="acao" value="editar_crm" />

            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <div class="limpar"></div>
          </form>
      <?php
        else :
          echo '1';
        endif;
      }
      break;
      //===============================================================================================================================
      // SISTEMA DE CLIENTES
      //===============================================================================================================================         
    case 'cad_clientes':
      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $c['cpf_cnpj26'] = $_POST['cpf_cnpj_c'];
      $data_nasc = $_POST['data_nasc'];
      $sexo = $_POST['sexo'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $tel3 = $_POST['tel3'];
      $categoria = $_POST['categoria'];
      $origem = $_POST['origem'];
      $cep = $_POST['cep'];
      $logado = $_POST['rua'];
      $numero = $_POST['numero'];
      $bairro = $_POST['bairro'];
      $municipio = $_POST['cidade'];
      $estado = $_POST['estado'];
      $complemento = $_POST['complemento'];
      $obs = $_POST['obs'];
      $senha = Check::NewPass('5', false, true, false);
      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('cliente', 'WHERE email = :id and cnpj_cpf = :id2 and tipo = 2', "id=" . $c['email'] . "&id2=" . $c['cpf_cnpj26'] . "");
        if (!$igual->getRowCount() >= 1) :


          //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
          if (isset($_FILES['user_thumb'])) :

            $upload = new Upload('../imagens_site/');
            //-----------------imagem, nome, tamanho, pasta----------------//
            $upload->Image($_FILES['user_thumb'], md5($c['email']), '500', 'clientes', '500');
            $foto = $upload->getResult();
          else :
            $foto = '';
          endif;

          $dados = array(
            "nome" => $c['nome'],
            "cnpj_cpf" => $c['cpf_cnpj26'],
            "ie" => '',
            "im" => '',
            "logo" => $foto,
            "tel" => $tel,
            "tel2" => $tel2,
            "tel3" => $tel3,
            "obs" => $obs,
            "logado" => $logado,
            "numero" => $numero,
            "complemento" => $complemento,
            "cep" => $cep,
            "bairro" => $bairro,
            "municipio" => $municipio,
            "estado" => $estado,
            "token" => md5($c['cpf_cnpj26'] . $dataStamp2 . '2'),
            "email" => $c['email'],
            "data" => $dataStamp2,
            "hora" => $hora,
            "status" => '1',
            "propaganda" => '2',
            "rastreamento_cliente" => '',
            "nome_empresa" => $c['nome'],
            "sexo" => $sexo,
            "data_nasc" => $data_nasc,
            "senha" => $senha,
            "tipo" => '2',
            "origem" => $origem,
            "categoria" => $categoria,
            "id_usuario" => $_SESSION['usuario'],
          );
          $Cadastra = new Create;
          $Cadastra->ExeCreate('cliente', $dados);
          if ($Cadastra->getResult()) :

            $dados2 = array(
              "id_cliente" => $Cadastra->getResult(),
              "nome" => $c['nome'],
              "cargo" => '',
              "tel" => $tel,
              "tel2" => $tel2,
              "email" => $c['email'],
              "senha" => $senha,
              "obs" => $obs,
              "data" => $dataStamp2,
              "hora" => $hora,
              "status" => '1',
              "token" => md5($c['cpf_cnpj26'] . $dataStamp2 . '2'),
              "avatar" => $foto,
              "data_aniv" => $data_nasc,
            );
            $Cadastra->ExeCreate('cliente_contato', $dados2);

            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'id_clientes_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('cliente', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
      ?>
      <script>
        jQuery(function($) {
          $("#mascara_celular22").mask("(99)999999999");
          $("#mascara_telefone22").mask("(99)999999999");
          $("#mascara_telefone222").mask("(99)999999999");
          $('#datacompleta2').datepicker({
            language: 'pt-BR',
            todayButton: new Date() // Now can select only dates, which goes after today
          });
        });
        $("select").select2();
      </script>

      <form class="form_linha" method="post" name="editar_clientes" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar cliente</h1>
        <div class="box box80">
          <div class="box box50">
            <p class="texto_form">Nome completo</p>
            <input name="nome" type="text" required placeholder="Nome completo" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">E-mail válido</p>
            <input name="email" type="email" required placeholder="E-mail válido" value="<?= $resultado['email']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">CPF ou CNPJ</p>
            <input name="cpf_cnpj_c" type="text" required placeholder="CPF ou CNPJ" style=" width: 100%;" value="<?= $resultado['cnpj_cpf']; ?>" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' />
          </div>
          <div class="box box33">
            <p class="texto_form">Categoria</p>
            <select name="categoria" required style="width: 100%;">
              <option <?= ($resultado['categoria'] == '1' ? "selected" : ""); ?> value="1">Cliente efetivo</option>
              <option <?= ($resultado['categoria'] == '2' ? "selected" : ""); ?> value="2">Cliente em potencial</option>
              <option <?= ($resultado['categoria'] == '3' ? "selected" : ""); ?> value="3">Concorrente</option>
              <option <?= ($resultado['categoria'] == '4' ? "selected" : ""); ?> value="4">Fornecedor</option>
              <option <?= ($resultado['categoria'] == '5' ? "selected" : ""); ?> value="5">Parceiro</option>
            </select>
          </div>
          <div class="box box33">
            <p class="texto_form">Origem</p>
            <select name="origem" required style="width: 100%;">
              <option <?= ($resultado['origem'] == '1' ? "selected" : ""); ?> value="1">Site</option>
              <option <?= ($resultado['origem'] == '2' ? "selected" : ""); ?> value="2">Telefone/Celular</option>
              <option <?= ($resultado['origem'] == '3' ? "selected" : ""); ?> value="3">Formulário de contato</option>
              <option <?= ($resultado['origem'] == '4' ? "selected" : ""); ?> value="4">Whatsapp</option>
              <option <?= ($resultado['origem'] == '5' ? "selected" : ""); ?> value="5">E-mail</option>
              <option <?= ($resultado['origem'] == '6' ? "selected" : ""); ?> value="6">Facebook</option>
              <option <?= ($resultado['origem'] == '7' ? "selected" : ""); ?> value="7">Instagram</option>
              <option <?= ($resultado['origem'] == '8' ? "selected" : ""); ?> value="8">Twitter</option>
            </select>
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">Telefone</p>
            <input name="tel" type="text" placeholder="Telefone" id="mascara_telefone22" value="<?= $resultado['tel']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33">
            <p class="texto_form">Telefone</p>
            <input name="tel2" type="text" placeholder="Telefone" id="mascara_telefone22" value="<?= $resultado['tel2']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33 no-margim">
            <p class="texto_form">Celular</p>
            <input name="tel3" type="text" placeholder="Celular" id="mascara_celular222" value="<?= $resultado['tel3']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Data de nascimento</p>
            <input name="data_nasc" type="text" placeholder="Data de nascimento" value="<?= $resultado['data_nasc']; ?>" style=" width: 100%;" id="datacompleta2" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Sexo</p>
            <select name="sexo" required style="width: 100%;">
              <option <?= ($resultado['sexo'] == '1' ? "selected" : ""); ?> value="1">Masculino</option>
              <option <?= ($resultado['sexo'] == '2' ? "selected" : ""); ?> value="2">Feminino</option>
            </select>
          </div>
          <div class="limpar"></div>

          <p class="legenda_form">Endereço completo</p>
          <div class="box box-completa">
            <input name="cep" class="cep_cad_parsa2" type="text" placeholder="Seu CEP *" value="<?= $resultado['cep']; ?>" id="csp mascara_cep" style=" width: 99%;" />
            <div class="load2" style=" display: none"></div>
          </div>
          <div class="box box70">
            <input name="rua" type="text" placeholder="Rua, Avenida" value="<?= $resultado['logado']; ?>" id="logradourop2" style=" width: 100%;" />
          </div>
          <div class="box box30 no-margim">
            <input name="numero" type="text" placeholder="Nº" value="<?= $resultado['numero']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>

          <div class="box box-completa">
            <input name="complemento" type="text" placeholder="Complemento" value="<?= $resultado['complemento']; ?>" style=" width: 99%;" />
          </div>
          <div class="limpar"></div>

          <div class="box box35">
            <input name="bairro" type="text" placeholder="Bairro" value="<?= $resultado['bairro']; ?>" id="bairrop2" style=" width: 100%;" />
          </div>
          <div class="box box35">
            <input name="cidade" type="text" placeholder="Cidade" value="<?= $resultado['municipio']; ?>" id="localidadep2" style=" width: 100%;" />
          </div>

          <div class="box box30 no-margim">
            <input name="estado" type="text" placeholder="Estado" value="<?= $resultado['estado']; ?>" id="ufp2" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <textarea name="obs" id="" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"><?= $resultado['obs']; ?></textarea>
          <div class="limpar"></div>
        </div>
        <div class="box box20 no-margim">

          <p class="texto_form"></p>
          <?php
          if ($resultado['logo'] == '') :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
          else :
            echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . SITE . 'imagens_site/' . $resultado['logo'] . '" default="' . HOME . 'imagens_site/' . $resultado['logo'] . '">';
          endif;
          ?>
          <div class="box_content">
            <div class="limpar"></div>
            <div class="mensagem_imagem ds-none">
              <p><b></b></p>
            </div>
            <span class="legend">Foto (500x500px, JPG ou PNG):</span>
            <div class="limpar" style=" margin-bottom: 2%"></div>
            <label class="label_file" for='selecao-arquivo4'>Selecionar um arquivo</label>
            <input id='selecao-arquivo4' type="file" name="user_thumb" class="wc_loadimage" />
            <div class="limpar"></div>

            <div class="upload_bar m_top m_botton">
              <div class="upload_progress ds-none">0%</div>
            </div>
            <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
            <div class="limpar"></div>
            <br><br>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
              <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
            </button>
          </div>
        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="editar_clientes" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>

        <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'editar_clientes':

      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $c['cpf_cnpj26'] = $_POST['cpf_cnpj_c'];
      $data_nasc = $_POST['data_nasc'];
      $sexo = $_POST['sexo'];
      $tel = $_POST['tel'];
      $tel2 = $_POST['tel2'];
      $tel3 = $_POST['tel3'];
      $cep = $_POST['cep'];
      $logado = $_POST['rua'];
      $numero = $_POST['numero'];
      $bairro = $_POST['bairro'];
      $municipio = $_POST['cidade'];
      $estado = $_POST['estado'];
      $complemento = $_POST['complemento'];
      $id = $_POST['id'];
      $obs = $_POST['obs'];
      $categoria = $_POST['categoria'];
      $origem = $_POST['origem'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('cliente', 'WHERE id = :id', "id=" . $id . "");
        foreach ($igual->getResult() as $resultado);


        //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
        if (isset($_FILES['user_thumb'])) :

          $upload = new Upload('../imagens_site/');
          //-----------------imagem, nome, tamanho, pasta----------------//
          $upload->Image($_FILES['user_thumb'], md5($c['email']), '500', 'clientes', '500');
          $foto = $upload->getResult();
        else :
          $foto = $resultado['logo'];
        endif;

        $dados = array(
          "nome" => $c['nome'],
          "cnpj_cpf" => $c['cpf_cnpj26'],
          "logo" => $foto,
          "tel" => $tel,
          "tel2" => $tel2,
          "tel3" => $tel3,
          "obs" => $obs,
          "logado" => $logado,
          "numero" => $numero,
          "complemento" => $complemento,
          "cep" => $cep,
          "bairro" => $bairro,
          "municipio" => $municipio,
          "estado" => $estado,
          "email" => $c['email'],
          "nome_empresa" => $c['nome'],
          "sexo" => $sexo,
          "data_nasc" => $data_nasc,
          "origem" => $origem,
          "categoria" => $categoria,
        );
        $updade = new Update;
        $updade->ExeUpdate('cliente', $dados, "WHERE id = :id", "id=" . $id . "");
        if ($updade->getResult()) :

          $dados2 = array(
            "nome" => $c['nome'],
            "cargo" => '',
            "tel" => $tel,
            "tel2" => $tel2,
            "email" => $c['email'],
            "obs" => $obs,
            "avatar" => $foto,
            "data_aniv" => $data_nasc,
          );
          $updade->ExeUpdate('cliente_contato', $dados2, "WHERE id_cliente = :id", "id=" . $id . "");
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
      //===============================================================================================================================
      // SISTEMA DE TICKET
      //=============================================================================================================================== 
    case 'cad_ticket':

      $c['assunto'] = $_POST['assunto'];
      $prioridade = $_POST['prioridade'];
      $c['departamento'] = $_POST['departamento'];
      $obs = $_POST['obs'];
      $usuario = $_POST['responsavel'];
      $cliente = $_POST['empresa'];
      $origem = $_POST['origem'];
      $usuario2 = $_POST['usuario'];
      $contato_empresa = $_POST['contato_empresa'];


      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        $token_sac = md5($c['assunto'] . $hora);

        $dados = array(
          "assunto" => $c['assunto'],
          "departamento" => $c['departamento'],
          "id_cliente_contato" => $contato_empresa,
          "id_cliente" => $cliente,
          "prioridade" => $prioridade,
          "atendente" => $usuario,
          "status" => '1',
          "avaliacao" => '',
          "token" => $token_sac,
          "data" => $dataStamp2,
          "hora" => $hora,
          "data_entrega" => '',
          "origem" => $origem,
        );
        $Cadastra = new Create;
        $Cadastra->ExeCreate('sac', $dados);
        if ($Cadastra->getResult()) :

          $dados2 = array(
            "id_sac" => $Cadastra->getResult(),
            "id_cliente_contato" => '',
            "msn" => $obs,
            "hora" => $hora,
            "data" => $dataStamp2,
            "atendente" => $usuario,
          );
          $Cadastra22 = new Create;
          $Cadastra22->ExeCreate('sac_interacao', $dados2);

          if (isset($_FILES['img_documento'])) :

            $data_name = array_keys($_FILES['img_documento']);
            $uploadwW = new Upload('../imagens_site/');
            $gbcont2 = count($_FILES['img_documento']['tmp_name']);

            for ($i = 0; $i < $gbcont2; $i++) {
              foreach ($data_name as $image) :
                $img2[$i][$image] = $_FILES['img_documento'][$image][$i];
              endforeach;
            }
            $cont_mest = '';
            $Cadastra___ = new Create;
            foreach ($img2 as $gbenviar2) :
              $cont_mest = $cont_mest + 1;
              $uploadwW->File($gbenviar2, md5($hora . $cont_mest), 'arquivos_sac');
              $fotooutrass = $uploadwW->getResult();

              $Dadosww = [
                'id_sac' => $Cadastra->getResult(),
                'id_sac_interacao' => $Cadastra22->getResult(),
                'arquivo' => $fotooutrass,
                'token' => md5($Cadastra->getResult() . $usuario . $fotooutrass . $hora . $cont_mest),
                'data' => $dataStamp2,
                'hora' => $hora,
                'status' => '1',
              ];

              $Cadastra___->ExeCreate('sac_arquivo', $Dadosww);
            endforeach;
          endif;
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'id_sac_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('sac', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        jQuery(function($) {
          $("#mascara_celular22").mask("(99)999999999");
          $("#mascara_telefone22").mask("(99)999999999");
          $("#mascara_telefone222").mask("(99)999999999");
          $('#datacompleta2').datepicker({
            language: 'pt-BR',
            todayButton: new Date() // Now can select only dates, which goes after today
          });
        });
        $("select").select2();
      </script>

      <form class="form_linha" method="post" name="editar_sac" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar SAC</h1>
        <div class="box box100">
          <div class="box box33">
            <p class="texto_form">Titulo</p>
            <input name="assunto" type="text" required placeholder="Titulo" value="<?= $resultado['assunto']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33">
            <p class="texto_form">Prioridade</p>
            <select name="prioridade" class="select " style=" width: 100%;">
              <option <?= ($resultado['prioridade'] == 'Alta' ? "selected" : ""); ?> value="Alta">Alta</option>
              <option <?= ($resultado['prioridade'] == 'Média' ? "selected" : ""); ?> value="Média">Média</option>
              <option <?= ($resultado['prioridade'] == 'Baixa' ? "selected" : ""); ?> value="Baixa">Baixa</option>
            </select>
          </div>
          <div class="box box33  no-margim">
            <p class="texto_form">Departamento</p>
            <select name="departamento" class="select " style=" width: 100%;">
              <option <?= ($resultado['departamento'] == 'Suporte' ? "selected" : ""); ?> value="Suporte">Suporte</option>
              <option <?= ($resultado['departamento'] == 'Contas e Vendas' ? "selected" : ""); ?> value="Contas e Vendas">Contas e Vendas</option>
            </select>
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">Empresa</p>
            <select name="empresa" class="select " style=" width: 100%;">
              <?php
              $corretor = new Read;
              $corretor->ExeRead('cliente', 'WHERE status = "1"');
              if ($corretor->getRowCount() >= 1) :
                foreach ($corretor->getResult() as $examinado) :
                  echo ' <option  ' . ($resultado['id_cliente'] == $examinado['id'] ? "selected" : "") . ' value="' . $examinado['id'] . '">' . $examinado['nome'] . '</option> ';
                endforeach;
              else :
                echo ' <option value="">Não há empresa cadastrada!</option> ';
              endif;
              ?>
            </select>
          </div>
          <div class="box box33">
            <p class="texto_form">Atendente Responsável</p>
            <select name="responsavel" class="select " style=" width: 100%;">
              <?php
              $corretor->ExeRead('perfil', 'WHERE status = "1"');
              if ($corretor->getRowCount() >= 1) :
                foreach ($corretor->getResult() as $examinado) :
                  echo ' <option ' . ($resultado['atendente'] == $examinado['id'] ? "selected" : "") . ' value="' . $examinado['id'] . '">' . $examinado['nome'] . '</option> ';
                endforeach;
              else :
                echo ' <option value="">Não há perfil cadastrado!</option> ';
              endif;
              ?>
            </select>
          </div>
          <div class="box box33  no-margim">
            <p class="texto_form">Origem</p>
            <select name="origem" class="select " style=" width: 100%;">
              <option <?= ($resultado['origem'] == '1' ? "selected" : ""); ?> value="1">Site</option>
              <option <?= ($resultado['origem'] == '2' ? "selected" : ""); ?> value="2">Telefone/Celular</option>
              <option <?= ($resultado['origem'] == '3' ? "selected" : ""); ?> value="3">Formulário de contato</option>
              <option <?= ($resultado['origem'] == '4' ? "selected" : ""); ?> value="4">Whatsapp</option>
              <option <?= ($resultado['origem'] == '5' ? "selected" : ""); ?> value="5">E-mail</option>
              <option <?= ($resultado['origem'] == '6' ? "selected" : ""); ?> value="6">Facebook</option>
              <option <?= ($resultado['origem'] == '7' ? "selected" : ""); ?> value="7">Instagram</option>
              <option <?= ($resultado['origem'] == '8' ? "selected" : ""); ?> value="8">Twitter</option>
              <option <?= ($resultado['origem'] == '9' ? "selected" : ""); ?> value="9">Reclame aqui</option>
            </select>
          </div>
          <div class="limpar" style=" margin-bottom: 1%"></div>
          <div class="box box25 ">
            <p class="texto_form">Status</p>
            <select name="status" class="select " style=" width: 100%;">
              <option <?= ($resultado['status'] == '1' ? "selected" : ""); ?> value="1">Aberto</option>
              <option <?= ($resultado['status'] == '2' ? "selected" : ""); ?> value="2">Respondido</option>
              <option <?= ($resultado['status'] == '3' ? "selected" : ""); ?> value="3">Finalizado</option>
            </select>
          </div>
          <div class="box box25 ">
            <p class="texto_form">Data de entrega</p>
            <input name="data_entrega" type="text" required placeholder="Data de entrega" value="<?= ($resultado['data_entrega'] == '' ? "" : Check::TimesData($resultado['data_entrega'])); ?>" id="datacompleta2" style=" width: 100%;" />
            </select>
          </div>
          <div class="box box25">
            <p class="texto_form">Tempo de trabalho (em minutos)</p>
            <input name="tempo_serv" type="text" required placeholder="Tempo de trabalho em minutos" value="<?= $resultado['tempo_serv']; ?>" style=" width: 100%;" />
            </select>
          </div>
          <div class="box box25 no-margim">
            <p class="texto_form">Enviar e-mail para o responsável?</p>
            <select name="enviar" class="select " style=" width: 100%;">
              <option value="1">Não enviar </option>
              <option value="2">Enviar e-mail</option>
            </select>
          </div>
          <div class="limpar"></div>
        </div>
        <div class="limpar"></div>
        <br>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
          <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
        </button>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="editar_sac" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'editar_sac':
      $c['assunto'] = $_POST['assunto'];
      $prioridade = $_POST['prioridade'];
      $departamento = $_POST['departamento'];
      $empresa = $_POST['empresa'];
      $responsavel = $_POST['responsavel'];
      $data_entrega = $_POST['data_entrega'];
      $status = $_POST['status'];
      $tempo_serv = $_POST['tempo_serv'];
      $origem = $_POST['origem'];
      $enviar = $_POST['enviar'];
      $id = $_POST['id'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('sac', 'WHERE id = :id', "id=" . $id . "");
        foreach ($igual->getResult() as $resultado);

        $dados = array(
          "assunto" => $c['assunto'],
          "departamento" => $departamento,
          "id_cliente" => $empresa,
          "prioridade" => $prioridade,
          "atendente" => $responsavel,
          "status" => $status,
          "data_entrega" => Check::Datastamp($data_entrega),
          "tempo_serv" => $tempo_serv,
          "origem" => $origem,
        );
        $updade = new Update;
        $updade->ExeUpdate('sac', $dados, "WHERE id = :id", "id=" . $id . "");
        if ($updade->getResult()) :

          if ($resultado['id_cliente_contato'] == '') :
          else :
            $igual2 = new Read;
            $igual2->ExeRead('sac', 'WHERE id = :id', "id=" . $id . "");
            foreach ($igual2->getResult() as $resultado_novo);

            $igual->ExeRead('cliente_contato', 'WHERE id = :id', "id=" . $resultado_novo['id_cliente_contato'] . "");
            foreach ($igual->getResult() as $resultado_contato);
            $igual->ExeRead('cliente', 'WHERE id = :id', "id=" . $resultado_contato['id_cliente'] . "");
            foreach ($igual->getResult() as $resultado_cliente);
            $igual->ExeRead('perfil', 'WHERE id = :id', "id=" . $resultado_novo['atendente'] . "");
            foreach ($igual->getResult() as $resultado_perfil);

            $resultado_novo['atendente'] = $resultado_perfil['nome'];

            if ($resultado_novo['status'] == '1') :
              $resultado_novo['status'] = 'Aberto';
            elseif ($resultado_novo['status'] == '2') :
              $resultado_novo['status'] = 'Respondido';
            elseif ($resultado_novo['status'] == '3') :
              $resultado_novo['status'] = 'Finalizado';
            endif;

            if ($enviar == '2') :
              $c['mensagem'] = $variavel_x = file_get_contents(SAC . "email_integracao_at_alt&value=" . base64_encode($resultado_novo['id']) . "");

              $email_senha = array(
                "Assunto" => "Central de atendimento Casa dos Sites  - Ticket aletardo", // Assunto do e-mail.
                "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
                "RemetenteNome" => NOMECLIENTE, //Nome da pessoa que enviou.
                "RemetenteEmail" => EMAILATENDIMENTO, //E-mail da pessoa que enviou.
                "DestinoNone" => $resultado_contato['nome'], //Nome da pessoa que vai receber.
                "DestinoEmail" => $resultado_contato['email'] //Email da pessoa que esta recebendo.
              );

              $enviar_envio = sendMail($email_senha['Assunto'], $email_senha['Mensagem'], $email_senha['RemetenteEmail'], $email_senha['RemetenteNome'], $email_senha['DestinoEmail'], $email_senha['DestinoNone'], $reply = NULL, $replyNome = NULL, $anexo_pasta = NULL);
            endif;
          endif;
          echo '1';
        else :
          echo '2';
        endif;

      endif;
      break;
    case 'interagir':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('sac', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      $ultimo->ExeRead('cliente_contato', "WHERE id = :id", 'id=' . $resultado['id_cliente_contato'] . '');
      foreach ($ultimo->getResult() as $cliente);

      $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $_SESSION['usuario'] . '');
      foreach ($ultimo->getResult() as $cliente_at);

      if ($resultado['atendente'] == '') :
      else :
        $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $resultado['atendente'] . '');
        foreach ($ultimo->getResult() as $atendente);
      endif;
    ?>
      <script>
        $('.botao_cadastro').click(function() {
          $('.form_info_p').slideUp(function() {
            $('.form_integarcao_p').slideDown();
          });
        });
        $('.info_cadastro').click(function() {
          $('.form_integarcao_p').slideUp(function() {
            $('.form_info_p').slideDown();
          });
        });
      </script>
      <div style=" width: 100%; background: #fff; padding: 3%;">
        <h1 class="topo_modal">Informações do atendimento</h1>
        <div class="box box30" style=" padding: 1%; background: #fff">
          <div class="form_info_p">
            <p style=" font-weight: 900; font-size: 0.9em;">Titulo:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['assunto']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Departamento:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['departamento']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Prioridade:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['prioridade']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Status:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%">
              <?php
              if ($resultado['status'] == '1') :
                echo $status = 'Aberto';
              elseif ($resultado['status'] == '2') :
                echo $status = 'Respondido';
              elseif ($resultado['status'] == '3') :
                echo $status = 'Finalizado';
              endif;
              ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Data de abertura:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= Check::TimesData($resultado['data']); ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Previsão de entrega:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?php
                                                            if ($resultado['data_entrega'] == '') :
                                                              echo 'Seu atendimento esta sendo avaliado';
                                                            else :
                                                              echo Check::TimesData($resultado['data_entrega']);
                                                            endif;
                                                            ?></p>
            <div class="btn btn_green botao_cadastro" style=" width: 100%; text-align: center; font-size: 0.9em; margin-top: 5%">Cadastrar nova integração</div>
          </div>

          <div class="form_integarcao_p ds-none">
            <form class="form_linha" method="post" name="interagir_form" enctype="multipart/form-data">
              <p style=" font-weight: 900; font-size: 0.9em; margin-bottom: 5%; border-bottom: 2px solid #000">Nova integração:</p>
              <div class="box box100" style=" width: 100%">
                <p class="texto_form">Mensagem</p>
                <textarea name="obs" id="" required rows="5" placeholder="Mensagem" style=" width: 100%; height: 110px"></textarea>
                <div class="limpar"></div>
                <br>
                <p class="texto_form">Selecione um ou mais arquivos</p>
                <div class="limpar" style=" margin-bottom: 2%"></div>
                <label class="label_file" for='selecao-arquivo101'>Selecionar um arquivo</label>
                <input id='selecao-arquivo101' type="file" name="img_documento[]" multiple class="" />
                <div class="limpar"></div>
                <br>
                <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 50%; float: left">Cadastrar</button>
                <div class="limpar"></div>
                <br><br>
              </div>
              <div class="limpar"></div>
              <input type="hidden" name="id_sac" value="<?= $resultado['id']; ?>" />
              <input type="hidden" name="id_cliente" value="<?= $cliente_at['id']; ?>" />
              <input type="hidden" name="token" value="<?= $resultado['token']; ?>" />
              <input type="hidden" name="acao" value="interagir_form" />
              <div class="limpar"></div>
            </form>
            <div class="limpar"></div>
            <div class="btn btn_green info_cadastro" style=" width: 100%; text-align: center; font-size: 0.9em; margin-top: 5%">Mostrar informações</div>
          </div>

        </div>
        <div class="box box70 no-margim" style=" background: #EFEFF0; padding: 3%; max-height: 400px; overflow: auto;">
          <?php
          $ultimo->ExeRead('sac_interacao', "WHERE id_sac = :id order by id desc", 'id=' . $resultado['id'] . '');
          foreach ($ultimo->getResult() as $sac_mensagem) :

            if ($sac_mensagem['atendente'] == '') :

              $ultimo->ExeRead('cliente_contato', "WHERE id = :id", 'id=' . $sac_mensagem['id_cliente_contato'] . '');
              foreach ($ultimo->getResult() as $cliente_);
              //print_r($cliente_);
          ?>
              <div class="box box100" style=" width: 100%; margin-bottom: 5%">
                <div class="box box10">
                  <?php
                  if ($cliente_['avatar'] == '') :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
                  else :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $cliente_['avatar'] . '" default="' . HOME . 'imagens_site/' . $cliente_['avatar'] . '">';
                  endif;
                  ?>
                </div>

                <div class="box box90 no-margim">
                  <p style=" margin-left: 1.5%; font-size: 0.8em; margin-bottom: 1%;"><?= $cliente_['nome']; ?> / Data: <?= Check::TimesData($sac_mensagem['data']); ?> - <?= $sac_mensagem['hora']; ?></p>
                  <div style="background: #fff; padding: 2% 3%; margin-left: 1%; width: 100%; font-size: 0.9em;">
                    <?= $sac_mensagem['msn']; ?>
                    <?php
                    $ultimo->ExeRead('sac_arquivo', "WHERE id_sac_interacao = :id and id_sac = " . $sac_mensagem['id_sac'] . "", 'id=' . $sac_mensagem['id'] . '');
                    if ($ultimo->getRowCount() >= 1) :
                      echo '<p style=" font-weight: 900; font-size: 0.9em; margin-top: 2%; margin-bottom: 2%; border-bottom: 2px solid #000">Arquivos Anexados:</p>';
                      foreach ($ultimo->getResult() as $sac_arquivo) :
                    ?>
                        <a style=" font-size: 0.9em;" href="<?= HOME; ?>imagens_site/<?= $sac_arquivo['arquivo']; ?>" target="_blank"><?= $sac_arquivo['token']; ?></a><br>
                    <?php
                      endforeach;
                    else :
                    endif;
                    ?>
                  </div>
                </div>
                <div class="limpar"></div>
              </div>
            <?php
            else :

              $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $sac_mensagem['atendente'] . '');
              foreach ($ultimo->getResult() as $cliente__);
            ?>
              <div class="box box100" style=" width: 100%; margin-top: 5%; margin-bottom: 5%">

                <div class="box box90">
                  <p style=" float: right; margin-right: 1.5%; font-size: 0.8em; margin-bottom: 1%;">Data: <?= Check::TimesData($sac_mensagem['data']); ?> - <?= $sac_mensagem['hora']; ?> / <?= $cliente__['nome']; ?></p>
                  <div style=" float: right; background: #6494ED; color: #fff; padding: 2% 3%; margin-right: 1%; width: 100%; font-size: 0.9em;">
                    <?= $sac_mensagem['msn']; ?>
                    <?php
                    $ultimo->ExeRead('sac_arquivo', "WHERE id_sac_interacao = :id and id_sac = " . $sac_mensagem['id_sac'] . "", 'id=' . $sac_mensagem['id'] . '');
                    if ($ultimo->getRowCount() >= 1) :
                      echo '<p style=" font-weight: 900; font-size: 0.9em; margin-top: 2%; margin-bottom: 2%; border-bottom: 2px solid #fff">Arquivos Anexados:</p>';
                      foreach ($ultimo->getResult() as $sac_arquivo) :
                    ?>
                        <a style=" font-size: 0.9em; color: #fff;" href="<?= HOME; ?>imagens_site/<?= $sac_arquivo['arquivo']; ?>" target="_blank"><?= $sac_arquivo['token']; ?></a><br>
                    <?php
                      endforeach;
                    else :
                    endif;
                    ?>
                  </div>
                </div>
                <div class="box box10 no-margim">
                  <?php
                  if ($cliente__['avatar'] == '') :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
                  else :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $cliente__['avatar'] . '" default="' . HOME . 'imagens_site/' . $cliente__['avatar'] . '">';
                  endif;
                  ?>
                </div>
                <div class="limpar"></div>
              </div>
          <?php
            endif;

          endforeach;
          ?>
        </div>
        <div class="limpar"></div>
      </div>
    <?php
      break;
    case 'interagir_form':

      $obs = $_POST['obs'];
      $usuario = $_POST['id_cliente'];
      $id_sac = $_POST['id_sac'];
      //$nomeusuario = $_POST['nome_cliente'];
      //$emailusuario = $_POST['email_cliente'];
      $token = $_POST['token'];

      $Dados = [
        'status' => '1',
      ];

      $updade = new Update;
      $updade->ExeUpdate('sac', $Dados, "WHERE id = :id", "id=" . $id_sac . "");


      $dados2 = array(
        "id_sac" => $id_sac,
        "id_cliente_contato" => '',
        "msn" => $obs,
        "hora" => $hora,
        "data" => $dataStamp2,
        "atendente" => $usuario,
      );
      $Cadastra = new Create;
      $Cadastra->ExeCreate('sac_interacao', $dados2);
      $id_sac_interacao = $Cadastra->getResult();

      if (isset($_FILES['img_documento'])) :

        $data_name = array_keys($_FILES['img_documento']);
        $uploadwW = new Upload('../imagens_site/');
        $gbcont2 = count($_FILES['img_documento']['tmp_name']);

        for ($i = 0; $i < $gbcont2; $i++) {
          foreach ($data_name as $image) :
            $img2[$i][$image] = $_FILES['img_documento'][$image][$i];
          endforeach;
        }
        $cont_mest = '';
        $Cadastra___ = new Create;
        foreach ($img2 as $gbenviar2) :
          $cont_mest = $cont_mest + 1;
          $uploadwW->File($gbenviar2, md5($hora . $cont_mest), 'arquivos_sac');
          $fotooutrass = $uploadwW->getResult();

          $Dadosww = [
            'id_sac' => $id_sac,
            'id_sac_interacao' => $Cadastra->getResult(),
            'arquivo' => $fotooutrass,
            'token' => md5($Cadastra->getResult() . $usuario . $fotooutrass . $hora . $cont_mest),
            'data' => $dataStamp2,
            'hora' => $hora,
            'status' => '1',
          ];
          $Cadastra___->ExeCreate('sac_arquivo', $Dadosww);
        endforeach;
      endif;





      $ultimo = new Read;
      $ultimo->ExeRead('sac', "WHERE id = :id", 'id=' . $id_sac . '');
      foreach ($ultimo->getResult() as $resultado);
      // print_r($resultado);

      $ultimo->ExeRead('cliente_contato', "WHERE id = :id", 'id=' . $resultado['id_cliente_contato'] . '');
      foreach ($ultimo->getResult() as $cliente);
      $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $_SESSION['usuario'] . '');
      foreach ($ultimo->getResult() as $cliente_at);

      if ($resultado['atendente'] == '') :
      else :
        $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $resultado['atendente'] . '');
        foreach ($ultimo->getResult() as $atendente);
      endif;
    ?>
      <script>
        $('.botao_cadastro').click(function() {
          $('.form_info_p').slideUp(function() {
            $('.form_integarcao_p').slideDown();
          });
        });
        $('.info_cadastro').click(function() {
          $('.form_integarcao_p').slideUp(function() {
            $('.form_info_p').slideDown();
          });
        });
      </script>
      <div style=" width: 100%; background: #fff; padding: 3%;">
        <h1 class="topo_modal">Informações do atendimento</h1>
        <div class="box box30" style=" padding: 1%; background: #fff">
          <div class="form_info_p">
            <p style=" font-weight: 900; font-size: 0.9em;">Titulo:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['assunto']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Departamento:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['departamento']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Prioridade:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= $resultado['prioridade']; ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Status:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%">
              <?php
              if ($resultado['status'] == '1') :
                echo $status = 'Aberto';
              elseif ($resultado['status'] == '2') :
                echo $status = 'Respondido';
              elseif ($resultado['status'] == '3') :
                echo $status = 'Finalizado';
              endif;
              ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Data de abertura:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?= Check::TimesData($resultado['data']); ?></p>

            <p style=" font-weight: 900; font-size: 0.9em;">Previsão de entrega:</p>
            <p style=" font-size: 0.8em; margin-bottom: 3%"><?php
                                                            if ($resultado['data_entrega'] == '') :
                                                              echo 'Seu atendimento esta sendo avaliado';
                                                            else :
                                                              echo Check::TimesData($resultado['data_entrega']);
                                                            endif;
                                                            ?></p>
            <div class="btn btn_green botao_cadastro" style=" width: 100%; text-align: center; font-size: 0.9em; margin-top: 5%">Cadastrar nova integração</div>
          </div>

          <div class="form_integarcao_p ds-none">
            <form class="form_linha" method="post" name="interagir_form" enctype="multipart/form-data">
              <p style=" font-weight: 900; font-size: 0.9em; margin-bottom: 5%; border-bottom: 2px solid #000">Nova integração:</p>
              <div class="box box100" style=" width: 100%">
                <p class="texto_form">Mensagem</p>
                <textarea name="obs" id="" required rows="5" placeholder="Mensagem" style=" width: 100%; height: 110px"></textarea>
                <div class="limpar"></div>
                <br>
                <p class="texto_form">Selecione um ou mais arquivos</p>
                <div class="limpar" style=" margin-bottom: 2%"></div>
                <label class="label_file" for='selecao-arquivo111'>Selecionar um arquivo</label>
                <input id='selecao-arquivo111' type="file" name="img_documento[]" multiple class="" />
                <div class="limpar"></div>
                <br>
                <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 50%; float: left">Cadastrar</button>
                <div class="limpar"></div>
                <br><br>
              </div>
              <div class="limpar"></div>
              <input type="hidden" name="id_sac" value="<?= $resultado['id']; ?>" />
              <input type="hidden" name="id_cliente" value="<?= $cliente_at['id']; ?>" />
              <input type="hidden" name="token" value="<?= $resultado['token']; ?>" />
              <input type="hidden" name="acao" value="interagir_form" />
              <div class="limpar"></div>
            </form>
            <div class="limpar"></div>
            <div class="btn btn_green info_cadastro" style=" width: 100%; text-align: center; font-size: 0.9em; margin-top: 5%">Mostrar informações</div>
          </div>

        </div>
        <div class="box box70 no-margim" style=" background: #EFEFF0; padding: 3%; max-height: 400px; overflow: auto;">
          <?php
          $ultimo->ExeRead('sac_interacao', "WHERE id_sac = :id order by id desc", 'id=' . $resultado['id'] . '');
          foreach ($ultimo->getResult() as $sac_mensagem) :

            if ($sac_mensagem['atendente'] == '') :

              $ultimo->ExeRead('cliente_contato', "WHERE id = :id", 'id=' . $sac_mensagem['id_cliente_contato'] . '');
              foreach ($ultimo->getResult() as $cliente_);
          ?>
              <div class="box box100" style=" width: 100%; margin-bottom: 5%">
                <div class="box box10">
                  <?php
                  if ($cliente_['avatar'] == '') :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
                  else :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $cliente_['avatar'] . '" default="' . HOME . 'imagens_site/' . $cliente_['avatar'] . '">';
                  endif;
                  ?>
                </div>

                <div class="box box90 no-margim">
                  <p style=" margin-left: 1.5%; font-size: 0.8em; margin-bottom: 1%;"><?= $cliente_['nome']; ?> / Data: <?= Check::TimesData($sac_mensagem['data']); ?> - <?= $sac_mensagem['hora']; ?></p>
                  <div style="background: #fff; padding: 2% 3%; margin-left: 1%; width: 100%; font-size: 0.9em;">
                    <?= $sac_mensagem['msn']; ?>
                    <?php
                    $ultimo->ExeRead('sac_arquivo', "WHERE id_sac_interacao = :id and id_sac = " . $sac_mensagem['id_sac'] . "", 'id=' . $sac_mensagem['id'] . '');
                    if ($ultimo->getRowCount() >= 1) :
                      echo '<p style=" font-weight: 900; font-size: 0.9em; margin-top: 2%; margin-bottom: 2%; border-bottom: 2px solid #000">Arquivos Anexados:</p>';
                      foreach ($ultimo->getResult() as $sac_arquivo) :
                    ?>
                        <a style=" font-size: 0.9em;" href="<?= HOME; ?>imagens_site/<?= $sac_arquivo['arquivo']; ?>" target="_blank"><?= $sac_arquivo['token']; ?></a><br>
                    <?php
                      endforeach;
                    else :
                    endif;
                    ?>
                  </div>
                </div>
                <div class="limpar"></div>
              </div>
            <?php
            else :

              $ultimo->ExeRead('perfil', "WHERE id = :id", 'id=' . $sac_mensagem['atendente'] . '');
              foreach ($ultimo->getResult() as $cliente__);
            ?>
              <div class="box box100" style=" width: 100%; margin-top: 5%; margin-bottom: 5%">

                <div class="box box90">
                  <p style=" float: right; margin-right: 1.5%; font-size: 0.8em; margin-bottom: 1%;">Data: <?= Check::TimesData($sac_mensagem['data']); ?> - <?= $sac_mensagem['hora']; ?> / <?= $cliente__['nome']; ?></p>
                  <div style=" float: right; background: #6494ED; color: #fff; padding: 2% 3%; margin-right: 1%; width: 100%; font-size: 0.9em;">
                    <?= $sac_mensagem['msn']; ?>
                    <?php
                    $ultimo->ExeRead('sac_arquivo', "WHERE id_sac_interacao = :id and id_sac = " . $sac_mensagem['id_sac'] . "", 'id=' . $sac_mensagem['id'] . '');
                    if ($ultimo->getRowCount() >= 1) :
                      echo '<p style=" font-weight: 900; font-size: 0.9em; margin-top: 2%; margin-bottom: 2%; border-bottom: 2px solid #fff">Arquivos Anexados:</p>';
                      foreach ($ultimo->getResult() as $sac_arquivo) :
                    ?>
                        <a style=" font-size: 0.9em; color: #fff;" href="<?= HOME; ?>imagens_site/<?= $sac_arquivo['arquivo']; ?>" target="_blank"><?= $sac_arquivo['token']; ?></a><br>
                    <?php
                      endforeach;
                    else :
                    endif;
                    ?>
                  </div>
                </div>
                <div class="box box10 no-margim">
                  <?php
                  if ($cliente__['avatar'] == '') :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
                  else :
                    echo '<img class="user_thumb radius-circulo" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $cliente__['avatar'] . '" default="' . HOME . 'imagens_site/' . $cliente__['avatar'] . '">';
                  endif;
                  ?>
                </div>
                <div class="limpar"></div>
              </div>
          <?php
            endif;

          endforeach;
          ?>
        </div>
        <div class="limpar"></div>
      </div>
      <?php
      if ($resultado['id_cliente_contato'] == '') :
      else :

        $c['mensagem'] = $variavel_x = file_get_contents(SAC . "email_integracao_at&value=" . base64_encode($id_sac_interacao) . "");

        $email_senha = array(
          "Assunto" => "Central de atendimento Casa dos Sites - Ticket ID: " . $id_sac, // Assunto do e-mail.
          "Mensagem" => $c['mensagem'], //Mensagem do e-mail pode ser em html.
          "RemetenteNome" => NOMECLIENTE, //Nome da pessoa que enviou.
          "RemetenteEmail" => EMAILATENDIMENTO, //E-mail da pessoa que enviou.
          "DestinoNone" => $cliente['nome'], //Nome da pessoa que vai receber.
          "DestinoEmail" => $cliente['email'] //Email da pessoa que esta recebendo.
        );

        $enviar_envio = sendMail($email_senha['Assunto'], $c['mensagem'], $email_senha['RemetenteEmail'], $email_senha['RemetenteNome'], $email_senha['DestinoEmail'], $email_senha['DestinoNone'], $email_senha['RemetenteEmail'], $replyNome = NULL, $anexo_pasta = NULL);
      endif;

      break;
    case 'selcat':
      $categoria = $_POST['empresa'];
      $igual = new Read;
      $igual->ExeRead('cliente_contato', 'WHERE id_cliente = :id ', "id=" . $categoria . "");
      if ($igual->getRowCount() >= 1) :
        foreach ($igual->getResult() as $resultado) :
          echo '<option value="' . $resultado['id'] . '">' . $resultado['nome'] . '</option>';
        endforeach;
      else :
        echo '<option value="">Não há contato cadastrado</option>';
      endif;
      break;
      //===============================================================================================================================
      // SISTEMA DE ARQUIVOS
      //===============================================================================================================================       
    case 'cad_arquivo':

      $c['nome'] = $_POST['nome'];
      $obs = $_POST['obs'];
      $c['id'] = $_POST['usuario'];
      $empresa = $_POST['id_cliente_vinculo'];

      if ($empresa == 'bb') :
        $empresa = '';
      endif;

      if (in_array('', $c)) :
        echo '3';
        exit();
      else :
        //print_r($_FILES['documento']);
        $type = explode(".", $_FILES['documento']['name']);
        $tipo = end($type);

        if (isset($_FILES['documento'])) :
          $upload = new Upload('../imagens_site/');
          $upload->File($_FILES['documento'], md5($c['nome'] . $hora . $tipo . $c['id']), 'zeropape');
          $foto = $upload->getResult();
        else :
          $foto = '';
        endif;
        $Dados = [
          'id_cliente_vinculo' => $empresa,
          'nome' => $c['nome'],
          'tamanho' => $_FILES['documento']['size'],
          'tipo' => $tipo,
          'data' => $dataStamp2,
          'hora' => $hora,
          'token' => md5($c['nome'] . $hora . $tipo . $c['id']),
          'obs' => $obs,
          'id_usuario' => $c['id'],
          'arquivo' => $foto,
        ];
        $Cadastra = new Create;
        $Cadastra->ExeCreate('arquivos', $Dados);
        if ($Cadastra->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;
    case 'id_arquivo_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('arquivos', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
      ?>
      <script>
        $("select").select2();
      </script>
      <form class="form_linha" method="post" name="Alt_arquivo" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar arquivo</h1>
        <div class="box box100" style=" width: 100%">
          <div class="box box50">
            <p class="texto_form">Nome</p>
            <input name="nome" type="text" required placeholder="Nome" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Empresa</p>
            <select name="id_cliente_vinculo" required class="select " style=" width: 100%;">
              <option <?= ($resultado['id_cliente_vinculo'] == '' ? "selected" : ""); ?> value="bb">Arquivo não vinculado há empresa ou cliente.</option>
              <?php
              $corretor = new Read;
              $corretor->ExeRead('cliente', 'WHERE status = "1"');
              if ($corretor->getRowCount() >= 1) :
                foreach ($corretor->getResult() as $examinado) :
                  echo ' <option ' . ($resultado['id_cliente_vinculo'] == $examinado['id'] ? "selected" : "") . ' value="' . $examinado['id'] . '">' . $examinado['nome'] . '</option> ';
                endforeach;
              else :
                echo ' <option value="">Não há empresa cadastrada!</option> ';
              endif;
              ?>
            </select>
          </div>
          <div class="limpar"></div>
          <p class="texto_form">Observações</p>
          <textarea name="obs" rows="5" placeholder="Observações" style=" width: 100%; height: 100px"><?= $resultado['obs']; ?></textarea>
          <div class="limpar"></div>
          <br>
          <p class="texto_form">Selecione um arquivo, Maximo de 100mb</p>
          <div class="box box25">
            <div class="limpar"></div>
            <label class="label_file" for='selecao-arquivo4'>Selecionar um arquivo</label>
            <input id='selecao-arquivo4' required type="file" name="documento" multiple class="" />
            <div class="limpar"></div>
          </div>
          <div class="box box30" style=" margin-left: 5%;">
            <a style=" font-size: 1.2em;" href="<?= HOME; ?>imagens_site/<?= $resultado['arquivo']; ?>" target="_blank">Arquivo Atual</a>

          </div>
        </div>

        <div class="limpar"></div>
        <br>
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
          <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
        </button>
      </form>
      <div class="limpar"></div>
    <?php
      break;
    case 'ex_arquivo':
      $c['id'] = $_POST['del'];

      $ultimo = new Read;
      $ultimo->ExeRead('arquivos', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
      unlink("../imagens_site/" . $resultado['arquivo']);
      $delete = new Delete;
      $delete->ExeDelete('arquivos', "WHERE id = :id", 'id=' . $c['id'] . '');
      if ($delete->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;
      break;

    case 'ver_agenda':
      echo $c['id'] = $_POST['id'];


      break;
      //===============================================================================================================================
      // ORIENTADOR
      //===============================================================================================================================         
    case 'cad_orientador':
      $c['nome'] = $_POST['nome'];
      $c['email'] = $_POST['email'];
      $senha = Check::NewPass('5', false, true, false);
      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('orientador', 'WHERE email = :id and nome = :id2', "id=" . $c['email'] . "&id2=" . $c['nome'] . "");
        if (!$igual->getRowCount() >= 1) :


          //VERIFICAR SE FOTO VOU ENVIADA E SALVANDO NO SERVIDOR(REDIMENSIONANDO E NOMINANDO)
          if (isset($_FILES['user_thumb'])) :

            $upload = new Upload('../imagens_site/');
            //-----------------imagem, nome, tamanho, pasta----------------//
            $upload->Image($_FILES['user_thumb'], md5($c['email']), '500', 'clientes', '500');
            $foto = $upload->getResult();
          else :
            $foto = '';
          endif;

          $dados = array(
            "nome" => $c['nome'],
            "ilmd" => '',
            "cpf" => '',
            "email" => $c['email'],
            "senha" => $senha,
            "arq_1" => '',
            "arq_2" => '',
            "arq_3" => '',
            "arq_4" => '',
            "arq_5" => '',
            "arq_6" => '',
            "arq_7" => '',
            "arq_8" => '',
            "arq_9" => '',
            "data" => $dataStamp2,
            "hora" => $hora,
            "status" => '1',
          );
          $Cadastra = new Create;
          $Cadastra->ExeCreate('orientador', $dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'modal_alunos':
      $c['id'] = $_POST['id'];
    ?>
      <div class="" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Lista de alunos cadastrados</h1>
        <div class="box_conteudo_ lista_atual_modal">
          <!--LISTA DE CADASTRADOS-->
          <?php
          $listagem = new Read;
          $listagem->ExeRead('aluno', 'where id_orientador = ' . $c['id'] . ' and status <> 3');
          if ($listagem->getRowCount() >= 1) :
          ?>
            <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
            <script type="text/javascript" src="<?= HOME; ?>js/sorttable.js"></script>
            <table class="lista_base_tabela sortable">
              <!--<caption></caption>-->
              <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                <th width="30%" style=" text-align: center; padding: 1%;">Nome</th>
                <th width="15%" style=" text-align: center; padding: 1%;">Curso</th>
                <th width="15%" style=" text-align: center; padding: 1%;">CPF</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Instituição</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Coeficiente</th>
                <th width="10%" style=" text-align: center; padding: 1%;">Status</th>
                <th width="1%" style="padding: 0%;"></th>
                <th width="1%" style="padding: 0%"></th>
              </tr>
              <div class="limpar"></div>
              <?php
              foreach ($listagem->getResult() as $listagem_) :
              ?>
                <tr class="lista_tabela">
                  <td width="30%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                  <td width="15%"><?= $listagem_['curso']; ?></td>
                  <td width="15%"><?= $listagem_['cpf']; ?></td>
                  <td width="10%"><?= $listagem_['faculdade']; ?></td>
                  <td width="10%"><?= $listagem_['cr']; ?></td>
                  <td width="10%">
                    <?php
                    if ($listagem_['status'] == '1') :
                    ?>
                      <p style=" color: green">Ativo</p>
                    <?php
                    else :
                    ?>
                      <p style=" color: red">Inativo</p>
                    <?php
                    endif;
                    ?>
                  </td>
                  <!-- <td width="1%">
                   <div class="btn btn_red excluir_modal" data-excluir="ex_usuario" id="<? //= $listagem_['id']; 
                                                                                        ?>" style="" data-balloon-length="small" data-balloon="Alterar status" data-balloon-pos="up">
                      <i class="fa fa-times icone-funcao"></i>
                   </div>
               </td> 
                <td width="2%"> 
                   <div class="btn btn_blue" id="<? //= $listagem_['id']; 
                                                  ?>" style=" " data-balloon-length="small" data-balloon="Alterar status" data-balloon-pos="up">
                      <i class="fas fa-exchange-alt"></i>
                   </div>
                </td>-->
                  <td width="2%">
                    <div class="id_usuario_alt btn btn_green" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Informações" data-balloon-pos="up">
                      <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                    </div>
                  </td>
                  <div class="limpar"></div>
                </tr>
            <?php
              endforeach;
            else :
              echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há alunos cadastrados!</center></div>';
            endif;
            ?>
            <div class="limpar"></div>
            </table>
            <br>
        </div>
        <div class="limpar"></div>
      </div>
    <?php
      break;
    case 'modal_coorientador':
      $c['id'] = $_POST['id'];
    ?>
      <div class="" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Lista de Co-Orientadores</h1>
        <div class="box_conteudo_ lista_atual_modal">
          <!--LISTA DE CADASTRADOS-->
          <?php
          $listagem = new Read;
          $listagem->ExeRead('co_orientador', 'where id_orientador = ' . $c['id'] . ' and status <> 3');
          if ($listagem->getRowCount() >= 1) :
          ?>
            <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
            <script type="text/javascript" src="<?= HOME; ?>js/sorttable.js"></script>
            <table class="lista_base_tabela sortable">
              <!--<caption></caption>-->
              <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                <th width="40%" style=" text-align: center; padding: 1%;">Declaração de Participação na Coautoria</th>
                <th width="40%" style=" text-align: center; padding: 1%;">Currículo Lattes do Co-autor</th>
              </tr>
              <div class="limpar"></div>
              <?php
              foreach ($listagem->getResult() as $listagem_) :
              ?>
                <tr class="lista_tabela">
                  <td width="40%">Ver arquivo</td>
                  <td width="40%">Ver arquivo</td>
                  <div class="limpar"></div>
                </tr>
            <?php
              endforeach;
            else :
              echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há Co-Orientadores cadastrados!</center></div>';
            endif;
            ?>
            <div class="limpar"></div>
            </table>
            <br>
        </div>
        <div class="limpar"></div>
      </div>
    <?php
      break;
    case 'cordenadores_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('orientador', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        jQuery(function($) {
          $("#mascara_celular22").mask("(99)999999999");
          $("#mascara_telefone22").mask("(99)999999999");
          $("#mascara_telefone222").mask("(99)999999999");
          $('#datacompleta2').datepicker({
            language: 'pt-BR',
            todayButton: new Date() // Now can select only dates, which goes after today
          });
        });
        $("select").select2();
      </script>

      <form class="form_linha" method="post" name="editar_orientador" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar orientador</h1>
        <div class="box box100">
          <div class="box box50">
            <p class="texto_form">Nome completo(Obrigatório)</p>
            <input name="nome" type="text" required placeholder="Nome completo" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">E-mail válido</p>
            <input name="email" type="email" placeholder="E-mail válido" value="<?= $resultado['email']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box33">
            <p class="texto_form">CPF(Obrigatório)</p>
            <input name="cpf" type="text" required placeholder="CPF ou CNPJ" style=" width: 100%;" value="<?= $resultado['cpf']; ?>" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' />
          </div>
          <div class="box box33">
            <p class="texto_form">Vínculo com o ILMD(Obrigatório)</p>
            <input name="ilmd" type="text" required placeholder="Vínculo com o ILMD" value="<?= $resultado['ilmd']; ?>" style=" width: 100%;" />
          </div>
          <div class="box box33">
            <p class="texto_form">Senha(Obrigatório)</p>
            <input name="senha" type="password" required placeholder="Senha" value="<?= $resultado['senha']; ?>" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Resumo do projeto do orientador(Obrigatório)</p>
            <?php
            if ($resultado['arq_1'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_1']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="box box50">
            <p class="texto_form">Parecer/protocolo do comitê de ética(Obrigatório)</p>
            <?php
            if ($resultado['arq_2'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_2']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Comprovante de patrimônio gen.e de conhecimento tradicional(SISGEN)</p>
            <?php
            if ($resultado['arq_3'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_3']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="box box50">
            <p class="texto_form">Autorização pelo sisbio de coleta de material biológico(Obrigatório)</p>
            <?php
            if ($resultado['arq_4'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_4']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Currículo na plataforma Lattes do CNPq(Obrigatório)</p>
            <?php
            if ($resultado['arq_5'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_5']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="box box50">
            <p class="texto_form">Cadastros atualizados do orientador no banco da FAPEAM(Obrigatório)</p>
            <?php
            if ($resultado['arq_6'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_6']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Cadastro do orientador em grupo de pesquisa ILMD(Obrigatório)</p>
            <?php
            if ($resultado['arq_7'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_7']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="box box50">
            <p class="texto_form">Declaração de participação na orientação(Obrigatório)</p>
            <?php
            if ($resultado['arq_8'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_8']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Avaliação do orientador(no caso de renovação assinada), assinada(Obrigatório)</p>
            <?php
            if ($resultado['arq_9'] <> '') :
            ?>
              <a href="<?= HOME; ?>imagens_site/<?= $resultado['arq_9']; ?>" target="_blank">Ver arquivo</a>
            <?php
            else :
              echo 'Arquivo não enviado';
            endif;
            ?>
          </div>

          <div class="limpar"></div>
          <br><br>
          <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%;">
            <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
          </button>
        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="editar_orientador" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>

        <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'editar_orientador':

      $c['nome'] = $_POST['nome'];
      $email = $_POST['email'];
      $c['cpf'] = $_POST['cpf'];
      $c['ilmd'] = $_POST['ilmd'];
      $c['senha'] = $_POST['senha'];
      $id = $_POST['id'];

      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('orientador', 'WHERE id = :id', "id=" . $id . "");
        foreach ($igual->getResult() as $resultado);

        $dados = array(
          "nome" => $c['nome'],
          "ilmd" => $c['ilmd'],
          "cpf" => $c['cpf'],
          "email" => $email,
          "senha" => $c['senha'],
        );
        $updade = new Update;
        $updade->ExeUpdate('orientador', $dados, "WHERE id = :id", "id=" . $id . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;

    case 'del_orientador':
      $c['id'] = $_POST['del'];
      if (in_array('', $c)) :
        echo '3';
      else :

        $Dados = [
          'status' => '3',
        ];

        $updade = new Update;
        $updade->ExeUpdate('orientador', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      endif;
      break;


    case 'alterar_orientador':
      $c['nome'] = $_POST['nome'];
      $c['ilmd'] = $_POST['ilmd'];
      $c['cpf'] = $_POST['cpf'];
      $c['id'] = $_POST['id'];
      $c['email'] = $_POST['email'];
      $c['senha'] = $_POST['senha'];

      $ultimo = new Read;
      $ultimo->ExeRead('orientador', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      if (isset($_FILES['user_thumb'])) :
        if ($_FILES['user_thumb']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb'], md5($dataHora . 'user_thumb'), 'arquivos');
        $foto = $upload->getResult();
      else :
        $foto = $resultado["arq_1"];
      endif;


      if (isset($_FILES['user_thumb2'])) :

        if ($_FILES['user_thumb2']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb2'], md5($dataHora . 'user_thumb2'), 'arquivos');
        $foto2 = $upload->getResult();
      else :
        $foto2 = $resultado["arq_2"];
      endif;

      if (isset($_FILES['user_thumb3'])) :

        if ($_FILES['user_thumb3']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb3'], md5($dataHora . 'user_thumb3'), 'arquivos');
        $foto3 = $upload->getResult();
      else :
        $foto3 = $resultado["arq_3"];
      endif;

      if (isset($_FILES['user_thumb4'])) :

        if ($_FILES['user_thumb4']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb4'], md5($dataHora . 'user_thumb4'), 'arquivos');
        $foto4 = $upload->getResult();
      else :
        $foto4 = $resultado["arq_4"];
      endif;

      if (isset($_FILES['user_thumb5'])) :

        if ($_FILES['user_thumb5']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb5'], md5($dataHora . 'user_thumb5'), 'arquivos');
        $foto5 = $upload->getResult();
      else :
        $foto5 = $resultado["arq_5"];
      endif;

      if (isset($_FILES['user_thumb6'])) :

        if ($_FILES['user_thumb6']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb6'], md5($dataHora . 'user_thumb6'), 'arquivos');
        $foto6 = $upload->getResult();
      else :
        $foto6 = $resultado["arq_6"];
      endif;

      if (isset($_FILES['user_thumb7'])) :

        if ($_FILES['user_thumb7']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb7'], md5($dataHora . 'user_thumb7'), 'arquivos');
        $foto7 = $upload->getResult();
      else :
        $foto7 = $resultado["arq_7"];
      endif;

      if (isset($_FILES['user_thumb8'])) :

        if ($_FILES['user_thumb8']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb8'], md5($dataHora . 'user_thumb8'), 'arquivos');
        $foto8 = $upload->getResult();
      else :
        $foto8 = $resultado["arq_8"];
      endif;

      // if (isset($_FILES['user_thumb9'])) :   
      // $upload = new Upload('../imagens_site/');
      // $upload->File($_FILES['user_thumb9'], md5($dataHora . 'user_thumb9'), 'arquivos');
      //$foto9 = $upload->getResult();
      // else :
      // $foto9 = $resultado["arq_9"];
      //endif;

      $dados = array(
        "nome" => $c['nome'],
        "ilmd" => $c['ilmd'],
        "cpf" => $c['cpf'],
        "email" => $c['email'],
        "senha" => $c['senha'],
        "arq_1" => $foto,
        "arq_2" => $foto2,
        "arq_3" => $foto3,
        "arq_4" => $foto4,
        "arq_5" => $foto5,
        "arq_6" => $foto6,
        "arq_7" => $foto7,
        "arq_8" => $foto8,
        //"arq_9" => $foto9,
      );
      $updade = new Update;
      $updade->ExeUpdate('orientador', $dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;

      break;




















    case 'cad_alunos':
      $c['nome'] = $_POST['nome'];
      $c['curso'] = $_POST['curso'];
      $c['faculdade'] = $_POST['faculdade'];
      $c['cpf'] = $_POST['cpf'];
      $c['cr'] = $_POST['cr'];
      $c['tipo'] = $_POST['tipo'];
      $c['id'] = $_POST['id'];

      $nomecoo = $_POST['nomecoo'];

      if (isset($_POST['cooo'])) :
        $cooo = $_POST['cooo'];
      else :
        $cooo = "";
      endif;

      $opcao = $_POST['opcao'];
      //$c['email'] = $_POST['email'];
      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        $upload = new Upload('../imagens_site/');

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        // $igual = new Read;
        // $igual->ExeRead('aluno', 'WHERE cpf = :id and nome = :id2 and status = 1', "id=" . $c['cpf'] . "&id2=" . $c['nome'] . "");
        // if (!$igual->getRowCount() >= 1) :

          if (isset($_FILES['user_thumb'])) :
            $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb'], md5($dataHora . 'user_thumb'), 'arquivos');
            $foto = $upload->getResult();
          else :
            $foto = "";
          endif;


        //print_r($_FILES['envio_01']);

        if (isset($_FILES['enviando'])) :

          //print_r($_FILES['enviando']);

            if ($_FILES['enviando']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['enviando'], md5($dataHora . 'enviando'), 'arquivos');
            $foto19 = $upload->getResult();
          else :
            $foto19 = "";
          endif;

//print_r($_FILES['envio_02']);

        if (isset($_FILES['envio_02'])) :
          //print_r($_FILES['envio_02']);
          if ($_FILES['envio_02']['type'] == 'application/pdf') :
          else :
            echo '11';
            exit();
            break;
          endif;
          //$upload = new Upload('../imagens_site/');
          $upload->File($_FILES['envio_02'], md5($dataHora . 'envio_02'), 'arquivos');
          $foto21 = $upload->getResult();
        else :
          $foto21 = "";
        endif;


          if (isset($_FILES['user_thumb2'])) :

            if ($_FILES['user_thumb2']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb2'], md5($dataHora . 'user_thumb2'), 'arquivos');
            $foto2 = $upload->getResult();
          else :
            $foto2 = "";
          endif;

          if (isset($_FILES['user_thumb3'])) :

            if ($_FILES['user_thumb3']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb3'], md5($dataHora . 'user_thumb3'), 'arquivos');
            $foto3 = $upload->getResult();
          else :
            $foto3 = "";
          endif;

          if (isset($_FILES['user_thumb4'])) :

            if ($_FILES['user_thumb4']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb4'], md5($dataHora . 'user_thumb4'), 'arquivos');
            $foto4 = $upload->getResult();
          else :
            $foto4 = "";
          endif;

          if (isset($_FILES['user_thumb5'])) :

            if ($_FILES['user_thumb5']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb5'], md5($dataHora . 'user_thumb5'), 'arquivos');
            $foto5 = $upload->getResult();
          else :
            $foto5 = "";
          endif;

          if (isset($_FILES['user_thumb6'])) :

            if ($_FILES['user_thumb6']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb6'], md5($dataHora . 'user_thumb6'), 'arquivos');
            $foto6 = $upload->getResult();
          else :
            $foto6 = "";
          endif;

          if (isset($_FILES['user_thumb7'])) :

            if ($_FILES['user_thumb7']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb7'], md5($dataHora . 'user_thumb7'), 'arquivos');
            $foto7 = $upload->getResult();
          else :
            $foto7 = "";
          endif;

          if (isset($_FILES['user_thumb8'])) :

            if ($_FILES['user_thumb8']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb8'], md5($dataHora . 'user_thumb8'), 'arquivos');
            $foto8 = $upload->getResult();
          else :
            $foto8 = "";
          endif;

          if (isset($_FILES['user_thumb9'])) :

            //if ($_FILES['user_thumb9']['type'] == 'application/pdf') :
            //else :
            //  echo '11';
            //  exit();
            //  break;
            // endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb9'], md5($dataHora . 'user_thumb9'), 'arquivos');
            $foto9 = $upload->getResult();
          else :
            $foto9 = "";
          endif;


          if (isset($_FILES['user_thumb10'])) :

            if ($_FILES['user_thumb10']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb10'], md5($dataHora . 'user_thumb10'), 'arquivos');
            $foto10 = $upload->getResult();
          else :
            $foto10 = "";
          endif;

          if (isset($_FILES['user_thumb11'])) :

            if ($_FILES['user_thumb11']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb11'], md5($dataHora . 'user_thumb11'), 'arquivos');
            $foto11 = $upload->getResult();
          else :
            $foto11 = "";
          endif;

          if (isset($_FILES['user_thumb12'])) :

            if ($_FILES['user_thumb12']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb12'], md5($dataHora . 'user_thumb12'), 'arquivos');
            $foto12 = $upload->getResult();
          else :
            $foto12 = "";
          endif;

          if (isset($_FILES['user_thumb13'])) :

            if ($_FILES['user_thumb13']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
           // $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb13'], md5($dataHora . 'user_thumb13'), 'arquivos');
            $foto13 = $upload->getResult();
          else :
            $foto13 = "";
          endif;


          if (isset($_FILES['user_thumb14'])) :

            if ($_FILES['user_thumb14']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb14'], md5($dataHora . 'user_thumb14'), 'arquivos');
            $foto14 = $upload->getResult();
          else :
            $foto14 = "";
          endif;

          if (isset($_FILES['user_thumb15'])) :

            if ($_FILES['user_thumb15']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb15'], md5($dataHora . 'user_thumb15'), 'arquivos');
            $foto15 = $upload->getResult();
          else :
            $foto15 = "";
          endif;


          if (isset($_FILES['user_thumb16'])) :

            if ($_FILES['user_thumb16']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb16'], md5($dataHora . 'user_thumb16'), 'arquivos');
            $foto16 = $upload->getResult();
          else :
            $foto16 = "";
          endif;


          if (isset($_FILES['user_thumb17'])) :

            if ($_FILES['user_thumb17']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
           // $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb17'], md5($dataHora . 'user_thumb17'), 'arquivos');
            $foto17 = $upload->getResult();
          else :
            $foto17 = "";
          endif;

          if (isset($_FILES['user_thumb18'])) :

            if ($_FILES['user_thumb18']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;
           // $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb18'], md5($dataHora . 'user_thumb18'), 'arquivos');
            $foto18 = $upload->getResult();
          else :
            $foto18 = "";
          endif;

        
          if (isset($_FILES['user_thumb20'])) :

            //if ($_FILES['user_thumb20']['type'] == 'application/pdf') :
            //else :
            //  echo '11';
            //  exit();
            //  break;
            //endif;
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb20'], md5($dataHora . 'user_thumb20'), 'arquivos');
            $foto20 = $upload->getResult();
          else :
            $foto20 = "";
          endif;

          

          if (isset($_FILES['arq_ori1'])) :
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['arq_ori1'], md5($dataHora . 'arq_ori1'), 'arquivos');
            $fotoo10 = $upload->getResult();
          else :
            $fotoo10 = "";
          endif;

          if (isset($_FILES['arq_ori2'])) :
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['arq_ori2'], md5($dataHora . 'arq_ori2'), 'arquivos');
            $fotoo11 = $upload->getResult();
          else :
            $fotoo11 = "";
          endif;

          if (isset($_FILES['arq_ori3'])) :
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['arq_ori3'], md5($dataHora . 'arq_ori3'), 'arquivos');
            $fotoo12 = $upload->getResult();
          else :
            $fotoo12 = "";
          endif;

          if (isset($_FILES['arq_ori4'])) :
            //$upload = new Upload('../imagens_site/');
            $upload->File($_FILES['arq_ori4'], md5($dataHora . 'arq_ori4'), 'arquivos');
            $fotoo13 = $upload->getResult();
          else :
            $fotoo13 = "";
          endif;


          $dados = array(
            "id_orientador" => $c['id'],
            "id_co_orientador" => "",
            "nome" => $c['nome'],
            "curso" => $c['curso'],
            "faculdade" => $c['faculdade'],
            "cpf" => $c['cpf'],
            "cr" => $c['cr'],
            "tipo" => $c['tipo'],
            "arq_1" => $foto9,
            "arq_2" => $foto10,
            "arq_3" => $foto11,
            "arq_4" => $foto12,
            "arq_5" => $foto13,
            "arq_6" => $foto14,
            "arq_7" => $foto15,
            "arq_8" => $foto16,
            "arq_9" => $foto17,
            "data" => $dataStamp2,
            "hora" => $hora,
            "status" => '1',
            "block" => '1',
            "arq_ori1" => $fotoo10,
            "arq_ori2" => $fotoo11,
            "arq_ori3" => $fotoo12,
            "arq_ori4" => $fotoo13,
            "arq_ori5" => $foto,
            "arq_ori6" => $foto2,
            "arq_ori7" => $foto3,
            "arq_ori8" => $foto4,
            "arq_ori9" => $foto5,
            "arq_ori10" => $foto6,
            "arq_ori11" => $foto7,
            "arq_ori12" => $foto8,
            "nome_coorientado" => $nomecoo,
            "arq_co" => $foto18,
            "arq_co2" => $foto19,
            "arq_co3" => $foto20,
            "arq_co4" => $foto21,
          );
          $Cadastra = new Create;
          $Cadastra->ExeCreate('aluno', $dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        //else :
         // echo '4';
      //  endif;
      endif;
      break;
    case 'ex_aluno':
      $c['id'] = $_POST['del'];

      if (in_array('', $c)) {
        echo '3';
      } else {
        $Dados = [
          'status' => '2',
        ];

        $updade = new Update;
        $updade->ExeUpdate('aluno', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      }
      break;
    case 'id_aluno_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('aluno', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <script>
        $("#mascara_cpf").mask("999.999.999-99");
        $("select").select2();
      </script>
      <form class="form_linha" method="post" name="editar_aluno" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar informações do aluno</h1>
        <div class="box box100">
          <div class="box box100">
            <div class="box box33">
              <p class="texto_form">Nome completo do estudante (obrigatório)</p>
              <input name="nome" type="text" required placeholder="Nome completo" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
            </div>
            <div class="box box33">
              <p class="texto_form">Curso (obrigatório)</p>
              <input name="curso" type="text" required placeholder="Curso" value="<?= $resultado['curso']; ?>" style=" width: 100%;" />
            </div>
            <div class="box box33 no-margim">
              <p class="texto_form">Instituição de ensino (obrigatório)</p>
              <input name="faculdade" type="text" required placeholder="Instituição de ensino" value="<?= $resultado['faculdade']; ?>" style=" width: 100%;" />
            </div>
            <div class="limpar"></div>

            <div class="box box33">
              <p class="texto_form">CPF (obrigatório)</p>
              <input name="cpf" type="text" placeholder="CPF" autocomplete="off" value="<?= $resultado['cpf']; ?>" style=" width: 100%;" id="mascara_cpf" />
            </div>
            <div class="box box33">
              <p class="texto_form">Coeficiente de Rendimento(CR)</p>
              <input name="cr" type="text" placeholder="Coeficiente de Rendimento(CR)" value="<?= $resultado['cr']; ?>" id="" style=" width: 100%;" />
            </div>
            <div class="box box33 no-margim seleciomne">
              <p class="texto_form">Tipo</p>
              <select class="seletipo2" name="tipo" style=" width: 100%;">
                <option <?= ($resultado['tipo'] == "1" ? "selected" : ""); ?> value="1">Aluno Novo</option>
                <option <?= ($resultado['tipo'] == "2" ? "selected" : ""); ?> value="2">Renovação</option>
              </select>
            </div>
            <div class="limpar"></div>
            <?php
            if ($resultado['tipo'] == '2') :
            ?>
              <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;">

                <h1 style=" text-align: left; font-size: 1.4em; margin-bottom: 2%">Informações extras para renovação </h1>
                <div class="box box50">
                  <p class="texto_form">Comprovante de patrimônio genético e de conhecimento tradicional(SISGEN)</p>
                  <input type="file" name="arq_ori1" class="" style="display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                  <?php if ($resultado["arq_ori1"] == "") : ?>
                    <p class="texto_form" style=" color: red">Arquivo não enviado</p>
                  <?php else : ?>
                    <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori1"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
                  <?php endif; ?>
                </div>
                <div class="box box50 no-margim">
                  <p class="texto_form">Parecer/protocolo do comitê de ética(CEP)</p>
                  <input type="file" name="arq_ori2" class="" style="display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                  <?php if ($resultado["arq_ori2"] == "") : ?>
                    <p class="texto_form" style=" color: red">Arquivo não enviado</p>
                  <?php else : ?>
                    <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori2"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
                  <?php endif; ?>
                </div>
              </div>
              <div class="box box50">
                <p class="texto_form">Autorização pelo SISBIO de coleta de material biolôgico</p>
                <input type="file" name="arq_ori3" class="" style="display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                <?php if ($resultado["arq_ori3"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori3"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
                <?php endif; ?>
              </div>
              <div class="box box50 no-margim">
                <p class="texto_form">Avaliação do orientador(no caso de renovação), assinada (obrigatório)</p>
                <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                <input id='' type="file" name="arq_ori4" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                <div class="limpar"></div>
                <?php if ($usuario_["arq_ori4"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $usuario_["arq_ori4"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
                <?php endif; ?>
              </div>

              <div class="limpar"></div>
          </div>
        <?php
            else :
        ?>
          <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;">

          </div>
        <?php
            endif;
        ?>
        <div class="limpar"></div>
        <div class="box box50">
          <p class="texto_form">Projeto do aluno detalhado (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_1"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_1"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="box box50 no-margim">
          <p class="texto_form">Currículo na plataforma Lattes do CNPq (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb2" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_2"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_2"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="limpar"></div>

        <div class="box box50">
          <p class="texto_form">Cadastro atualizado do candidato no bando de pesquisa da FAPEAM (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb3" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_3"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_3"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="box box50 no-margim">
          <p class="texto_form">História escolar de graduação atualização (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb4" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_4"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_4"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="limpar"></div>

        <div class="box box50">
          <p class="texto_form">Comprovante de matrícula atualizado (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb5" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_5"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_5"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="box box50 no-margim">
          <p class="texto_form">Cópia do CPF do candidato (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb6" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_6"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_6"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="limpar"></div>

        <div class="box box50">
          <p class="texto_form">Cópia da carteira de indentidade do candidato (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb7" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_7"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_7"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="box box50 no-margim">
          <p class="texto_form">Cópia do comprovante de residencia do candidato (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb8" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_8"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_8"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="box box50">
          <p class="texto_form">Declaração negativa de vinculo empregaticio (obrigatório)</p>
          <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
          <input id='' type="file" name="user_thumb9" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          <div class="limpar"></div>
          <?php if ($resultado["arq_9"] == "") : ?>
            <p class="texto_form" style=" color: red">Arquivo não enviado</p>
          <?php else : ?>
            <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_9"]; ?>" style=" color: black" target="_blank">Verificar arquivo</a>
          <?php endif; ?>
        </div>
        <div class="limpar"></div>
        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
        <input type="hidden" name="acao" value="editar_aluno" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 9%;">
          <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
        </button>
        <div class="limpar"></div>
      </form>
    <?php
      break;

    case 'ver_cadastro':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('aluno', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>

      <form class="form_linha" method="post" name="editar_aluno" enctype="multipart/form-data">
        <h1 class="topo_modal">Informações do aluno</h1>
        <div class="box box100">
          <div class="box box100">
            <div class="box box33">
              <p class="texto_form">Nome completo do estudante (obrigatório)</p>
              <?= $resultado['nome']; ?>
            </div>
            <div class="box box33">
              <p class="texto_form">Curso (obrigatório)</p>
              <?= $resultado['curso']; ?>
            </div>
            <div class="box box33 no-margim">
              <p class="texto_form">Instituição de ensino (obrigatório)</p>
              <?= $resultado['faculdade']; ?>
            </div>
            <div class="limpar"></div>

            <div class="box box33">
              <p class="texto_form">CPF (obrigatório)</p>
              <?= $resultado['cpf']; ?>
            </div>
            <div class="box box33">
              <p class="texto_form">Coeficiente de Rendimento(CR)</p>
              <?= $resultado['cr']; ?>
            </div>
            <div class="box box33 no-margim seleciomne">
              <p class="texto_form">Tipo</p>
              <?= ($resultado['tipo'] == "1" ? "Aluno Novo" : "Renovação"); ?>
            </div>
            <div class="limpar"></div>
            <br>
            <?php
            if ($resultado['tipo'] == '2') :
            ?>
              <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;">

              <h1 style=" text-align: left; font-size: 1.4em; margin-bottom: 2%">Informações extras para renovação </h1>
              <div class="box box100">
                <p class="texto_form">Avaliação do orientador(no caso de renovação), assinada (obrigatório)</p>
                <div class="limpar"></div>
                <?php if ($resultado["arq_ori4"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori4"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
              </div>

              <div class="limpar"></div>
          </div>
        <?php
            else :
        ?>
          <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;">

          </div>
        <?php
            endif;
        ?>
        <div class="limpar"></div>
        <!--cordenador-->
        <div class="box box50">
          <h1 class="topo_modal" style=" background: #1753ea;">Cadastro do Orientador</h1>
          <div class="box box100">
            <p class="texto_form">Resumo do projeto do orientador <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori5"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori5"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Parecer/protocolo do Comitê de Ética (CEP) <font color=red>*</font>
            </p>
             <?php if ($resultado["arq_ori6"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori6"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Comprovante de patrimônio Genético e de conhecimento tradicional (SISGEN) </p>
            <?php if ($resultado["arq_ori7"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori7"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Autorização pelo SISBIO de coleta de material biológico <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori8"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori8"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori9"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori9"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Cadastro atualizado no banco de pesquisa da FAPEAM <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori10"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori10"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Cadastro do orientador em grupo de pesquisa do ILMD <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori11"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori11"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Declaração de participação na orientação do aluno <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_ori12"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_ori12"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
          <div class="limpar"></div>
        </div>
        <!-- aluno -->
        <div class="box box50 no-margim">
          <h1 class="topo_modal">Cadastro do Aluno</h1>
          <div class="box box100">
            <p class="texto_form">Projeto de aluno detalhado em .DOC ou DOCX <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_co3"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_co3"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Declaração de responsabilidade na orientação do aluno. <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_2"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_2"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_co4"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_co4"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Cadastro atualizado do candidato no banco de pesquisa da FAPEAM <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_3"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_3"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
          <div class="box box100">
            <p class="texto_form">Histórico escolar de graduação atualizado <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_4"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_4"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Comprovante de matrícula atualizado <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_5"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_5"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
          <div class="box box100">
            <p class="texto_form">Cópia do CPF e carteira de identidade do candidato <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_6"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_6"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <!--<div class="box box100">
            <p class="texto_form">Cópia da carteira de identidade do candidato <font color=red>*</font>
            </p>
            <?php //if ($resultado["arq_7"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php //else : ?>
                  <a href="<?//= HOME; ?>imagens_site/<?//= $resultado["arq_7"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php //endif; ?>
          </div> -->
          
          <div class="box box100">
            <p class="texto_form">Cópia do comprovante de residência do candidato <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_8"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_8"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
          <div class="box box100">
            <p class="texto_form">Declaração negativa de vínculo empregatício <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_9"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_9"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
        </div>
        <div class="limpar"></div>
        <br>
        <!--Co-orientado-->
        <div class="box box100">
          <h1 class="topo_modal" style=" background: #9915a3;">Informações do Co-orientador</h1>

          <div class="box box100">
            <p class="texto_form">Nome completo <font color=red>*</font>
            </p>
            <?php if ($resultado["nome_coorientado"] == "") : ?>
                  <p class="texto_form" style=" color: red">Não enviado!</p>
                <?php else : ?>
                 <?=$resultado["nome_coorientado"];?>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Declaração de partipação na coautoria <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_co"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_co"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>

          <div class="box box100">
            <p class="texto_form">Currículo lattes do coautor <font color=red>*</font>
            </p>
            <?php if ($resultado["arq_co2"] == "") : ?>
                  <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
                <?php else : ?>
                  <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_co2"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
                <?php endif; ?>
          </div>
        </div>
        <br>
        <div class="limpar"></div>
      </div>

        <div class="limpar"></div>
        <br>
        <div class="limpar"></div>
      </form>
    <?php
      break;


    case 'editar_aluno':
      $c['nome'] = $_POST['nome'];
      $c['curso'] = $_POST['curso'];
      $c['faculdade'] = $_POST['faculdade'];
      $c['cpf'] = $_POST['cpf'];
      $c['cr'] = $_POST['cr'];
      $c['tipo'] = $_POST['tipo'];
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('aluno', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      if (isset($_FILES['user_thumb'])) :
        if ($_FILES['user_thumb']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb'], md5($dataHora . 'user_thumb'), 'arquivos');
        $foto = $upload->getResult();
      else :
        $foto = $resultado["arq_1"];
      endif;


      if (isset($_FILES['user_thumb2'])) :

        if ($_FILES['user_thumb2']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb2'], md5($dataHora . 'user_thumb2'), 'arquivos');
        $foto2 = $upload->getResult();
      else :
        $foto2 = $resultado["arq_2"];
      endif;

      if (isset($_FILES['user_thumb3'])) :

        if ($_FILES['user_thumb3']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb3'], md5($dataHora . 'user_thumb3'), 'arquivos');
        $foto3 = $upload->getResult();
      else :
        $foto3 = $resultado["arq_3"];
      endif;

      if (isset($_FILES['user_thumb4'])) :

        if ($_FILES['user_thumb4']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb4'], md5($dataHora . 'user_thumb4'), 'arquivos');
        $foto4 = $upload->getResult();
      else :
        $foto4 = $resultado["arq_4"];
      endif;

      if (isset($_FILES['user_thumb5'])) :

        if ($_FILES['user_thumb5']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb5'], md5($dataHora . 'user_thumb5'), 'arquivos');
        $foto5 = $upload->getResult();
      else :
        $foto5 = $resultado["arq_5"];
      endif;

      if (isset($_FILES['user_thumb6'])) :

        if ($_FILES['user_thumb6']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb6'], md5($dataHora . 'user_thumb6'), 'arquivos');
        $foto6 = $upload->getResult();
      else :
        $foto6 = $resultado["arq_6"];
      endif;

      if (isset($_FILES['user_thumb7'])) :

        if ($_FILES['user_thumb7']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb7'], md5($dataHora . 'user_thumb7'), 'arquivos');
        $foto7 = $upload->getResult();
      else :
        $foto7 = $resultado["arq_7"];
      endif;

      if (isset($_FILES['user_thumb8'])) :

        if ($_FILES['user_thumb8']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb8'], md5($dataHora . 'user_thumb8'), 'arquivos');
        $foto8 = $upload->getResult();
      else :
        $foto8 = $resultado["arq_8"];
      endif;

      if (isset($_FILES['user_thumb9'])) :

        // if ($_FILES['user_thumb9']['type'] == 'application/pdf') :
        // else :
        //   echo '11';
        //   exit();
        //   break;
        // endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb9'], md5($dataHora . 'user_thumb9'), 'arquivos');
        $foto9 = $upload->getResult();
      else :
        $foto9 = $resultado["arq_9"];
      endif;

      $dados = array(
        // "id_orientador" => $c['id'],
        // "id_co_orientador" => "",
        "nome" => $c['nome'],
        "curso" => $c['curso'],
        "faculdade" => $c['faculdade'],
        "cpf" => $c['cpf'],
        "cr" => $c['cr'],
        "tipo" => $c['tipo'],
        "arq_1" => $foto,
        "arq_2" => $foto2,
        "arq_3" => $foto3,
        "arq_4" => $foto4,
        "arq_5" => $foto5,
        "arq_6" => $foto6,
        "arq_7" => $foto7,
        "arq_8" => $foto8,
        "arq_9" => $foto9,
        //"data" => $dataStamp2,
        //"hora" => $hora,
        //"status" => '1',
      );
      $updade = new Update;
      $updade->ExeUpdate('aluno', $dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;

      break;


    case 'cad_coorientador':
      $nome = $_POST['nome'];
      $c['id'] = $_POST['id'];
      $cooo = $_POST['id'];
      //$c['email'] = $_POST['email'];
      //VERICIAR CAMPOS VAZIOS
      if (in_array('', $c)) :
        echo '3';
      else :

        //VERIFICANDO SE JÁ ESTA CADASTRADO
        $igual = new Read;
        $igual->ExeRead('co_orientador', 'WHERE id_aluno = :id2 and status = 1', "id2=" . $c['id'] . "");
        if (!$igual->getRowCount() >= 1) :


          if (isset($_FILES['user_thumb'])) :
            if ($_FILES['user_thumb']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb'], md5($dataHora . 'user_thumb'), 'arquivos');
            $foto = $upload->getResult();
          else :
            $foto = "";
          endif;


          if (isset($_FILES['user_thumb2'])) :

            if ($_FILES['user_thumb2']['type'] == 'application/pdf') :
            else :
              echo '11';
              exit();
              break;
            endif;

            $upload = new Upload('../imagens_site/');
            $upload->File($_FILES['user_thumb2'], md5($dataHora . 'user_thumb2'), 'arquivos');
            $foto2 = $upload->getResult();
          else :
            $foto2 = "";
          endif;

          $Dados = [
            'block' => '1',
          ];

          $updade = new Update;
          $updade->ExeUpdate('aluno', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");

          $dados = array(
            "id_orientador" => '',
            "nome" => $nome,
            "arq_1" => $foto,
            "arq_2" => $foto2,
            "data" => $dataStamp2,
            "hora" => $hora,
            "status" => '1',
            "id_aluno" => $c['id'],
          );
          $Cadastra = new Create;
          $Cadastra->ExeCreate('co_orientador', $dados);
          if ($Cadastra->getResult()) :
            echo '1';
          else :
            echo '2';
          endif;
        else :
          echo '4';
        endif;
      endif;
      break;
    case 'ex_coorientador':
      $c['id'] = $_POST['del'];

      if (in_array('', $c)) {
        echo '3';
      } else {
        $Dados = [
          'status' => '2',
        ];

        $updade = new Update;
        $updade->ExeUpdate('co_orientador', $Dados, "WHERE id = :id", "id=" . $c['id'] . "");
        if ($updade->getResult()) :
          echo '1';
        else :
          echo '2';
        endif;
      }
      break;
    case 'id_coorientador_alt':
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('co_orientador', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);
    ?>
      <form class="form_linha" method="post" name="editar_coorientador" enctype="multipart/form-data">
        <h1 class="topo_modal">Alterar informações do Co-cordenador</h1>
        <div class="box box100">
          <div class="box box100">
            <div class="box box100">
              <p class="texto_form">Nome completo (obrigatório)</p>
              <input name="nome" type="text" required placeholder="Nome completo" value="<?= $resultado['nome']; ?>" style=" width: 100%;" />
            </div>
            <div class="limpar"></div>
            <div class="box box50">
              <p class="texto_form">Declaração de partipação na coautoria (obrigatório)</p>
              <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
              <input id='' type="file" name="user_thumb" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
              <div class="limpar"></div>
              <?php if ($resultado["arq_1"] == "") : ?>
                <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
              <?php else : ?>
                <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_1"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
              <?php endif; ?>
            </div>
            <div class="box box50 no-margim">
              <p class="texto_form">Currículo lattes do co-autor (obrigatório)</p>
              <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
              <input id='' type="file" name="user_thumb2" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
              <div class="limpar"></div>
              <?php if ($resultado["arq_2"] == "") : ?>
                <p class="texto_form" style=" color: red">Arquivo não enviado!</p>
              <?php else : ?>
                <a href="<?= HOME; ?>imagens_site/<?= $resultado["arq_2"]; ?>" style=" color: red" target="_blank">Verificar arquivo!</a>
              <?php endif; ?>
            </div>
            <div class="limpar"></div>
          </div>

          <div class="limpar"></div>
          <br>
          <input type="hidden" name="id" value="<?= $resultado['id']; ?>" />
          <input type="hidden" name="acao" value="editar_coorientador" />
          <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
          <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%; width: 9%;">
            <figure class="icon-pencil-square-o" style="margin-top: -4%;"></figure> Alterar
          </button>
          <div class="limpar"></div>
      </form>
    <?php
      break;
    case 'editar_coorientador':
      $c['nome'] = $_POST['nome'];
      $c['id'] = $_POST['id'];

      $ultimo = new Read;
      $ultimo->ExeRead('co_orientador', "WHERE id = :id", 'id=' . $c['id'] . '');
      foreach ($ultimo->getResult() as $resultado);

      if (isset($_FILES['user_thumb'])) :
        if ($_FILES['user_thumb']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb'], md5($dataHora . 'user_thumb'), 'arquivos');
        $foto = $upload->getResult();
      else :
        $foto = $resultado["arq_1"];
      endif;


      if (isset($_FILES['user_thumb2'])) :

        if ($_FILES['user_thumb2']['type'] == 'application/pdf') :
        else :
          echo '11';
          exit();
          break;
        endif;

        $upload = new Upload('../imagens_site/');
        $upload->File($_FILES['user_thumb2'], md5($dataHora . 'user_thumb2'), 'arquivos');
        $foto2 = $upload->getResult();
      else :
        $foto2 = $resultado["arq_2"];
      endif;



      $dados = array(
        "nome" => $c['nome'],
        "arq_1" => $foto,
        "arq_2" => $foto2,
      );
      $updade = new Update;
      $updade->ExeUpdate('co_orientador', $dados, "WHERE id = :id", "id=" . $c['id'] . "");
      if ($updade->getResult()) :
        echo '1';
      else :
        echo '2';
      endif;

      break;


    case 'cad_cordenador':
      $c['id'] = $_POST['id'];
    ?>
      <h1 class="topo_modal">Cadastra Co-orientadores</h1>
      <form class="form_linha" method="post" name="cad_coorientador">
        <div class="box box100">

          <INPUT TYPE="checkbox" NAME="cooo" VALUE="1" required style=" margin-top: -0.5%; margin-right: 1%">O projeto não possui coorientador

          <div class="box box100">
            <p class="texto_form">Nome completo (obrigatório)</p>
            <input name="nome" type="text" placeholder="Nome completo" style=" width: 100%;" />
          </div>
          <div class="limpar"></div>
          <div class="box box50">
            <p class="texto_form">Declaração de partipação na coautoria (obrigatório)</p>
            <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
            <input id='' type="file" name="user_thumb" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          </div>
          <div class="box box50 no-margim">
            <p class="texto_form">Currículo lattes do co-autor (obrigatório)</p>
            <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
            <input id='' type="file" name="user_thumb2" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          </div>
          <div class="limpar"></div>
          <br>
          <INPUT TYPE="checkbox" NAME="opcao" VALUE="1" required style=" margin-top: -0.5%; margin-right: 1%"> Declaro que são verdadeiras todas as informações...
          <p>
            Você tem certeza que deseja enviar o projeto para avaliação?<br>
            Após a finalização e envio dos arquivos, o orientador não poderá editar e nem excluir os documentos, apenas visualizá-los.
          </p>
          <div class="limpar"></div>
        </div>

        <div class="limpar"></div>
        <br>
        <input type="hidden" name="id" value="<?= $c['id']; ?>" />
        <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
          <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar co-orientador
        </button>
        <div class="limpar"></div>
      </form>
  <?php
      break;
  }
