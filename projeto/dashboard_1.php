<section class="box conteudo conteudo-completo">
    <br>
    <?php if ($usuario_['ilmd'] <> "" and $usuario_['nome'] <> "" and $usuario_['cpf'] <> "") : ?>
    <p style="color: green; float: left; font-size: 1.1em; margin-top: 0.5%;">Senha e cadastro atualizados</p>
    <?php else : ?>
    <p style="color: red; float: left; font-size: 1.1em; margin-top: 0.5%;">Por favor, altere a senha!</p>
    <?php endif; ?>
    <a href="" class="btn btn_green fl-right cadastrar3" style=" width: 17%; margin-top: 0%">
        <figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.6%; margin-right: 2%;"></figure> Alterar Senha
    </a>
    <div class="limpar"></div>
    <br>

    <article class="box box100" style="background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1">Alunos cadastrados</h1>
        </div>
        <div class="box_conteudo_">
            <a href="" class="btn btn_green fl-right cadastrar" style=" width: 15%; margin-top: 0%">
                <figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.6%; margin-right: 2%;"></figure> Cadastrar novo Aluno
            </a>
            <div class="limpar"></div>
            <br>
            <?php
      $listagem = new Read;
      $listagem->ExeRead('aluno', 'WHERE status = :tipo and id_orientador = "' . $usuario_['id'] . '"order by id desc', "tipo=1");
      if ($listagem->getRowCount() >= 1) :
        foreach ($listagem->getResult() as $listagem_);
      ?>
            <!--<p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p> -->
            <table class="lista_base_tabela sortable">
                <!--<caption></caption>-->
                <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                    <!-- <th width="9%" style=" text-align: center; padding: 1%;">Imagem</th> -->
                    <th width="30%" style=" text-align: center; padding: 1%;">Nome</th>
                    <!-- <th width="30%" style=" text-align: center; padding: 1%;">E-mail</th> -->
                    <th width="15%" style=" text-align: center; padding: 1%;">CPF</th>
                    <th width="15%" style=" text-align: center; padding: 1%;">Curso</th>
                    <th width="15%" style=" text-align: center; padding: 1%;">Status</th>
                    <th width="1%" style="padding: 0%;"></th>
                    <!-- <th width="1%" style="padding: 0%"></th>
            <th width="1%" style="padding: 0%"></th> -->
                </tr>
                <div class="limpar"></div>
                <?php
          foreach ($listagem->getResult() as $listagem_) :
            //if ($listagem_['avatar'] == ''):
            //   $avatar = Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
            //else:
            //   $avatar = '<img src="' . SITE . 'imagens_site/' . $listagem_['avatar'] . '" title="' . $listagem_['nome'] . '"width="500"/>';
            //endif;
          ?>
                <tr class="lista_tabela">
                    <td width="30%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                    <td width="15%"><?= $listagem_['cpf']; ?></td>
                    <td width="15%"><?= $listagem_['curso']; ?></td>
                    <td width="15%">
                        <?php
                if ($listagem_['block'] == '1') :
                ?>
                        <p>Cadastro finalizado</p>
                        <?php
                else :
                ?>
                        <p>Aguadando finalização</p>
                        <?php
                endif;
                ?>
                    </td>
                    <td width="1%">
                        <div class="ver_cadastro btn btn-block" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Ver cadastro" data-balloon-pos="up">
                            <figure class="icon-user8" style="font-size: 1.3em;"></figure>
                        </div>
                    </td>

                    <!--<td width="1%">
                <div class="cad_cordenador btn btn_blue" style="" id="<? //= $listagem_['id']; 
                                                                      ?>" data-balloon-length="small" data-balloon="Co-cordenador" data-balloon-pos="up">
                  <figure class="icon-user8" style="font-size: 1.3em;"></figure>
                </div>
              </td> -->
                    <!--  <td width="1%">
                  <div class="id_aluno_alt btn btn_green" style="" id="<? //= $listagem_['id']; 
                                                                        ?>" data-balloon-length="small" data-balloon="Alterar" data-balloon-pos="up">
                    <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                  </div>
                </td> -->
                    <!--<td width="1%">
                <div class="btn btn_red excluir_modal" data-excluir="ex_aluno" id="<? //= $listagem_['id']; 
                                                                                    ?>" style="" data-balloon-length="small" data-balloon="Excluir" data-balloon-pos="up">
                  <figure class="icon-close2" style="font-size: 1.3em;"></figure>
                </div>
              </td> -->
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
        </div>
    </article>


    <article class="box box50 no-margim" style="background: #fff; display: none">
        <div class="box_div_h1">
            <h1 class="box_h1">Coorientadores Cadastrados</h1>
        </div>
        <div class="box_conteudo_">
            <a href="" class="btn btn_green fl-right cadastrar2" style=" width: 36%; margin-top: 0%">
                <figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.6%; margin-right: 2%;"></figure> Cadastrar novo Coorientador
            </a>
            <div class="limpar"></div>
            <br>
            <?php
      //$listagem = new Read;
      $listagem->ExeRead('co_orientador', 'WHERE status = :tipo order by id desc', "tipo=1");
      if ($listagem->getRowCount() >= 1) :
      ?>
            <!--<p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p> -->
            <table class="lista_base_tabela sortable">
                <!--<caption></caption>-->
                <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                    <!-- <th width="9%" style=" text-align: center; padding: 1%;">Imagem</th> -->
                    <th width="60%" style=" text-align: center; padding: 1%;">Nome</th>
                    <!-- <th width="30%" style=" text-align: center; padding: 1%;">E-mail</th> -->
                    <!--<th width="15%" style=" text-align: center; padding: 1%;">CPF</th>
            <th width="20%" style=" text-align: center; padding: 1%;">Curso</th>
            <!--<th width="19%" style=" text-align: center; padding: 1%;"></th> -->
                    <th width="1%" style="padding: 0%;"></th>
                    <th width="1%" style="padding: 0%"></th>
                </tr>
                <div class="limpar"></div>
                <?php
          foreach ($listagem->getResult() as $listagem_) :
            //if ($listagem_['avatar'] == ''):
            //   $avatar = Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
            //else:
            //   $avatar = '<img src="' . SITE . 'imagens_site/' . $listagem_['avatar'] . '" title="' . $listagem_['nome'] . '"width="500"/>';
            //endif;
          ?>
                <tr class="lista_tabela">
                    <td width="50%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                    <!--<td width="18%"><? //= $listagem_['cpf']; 
                                  ?></td>
              <td width="25%"><? //= $listagem_['curso']; 
                              ?></td> -->
                    <td width="1%">
                        <div class="id_coorientador_alt btn btn_green" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Alterar" data-balloon-pos="up">
                            <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                        </div>
                    </td>
                    <td width="1%">
                        <div class="btn btn_red excluir_modal" data-excluir="ex_coorientador" id="<?= $listagem_['id']; ?>" style="" data-balloon-length="small" data-balloon="Excluir" data-balloon-pos="up">
                            <figure class="icon-close2" style="font-size: 1.3em;"></figure>
                        </div>
                    </td>
                    <div class="limpar"></div>
                </tr>
                <?php
          endforeach;
        else :
          echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há Co-orientadores cadastrados!</center></div>';
        endif;
        ?>
                <div class="limpar"></div>
            </table>
        </div>
    </article>
    <div class="limpar"></div>
    <br>
</section>

<!--CADASTROS /////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="cadastrar_total">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2 fecha_cadastro">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="cadastrar_total_contetudo" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Cadastrar Novo Aluno</h1>
        <form class="form_linha" method="post" name="cad_alunos">
            <div class="box box100">
                <div class="box box33">
                    <p class="texto_form">Nome Completo do Estudante <font color=red>*</font>
                    </p>
                    <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;" />
                </div>
                <div class="box box33">
                    <p class="texto_form">Curso <font color=red>*</font>
                    </p>
                    <input name="curso" type="text" required placeholder="Curso" style=" width: 100%;" />
                </div>
                <div class="box box33 no-margim">
                    <p class="texto_form">Instituição de Ensino <font color=red>*</font>
                    </p>
                    <input name="faculdade" type="text" required placeholder="Instituição de ensino" style=" width: 100%;" />
                </div>
                <div class="limpar"></div>

                <div class="box box33">
                    <p class="texto_form">CPF <font color=red>*</font>
                    </p>
                    <input name="cpf" type="text" placeholder="CPF" autocomplete="off" style=" width: 100%;" id="mascara_cpf" />
                </div>
                <div class="box box33">
                    <p class="texto_form">Coeficiente de Rendimento(CR)<font color=red>*</font>
                    </p>
                    <input name="cr" type="text" maxlength="10" placeholder="Coeficiente de Rendimento(CR)" id="coe" style=" width: 100%;" />
                </div>
                <div class="box box33 no-margim">
                    <p class="texto_form">Tipo<font color=red>*</font>
                    </p>
                    <select class="seletipo" name="tipo" style=" width: 100%;">
                        <option value="1">Aluno Novo</option>
                        <option value="2">Renovação</option>
                    </select>
                </div>
                <div class="limpar"></div>

                <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;"></div>

                <div class="limpar"></div>
                <!--cordenador-->
                <div class="box box50">
                    <h1 class="topo_modal" style=" background: #1753ea;">Cadastro do Orientador</h1>
                    <div class="box box100">
                        <p class="texto_form">Resumo do projeto do orientador <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Parecer/protocolo do Comitê de Ética (CEP) <font color=red></font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb2" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Comprovante de patrimônio Genético e de conhecimento tradicional (SISGEN)</p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb3" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Autorização pelo SISBIO de coleta de material biológico <font color=red></font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb4" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb5" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Cadastro atualizado no banco de pesquisa da FAPEAM <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb6" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Cadastro do orientador em grupo de pesquisa do ILMD <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb7" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Declaração de participação na orientação do aluno <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb8" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="limpar"></div>
                </div>
                <!-- aluno -->
                <div class="box box50 no-margim">
                    <h1 class="topo_modal">Cadastro do Aluno</h1>
                    <div class="box box100">
                        <p class="texto_form">Projeto do aluno detalhado em .DOC ou DOCX <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb20" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Declaração de responsabilidade na orientação do aluno <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb10" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo       </label> -->
                        <input id='' type="file" name="envio_02" class="" required style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Cadastro atualizado do candidato no banco de pesquisa da FAPEAM <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb11" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Histórico escolar de graduação atualizado <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb12" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Comprovante de matrícula atualizado <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb13" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Cópia do CPF e carteira de identidade do candidato <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb14" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <!-- <div class="box box100">
            <p class="texto_form">Excluir esse campo<font color=red>*</font>
            </p>
            <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                    <!--<input id='' type="file" name="user_thumb15" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
          </div> -->
                    <div class="box box100">
                        <p class="texto_form">Cópia do comprovante de residência do candidato <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb16" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Declaração negativa de vínculo empregatício <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb17" required class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                </div>
                <div class="limpar"></div>
                <br>
                <!--Co-orientado-->
                <div class="box box100">
                    <h1 class="topo_modal" style=" background: #9915a3;">Cadastro de Coorientador</h1>
                    <INPUT TYPE="checkbox" NAME="cooo" VALUE="1" style=" margin-top: -0.5%; margin-right: 1%">O projeto não possui coorientador

                    <div class="box box100">
                        <p class="texto_form">Nome completo <font color=red>*</font>
                        </p>
                        <input name="nomecoo" type="text" placeholder="Nome completo" style=" width: 100%;" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Declaração de partipação na coautoria <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb18" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Currículo lattes do coautor <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="enviando" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                </div>
                <br>
                <div class="limpar"></div>
            </div>

            <div class="limpar"></div>
            <div class="limpar"></div>
            <br>
            <INPUT TYPE="checkbox" NAME="opcao" VALUE="1" required style=" margin-top: -0.5%; margin-right: 1%"> Declaro que são verdadeiras todas as informações.
            <p>
                <br>Você tem certeza que deseja enviar o projeto para avaliação?
                <br>Após a finalização e envio dos arquivos, o orientador não poderá editar e nem excluir os documentos, apenas visualizá-los.
            </p>
            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
                <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar
            </button>
            <div class="limpar"></div>
        </form>
    </div>
    <div class="limpar"></div>
</div>

<div class="cadastrar_total2">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2 fecha_cadastro2">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="cadastrar_total_contetudo2" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Cadastra Co-orientadores</h1>
        <form class="form_linha" method="post" name="cad_coorientador">
            <div class="box box100">
                <div class="box box100">
                    <p class="texto_form">Nome completo (obrigatório)</p>
                    <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;" />
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
                <INPUT TYPE="checkbox" NAME="opcao" VALUE="1" required style=" margin-top: -0.5%; margin-right: 1%">
                <b> Declaro que são verdadeiras todas as informações.</b>
                <div class="limpar"></div>
            </div>

            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
                <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar co-orientador
            </button>
            <div class="limpar"></div>
        </form>
    </div>
    <div class="limpar"></div>
</div>

<div class="cadastrar_total3">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2 fecha_cadastro3">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="cadastrar_total_contetudo3" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Alterar cadastro</h1>
        <form class="form_linha" method="post" name="alterar_orientador">
            <div class="box box100">
                <div class="box box20">
                    <p class="texto_form">Nome completo (obrigatório)</p>
                    <input name="nome" type="text" required placeholder="Nome completo" value="<?= $usuario_["nome"]; ?>" style=" width: 100%;" />
                </div>
                <div class="box box20">
                    <p class="texto_form">Cargo</p>
                    <input name="ilmd" type="text" required placeholder="Vínculo com o ILMD" value="<?= $usuario_["ilmd"]; ?>" style=" width: 100%;" />
                </div>
                <div class="box box20 ">
                    <p class="texto_form">E-mail (obrigatório)</p>
                    <input name="email" type="email" required placeholder="E-mail" value="<?= $usuario_["email"]; ?>" style=" width: 100%;" />
                </div>
                <div class="box box20">
                    <p class="texto_form">Matricula</p>
                    <input name="cpf" type="text" placeholder="CPF" autocomplete="off" value="<?= $usuario_["cpf"]; ?>" style=" width: 100%;" id="mascara_cpf2" />
                </div>
                <div class="box box20 no-margim">
                    <p class="texto_form">Alterar senha</p>
                    <input name="senha" type="password" placeholder="Senha" autocomplete="off" value="<?= $usuario_["senha"]; ?>" style=" width: 100%;" id="" />
                </div>
                <div class="limpar"></div>
            </div>

            <div class="limpar"></div>
            <br>
            <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
            <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
            <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
                <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar Aluno
            </button>
            <div class="limpar"></div>
        </form>
    </div>
    <div class="limpar"></div>
</div>

<!-- ALTERAÇÃO /////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="alterar_total">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="alterar_total_contetudo" style=" background: #fff; padding: 3%">

    </div>
    <div class="limpar"></div>
</div>
