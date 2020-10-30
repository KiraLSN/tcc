<?php
$titulo_cadastro = 'Cadastrar usuário';
$titulo_listagem = 'Lista de usuário';
$titulo_botao_de_acesso = 'Cadastrar novo usuário';
$titulo_foto = 'Foto do usuário';
$titulo_alterar = 'Alterar cadastro do usuário';
?>
<section class="box conteudo conteudo-completo">
   <br>
   <article class="listagem" style="float: left; width: 100%; background: #fff;">
      <div class="box_div_h1">
         <h1 class="box_h1"><?= $titulo_listagem; ?></h1>
      </div>

      <form method="post" name="busca_usuario" class="form" style=" margin-top: 2%; padding: 0 1.8%">
         <div class=""  style="width: 18%; float: right;">
            <a href="" class="btn btn_green fl-right cadastrar" style=" width: 90%; margin-top: 10%"><figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.9%; margin-right: 2%;"></figure> <?= $titulo_botao_de_acesso; ?></a>
            <div class="limpar"></div>
            <!--!<a href="" class="btn btn_blue fl-right" style=" width: 90%;"><i class="fas fa-download" style=" margin-right: 2%; margin-top: -0.5%; font-size: 1.3em; float: left"></i> Baixar lista em excel</a>-->
         </div>

         <div class="" style=" width: 25%; float: left; margin-right: 2%;">
            <p class="texto_form">Encontrar por:</p>
            <select name="busca_loja" required style="width: 100%;" class="">
               <option value="1">Nome do usuário</option>
               <option value="2">E-mail</option>
            </select>
         </div>
         <div class="" style=" width: 40%; float: left">
            <p class="texto_form">Descreva:</p>
            <input name="busca_text" placeholder="..." min="3" required type="text" style="float: left; width: 78%" />
            <button class="btn btn_green fl-left" data-balloon-length="small" data-balloon="Buscar" data-balloon-pos="up" style=" font-size: 0.9em; margin-left: 2%; margin-top: -0.1%; padding: 1.9% 3%;">
               <figure class="icon-search9" style=""></figure>
            </button>
         </div>
      </form>


      <div class="limpar"></div>
      <div class="box_conteudo_" style=" margin: 0; padding: 0 2%;">
         <div class="carregando_busca ds-none">
            <img src="<?= HOME; ?>imagens_fixas/carregando2.gif" style=""><span style=" margin-left: 1%;">Aguarde, carregando...</span>
            <div class="limpar"></div>
            <br>
         </div>
         <div class="limpar"></div>
         <div class="lista_nova ds-none">

         </div>
         <div class="limpar"></div>
      </div>

      <div class="limpar"></div>
      <div class="box_conteudo_ lista_atual">
         <!--LISTA DE CADASTRADOS-->
         <?php
         $listagem = new Read;
         $listagem->ExeRead('perfil', 'WHERE status = :tipo order by id desc', "tipo=1");
         if ($listagem->getRowCount() >= 1):
            ?>
            <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
            <table class="lista_base_tabela sortable">
                <!--<caption></caption>-->
               <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                  <th width="9%" style=" text-align: center; padding: 1%;">Imagem</th>
                  <th width="30%" style=" text-align: center; padding: 1%;">Nome</th>
                  <th width="30%" style=" text-align: center; padding: 1%;">E-mail</th>
                  <th width="15%" style=" text-align: center; padding: 1%;">Celular</th>
                  <th width="19%" style=" text-align: center; padding: 1%;">Cargo</th>
                  <th width="1%" style="padding: 0%;"></th>
                  <th width="1%" style="padding: 0%"></th>
               </tr>
               <div class="limpar"></div>
               <?php
               foreach ($listagem->getResult() as $listagem_):
                  if ($listagem_['avatar'] == ''):
                     $avatar = Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
                  else:
                     $avatar = Check::Imagem('imagens_site/' . $listagem_['avatar'] . '', $listagem_['nome'], '500', '500', '');
                  endif;
                  ?>
                  <tr class="lista_tabela">
                     <td width="9%"><?= $avatar; ?></td>
                     <td width="30%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                     <td width="30%"><?= $listagem_['email']; ?></td>
                     <td width="15%"><?= $listagem_['cel']; ?></td>
                     <td width="19%"><?= $listagem_['cargo']; ?></td>
                     <td width="1%"> 
                        <div class="btn btn_red excluir_modal" data-excluir="ex_usuario" id="<?= $listagem_['id']; ?>" style="" data-balloon-length="small" data-balloon="Excluir" data-balloon-pos="up">
                           <figure class="icon-close2" style="font-size: 1.3em;"></figure>
                        </div>
                     </td>
                     <td width="1%"> 
                        <div class="id_usuario btn btn_green" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Alterar" data-balloon-pos="up">
                           <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                        </div>
                     </td>
                  <div class="limpar"></div>
                  </tr>
                  <?php
               endforeach;
            else:
               echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há usuários cadastrados!</center></div>';
            endif;
            ?>
            <div class="limpar"></div>
         </table>
         <br>
      </div>
      <div class="limpar"></div>
   </article>
   <div class="limpar"></div>
</section>

<div class="cadastrar_total">
   <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2"><figure class="icon-window-close" style="color: #fff;"></figure></a>
   <div class="cadastrar_total_contetudo" style=" background: #fff; padding: 3%">
      <h1 class="topo_modal">Cadastrar usuário</h1>
      <form class="form_linha" method="post" name="cad_usuario">
         <div style="width: 75%; float: left">
            <div class="box box50">
               <p class="texto_form">Nome completo</p>
               <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;"/>
            </div>
            <div class="box box50 no-margim">
               <p class="texto_form">E-mail válido</p>
               <input name="email" type="email" required placeholder="E-mail válido" style=" width: 100%;"/>
            </div>
            <div class="limpar"></div>
            <div class="box box33">
               <p class="texto_form">Telefone</p>
               <input name="tel" type="text"  placeholder="Telefone" id="mascara_telefone2" style=" width: 100%;"/>
            </div>

            <div class="box box33">
               <p class="texto_form">Celular</p>
               <input name="cel" type="text" placeholder="Celular" id="mascara_celular2" style=" width: 100%;"/>
            </div>
            <div class="box box33 no-margim">
               <p class="texto_form">Cargo</p>
               <input name="cargo" type="text" required placeholder="Cargo na empresa" style=" width: 100%;"/>
            </div>
            <div class="limpar"></div>

            <p class="texto_form">Permissão</p>
            <p class="texto_form">Selecione apenas as permissões que gostaria que este usuário utilizasse.</p>
            <br>

            <div class="box box-media">
               <?php
               if (dashboard == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="1" id="coding">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding" name="1"><p class="labelterm">Página inicial</p></label>
                     <div class="limpar"></div>
                  </div>
                  <?php
               endif;

               if (depoimentos == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="2" id="coding2">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding2" name="2"><p class="labelterm">Depoimentos</p></label>
                  </div>
                  <?php
               endif;

               if (arquivos == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="3" id="coding3">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding3" name="3"><p class="labelterm">Sistema de arquvos</p></label>
                  </div>
                  <?php
               endif;

               if (newsletter == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="4" id="coding4">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding4" name="4"><p class="labelterm">Newsletter</p></label>
                  </div>
                  <?php
               endif;

               if (sac == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="5" id="coding5">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding5" name="5"><p class="labelterm">SAC</p></label>
                  </div>
                  <?php
               endif;

               if (cadastrar_usuario == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="6" id="coding6">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding6" name="6"><p class="labelterm">Perfil</p></label>
                  </div>
                  <?php
               endif;
               ?>

               <div class="limpar"></div>
            </div>
            <div class="box box-media">
               <?php
               if (cliente == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="7" id="coding7">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding7" name="7"><p class="labelterm">Empresa</p></label>
                  </div>
                  <?php
               endif;

               if (cliente_usuario == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="8" id="coding8">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding8" name="8"><p class="labelterm">Contatos na empresa</p></label>
                  </div>

                  <?php
               endif;

               if (blog == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="9" id="coding9">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding9" name="9"><p class="labelterm">Blog</p></label>
                  </div>
                  <?php
               endif;

               if (crm == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="10" id="coding10">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding10" name="10"><p class="labelterm">CRM</p></label>
                  </div>
                  <?php
               endif;
               
               if (agenda == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="11" id="coding11">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding11" name="11"><p class="labelterm">Agenda</p></label>
                  </div>
                  <?php
               endif;

              if (orientador == 'ON'):
                  ?>
                  <div class="mylabel">
                     <input name="acesso[]" type="checkbox" value="12" id="coding12">
                     <div class="slidinggroove"></div>
                     <label class="mylabel" for="coding12" name="12"><p class="labelterm">Orientador</p></label>
                  </div>
                  <?php
               endif;
               ?>
            </div>

            <div class = "box box-media no-margim">

            </div>
            <div class = "limpar"></div>
            <input type = "hidden" name = "id" value = "<?= $usuario_['id']; ?>"/>
         </div>


         <div style = "width: 23%; float: right">

            <p class = "texto_form"><?= $titulo_foto; ?></p>
            <img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="<?= HOME; ?>imagens_fixas/sem_imagem.jpg" default="<?= HOME; ?>imagens_fixas/sem_imagem.jpg">
            <div class="box_content">
               <div class="limpar"></div>
               <div class="mensagem_imagem ds-none">
                  <p><b></b></p>
               </div>
               <span class="legend">Foto (500x500px, JPG ou PNG):</span>
               <div class="limpar" style=" margin-bottom: 2%"></div>
               <label class="label_file" for='selecao-arquivo'>Selecionar um arquivo</label>
               <input id='selecao-arquivo' type="file" name="user_thumb" class="wc_loadimage"/>
               <div class="limpar"></div>

               <div class="upload_bar m_top m_botton"><div class="upload_progress ds-none">0%</div></div>
               <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif"/>

            </div>
         </div>

         <div class="limpar"></div>
         <br>
         <input type="hidden" name="id" value="<?= $usuario_['id']; ?>"/>
         <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif"/></span> 
         <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%"><figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar</button>
         <div class="limpar"></div>
      </form>
   </div>
   <div class="limpar"></div>
</div>

<div class="alterar_total">
   <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2"><figure class="icon-window-close" style="color: #fff;"></figure></a>
   <div class="alterar_total_contetudo" style=" background: #fff; padding: 3%">

   </div>
   <div class="limpar"></div>
</div>