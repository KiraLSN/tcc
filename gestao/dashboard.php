<section class="box conteudo conteudo-completo">
  <br>
  <article class="box box50" style="background: #fff;">
    <div class="box_div_h1">
      <h1 class="box_h1">Informações do usuário</h1>
    </div>
    <div class="box_conteudo_">
      <p>Nome: <?= $usuario_['nome']; ?></p>
      <p>IP: <?= $_SERVER['REMOTE_ADDR']; ?></p>
      <?php
      $Browser = $_SESSION['useronline']['online_agent'];
      if (strpos($Browser, 'Chrome')) :
        $Browser = 'Chrome';
      elseif (strpos($Browser, 'Firefox')) :
        $Browser = 'Firefox';
      elseif (strpos($Browser, 'MSIE') || strpos($Browser, 'Trident/')) :
        $Browser = 'IE';
      else :
        $Browser = 'Outros';
      endif;
      ?>
      <p>Navegador: <?= $Browser ?></p>
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