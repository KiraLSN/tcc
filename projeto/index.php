<?php
require("./poo/app/Config.inc.php");
$sessao = new Session;

?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/WebPage">
   <head>
      <!--METAS DA PAGINA-->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title><?= $pg_titulo ?></title>
      <meta name="description" content="<?= strip_tags($pg_descricao); ?>" />
      <meta name="robots" content="index, follow" />
      <meta name="author" content="<?= SITENOME; ?>" />
      <link rel="canonical" href="<?= $pg_url; ?>" />
      <link rel="base" href="<?= HOME; ?>"/> 

      <!--[if lt IE 9]>
        <script src="<?= HOME; ?>js/html5shiv.js"></script>
      <![endif]-->

      <!--AUTORAÇÃO DA PAGINA-->
      <link rel="author" href="<?= $pg_autor; ?>"/>
      <link rel="publisher" href="<?= $pg_empresa; ?>"/>

      <!--SEO GENERICO PARA TODAS AS MIDIAS CONFIGURADO PARA O MICROFORMATO-->
      <meta itemprop="name" content="<?= $pg_titulo; ?>" />
      <meta itemprop="description" content="<?= strip_tags($pg_descricao); ?>" />
      <meta itemprop="image" content="<?= $pg_imagem; ?>" />
      <meta itemprop="url" content="<?= $pg_url; ?>" />

      <!--IDENTIFICADORES-->
      <meta property="article:author" content="<?= SITENOME; ?>" />
      <meta property="article:publisher" content="<?= SITENOME; ?>" />

      <link rel="shortcut icon" href="<?= HOME; ?>imagens_fixas/favicon.png"/>
      <link rel="stylesheet" href="<?= HOME; ?>poo/css/reset.css"/>

      <?php include('poo/css.php'); ?>
      <?php include('poo/js.php'); ?>
      <script type="text/javascript" src="<?= HOME; ?>poo/js_code.js"></script>
   </head>

   <body  <?php
   if ($pagina == 'home'): echo 'style="background-image: url(' . HOME . 'imagens_site/bg.jpg);  background-size: 100% 100%; background-position: top left; background-repeat: no-repeat; background-attachment: fixed;"';
   else: endif;
   ?>>
         <?php include('modais.php'); ?>
      <!--
      ===========================================================================================================================================
      CABEÇA DO PROJETO
      ===========================================================================================================================================
      -->
      <?php
      if ($pagina == 'home'):
      else:

         if (!isset($_SESSION['usuario'])):
            ?>
            <script language = "JavaScript">
         location.href = "<?= HOME; ?>";
            </script>
            <?php
         else:
            $usuario = new Read;
            $usuario->ExeRead('orientador', 'WHERE id=:url', "url=" . $_SESSION['usuario'] . "");
            if ($usuario->getRowCount() >= 1):
               foreach ($usuario->getResult() as $usuario_)
                  ;
            endif;

          //  $usuario->ExeRead('permissao', 'WHERE id_perfil = :id', "id=" . $usuario_['id'] . "");
          //  if ($usuario->getRowCount() >= 1):
          //     foreach ($usuario->getResult() as $permissa_usuario):
          //        $arr_permisao[] = $permissa_usuario['permissao'];
          //     endforeach;
          //  else:
          //     $arr_permisao[] = '';
          //  endif;
         endif;
         ?>
         <!--
         ===========================================================================================================================================
         MENU LATERAL
         ===========================================================================================================================================
         -->
         <section class="corpo">

            <article class="menu"  style=" z-index: 997000;">
              <img class="logo_menu s" src="<?= HOME; ?>imagens_site/logo_branca.png" title="<?= SITENOME; ?>"/>
               <br><br>
               <h1 class="barra_menu link_controle">Controle geral</h1>
               <div class="controle_menu ds-none">
                  <a href="<?=HOME;?>dashboard"><figure class="icon-dashboard1" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Página inicial</a>
               </div>
            </article>
            <!--
            ===========================================================================================================================================
              MENU SUSPENSO 
            ===========================================================================================================================================
            -->
            <div class="menu_suspent">
               <a href="" class="mostar_menu " data-balloon="Mostrar Menu" data-balloon-pos="right">
                  <img src="<?= HOME; ?>imagens_site/menu.png" class="menu_ss" style=" width: 100%;" />
               </a>
               <a href="" class="esconder_menu ds-none" data-balloon="Fechar Menu" data-balloon-pos="right" style="">
                  <img src="<?= HOME; ?>imagens_site/close2.png" class="menu_ss2" style=" width: 100%;" />
               </a>
            </div>
            <article class="cont">
               <div class="menu_suspenso">

                  <div class="fl-right avatar" style="width: 50%;">

                     <a class="fl-right btn btn_green" href="<?= HOME; ?>sair" title="Sair" style="font-size: 0.9em; margin-right: 3.3%; margin-top: 0.5%; margin-left: 2%;"><figure class="icon-login" style="margin-top: -2%;"></figure> Sair</a>

                     <a href="<?= HOME; ?>dashboard" data-balloon="Meu perfil" data-balloon-pos="down" class="fl-right" style="color: #fff; margin-right: 4.3%; margin-top: 1.5%; margin-left: 2%; font-size: 0.9em"><?= Check::Limitador($usuario_['nome'], 3); ?></a>
                     <?php
                    // if ($usuario_['avatar'] == ''):
                    //    echo Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '400', '400', 'radius-circulo fl-right');
                    // else:
                    //    echo'<img class="radius-circulo fl-right" src ="' . HOME . 'imagens_site/' . $usuario_['avatar'] . '"/>';
                   //  endif;
                     ?>
                  </div>
                  <div class="limpar"></div>
               </div>
               <div class="limpar"></div>
               <!--
               ===========================================================================================================================================
               BASE DE CHAMADA DE OUTRAS PAGINAS
               ===========================================================================================================================================
               -->
            <?php
            endif;
            require("{$pagina}.php"); //para outras páginas apenas recuperar por  $atual[1], $atual[2]
            if ($pagina == 'home'):
            else:
               ?>
            </article>
         </section>
      <?php endif; ?>   

   </body>
</html>