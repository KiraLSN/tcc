<?php
require("./poo/app/Config.inc.php");
$sessao = new Session;

?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/WebPage">

<head>
    <!--METAS DA PAGINA-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $pg_titulo ?></title>
    <meta name="description" content="<?= strip_tags($pg_descricao); ?>" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="<?= SITENOME; ?>" />
    <link rel="canonical" href="<?= $pg_url; ?>" />
    <link rel="base" href="<?= HOME; ?>" />

    <!--[if lt IE 9]>
        <script src="<?= HOME; ?>js/html5shiv.js"></script>
      <![endif]-->

    <!--AUTORAÇÃO DA PAGINA-->
    <link rel="author" href="<?= $pg_autor; ?>" />
    <link rel="publisher" href="<?= $pg_empresa; ?>" />

    <!--SEO GENERICO PARA TODAS AS MIDIAS CONFIGURADO PARA O MICROFORMATO-->
    <meta itemprop="name" content="<?= $pg_titulo; ?>" />
    <meta itemprop="description" content="<?= strip_tags($pg_descricao); ?>" />
    <meta itemprop="image" content="<?= $pg_imagem; ?>" />
    <meta itemprop="url" content="<?= $pg_url; ?>" />

    <!--IDENTIFICADORES-->
    <meta property="article:author" content="<?= SITENOME; ?>" />
    <meta property="article:publisher" content="<?= SITENOME; ?>" />

    <link rel="shortcut icon" href="<?= HOME; ?>imagens_fixas/favicon.png" />
    <link rel="stylesheet" href="<?= HOME; ?>poo/css/reset.css" />

    <?php include('poo/css.php'); ?>
    <?php include('poo/js.php'); ?>
    <script type="text/javascript" src="<?= HOME; ?>poo/js_code.js"></script>
</head>

<body <?php
   if ($pagina == 'home'): echo 'style="background-image: url(' . HOME . 'imagens_site/inno.gif);  background-size: 100% 100%; background-position: top left; background-repeat: no-repeat; background-attachment: fixed;"';
   else: endif;
   ?>>
    <?php include('modais.php'); ?>
    <!--
      ===========================================================================================================================================
      CABEÇA DO PROJETO
      ===========================================================================================================================================
      -->

    <!--
         ===========================================================================================================================================
         MENU LATERAL
         ===========================================================================================================================================
         -->
    <section class="corpo">

        <article class="menu" style=" z-index: 997000;">
            <img class="logo_menu s" src="<?= HOME; ?>imagens_site/INNOVATION.gif" title="<?= SITENOME; ?>" />
            <br><br>
            <h1 class="barra_menu link_controle">Menu Geral</h1>
            <div class="controle_menu ds-none">
                <a href="dashboard">
                    <figure class="icon-dashboard1" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Página inicial
                </a>
                <a href="projetos">
                    <figure class="icon-dashboard1" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Projetos
                </a>
            </div>






            <!--   <h1 class="barra_menu prod_conf">Empresas e clientes</h1>
               <div class="prod_menu ds-none">
                  <?php
                 // if (cliente == 'ON'):
                 //    echo ((in_array('7', $arr_permisao)) ? '<a href="' . HOME . 'cliente"><figure class="icon-office" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Empresas</a>' : '' );
                 // endif;
                 // if (cliente_usuario == 'ON'):
                 //    echo ((in_array('8', $arr_permisao)) ? '<a href="' . HOME . 'cliente_usuario"><figure class="icon-users5" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Clientes</a>' : '' );
                 // endif;
                  ?>
               </div> -->


            <?php
               //  if (in_array('16', $arr_permisao) || in_array('17', $arr_permisao) || in_array('18', $arr_permisao)):
               ?>
            <!--<h1 class="barra_menu link_blog">Blog</h1>
               <div class="blog_menu ds-none">
                 <?php
                  if (blog == 'ON'):
                     echo ((in_array('9', $arr_permisao)) ? '<a href="' . HOME . 'blog"><figure class="icon-comments2" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> Blog</a>' : '' );
                  endif;
                  ?>
               </div> -->
            <?php
               //else:
               // endif;
               ?>

            <?php
               //if (in_array('19', $arr_permisao) || in_array('20', $arr_permisao) || in_array('21', $arr_permisao) || in_array('22', $arr_permisao)):
               ?>
            <!--<h1 class="barra_menu finace">Textos</h1>
               <div class="finace_p ds-none">
                   <?//= ((in_array('19', $arr_permisao)) ? '<a href="' . HOME . 'empresa"><i class="fa fa-file-text-o icone_full" ></i> Empresa</a>' : '' ); ?>
                   <?//= ((in_array('20', $arr_permisao)) ? '<a href="' . HOME . 'seja_parceiro"><i class="fa fa-file-text-o icone_full" ></i> Sejá um parceiro</a>' : '' ); ?>
                   <?//= ((in_array('21', $arr_permisao)) ? '<a href="' . HOME . 'politica_privacidade"><i class="fa fa-file-text-o icone_full" ></i> Vender</a>' : '' ); ?>
                   <?//= ((in_array('22', $arr_permisao)) ? '<a href="' . HOME . 'como_comprar"><i class="fa fa-file-text-o icone_full" ></i> Comprar</a>' : '' ); ?>
                   <?//= ((in_array('26', $arr_permisao)) ? '<a href="' . HOME . 'seguro"><i class="fa fa-file-text-o icone_full" ></i> Seguro</a>' : '' ); ?>
                   <?//= ((in_array('27', $arr_permisao)) ? '<a href="' . HOME . 'tabela"><i class="fa fa-file-text-o icone_full" ></i> Tabela FIPE</a>' : '' ); ?>
               </div>-->
            <?php
               // else:
               // endif;
               ?>

            <?php
               //  if (in_array('29', $arr_permisao) || in_array('30', $arr_permisao) || in_array('31', $arr_permisao) || in_array('32', $arr_permisao)|| in_array('35', $arr_permisao)):
               ?>
            <!--<h1 class="barra_menu link_txt">Gestão financeira</h1>
               <div class="txt_menu ds-none">
                   <?//= ((in_array('29', $arr_permisao)) ? '<a href="' . HOME . 'representantes"><i class="fa fa-file-text-o icone_full" ></i> Categorias</a>' : '' ); ?>
                   <?//= ((in_array('31', $arr_permisao)) ? '<a href="' . HOME . 'financeiro_carro"><i class="fa fa-file-text-o icone_full" ></i> Finaceiro carros</a>' : '' ); ?>
                   <?//= ((in_array('32', $arr_permisao)) ? '<a href="' . HOME . 'financeiro_empresa"><i class="fa fa-file-text-o icone_full" ></i> Financeiro empresa</a>' : '' ); ?>
                   <?//= ((in_array('30', $arr_permisao)) ? '<a href="' . HOME . 'financeiro_carro_saida"><i class="fa fa-file-text-o icone_full" ></i> Venda de carros</a>' : '' ); ?>
                   <?//= ((in_array('35', $arr_permisao)) ? '<a href="' . HOME . 'financeiro_carro_compra"><i class="fa fa-file-text-o icone_full" ></i> Compra de carros</a>' : '' ); ?>
               </div>-->
            <?php
               // else:
               // endif;
               ?>
            <!--<h1 class="barra_menu link_crm">Relacionamento com cliente</h1>
                <div class="txt_crm ds-none">
                   <?php
                  if (crm == 'ON'):
                     echo ((in_array('10', $arr_permisao)) ? '<a href="' . HOME . 'crm"><figure class="icon-rocket2" style="margin-right: 4%; margin-top: -1.5%; font-size: 1.3em;"></figure> CRM</a>' : '' );
                  endif;
                  ?>
                </div> -->
            <?php
               // if (in_array('50', $arr_permisao)):
               ?>
            <!--                        <h1 class="barra_menu link_txt_r">Relatórios</h1>
                                       <div class="txt_menu_r ds-none">
                                           <?//= ((in_array('50', $arr_permisao)) ? '<a href="' . HOME . 'rela_visao"><i class="fa fa-line-chart icone_full" ></i> Relatório simplificado</a>' : '' ); ?>
                                           
                                       </div>-->
            <?php
               // else:
               // endif;
               ?>

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

                    <a class="fl-right btn btn_green" href="http://localhost/tcc" title="Sair" style="font-size: 0.9em; margin-right: 3.3%; margin-top: 0.5%; margin-left: 2%;">
                        <figure class="icon-login" style="margin-top: -2%;"></figure> Sair
                    </a>

                    <a href="<?= HOME; ?>perfil" data-balloon="Meu perfil" data-balloon-pos="down" class="fl-right" style="color: #fff; margin-right: 4.3%; margin-top: 1.5%; margin-left: 2%; font-size: 0.9em"><?= Check::Limitador('Convidado', 3); ?></a>


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
            
            require("{$pagina}.php"); //para outras páginas apenas recuperar por  $atual[1], $atual[2]
            if ($pagina == 'home'):
            else:
               ?>
        </article>
    </section>
    <?php endif; ?>

</body>

</html>
