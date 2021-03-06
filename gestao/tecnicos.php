<?php
$titulo_cadastro = 'Cadastrar Supervisor';
$titulo_listagem = 'Listagem de Técnicos';
$titulo_botao_de_acesso = 'Cadastrar novo Técnico';
$titulo_botao_de_acesso2 = 'Cadastrar novo Projeto';

$titulo_foto = 'Avatar';
$titulo_alterar = 'Alterar cadastro de Supervisor';
?>
<section class="box conteudo conteudo-completo">
    <br>
    <article class="listagem" style="float: left; width: 100%; background: #fff;">
        <div class="box_div_h1">
            <h1 class="box_h1"><?= $titulo_listagem; ?></h1>
        </div>

        <form method="post" name="busca_usuario" class="form" style=" margin-top: 2%; padding: 0 1.8%">
            <div class="" style="width: 18%; float: right;">
                <a href="" class="btn btn_green fl-right cadastrar" style=" width: 90%; margin-top: 10%">
                    <figure class="icon-plus6" style="font-size: 1.1em; margin-top: -0.6%; margin-right: 2%;"></figure> <?= $titulo_botao_de_acesso; ?>
                </a>
                <div class="limpar"></div>
                <!--!<a href="" class="btn btn_blue fl-right" style=" width: 90%;"><i class="fas fa-download" style=" margin-right: 2%; margin-top: -0.5%; font-size: 1.3em; float: left"></i> Baixar lista em excel</a>-->
            </div>


            <div class="select_ativo" style=" width: 25%; float: left; margin-right: 2%;">
                <!--   <p class="texto_form">Encontrar por:</p>
            <select name="busca_loja" required style="width: 100%;" class="js-example-basic-single">
               <option value="1">Nome do usuário</option>
               <option value="2">E-mail</option>
            </select>-->
            </div>
            <div class="" style=" width: 40%; float: left">
                <!--    <p class="texto_form">Descreva:</p>
            <input name="busca_text" placeholder="..." min="3" required type="text" style="float: left; width: 78%" />
            <button class="btn btn_green fl-left" data-balloon-length="small" data-balloon="Buscar" data-balloon-pos="up" style=" font-size: 1em; margin-left: 2%; margin-top: -0.1%; padding: 1.91% 3%;">
               <figure class="icon-search9" style=""></figure>
            </button>-->
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
            //echo $usuario_['nome'];
            $listagem2 = new Read;
            $listagem2->ExeRead('orientador', "where nome ='". $usuario_['nome'] ."' ");
                foreach($listagem2->getResult() as $listagem2_);
            //echo $listagem2_['id'];
            //echo $_SESSION['usuario'];
         $listagem = new Read;
            try{
                $listagem->ExeRead('aluno', "where id_orientador = '".$listagem2_['id']."' AND status != 3 order by status asc");
            }catch(Exception $e){
                echo "Supervisor sem projetos cadastrados";
            }    
            
         $listagem->ExeRead('tecnico', "where status = '1' order by nome asc");
         if ($listagem->getRowCount() >= 1):
            ?>
            <p class="texto_form" style=" margin-top: 0;">Você pode ordenar a lista clicando nos titulos da lista abaixo.</p>
            <table class="lista_base_tabela sortable">
                <!--<caption></caption>-->
                <tr style=" width: 100%; border-bottom: 1px solid #000; background-color: #000000; color: #FFF; font-size: 0.9em;">
                    <!--<th width="9%" style=" text-align: center; padding: 1%;">Logo</th> -->
                    <th width="20%" style=" text-align: center; padding: 1%;">Nome</th>
                    <th width="15%" style=" text-align: center; padding: 1%;">E-Mail</th>
                    <th width="10%" style=" text-align: center; padding: 1%;">Expertise</th>
                    <th width="15%" style=" text-align: center; padding: 1%;">Desempenho</th>
                    <th width="10%" style=" text-align: center; padding: 1%;">Media</th>
                    <!-- <th width="8%" style="text-align: center; padding: 1%;">Tipo</th> -->
                    <th width="1%" style="padding: 0%"></th>
                    <th width="1%" style="padding: 0%"></th>
                    <th width="1%" style="padding: 0%"></th>
                    <!-- <th width="1%" style="padding: 0%"></th> -->
                </tr>
                <div class="limpar"></div>
                <?php
               foreach ($listagem->getResult() as $listagem_):
                  //if ($listagem_['logo'] == ''):
                  //   $avatar = Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '500', '500', '');
                  //else:
                  //   $avatar = Check::Imagem('imagens_site/' . $listagem_['logo'] . '', $listagem_['nome'], '500', '500', '');
                  //endif;
                  ?>
                <tr class="lista_tabela">
                    <!--<td width="9%"><?//= $avatar; ?></td> -->
                    <td width="20%" data-balloon-length="large" data-balloon="<?= $listagem_['nome']; ?>" data-balloon-pos="up"><?= Check::limitcaracter($listagem_['nome'], 36); ?></td>
                    <td width="15%"><?= $listagem_['email']; ?></td>
                    <td width="10%"><?= $listagem_['expertise']; ?></td>
                    <td width="15%"><?= $listagem_['rendimento']; ?></td>
                    <td width="10%"><?= $listagem_['mediaproj']; ?></td>
                    <td width="2%">
                        <div class="btn id_arquivo_alt btn_green" id="<?= $listagem_['id']; ?>" style="" data-balloon-length="small" data-balloon="Editar Informações" data-balloon-pos="up">
                            <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                        </div>
                    </td>
                    <!-- <td width="2%"> 
                        <div class="modal_coorientador btn btn_green_escuro" style="" id="<?//= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Co-Orientador cadastrado" data-balloon-pos="up">
                           <figure class="icon-user-circle" style="font-size: 1.3em;"></figure>
                        </div>
                     </td> -->
                    <!--td width="2%"> 
                        <div class="cordenadores_alt btn btn_green" style="" id="<?= $listagem_['id']; ?>" data-balloon-length="small" data-balloon="Informações" data-balloon-pos="up">
                           <figure class="icon-edit-3" style="font-size: 1.3em;"></figure>
                        </div>
                     </td-->
                    <td width="2%">
                        <div class="btn btn_red excluir_modal" data-sms="" data-excluir="del_projeto" id="<?= $listagem_['id']; ?>" style="" data-balloon-length="small" data-balloon="Excluir" data-balloon-pos="up">
                            <figure class="icon-close2" style="font-size: 1.3em;"></figure>
                        </div>
                    </td>
                    <div class="limpar"></div>
                </tr>
                <?php
               endforeach;
            else:
               echo '<div class="list" style="color: #000; font-size: 1.1em;"><center>Não há orientadores cadastrados!</center></div>';
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

<div class="alterar_total">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2 fecha_cadastro">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="alterar_total_contetudo" style=" background: #fff; padding: 3%">
        <h1 class="topo_modal">Cadastrar Projeto</h1>
        <form class="form_linha" method="post" name="cad_orientador">
            <div class="box box100">
                <div class="box box33">
                    <p class="texto_form">Titulo do Projeto <font color=red>*</font>
                    </p>
                    <input name="nome" type="text" required placeholder="Título do Projeto" style=" width: 100%;" />
                </div>
                <div class="box box33">
                    <p class="texto_form">Responsavel <font color=red>*</font>
                    </p>
                    <?php include 'conexao.php';
                    $pdo_verifica = $conexao_pdo->prepare("select nome, matricula from tecnico order by nome DESC");
                     $pdo_verifica->execute();
                    $i=0;
                    $nome = array();
                    $matricula = array();
            while($fetch = $pdo_verifica->fetch()){
                $i=$i+1;
                    $nome[$i] = $fetch['nome'];
            }
                    
                    
                    
                    ?>
                    <select class="seletipo" name="curso" style=" width: 100%;">
                        <?php
                        foreach($nome as $value){
                            echo "<option>".$value."</option>";
                        }
                        ?>

                    </select>

                    <!--<input name="curso" type="text" required placeholder="Técnico Responsavel" style=" width: 100%;" />-->
                </div>
                <div class="box box33 no-margim" hidden>
                    <p class="texto_form">Expertise <font color=red>*</font>
                    </p>
                    <input name="faculdade" type="text" placeholder="Expertise" style=" width: 100%;" />
                </div>


                <div class="box box33" hidden>
                    <p class="texto_form">Matricula <font color=red>*</font>
                    </p>
                    <input name="cpf" type="text" placeholder="Matricula" autocomplete="off" style=" width: 100%;" />
                </div>

                <div class="box box33">
                    <p class="texto_form">Andamento<font color=red>*</font>
                    </p>
                    <input name="cr" type="text" placeholder="Andamento %" id="co" style=" width: 100%;" />
                </div>
                <div class="box box33 no-margim">
                    <p class="texto_form">Tipo<font color=red>*</font>
                    </p>
                    <select class="seletipo" name="tipo" style=" width: 100%;">
                        <option>Inovação</option>
                        <option>Melhoria</option>
                    </select>
                </div>
                <div class="box box33">
                    <p class=" texto_form">Entrega<font color=red>*</font>
                    </p>
                    <input type="date" name="entrega" style="width: 100%;" required>
                </div>

                <div class="limpar"></div>

                <div class="forms_exta ds-none" style=" width: 100%; padding: 2%; background: #f1f1f1; border: 0.9% solid #333;"></div>

                <div class="limpar"></div>
                <!--cordenador-->
                <div class="box box50">
                    <h1 class="topo_modal" style=" background: #1753ea;">Anexo</h1>
                    <div class="box box100">
                        <p class="texto_form"> Anexo auxiliar do Projeto <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Parecer/protocolo do Comitê de Ética (CEP) <font color=red></font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb2" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Comprovante de patrimônio Genético e de conhecimento tradicional (SISGEN)</p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb3" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Autorização pelo SISBIO de coleta de material biológico <font color=red></font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb4" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb5" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Cadastro atualizado no banco de pesquisa da FAPEAM <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb6" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Cadastro do orientador em grupo de pesquisa do ILMD <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb7" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100" hidden>
                        <p class="texto_form">Declaração de participação na orientação do aluno <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb8" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="limpar"></div>
                </div>
                <!-- aluno -->
                <div class="box box50 no-margim" hidden>
                    <h1 class="topo_modal">Cadastro do Aluno</h1>
                    <div class="box box100">
                        <p class="texto_form">Projeto do aluno detalhado em .DOC ou DOCX <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb20" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Declaração de responsabilidade na orientação do aluno <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb10" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Currículo na plataforma Lattes do CNPQ <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="envio_02" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Cadastro atualizado do candidato no banco de pesquisa da FAPEAM <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb11" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Histórico escolar de graduação atualizado <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb12" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>

                    <div class="box box100">
                        <p class="texto_form">Comprovante de matrícula atualizado <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb13" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Cópia do CPF e carteira de identidade do candidato <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb14" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
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
                        <input id='' type="file" name="user_thumb16" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                    <div class="box box100">
                        <p class="texto_form">Declaração negativa de vínculo empregatício <font color=red>*</font>
                        </p>
                        <!-- <label class="label_file" for='selecao-arquivo2'>Selecionar um arquivo</label> -->
                        <input id='' type="file" name="user_thumb17" class="" style=" display: block; width: 100%; border: 1px solid #b1b1b1; padding: 1%" />
                    </div>
                </div>
                <div class="limpar"></div>
                <br>
                <!--Co-orientado-->
                <div class="box box100" hidden>
                    <h1 class="topo_modal" style=" background: #9915a3;">Cadastro de Coorientador</h1>
                    <input TYPE="checkbox" NAME="cooo" checked VALUE="1" style=" margin-top: -0.5%; margin-right: 1%" hidden>O projeto não possui coorientador

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
            <input TYPE="checkbox" checked NAME="opcao" VALUE="1" required style=" margin-top: -0.5%; margin-right: 1%" hidden>
            <p hidden>
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


<!--CADASTROS /////////////////////////////////////////////////////////////////////////////////////////////////-->
<div class="cadastrar_total">
    <a href="" style="text-align: center;" data-balloon-length="small" data-balloon="Fecha" data-balloon-pos="left" class="fecha_moldura2">
        <figure class="icon-window-close" style="color: #fff;"></figure>
    </a>
    <div class="cadastrar_total_contetudo" style=" background: #fff; padding: 3%">
        <div class="cadastro_cliente_cv">
            <h1 class="topo_modal">Cadastro de Técnico</h1>
            <form class="form_linha" method="post" name="cad_orientador">
                <!-- cad_clientes -->
                <div class="box box100">
                    <div class="box box33">
                        <p class="texto_form">Nome completo(Obrigatório)</p>
                        <input name="nome" type="text" required placeholder="Nome completo" style=" width: 100%;" />
                    </div>
                    <div class="box box33">
                        <p class="texto_form">E-mail válido</p>
                        <input name="email" type="email" placeholder="E-mail válido" style=" width: 100%;" />
                    </div>
                    <div class="box box33 no-margim">
                        <p class="texto_form">Matricula</p>
                        <input name="cpf" type="text" required placeholder="Matrícula do Técnico" style=" width: 100%;" />
                    </div>

                    <div class="box box33 no-margim">
                        <p class="texto_form">Expertise</p>
                        <input name="expertise" type="text" required placeholder="Expertise" style=" width: 100%;" />
                    </div>
                </div>


                <div class="box box20 no-margim">
                    <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
                        <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar
                    </button>
                </div>

                <div class="limpar"></div>
                <br>
                <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
                <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>

                <div class="limpar"></div>
            </form>
        </div>






        <div class="cadastro_empresa_cv ds-none">
            <h1 class="topo_modal">Cadastro de empresa</h1>
            <form class="form_linha" method="post" name="cad_cliente">
                <div class="box box80">
                    <div class="box box50" style="">
                        <p class="texto_form">Nome fantasia</p>
                        <input name="nome" type="text" required placeholder="Nome fantasia" style=" width: 100%;" />
                    </div>
                    <div class="box box50 no-margim">
                        <p class="texto_form">Nome da empresa</p>
                        <input name="nome_empresa" type="text" placeholder="Nome da empresa" style=" width: 100%;" />
                    </div>
                    <div class="limpar"></div>
                    <div class="box box33">
                        <p class="texto_form">CNPJ ou CPF</p>
                        <input name="cnpj_cpf" type="text" required placeholder="Seu CPF ou CNPJ (obrigatório)" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' style="width: 100%" />
                    </div>
                    <div class="box box33">
                        <p class="texto_form">Inscrição estadual</p>
                        <input name="ie" type="text" placeholder="Inscrição estadual" style=" width: 100%;" />
                    </div>
                    <div class="box box33 no-margim">
                        <p class="texto_form">Inscrição municipal</p>
                        <input name="im" type="text" placeholder="Inscrição municipal" style=" width: 100%;" />
                    </div>
                    <div class="limpar"></div>
                    <div class="box box33">
                        <p class="texto_form">Telefone</p>
                        <input name="tel" type="text" placeholder="Telefone" id="mascara_telefone2" style=" width: 100%;" />
                    </div>
                    <div class="box box33">
                        <p class="texto_form">Telefone</p>
                        <input name="tel2" type="text" placeholder="Telefone" id="mascara_celular2" style=" width: 100%;" />
                    </div>
                    <div class="box box33 no-margim">
                        <p class="texto_form">Telefone</p>
                        <input name="tel3" type="text" placeholder="Telefone" id="mascara_celular3" style=" width: 100%;" />
                    </div>

                    <div class="limpar"></div>
                    <div class="box box50">
                        <p class="texto_form">Categoria</p>
                        <select name="categoria" required style="width: 100%;">
                            <option value="1">Cliente efetivo</option>
                            <option value="2">Cliente em potencial</option>
                            <option value="3">Concorrente</option>
                            <option value="4">Fornecedor</option>
                            <option value="5">Parceiro</option>
                        </select>
                    </div>
                    <div class="box box50 no-margim">
                        <p class="texto_form">Origem</p>
                        <select name="origem" required style="width: 100%;">
                            <option value="1">Site</option>
                            <option value="2">Telefone/Celular</option>
                            <option value="3">Formulário de contato</option>
                            <option value="4">Whatsapp</option>
                            <option value="5">E-mail</option>
                            <option value="6">Facebook</option>
                            <option value="7">Instagram</option>
                            <option value="8">Twitter</option>
                        </select>
                    </div>
                    <div class="limpar"></div>
                    <p class="legenda_form">Endereço completo</p>
                    <div class="box box-completa">
                        <input name="cep" class="cep_cad_parsa" type="text" placeholder="Seu CEP *" value="" id="csp mascara_cep" style=" width: 99%;" />
                        <div class="load2" style=" display: none"></div>
                    </div>
                    <div class="box box70">
                        <input name="rua" type="text" placeholder="Rua, Avenida" value="" id="logradourop" style=" width: 100%;" />
                    </div>
                    <div class="box box30 no-margim">
                        <input name="numero" type="text" placeholder="Nº" value="" style=" width: 100%;" />
                    </div>
                    <div class="limpar"></div>

                    <div class="box box-completa">
                        <input name="complemento" type="text" placeholder="Complemento" value="" style=" width: 99%;" />
                    </div>
                    <div class="limpar"></div>

                    <div class="box box35">
                        <input name="bairro" type="text" placeholder="Bairro" value="" id="bairrop" style=" width: 100%;" />
                    </div>
                    <div class="box box35">
                        <input name="cidade" type="text" placeholder="Cidade" value="" id="localidadep" style=" width: 100%;" />
                    </div>

                    <div class="box box30 no-margim">
                        <input name="estado" type="text" placeholder="Estado" value="" id="ufp" style=" width: 100%;" />
                    </div>
                    <div class="limpar"></div>
                    <textarea name="obs" id="elm2" rows="10" placeholder="Observações" style=" width: 100%; height: 150px"></textarea>
                </div>


                <div class="box box20 no-margim">

                    <p class="texto_form"><?= $titulo_foto; ?></p>
                    <img class="user_thumb" style="width: 100%;" alt="Foto do usuário" title="Foto do usuário" src="<?= HOME; ?>imagens_fixas/sem_imagem.jpg" default="<?= HOME; ?>imagens_fixas/sem_imagem.jpg">
                    <div class="box_content">
                        <div class="limpar"></div>
                        <div class="mensagem_imagem ds-none">
                            <p><b></b></p>
                        </div>
                        <span class="legend">Foto (500x500px, JPG ou PNG):</span>
                        <div class="limpar" style=" margin-bottom: 2%"></div>
                        <label class="label_file" for='selecao-arquivo9'>Selecionar um arquivo</label>
                        <input id='selecao-arquivo9' type="file" name="user_thumb" class="wc_loadimage" />
                        <div class="limpar"></div>


                        <div class="upload_bar m_top m_botton">
                            <div class="upload_progress ds-none">0%</div>
                        </div>
                        <img class="form_load ds-none fl_right" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="imagens_fixas/carregando2.gif" />
                        <div class="limpar"></div>
                        <br><br>
                        <button class="btn btn_green fl-left" style="font-size: 0.8em; margin-right: 1%">
                            <figure class="icon-save2" style="margin-top: -6%;"></figure> Cadastrar
                        </button>
                        <div class="btn btn_blue fl-left voltar_escolha_empresa" style="font-size: 0.8em; margin-right: 1%">
                            <figure class="icon-arrow-back" style="margin-top: -6%;"></figure> Voltar
                        </div>
                    </div>
                </div>

                <div class="limpar"></div>
                <br>
                <input type="hidden" name="id" value="<?= $usuario_['id']; ?>" />
                <span class="carregando2 ds-none"><img src="<?= HOME; ?>imagens_fixas/carregando2.gif" /></span>
                <div class="limpar"></div>
            </form>
        </div>
        <div class="limpar"></div>
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
