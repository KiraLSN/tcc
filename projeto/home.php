<!--
===========================================================================================================================================
Login e senha
===========================================================================================================================================
-->
<?php
$Browser = $_SESSION['useronline']['online_agent'];
if (strpos($Browser, 'Chrome')):
    $Browser = 'Chrome';
elseif (strpos($Browser, 'Firefox')):
    $Browser = 'Firefox';
elseif (strpos($Browser, 'MSIE') || strpos($Browser, 'Trident/')):
    $Browser = 'IE';
else:
    $Browser = 'Outros';
endif;
?>
<section class="login ds-none">
    <!--<img src="<?//= HOME; ?>imagens_site/logo.png" title="<?//= SITENOME; ?>" alt="<?//= SITENOME; ?>"/> -->
    <div class="limpar"></div>
    <article class="box_login radius b-shadow">
        <h1>Painel de controle</h1>
        <form method="post" class="form login_entrada" name="logar">
            <p class="legenda_form">E-mail cadastrado</p>
            <input name="email" type="email" required placeholder="E-mail cadastrado" style=" width: 100%" />
            <p class="legenda_form">Senha cadastrada</p>
            <input name="senha" type="password" required placeholder="Senha cadastrada" style=" width: 100%" />
            <input type="hidden" name="nav" value="<?= $Browser; ?>"/>
            <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>"/>
            <p class="esqueci_senha">Esqueceu sua senha?</p>
            <div class="limpar"></div>
            <div class="fl-left" style="width: 70%; margin-top: 4.3%;">
                <div class="box box-larga" style="font-size: 0.8em; color: #343736"><b style="font-weight: 600;">Seu navegador:</b><br><?= $Browser; ?></div>
                <div class="box box-larga no-margim" style="font-size: 0.8em; color: #343736"><b style="font-weight: 600;">Seu IP:</b><br><?= $_SERVER['REMOTE_ADDR']; ?></div>
            </div>
            <button class="btn btn_green fl-right">Entrar</button>
            <div class="limpar"></div>
        </form>

        <form method="post" class="form senha ds-none" name="senha">
            <p class="legenda_form">E-mail cadastrado</p>
            <input name="email" type="email" required placeholder="E-mail cadastrado" style=" width: 100%" />
            <input type="hidden" name="nav" value="<?= $Browser; ?>"/>
            <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>"/>
            <p class="voltar_painel">Voltar ao login</p>
            <div class="limpar"></div>
            <div class="fl-left" style="width: 70%; margin-top: 4.3%;">
                <div class="box box-larga" style="font-size: 0.8em; color: #343736"><b style="font-weight: 600;">Seu navegador:</b><br><?= $Browser; ?></div>
                <div class="box box-larga no-margim" style="font-size: 0.8em; color: #343736"><b style="font-weight: 600;">Seu IP:</b><br><?= $_SERVER['REMOTE_ADDR']; ?></div>
            </div>
            <button class="btn btn_green fl-right">Recuperar</button>
            <div class="limpar"></div>
        </form>
    </article>
   <!-- <a href="https://www.casadossites.com" title="Casa dos sites - Criaçaaaa e manutençao " target="_blank" style="width: 100%;">
        <img src="<?//= HOME; ?>imagens_site/casadossites3.png" title="" alt="" style="width: 40%; margin-top: 2%; margin-left: 30%; margin-bottom: 0;"/>
        <div class="limpar"></div>
        <p style="margin-top: 0%; text-align: center; color: #fff; font-size: 0.9em;">OME; ?>imagens_site/casadossites3.png" title="" alt="" style="width: 40%; margin-top: 2%; margin-left: 30%; margin-bottom: 0;"/>
        <div class="
            Desenvolvido com orgulho!
        </p>
    </a> -->
</section>