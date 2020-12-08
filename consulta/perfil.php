<?php
//VERIFICAR SE EXISTE E ALIMENTAR O FORMULÁRIO
$read = new Read;
$read->ExeRead('perfil', 'WHERE id = :id', "id=" . $usuario_['id'] . "");
foreach ($read->getResult() as $resultado)
    ;
?>
<section class="box conteudo conteudo-completo">
    <br>
    <article class="" style="float: left; width: 100%; background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1">Alterar informações do seu perfil</h1>
        </div>
        <div class="box_conteudo_">
            <form class=" form_linha" method="post" name="editar_usuario_perfil" enctype="multipart/form-data">

                <div style="width: 75%; float: left">
                    <div class="box box50">
                        <p class="texto_form">Nome completo</p>
                        <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;" value="<?= $resultado['nome']; ?>"/>
                    </div>
                    <div class="box box50 no-margim">
                        <p class="texto_form">E-mail válido</p>
                        <input name="email" type="email" required placeholder="E-mail válido" style=" width: 100%;" value="<?= $resultado['email']; ?>"/>
                    </div>
                    <div class="limpar"></div>
                    
                    <div class="box box50">
                        <p class="texto_form">Senha</p>
                        <input name="senha" type="password" required placeholder="Senha" style=" width: 100%;" value="<?= $resultado['senha']; ?>"/>
                    </div>

                    <div class="box box50 no-margim">
                        <p class="texto_form">Cargo</p>
                        <input name="cargo" type="text" placeholder="Cargo" style=" width: 100%;" value="<?= $resultado['cargo']; ?>"/>
                    </div>
                    <div class="limpar"></div>
                    
                    <div class="box box50">
                        <p class="texto_form">Telefone</p>
                        <input name="tel" type="text" placeholder="Telefone" id="mascara_celular_usuario" style=" width: 100%;" value="<?= $resultado['tel']; ?>"/>
                    </div>
                    <div class="box box50 no-margim">
                        <p class="texto_form">Celular</p>
                        <input name="cel" type="text" required placeholder="Celular" id="mascara_telefone_usuario" style=" width: 100%;" value="<?= $resultado['cel']; ?>"/>
                    </div>
                    <div class="limpar"></div>
                </div>


                <div style="width: 23%; float: right">
                    <p class="texto_form"></p>
                    <?php
                    if ($resultado['avatar'] == ''):
                        echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_fixas/sem_imagem.jpg" default="' . HOME . 'imagens_fixas/sem_imagem.jpg">';
                    else:
                        echo '<img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="' . HOME . 'imagens_site/' . $resultado['avatar'] . '" default="' . HOME . 'imagens_site/' . $resultado['avatar'] . '">';
                    endif;
                    ?>
                    <div class="box_content">
                        <div class="limpar"></div>
                        <div class="mensagem_imagem ds-none">
                            <p><b></b></p>
                        </div>
                        <br>
                           <span class="legend" style=" font-size: 0.8em;">Foto (500x500px, JPG ou PNG, máximo de 3mb):</span>
                           <div class="limpar" style=" margin-bottom: 2%"></div>
                           <label class="label_file" for='selecao-arquivo'>Selecionar um arquivo</label>
                           <input id='selecao-arquivo' type="file" name="user_thumb" class="wc_loadimage"/>
                           <div class="limpar"></div>

                        <div class="upload_bar m_top m_botton"><div class="upload_progress ds-none">0%</div></div>
                        <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="<?= HOME; ?>imagens_fixas/carregando2.gif"/>
                    </div>
                    <div class="limpar"></div>
                    <br>
                </div>

                <div class="limpar"></div>
                <br>
                <input type="hidden" name="id_usuario" value="<?= $resultado['id']; ?>"/>
                <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif"/></span> 
                <button class="btn btn_green fl-left botao_alterar" style=""><figure class="icon-retweet2" style="margin-top: -4%;"></figure> Alterar</button>
                <div class="fl-right fechar_alterar" style="width: 4%; cursor: pointer" data-balloon-length="medium" data-balloon="Fechar alterar" data-balloon-pos="left">
                </div>
                <div class="limpar"></div>
            </form>
        </div>
    </article>
</section>