$(window).load(function () {
   $('.carregando_sistem').fadeOut(700, function () {
      $('.modal_janela_c').fadeOut(500);
   });

   //ESTABALECENDO ALTURA PARA A JANELA MODAS
   var modal = $(window).delay(2000).height();
   $('.menu').css({'height': modal});
   $('.cont').css({'height': modal});
   $('#map-canvas').css({'height': modal});
   $('.menu_mapa').css({'height': modal});

   var novamodal = modal - 80;
   $('.moldura_contetudo2').css({'max-height': novamodal});
   $('.moldura_contetudo').css({'max-height': novamodal});
   $('.alterar_total_contetudo').css({'max-height': novamodal});
   $('.cadastrar_total_contetudo').css({'max-height': novamodal});


   $('nav').addClass('animated bounceInRight');
   $('.chamada').addClass('animated bounceInDown');
   //rxScroll();
   setTimeout(function () {
      $('.login').removeClass('ds-none').fadeIn().addClass('animated bounceInLeft');
   }, 1500);
});
var urlbase = $('link[rel="base"]').attr('href');
$(function () {
   var botao = $('.enviar');
   botao.attr("type", "submit");
   var forms = $('form');
   var urlphp = '' + urlbase + 'php/php.php';
   forms.submit(function () {
      return false;
   });
//===============================================================================================================================
// FUNÇÕES GENERICAS 
//===============================================================================================================================
//como funciona o melhor alerta/////////////////////////////////////////////
//icone logado= icon-unlock1
//icone Alterado= icon-repost
//icone Alerta= icon-notifications_active
//icone Sucesso= icon-thumbs-up2
//icone Erro= icon-thumbs-down2
//
//triggerNotify({title: "Artigo cadastrado com sucesso!", icon: "icon-plus6", color: "green", timer: 3000});
//triggerNotify({title: "Artigo cadastrado com sucesso!", icon: "icon-plus6", color: "blue", timer: 3000});
//triggerNotify({title: "Artigo cadastrado com sucesso!", icon: "icon-plus6", color: "red", timer: 3000});
//triggerNotify({title: "Artigo cadastrado com sucesso!", icon: "icon-plus6", color: "yellon", timer: 3000});
   function triggerNotify(data) {
      var triggerContent = "<div class='trigger_notify trigger_notify_" + data.color + "' style='left: 100%; opacity: 0;'>";
      triggerContent += "<p'><figure class='" + data.icon + "' style=' margin-right: 2%'></figure> " + data.title + "</p>";
      triggerContent += "<span class='trigger_notify_timer'></span>";
      triggerContent += "</div>";

      if (!$('.trigger_notify_box').length) {
         $('body').prepend("<div class='trigger_notify_box'></div>");
      }

      $('.trigger_notify_box').prepend(triggerContent);
      $('.trigger_notify').stop().animate({'left': '0', 'opacity': '1'}, 200, function () {
         $(this).find('.trigger_notify_timer').animate({'width': '100%'}, data.timer, 'linear', function () {
            $('.trigger_notify').animate({'left': '100%', 'opacity': '0'}, function () {
               $(this).remove();
            });
         });
      });

      $('body').on('click', '.trigger_notify', function () {
         $(this).animate({'left': '100%', 'opacity': '0'}, function () {
            $(this).remove();
         });
      });
   }
   function carregando() {
      $('.modal_janela_c').fadeIn(700, function () {
         $('.carregando_sistem').fadeIn().addClass('animated zoomIn');
         setTimeout(function () {
            $('.carregando_sistem').removeClass('animated zoomIn');
         }, 1200);
      });
   }
   function carregandoOut() {
      $('.modal_janela_c').fadeOut(1000, function () {
         $('.carregando_sistem').fadeOut(500);
      });
   }
   function carregandoOut2() {
      $('.carregando_sistem').fadeOut();
   }
   function erro(msg) {
      $('.modal').addClass('animated fadeInRight').fadeIn(1000, function () {
         $('.msn-erro').addClass('animated fadeInRight').empty().html(msg).fadeIn(1000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeInRight');
         }, 2000);

         setTimeout(function () {
            $('.modal').addClass('animated fadeOutRight');
            $('.msn-erro').fadeOut(2000);
         }, 3000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeOutRight');
            $('.msn-erro').removeClass('animated fadeInRight');

         }, 5000);
      });
   }
   function sucesso(msg) {

      $('.modal').addClass('animated fadeInRight').fadeIn(1000, function () {
         $('.msn-sucess').addClass('animated fadeInRight').empty().html(msg).fadeIn(1000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeInRight');
         }, 2000);

         setTimeout(function () {
            $('.modal').addClass('animated fadeOutRight');
            $('.msn-sucess').fadeOut(2000);
         }, 3000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeOutRight');
            $('.msn-sucess').removeClass('animated fadeInRight');

         }, 5000);
      });
   }
   function alerta(msg) {

      $('.modal').addClass('animated fadeInRight').fadeIn(1000, function () {
         $('.msn-alert').addClass('animated fadeInRight').empty().html(msg).fadeIn(1000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeInRight');
         }, 2000);

         setTimeout(function () {
            $('.modal').addClass('animated fadeOutRight');
            $('.msn-alert').fadeOut(2000);
         }, 3000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeOutRight');
            $('.msn-alert').removeClass('animated fadeInRight');

         }, 5000);

      });
   }
   function erroines() {
      $('.modal').addClass('animated fadeInRight').fadeIn(1000, function () {
         $('.msn-erro').addClass('animated fadeInRight').empty().html('Erro inesperado, entre em contato com o administrador').fadeIn(1000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeInRight');
         }, 2000);

         setTimeout(function () {
            $('.modal').addClass('animated fadeOutRight');
            $('.msn-erro').fadeOut(2000);
         }, 3000);

         setTimeout(function () {
            $('.modal').removeClass('animated fadeOutRight');
            $('.msn-erro').removeClass('animated fadeInRight');

         }, 5000);

      });
   }
   //------------ CONFIGURANDO BOX DA MODAL    --------------------------------------------------------------------
   $('.x_modal').click(function () {
      $('.msn-erro').empty().html('');
      $('.msn-sucess').empty().html('');
      $('.msn-alert').empty().html('');
      $('.msn-erro').empty().html('');
      $('.modal').fadeOut(600);
   });
   $('.transp').css({opacity: 0});
   $("select").select2();
   $('.cadastro_cliente_cv_').click(function () {
      $('.cadastro_escolha_cv').fadeOut(function () {
         $('.cadastro_cliente_cv').fadeIn();
      });
   });
   $('.cadastro_empresa_cv_').click(function () {
      $('.cadastro_escolha_cv').fadeOut(function () {
         $('.cadastro_empresa_cv').fadeIn();
      });
   });
   $('.voltar_escolha_empresa').click(function () {
      $('.cadastro_empresa_cv').fadeOut(function () {
         $('.cadastro_escolha_cv').fadeIn();
      });
   });
   $('.voltar_escolha_cliente').click(function () {
      $('.cadastro_cliente_cv').fadeOut(function () {
         $('.cadastro_escolha_cv').fadeIn();
      });
   });
//===============================================================================================================================
// CONFIGURANDO AJAX 
//===============================================================================================================================	
   $.ajaxSetup({
      url: urlphp,
      type: 'POST',
      //beforeSend: carregando,
      error: erroines
   });
//===============================================================================================================================	
//===============================================================================================================================	  
   $('body').on('click', '.final__dropdown', function () {
      $('.final__dropdown__menu').fadeToggle();
   });
//sistema de compra 
   $('.moldura_contetudo2').on('change', '.selecione_statauis', function () {
      var valor = $("option:selected").attr('value');
      if (valor == '1') {
         $('.alert_status').fadeOut();
      } else if (valor == '2') {
         $('.alert_status').empty().fadeIn().html('Informar o pagamento ao seu cliente por e-mail, envie a nota fiscal abaixo e o número, para ser informado no e-mail que será enviado pelo e-mail.');
      } else if (valor == '3') {
         $('.alert_status').empty().fadeIn().html('Informar o número de rastreio para ser enviado por e-mail para o seu cliente.');
      } else if (valor == '4') {
         $('.alert_status').empty().fadeIn().html('Não será enviado e-mail para o seu cliente, porem as peças irão retonar para seu estoque.');
      }
   });
   
//agenda
         $('.tempo_dia').click(function(){
            $('.tempo_dia_').slideToggle();
         });

   
   //trasição login e senha
   $('.esqueci_senha').click(function () {
      $('.login_entrada').fadeOut(800, function () {
         $('.senha').fadeIn(800);
      });
      return false;
   });
   $('.voltar_painel').click(function () {
      $('.senha').fadeOut(800, function () {
         $('.login_entrada').fadeIn(800);
      });
      return false;
   });
//CONTROLE DO MEU
   $('.link_cadastro').click(function () {
      $('.cadastro_menu').slideToggle(700);
   });
   $('.link_controle').click(function () {
      $('.controle_menu').slideToggle(700);
   });
   $('.finace').click(function () {
      $('.finace_p').slideToggle(700);
   });
   $('.link_dados').click(function () {
      $('.dados_menu').slideToggle(700);
   });
   $('.link_conf').click(function () {
      $('.config_menu').slideToggle(700);
   });
   $('.link_blog').click(function () {
      $('.blog_menu').slideToggle(700);
   });
   $('.link_txt').click(function () {
      $('.txt_menu').slideToggle(700);
   });
   $('.link_txt_r').click(function () {
      $('.txt_menu_r').slideToggle(700);
   });
   $('.link_crm').click(function () {
      $('.txt_crm').slideToggle(700);
   });
   $('.prod_conf').click(function () {
      $('.prod_menu').slideToggle(700);
   });
   $('.link_local').click(function () {
      $('.local_menu').slideToggle(700);
   });
   $('.recuperar').click(function () {
      $('.login_').fadeOut(1000, function () {
         $('.senha_').fadeIn(1000);
      });
   });
   $('.logando').click(function () {
      $('.senha_').fadeOut(1000, function () {
         $('.login_').fadeIn(1000);
      });
   });
   //MENU PRINCIPAL
   $('.mostar_menu').click(function () {
      $('.menu_ss').fadeOut();
      $('.menu').animate({left: 0}), 1000;
      $('.menu_suspent').animate({left: '17%'}), 1000;
      setTimeout(function () {
         $('.cont').css({'width': '100%'});
      }, 300);

      setTimeout(function () {
         $('.esconder_menu').removeClass('ds-none').fadeIn();
         $('.menu_ss2').fadeIn();
      }, 400);
      return false;
   });
   $('.esconder_menu').click(function () {
      $('.menu_suspent').animate({left: 0}), 1000;
      $('.menu_ss2').fadeOut();
      $('.menu').animate({left: '-17%'}), 1000;
      setTimeout(function () {
         $('.cont').css({'width': '100%'});
      }, 300);

      setTimeout(function () {
         $('.mostar_menu').fadeIn();
         $('.menu_ss').fadeIn();
      }, 400);
      return false;
   });
   //ANIMAÇÃO DE CADASTRO LISTAGEM E ALTERAÇÃO
   $('.cadastrar').click(function () {
      $('.modal_janela_c').fadeIn();
      $('.cadastrar_total').fadeIn().addClass('animated bounceInDown');
      setTimeout(function () {
         $('.cadastrar_total').removeClass('animated bounceInDown');
      }, 1000);
      return false;
   });
   $('.cadastrar_categoria').click(function () {
      $('.modal_janela_c').fadeIn();
      $('.categoria_blog').fadeIn().addClass('animated bounceInDown');
      setTimeout(function () {
         $('.categoria_blog').removeClass('animated bounceInDown');
      }, 1000);
      return false;
   });
   $('.fechar_cadastro').click(function () {
      $('.cadastro').slideUp();
      return false;
   });
   $('.form_alt').on('click', '.fechar_alterar', function () {
      $('.alterar').slideUp();
   });
   $('body').on('change', '.wc_loadimage', function () {
      var input = $(this);
      var target = $('.' + input.attr('name'));
      var fileDefault = target.attr('default');

      if (!input.val()) {
         target.fadeOut('fast', function () {
            $(this).attr('src', fileDefault).fadeIn('slow');
         });
         return false;
      }

      if (this.files && this.files[0].type.match('image.*')) {
         var reader = new FileReader();
         reader.onload = function (e) {
            target.fadeOut('fast', function () {
               $(this).attr('src', e.target.result).width('100%').height('100%').fadeIn('fast');
            });
         };
         reader.readAsDataURL(this.files[0]);
      } else {
         $('.mensagem_imagem').fadeIn().html('<p><b>ERRO AO SELECIONAR:</b> O arquivo <b>' + this.files[0].name + '</b> Não e válido! <b>Selecione uma imagem JPG ou PNG!</b></p>');
         setTimeout(function () {
            $('.mensagem_imagem').fadeOut();
         }, 5000);

         target.fadeOut('fast', function () {
            $(this).attr('src', fileDefault).fadeIn('slow');
         });
         input.val('');
         return false;
      }
   });
   //MODAL
   $('.fecha_moldura').click(function () {
      $('.moldura').fadeOut(500, function () {
         $('.modal_janela_c').fadeOut();
         setTimeout(function () {
            $('.moldura_contetudo').empty();
         }, 400);
      });

      return false;
   });
   $('.fecha_moldura2').click(function () {
      $('.moldura2').fadeOut(500, function () {
         $('.modal_janela_c').fadeOut();
         setTimeout(function () {
            $('.moldura_contetudo2').empty();
         }, 400);
      });

      $('.categoria_blog').fadeOut(500, function () {
         $('.modal_janela_c').fadeOut();
      });

      $('.cadastrar_total').fadeOut(500, function () {
         $('.modal_janela_c').fadeOut();
      });

      $('.alterar_total').fadeOut(500, function () {
         $('.modal_janela_c').fadeOut();
      });
      return false;
   });
//===============================================================================================================================
// MODAIS DE EXCLUSÃO
//===============================================================================================================================
   //  $('.excluir_modal').click(function () {
   //     var delaid = $(this).attr('id');
   //     var delaid_calor = $(this).attr('data-excluir');
   //alert(delaid + delaid_calor);
   //     $('.modal_janela_c').fadeIn(400, function () {
//         $('.modal_exclusao').empty().html('<h1>Tem certeza de que deseja excluir o item selecionado?</h1><a href="" class="btn btn_red exca_sim ' + delaid_calor + '" id="' + delaid + '">Sim</a><a href="" class="btn btn_green exca_nao">Não</a>');
//         $('.modal_exclusao').fadeIn();
//      });
   //     return false;
   //  });
//===============================================================================================================================
// SELECIONAR A ESCOLHER REPRESENTANTE DA EMPRESA NO SAC
//===============================================================================================================================   
   $('body').on('change', 'select[name=empresa]', function () {
      var dados = $(this).serialize();
      var acao = "&acao=selcat";
      var sender = dados + acao;
      $.ajax({
         data: sender,
         beforeSend: function () {
            $("select[name=contato_empresa]").html('<option value="0">Aguarde Carregando...</option>');
         },
         success: function (resposta) {
            if (resposta == '') {
               complete: $("select[name=contato_empresa]").html('<option value=" ">Esta categoria não tem subcategorias, selecione outra...</option>');
            } else {
               complete: $("select[name=contato_empresa]").html(resposta);
            }
         },
         complete: function () {
            //location.href="quem_somos.php";
         }
      });
   });

   $('body').on('click', '.excluir_modal', function () {
      //$('.excluir_modal').click(function () {
      var delaid = $(this).attr('id');
      var delaid_calor = $(this).attr('data-excluir');
      var delaid_msn = $(this).attr('data-sms');
      //alert(delaid_msn);
      if (!delaid_msn) {
         var delaid_msn = 'Tem certeza de que deseja excluir o item selecionado?';
      }

      $('.modal_janela_c').fadeIn(400, function () {
         $('.modal_exclusao').empty().html('<h1>' + delaid_msn + '</h1><a href="" class="btn btn_red exca_sim ' + delaid_calor + '" id="' + delaid + '">Sim</a><a href="" class="btn btn_green exca_nao">Não</a>');
         $('.modal_exclusao').fadeIn();
      });
      return false;
   });
//FECHA JANELA DE EXCLUSÃO GENERICA
   $('.modal_exclusao').on('click', '.exca_nao', function () {
      $('.modal_exclusao').fadeOut(400, function () {
         $('.modal_janela_c').fadeOut();
      });
      return false;
   });
//===============================================================================================================================
// BUSCAR CEP
//===============================================================================================================================   
   $('body').on('focusout', '.cep_cad_parsa', function () {
      //$('.cep_cad_parsa').focusout(function () {
      $('.load2').empty().html('<img src="imagens_fixas/carregando.gif" width="20" height="20" />  Aguarde, enviando requisição!').fadeIn('fast');
      var delaid = $(this).val();
      var acao = "&acao=busca_cep&cep=" + delaid;
      var sender = acao;
      $.ajax({
         data: sender,
         beforeSend: function () {
            $('.load4').fadeIn(1000);
         },
         dataType: 'json',
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 2) {
               triggerNotify({title: "CEP, não encontrado", icon: "icon-thumbs-down2", color: "red", timer: 4000});
               $('.load2').fadeOut(800);
            } else {
               $('#logradourop').val(resposta.rua);
               $('#bairrop').val(resposta.bairro);
               $('#localidadep').val(resposta.cidade);
               $('#ufp').val(resposta.estado);
               $('.load2').fadeOut(800);
            }
         },
         complete: function () {
            //produto.find("input:text").val('');
            // produto.find(".textarea").val('');
         }
      });
   });
   $('body').on('focusout', '.cep_cad_parsa2', function () {
      //$('.cep_cad_parsa').focusout(function () {
      $('.load2').empty().html('<img src="imagens_fixas/carregando.gif" width="20" height="20" />  Aguarde, enviando requisição!').fadeIn('fast');
      var delaid = $(this).val();
      var acao = "&acao=busca_cep&cep=" + delaid;
      var sender = acao;
      $.ajax({
         data: sender,
         beforeSend: function () {
            $('.load4').fadeIn(1000);
         },
         dataType: 'json',
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 2) {
               triggerNotify({title: "CEP, não encontrado", icon: "icon-thumbs-down2", color: "red", timer: 4000});
               $('.load2').fadeOut(800);
            } else {
               $('#logradourop2').val(resposta.rua);
               $('#bairrop2').val(resposta.bairro);
               $('#localidadep2').val(resposta.cidade);
               $('#ufp2').val(resposta.estado);
               $('.load2').fadeOut(800);
            }
         },
         complete: function () {
            //produto.find("input:text").val('');
            // produto.find(".textarea").val('');
         }
      });
   });
//===============================================================================================================================
// SISTEMA DE EMPRESAS
//=============================================================================================================================== 

   //  uploadProgress: function (evento, posicao, total, completo) {
   //   bar.fadeIn();
   // console.log(completo);
   //   var porcentagem = completo + "%";
   //   per.width(porcentagem).text(porcentagem);
   //  },
   var cad_cliente = $('form[name="cad_cliente"]');
   cad_cliente.submit(function () {
      tinyMCE.triggerSave();
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_cliente"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut();
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.cadastrar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.cadastrar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               $('.cadastrar_total').fadeIn();
               $('.modal_janela_c').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.cadastrar_total').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.cadastrar_total').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.cadastrar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.id_cliente_alt').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_cliente_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
   $('.alterar_total').on('submit', 'form[name="editar_cliente"]', function () {
      var editar_cliente = $('form[name="editar_cliente"]');
      tinyMCE.triggerSave();
      editar_cliente.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_cliente"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut();
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('body').on('click', '.remove_arquivo', function () {
      //$('.ex_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=remove_arquivo&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.alterar_total').fadeOut();
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  $('.modal_janela_c').fadeIn();
                  $('.alterar_total').fadeIn();
               }, 1000);
               setTimeout(function () {
                  $('.apagar_' + delaid + '').fadeOut();
               }, 1500);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('body').on('click', '.ex_empresa', function () {
      //$('.ex_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ex_empresa&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_exclusao').fadeOut(400, function () {
                  $('.modal_janela_c').fadeOut();
               });
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('body').on('click', '.modal_usuario_empresa', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=modal_usuario_empresa&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.carregando_sistem').fadeOut(function () {
                  $('.moldura_contetudo2').empty().html('' + resposta + '');
                  $('.moldura2').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.moldura2').removeClass('animated bounceInDown');
                  }, 1000);
                  $('.carregando_sistem').fadeOut();
               });
            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('submit', 'form[name="cad_cliente_usuario"]', function () {
      //cad_cliente_usuario.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_cliente_usuario"},
         beforeSubmit: function () {
            $('.moldura2').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('body').on('click', '.id_usuario_alt', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_usuario_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.moldura2').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.carregando_sistem').fadeOut(function () {
                  $('.alterar_total_contetudo').empty().html('' + resposta + '');
                  $('.alterar_total').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.alterar_total').removeClass('animated bounceInDown');
                  }, 1000);
                  $('.carregando_sistem').fadeOut();
               });
            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('submit', 'form[name="editar_cliente_usuario"]', function () {
      //cad_cliente_usuario.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_cliente_usuario"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
           // alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// CADASTRO DE CLIENTES
//===============================================================================================================================   
   var cad_clientes = $('form[name="cad_clientes"]');
   cad_clientes.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_clientes"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
   });
   $('.id_clientes_alt').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_clientes_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('submit', 'form[name="editar_clientes"]', function () {
      var editar_clientes = $('form[name="editar_clientes"]');
      editar_clientes.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_clientes"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// CADASTRO DE USUÁRIOS
//===============================================================================================================================      
   var cad_tecnico = $('form[name="cad_usuario"]');
   cad_tecnico.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_usuario"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cadastrar_usuario";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// VERIFICANDO ID PARA ALTERAÇÃO DO USUÁRIO
//===============================================================================================================================      
   $('.id_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=identificar_usuario&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.modal_janela_c').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
//===============================================================================================================================
// ALTERANDO CADASTRO DO USUARIO
//=============================================================================================================================== 
   $('body').on('submit', 'form[name="editar_usuario"]', function () {
      var editar_usuario = $('form[name="editar_usuario"]');
      editar_usuario.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_usuario"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cadastrar_usuario";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// DELETANDO USUARIO
//===============================================================================================================================      
   $('.modal_exclusao').on('click', '.ex_usuario', function () {
      //$('.ex_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ex_usuario&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_exclusao').fadeOut(400, function () {
                  $('.modal_janela_c').fadeOut();
               });
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cadastrar_usuario";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Campo em branco, atualize sua página e tente novamente.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
//===============================================================================================================================
// CADASTRO DE CUPOM
//===============================================================================================================================      
   var cad_cupom = $('form[name="cad_cupom"]');
   cad_cupom.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_cupom"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cupom";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Desculpe o cupom não pode ter o código igual!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// LOGAR NO SISTEMA
//===============================================================================================================================
   var login = $('form[name="logar"]');
   login.submit(function () {
      var dados = $(this).serialize();
      var acao = "&acao=login";
      var sender = dados + acao;
      $.ajax({
         data: sender,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Bem vindo, Vou redireciona-lo para seu escritório online.", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "dashboard";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               $('.login_ button').html('Entrar');
               triggerNotify({title: "Desculpe! Login ou senha não confere...", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.login_ button').html('Entrar');
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 7) {
               carregandoOut();
               $('.login_ button').html('Entrar');
               triggerNotify({title: "Desculpe! Sua conta foi bloquiada entre em contato com o atendimento no e-mail: sac@casadossites.com", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut();
               $('.login_ button').html('Entrar');
               triggerNotify({title: "Desculpe! Sua conta ainda não foi autenticada, procure o e-mail em sua caixa de entrada ou spam em sua conta de e-mail e click no link para valisar seu cadastro", color: "blue", timer: 4000});
            } else if (resposta == 6) {
               carregandoOut();
               $('.login_ button').html('Entrar');
               triggerNotify({title: "Por Favor! Digite um e-mail valido.", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            login.find("input:text").val('');
            login.find(".textarea").val('');
         }
      });
   });
//===============================================================================================================================
// SISTEMA DE ESQUECI MINHA SENHA
//===============================================================================================================================
   var senha = $('form[name="senha"]');
   senha.submit(function () {
      var dados = $(this).serialize();
      var acao = "&acao=senha";
      var sender = dados + acao;
      $.ajax({
         data: sender,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Foi enviado para o seu e-mail as instruções para a alteração de senha.", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               $('.senha_ button').html('Recuperar');
            } else if (resposta == 2) {
               carregandoOut();
               $('.senha_ button').html('Recuperar');
               triggerNotify({title: "Desculpe! E-mail não confere...", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.senha_ button').html('Recuperar');
               triggerNotify({title: "Erro ao enviar, campo de e-mail em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               $('.senha_ button').html('Recuperar');
               triggerNotify({title: "Desculpe! Ocorreu um erro no sistema se persistir entre em contato com admin!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            senha.find("input:text").val('');
            senha.find(".textarea").val('');
         }
      });
   });
//===============================================================================================================================
// ALTERAR PERFIL  
//===============================================================================================================================
   var editar_usuario_perfil = $('form[name="editar_usuario_perfil"]');
   editar_usuario_perfil.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_usuario_perfil"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
//alert(resposta);
            if (resposta == 1) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "dashboard";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('Carro já cadastrado!');
            } else if (resposta == 8) {
               $('.carregando2').fadeOut();
               alerta('Tamanho da imagem e maior que 4 megas!');
            } else if (resposta == 11) {
               $('.carregando2').fadeOut();
               alerta('Este arquivo não é um arquivo .jpg ou .png');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// ALTERAR TAXA DE VENDA
//===============================================================================================================================      
   var sobrepreco = $('form[name="sobrepreco"]');
   sobrepreco.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "sobrepreco"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "configuracao";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               $('.carregando2').fadeOut();
               alerta('Produto já cadastrado, verifique o código que já consta em nosso banco de dados!');
            } else if (resposta == 6) {
               $('.carregando2').fadeOut();
               alerta('Código do fabricante já existe!');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// CADASTRAR DEPOIMENTOS
//===============================================================================================================================      
   var depoimento = $('form[name="depoimento"]');
   depoimento.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "depoimento"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            // alert(resposta);
            if (resposta == 1) {
               $('.cadastrar_total').fadeOut();
               $('.modal_janela_c').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "depoimentos";
               }, 2000);
            } else if (resposta == 2) {
               $('.cadastrar_total').fadeOut();
               $('.modal_janela_c').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.cadastrar_total').fadeOut();
               $('.modal_janela_c').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.cadastrar_total').fadeOut();
               $('.modal_janela_c').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// DEPOIMENTOS
//===============================================================================================================================      
   $('.depoimento_status_alt').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=depoimento_status_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
            $('.alterar').slideUp();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "depoimentos";
               }, 2000);
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {

            }
         },
         complete: function () {
         }
      });
   });
   $('.depoimento_status').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=depoimento_status&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.modal_janela_c').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
   $('.modal_exclusao').on('click', '.ex_depoimento', function () {
      //$('.ex_slide').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ex_depoimento&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_exclusao').fadeOut(400, function () {
                  $('.modal_janela_c').fadeOut();
               });
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "depoimentos";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Campo em branco, atualize sua página e tente novamente.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('.alterar_total').on('submit', 'form[name="depoimento_alt"]', function () {
      var depoimento_alt = $('form[name="depoimento_alt"]');
      depoimento_alt.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "depoimento_alt"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});

               setTimeout(function () {
                  location.href = "" + urlbase + "depoimentos";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// ABRIR MODAL DE ENVIO DE E-MAIL PARA O CLIENTE
//===============================================================================================================================      
   $('body').on('click', '.email_cliente', function () {
      //$('.email_cliente').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=email_cliente&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.modal_janela_c').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.moldura_contetudo').empty().html('' + resposta + '');
               $('.moldura').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.moldura').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {
         }
      });
   });
//===============================================================================================================================
// ENVIAR E-MAIL PARA CLIENTE
//===============================================================================================================================
   $('.moldura_contetudo').on('submit', 'form[name="email_cliente_form"]', function () {
      var email_cliente_form = $('form[name="email_cliente_form"]');
      tinyMCE.triggerSave();
      //alert('entrei 1');
      email_cliente_form.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "email_cliente_form"},
         beforeSubmit: function () {
            $('.moldura_contetudo').fadeOut();
            $('.carregando_sistem').fadeIn().addClass('animated zoomIn');
            setTimeout(function () {
               $('.carregando_sistem').removeClass('animated zoomIn');
            }, 1000);
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            // alert(resposta);
            if (resposta == 1) {
            } else if (resposta == 2) {
               alert('Descrição não pode ser em branco');
               $('.carregando_sistem').fadeOut();
               $('.moldura_contetudo').fadeIn();
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('Vinculo igual já cadastrado!');
               setTimeout(function () {
                  location.href = "" + urlbase + "produto_tipo_1";
               }, 2000);
            } else {
               $('.carregando_sistem').fadeOut();
               $('.moldura_contetudo').empty().fadeIn().html('' + resposta + '');
               $('.moldura').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.moldura').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// BUSCAR CLIENTE
//===============================================================================================================================
   var busca_cliente = $('form[name="busca_cliente"]');
   busca_cliente.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "busca_cliente"},
         beforeSubmit: function () {
            $('.lista_atual').slideUp();
            $('.carregando_busca').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('Equipamento já cadastrado!');
            } else {
               $('.lista_nova').html('' + resposta + '');
               $('.lista_nova').slideDown();
               $('.carregando_busca').fadeOut();
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// SISTEMA DE PORTIFÓLIO
//=============================================================================================================================== 
   $('body').on('click', '.ale_portolio_', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ale_portolio_&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.novo_portifolio').slideUp();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.alterados_portifolio').slideDown();
               $('.alterados_portifolio').empty().html('' + resposta + '');
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('click', '.cad_portolio', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=cad_portolio&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('submit', 'form[name="cad_portfolionovo"]', function () {
      var cad_portfolionovo = $('form[name="cad_portfolionovo"]');
      cad_portfolionovo.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_portfolionovo"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.alterar_total').on('submit', 'form[name="cad_portfolioo"]', function () {
      var cad_portfolioo = $('form[name="cad_portfolioo"]');
      cad_portfolioo.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_portfolioo"},
         beforeSubmit: function () {
            $('.carregando2').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});

               setTimeout(function () {
                  location.href = "" + urlbase + "cliente";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.modal_janela_c').fadeOut();
               $('.alterar_total').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// SISTEMA DE BLOG
//===============================================================================================================================
   var categoria_blog = $('form[name="categoria_blog"]');
   categoria_blog.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "categoria_blog"},
         beforeSubmit: function () {
            $('.categoria_blog').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
            } else if (resposta == 3) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               triggerNotify({title: "Categoria já cadastrada!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {

            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.id_noticia').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_noticia&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               triggerNotify({title: "Notícia não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.carregando_sistem').fadeOut(function () {
                  $('.alterar_total_contetudo').empty().html('' + resposta + '');
                  $('.alterar_total').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.alterar_total').removeClass('animated bounceInDown');
                  }, 1000);
               });
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('submit', 'form[name="editar_noticia"]', function () {
      var editar_noticia = $('form[name="editar_noticia"]');
      tinyMCE.triggerSave();
      editar_noticia.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_noticia"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('faq já cadastrado!');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.status_blog').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=status_blog&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {

            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('click', '.status_categoria', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=status_categoria&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.categoria_blog').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {

            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('click', '.status_delete', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=status_delete&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.categoria_blog').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {

            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('click', '.id_form_cat', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_form_cat&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.alterar_categoria_').slideUp();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.alterar_categoria_').empty().html('' + resposta + '');
               $('.alterar_categoria_').slideDown();
            }
         },
         complete: function () {
         }
      });
   });
   $('body').on('submit', 'form[name="alt_categoria_blog"]', function () {
      var alt_categoria_blog = $('form[name="alt_categoria_blog"]');
      alt_categoria_blog.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "alt_categoria_blog"},
         beforeSubmit: function () {
            $('.categoria_blog').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('faq já cadastrado!');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   var blog = $('form[name="blog"]');
   blog.submit(function () {
      tinyMCE.triggerSave();
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "blog"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "blog";
               }, 2000);
               //location.href = "" + urlbase + "perfil";
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               $('.carregando2').fadeOut();
               alerta('Título repetido, por favor modifique o título e envie novamente!');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// SISTEMA DE CRM CASA DOS SITES
//===============================================================================================================================
   var crm = $('form[name="crm"]');
   crm.submit(function () {
      tinyMCE.triggerSave();
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "crm"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "crm";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut();
               triggerNotify({title: "Título repetido, por favor modifique o título e envie novamente!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.id_crm').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_crm&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               triggerNotify({title: "Notícia não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               $('.carregando_sistem').fadeOut(function () {
                  $('.alterar_total_contetudo').empty().html('' + resposta + '');
                  $('.alterar_total').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.alterar_total').removeClass('animated bounceInDown');
                  }, 1000);
               });
               $('.carregando_sistem').fadeOut();
            }
         },
         complete: function () {

         }
      });
   });
//===============================================================================================================================
// SISTEMA DE TICKET
//===============================================================================================================================
   var cad_ticket = $('form[name="cad_ticket"]');
   cad_ticket.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_ticket"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "sac";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Título repetido, por favor modifique o título e envie novamente!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('.id_sac_alt').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_sac_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('submit', 'form[name="editar_sac"]', function () {
      var editar_sac = $('form[name="editar_sac"]');
      editar_sac.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_sac"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            // alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "sac";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('faq já cadastrado!');
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('body').on('click', '.interagir', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=interagir&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um adminstrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut2();
               $('.moldura_contetudo2').empty().html('' + resposta + '');
               $('.moldura2').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.moldura2').removeClass('animated bounceInDown');
                  carregandoOut2();
               }, 1000);
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('body').on('submit', 'form[name="interagir_form"]', function () {
      var interagir_form = $('form[name="interagir_form"]');
      //tinyMCE.triggerSave();
      //alert('entrei 1');
      interagir_form.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "interagir_form"},
         beforeSubmit: function () {
            $('.moldura2').fadeOut();
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            setTimeout(function () {
               bar.fadeOut();
               var porcentagem = 0;
            }, 1000);
            // alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               triggerNotify({title: "Descrição não pode ser em branco", icon: "icon-notifications_active", color: "blue", timer: 4000});
               carregandoOut2();
               $('.moldura2').fadeIn();
            } else if (resposta == 3) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               triggerNotify({title: "Vinculo igual já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "home";
               }, 2000);
            } else {
               carregandoOut2();
               $('.moldura_contetudo2').empty().fadeIn().html('' + resposta + '');
               $('.moldura2').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.moldura2').removeClass('animated bounceInDown');
               }, 1000);
               $('.fecha_moldura2').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.fecha_moldura2').removeClass('animated bounceInDown');
                  carregandoOut2();
               }, 1000);
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
//===============================================================================================================================
// SISTEMA DE ARQUIVOS
//===============================================================================================================================   
   var cad_arquivo = $('form[name="cad_arquivo"]');
   cad_arquivo.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_arquivo"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "zeropape";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               $('.carregando2').fadeOut();
               alerta('Equipamento já cadastrado!');
            } else {
               $('.lista_nova').html('' + resposta + '');
               $('.lista_nova').slideDown();
               $('.carregando_busca').fadeOut();
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
   $('body').on('click', '.id_arquivo_alt', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=id_arquivo_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um adminstrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('body').on('click', '.ex_arquivo', function () {
      //$('.ex_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ex_arquivo&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
           // alert(resposta);
            if (resposta == 1) {
               $('.modal_exclusao').fadeOut(400, function () {
                  $('.modal_janela_c').fadeOut();
               });
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "zeropape";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   $('body').on('click', '.id_agenda', function () {
   //$('.id_agenda').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=ver_agenda&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
               $('.modal_janela_c').fadeIn();
            }
         },
         complete: function () {

         }
      });
   });
   
//===============================================================================================================================
// ORIENTADOR
//===============================================================================================================================   
   var cad_orientador = $('form[name="cad_orientador"]');
   cad_orientador.submit(function () {
      $(this).ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "cad_orientador"},
         beforeSubmit: function () {
            $('.cadastrar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               $('.carregando_sistem').fadeOut();
               triggerNotify({title: "Cadastrado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "orientador";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
            } else if (resposta == 7) {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               alerta('Preço menor que R$10,00 reais por favor corrija!');
            } else {
               carregandoOut2();
               $('.moldura2').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
   });
    $('body').on('click', '.modal_alunos', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=modal_alunos&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
              carregandoOut();
              $('.modal_janela_c').fadeIn();
               $('.carregando_sistem').fadeOut(function () {
                  $('.moldura_contetudo2').empty().html('' + resposta + '');
                  $('.moldura2').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.moldura2').removeClass('animated bounceInDown');
                  }, 1000);
                  $('.carregando_sistem').fadeOut();
               });
               carregandoOut2();
               $('.carregando_sistem').fadeOut();
            }
         },
         complete: function () {
         }
      });
   });
    $('body').on('click', '.modal_coorientador', function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=modal_coorientador&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {

            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
              carregandoOut();
              $('.modal_janela_c').fadeIn();
               $('.carregando_sistem').fadeOut(function () {
                  $('.moldura_contetudo2').empty().html('' + resposta + '');
                  $('.moldura2').fadeIn().addClass('animated bounceInDown');
                  setTimeout(function () {
                     $('.moldura2').removeClass('animated bounceInDown');
                  }, 1000);
                  $('.carregando_sistem').fadeOut();
               });
               carregandoOut2();
               $('.carregando_sistem').fadeOut();
            }
         },
         complete: function () {
         }
      });
   });
   $('.cordenadores_alt').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=cordenadores_alt&id=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            carregando();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            if (resposta == 1) {
               triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 2) {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               triggerNotify({title: "Erro ao enviar, existem campos em branco, tente atualizar a página.", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 5) {
               triggerNotify({title: "E-mail ou senha Inválidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total_contetudo').empty().html('' + resposta + '');
               $('.alterar_total').fadeIn().addClass('animated bounceInDown');
               setTimeout(function () {
                  $('.alterar_total').removeClass('animated bounceInDown');
               }, 1000);
               $('.carregando_sistem').fadeOut();
            }
         },
         complete: function () {

         }
      });
   });
   $('body').on('submit', 'form[name="editar_orientador"]', function () {
      var editar_orientador = $('form[name="editar_orientador"]');
      editar_orientador.ajaxSubmit({
         url: urlphp,
         type: 'post',
         data: {acao: "editar_orientador"},
         beforeSubmit: function () {
            $('.alterar_total').fadeOut(function () {
               carregando();
            });
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               carregandoOut();
               $('.carregando_sistem').fadeOut();
               triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "orientador";
               }, 2000);
            } else if (resposta == 2) {
               carregandoOut();
               $('.carregando_sistem').fadeOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               $('.carregando2').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               carregandoOut();
               $('.carregando_sistem').fadeOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else if (resposta == 4) {
               carregandoOut();
               $('.carregando_sistem').fadeOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Usuário já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               carregandoOut();
               $('.modal_janela_c').fadeIn();
               $('.alterar_total').fadeIn();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
            //trocaimagem.find(".camp").val('');
         }
      });
      return false;
   });
$('body').on('click', '.del_orientador', function () {
      //$('.ex_usuario').click(function () {
      var delaid = $(this).attr('id');
      var deladata = "acao=del_orientador&del=" + delaid;
      $.ajax({
         data: deladata,
         beforeSend: function () {
            $('.carregando_topo').fadeIn();
         },
         uploadProgress: function (evento, posicao, total, completo) {
            var bar = $('.carregando_barra');
            var per = $('.progress');
            bar.fadeIn();
            // console.log(completo);
            var porcentagem = completo + "%";
            per.width(porcentagem).text(porcentagem);
         },
         success: function (resposta) {
            //alert(resposta);
            if (resposta == 1) {
               $('.modal_exclusao').fadeOut(400, function () {
                  $('.modal_janela_c').fadeOut();
               });
               triggerNotify({title: "Excluido com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
               setTimeout(function () {
                  location.href = "" + urlbase + "orientador";
               }, 2000);
            } else if (resposta == 2) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            } else if (resposta == 3) {
               $('.carregando_topo').fadeOut();
               triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
            } else {
               triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
            }
         },
         complete: function () {
         }
      });
      return false;
   });
   
   $('body').on('click', '.id_coorientador_alt', function () {
    var delaid = $(this).attr('id');
    var deladata = "acao=id_coorientador_alt&id=" + delaid;
    $.ajax({
      data: deladata,
      beforeSend: function () {
        $('.moldura2').fadeOut(function () {
          //carregando();
        });
      },
      uploadProgress: function (evento, posicao, total, completo) {
        var bar = $('.carregando_barra');
        var per = $('.progress');
        bar.fadeIn();
        // console.log(completo);
        var porcentagem = completo + "%";
        per.width(porcentagem).text(porcentagem);
      },
      success: function (resposta) {
        if (resposta == 1) {
          triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 2) {
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 3) {
          triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 5) {
          triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else {
          carregandoOut();
              $('.modal_janela_c').fadeIn();
          $('.carregando_sistem').fadeOut(function () {
            $('.alterar_total_contetudo').empty().html('' + resposta + '');
            $('.alterar_total').fadeIn().addClass('animated bounceInDown');
            setTimeout(function () {
              $('.alterar_total').removeClass('animated bounceInDown');
            }, 1000);
            $('.carregando_sistem').fadeOut();
          });
          $('.carregando_sistem').fadeOut();
        }
      },
      complete: function () {
      }
    });
  });
  $('body').on('submit', 'form[name="editar_coorientador"]', function () {
    //cad_cliente_usuario.submit(function () {
    $(this).ajaxSubmit({
      url: urlphp,
      type: 'post',
      data: {acao: "editar_coorientador"},
      beforeSubmit: function () {
        $('.alterar_total').fadeOut(function () {
          carregando();
        });
      },
      uploadProgress: function (evento, posicao, total, completo) {
        var bar = $('.carregando_barra');
        var per = $('.progress');
        bar.fadeIn();
        // console.log(completo);
        var porcentagem = completo + "%";
        per.width(porcentagem).text(porcentagem);
      },
      success: function (resposta) {
         //alert(resposta);
        if (resposta == 1) {
          carregandoOut();
          $('.carregando_sistem').fadeOut();
          triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
          setTimeout(function () {
            location.href = "" + urlbase + "dashboard";
          }, 2000);
        } else if (resposta == 2) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 3) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 4) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 5) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
        } else if (resposta == 7) {
          carregandoOut2();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          alerta('Preço menor que R$10,00 reais por favor corrija!');
        } else {
          carregandoOut2();
          $('.moldura2').fadeIn();
          $('.carregando_sistem').fadeOut();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        }
      },
      complete: function () {
        //trocaimagem.find(".camp").val('');
      }
    });
    return false;
  });
  $('body').on('click', '.id_aluno_alt', function () {
    var delaid = $(this).attr('id');
    var deladata = "acao=id_aluno_alt&id=" + delaid;
    $.ajax({
      data: deladata,
      beforeSend: function () {
        $('.moldura2').fadeOut(function () {
         // carregando();
        });
      },
      uploadProgress: function (evento, posicao, total, completo) {
        var bar = $('.carregando_barra');
        var per = $('.progress');
        bar.fadeIn();
        // console.log(completo);
        var porcentagem = completo + "%";
        per.width(porcentagem).text(porcentagem);
      },
      success: function (resposta) {
        if (resposta == 1) {
          triggerNotify({title: "Usuário não escontrado!", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 2) {
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 3) {
          triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 5) {
          triggerNotify({title: "E-mail ou senha invalidos!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else {
          carregandoOut();
          $('.modal_janela_c').fadeIn();
          $('.carregando_sistem').fadeOut(function () {
            $('.alterar_total_contetudo').empty().html('' + resposta + '');
            $('.alterar_total').fadeIn().addClass('animated bounceInDown');
            setTimeout(function () {
              $('.alterar_total').removeClass('animated bounceInDown');
            }, 1000);
            $('.carregando_sistem').fadeOut();
          });
          $('.carregando_sistem').fadeOut();
        }
      },
      complete: function () {
      }
    });
  });
  $('body').on('submit', 'form[name="editar_aluno"]', function () {
    //cad_cliente_usuario.submit(function () {
    $(this).ajaxSubmit({
      url: urlphp,
      type: 'post',
      data: {acao: "editar_aluno"},
      beforeSubmit: function () {
        $('.alterar_total').fadeOut(function () {
          carregando();
        });
      },
      uploadProgress: function (evento, posicao, total, completo) {
        var bar = $('.carregando_barra');
        var per = $('.progress');
        bar.fadeIn();
        // console.log(completo);
        var porcentagem = completo + "%";
        per.width(porcentagem).text(porcentagem);
      },
      success: function (resposta) {
         //alert(resposta);
        if (resposta == 1) {
          carregandoOut();
          $('.carregando_sistem').fadeOut();
          triggerNotify({title: "Alterado com sucesso!", icon: "icon-thumbs-up2", color: "green", timer: 4000});
          setTimeout(function () {
            location.href = "" + urlbase + "dashboard";
          }, 2000);
        } else if (resposta == 2) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        } else if (resposta == 3) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, existem campos em branco!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 4) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Cliente já cadastrado!", icon: "icon-notifications_active", color: "blue", timer: 4000});
        } else if (resposta == 5) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          alerta('Livro já cadastrado, verifique o e-mail ou nome que já consta em nosso banco de dados!');
        } else if (resposta == 7) {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          alerta('Preço menor que R$10,00 reais por favor corrija!');
        } else {
          carregandoOut2();
          $('.carregando_sistem').fadeOut();
          $('.moldura2').fadeIn();
          $('.carregando2').fadeOut();
          triggerNotify({title: "Erro ao enviar, consultem um administrador", icon: "icon-thumbs-down2", color: "red", timer: 4000});
        }
      },
      complete: function () {
        //trocaimagem.find(".camp").val('');
      }
    });
    return false;
  });
//===============================================================================================================================
// Tinymce
//===============================================================================================================================   
   tinymce.init({
      selector: "textarea#elm1",
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
      style_formats: [
         {title: 'Bold text', inline: 'b'},
         {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
         {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
         {title: 'Example 1', inline: 'span', classes: 'example1'},
         {title: 'Example 2', inline: 'span', classes: 'example2'},
         {title: 'Table styles'},
         {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
      ],
      external_filemanager_path: "" + urlbase + "poo/app/Library/tinymce/js/filemanager/",
      filemanager_title: "Responsive Filemanager",
      external_plugins: {"filemanager": "" + urlbase + "poo/app/Library/tinymce/js/filemanager/plugin.min.js"}
   });
   $('body').on('load', '.modal_janela_c', function () {
      tinymce.init({
         selector: "textarea#elm2",
         theme: "modern",
         height: 300,
         menubar: false,
         relative_urls: false,
         remove_script_host: false,
         plugins: [
            "advlist autolink lists charmap print preview hr pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
            "table contextmenu directionality emoticons paste textcolor"
         ],
         toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor | link unlink anchor |",
         toolbar2: "",
         image_advtab: true,
         style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
         ],
         external_filemanager_path: "" + urlbase + "poo/app/Library/tinymce/js/filemanager/",
         filemanager_title: "Responsive Filemanager",
         external_plugins: {"filemanager": "" + urlbase + "poo/app/Library/tinymce/js/filemanager/plugin.min.js"}
      });
   });
//===============================================================================================================================
// DATEPICKER TOTAL
//===============================================================================================================================     
   $('#dataapenasdodia').datepicker({
      language: 'pt-BR',
      minDate: new Date() // Now can select only dates, which goes after today
   });
   $('#dataapenasdodia2').datepicker({
      language: 'pt-BR',
      minDate: new Date() // Now can select only dates, which goes after today
   });
   $('#datacompleta').datepicker({
      language: 'pt-BR',
      todayButton: new Date() // Now can select only dates, which goes after today
   });
   $('#datacompleta2').datepicker({
      language: 'pt-BR',
      todayButton: new Date() // Now can select only dates, which goes after toda
   });
   $('#datacompleta3').datepicker({
      language: 'pt-BR',
      todayButton: new Date() // Now can select only dates, which goes after today
   });
   $('#datacompleta4').datepicker({
      language: 'pt-BR',
      todayButton: new Date() // Now can select only dates, which goes after today
   });
}); //--FIN DA FUNÇÃO GERAL-->

//===============================================================================================================================
// EFEITO DE PAGINAÇÃO
//===============================================================================================================================
$(function () {
   $("div.holder").jPages({
      containerID: "paginacao",
      perPage: 10, //quantidade por pagina
      startPage: 1, //inicial em qual pagina
      startRange: 1,
      midRange: 10,
      endRange: 1,
      animation: "fadeInUp",
      ////flash,shake,fadeInDown,bounce,tada,swing,wobble,pulse,
      //flip,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInLeft,fadeInRight,
      //fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutDown,fadeOutLeft,
      //fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,bounceIn,bounceInUp,bounceInDown,
      //bounceInLeft,bounceInRight,bounceOut,bounceOutUp,bounceOutDown,bounceOutLeft,bounceOutRight,
      //rotateIn,rotateInUpLeft,hinge,rollIn,rollOut,
      pause: false  //efeito automatico em segundos 
   });

   $("div.apoior").jPages({
      containerID: "apoio",
      perPage: 10, //quantidade por pagina
      startPage: 1, //inicial em qual pagina
      startRange: 1,
      midRange: 10,
      endRange: 1,
      animation: "fadeInUp",
      ////flash,shake,fadeInDown,bounce,tada,swing,wobble,pulse,
      //flip,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInLeft,fadeInRight,
      //fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutDown,fadeOutLeft,
      //fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,bounceIn,bounceInUp,bounceInDown,
      //bounceInLeft,bounceInRight,bounceOut,bounceOutUp,bounceOutDown,bounceOutLeft,bounceOutRight,
      //rotateIn,rotateInUpLeft,hinge,rollIn,rollOut,
      pause: false  //efeito automatico em segundos 
   });

   $("div.palestra").jPages({
      containerID: "evento",
      perPage: 10, //quantidade por pagina
      startPage: 1, //inicial em qual pagina
      startRange: 1,
      midRange: 10,
      endRange: 1,
      animation: "fadeInLeft",
      ////flash,shake,fadeInDown,bounce,tada,swing,wobble,pulse,
      //flip,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInLeft,fadeInRight,
      //fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutDown,fadeOutLeft,
      //fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,bounceIn,bounceInUp,bounceInDown,
      //bounceInLeft,bounceInRight,bounceOut,bounceOutUp,bounceOutDown,bounceOutLeft,bounceOutRight,
      //rotateIn,rotateInUpLeft,hinge,rollIn,rollOut,
      pause: 3000  //efeito automatico em segundos 
   });

   $("div.blogsss").jPages({
      containerID: "blogss",
      perPage: 1, //quantidade por pagina
      startPage: 1, //inicial em qual pagina
      startRange: 1,
      midRange: 10,
      endRange: 1,
      animation: "fadeInUp",
      ////flash,shake,fadeInDown,bounce,tada,swing,wobble,pulse,
      //flip,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInLeft,fadeInRight,
      //fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutDown,fadeOutLeft,
      //fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,bounceIn,bounceInUp,bounceInDown,
      //bounceInLeft,bounceInRight,bounceOut,bounceOutUp,bounceOutDown,bounceOutLeft,bounceOutRight,
      //rotateIn,rotateInUpLeft,hinge,rollIn,rollOut,
      pause: 3000  //efeito automatico em segundos 
   });
});
//===============================================================================================================================
// MASCARA PARA VALORES
//===============================================================================================================================
$(document).ready(function () {
   $("#mascara_valor").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "", allowZero: false});
   $("#mascara_valor_ipva").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: ".", allowZero: false});
   $("#mascara_valor39").maskMoney({showSymbol: true, symbol: "", decimal: ",", thousands: "", allowZero: false});
});
//===============================================================================================================================
// MASCARA PARA DATAS
//===============================================================================================================================
jQuery(function ($) {
   $("#mascara_data").mask("99/99/9999"); //Aqui montamos a máscara que queremos
   $("#mascara_celular").mask("(99)99999-9999");
   $("#mascara_cnpj").mask("99.999.999/9999-99");
   $("#mascara_telefone").mask("(99)999999999");
   $("#mascara_cpf").mask("999.999.999-99");
   $("#mascara_celular2").mask("(99)999999999");
   $("#mascara_celular3").mask("(99)999999999");
   $("#mascara_telefone2").mask("(99)999999999");
   $("#mascara_cep").mask("99999-999"); //usando

   $("#mascara_data_usuario").mask("99/99/9999");
   $("#mascara_celular_usuario").mask("(99)999999999");
   $("#mascara_telefone_usuario").mask("(99)999999999");

   $("#mascara_telefone_denuncia").mask("(99)999999999");
   $("#telefonepropri").mask("(99)999999999");
   $("#mascara_data_perfil").mask("99/99/9999");
   $("#mascara_celular_perfil").mask("(99)999999999");
   $("#mascara_telefone_perfil").mask("(99)999999999");

   $("#cad_parceiro").mask("(99)999999999");
   $("#apenas_telefone_fixo").mask("(99)99999999");

   $("#telefone_crm").mask("(99)99999999");
   $("#telefone_crm2").mask("(99)99999999");
   $("#telefone_crm3").mask("(99)99999999");

   $("#telefone_cliente").mask("(99)99999999");
   $("#telefone_cliente2").mask("(99)99999999");
   $("#telefone_cliente3").mask("(99)99999999");
});
//===============================================================================================================================
// MASCARA PARA VALIDAR O CNPJ OU CPF NO MESMO FORMULARIO
//===============================================================================================================================
function mascaraMutuario(o, f) {
   v_obj = o,
           v_fun = f,
           setTimeout('execmascara()', 1);
}

function execmascara() {
   v_obj.value = v_fun(v_obj.value);
}

function cpfCnpj(v) {
   //Remove tudo o que não é dígito
   v = v.replace(/\D/g, "");
   if (v.length < 14) { //CPF
      //Coloca um ponto entre o terceiro e o quarto dígitos
      v = v.replace(/(\d{3})(\d)/, "$1.$2");
      //Coloca um ponto entre o terceiro e o quarto dígitos
      //de novo (para o segundo bloco de números)
      v = v.replace(/(\d{3})(\d)/, "$1.$2");
      //Coloca um hífen entre o terceiro e o quarto dígitos
      v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
   } else { //CNPJ
      //Coloca ponto entre o segundo e o terceiro dígitos
      v = v.replace(/^(\d{2})(\d)/, "$1.$2");
      //Coloca ponto entre o quinto e o sexto dígitos
      v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
      //Coloca uma barra entre o oitavo e o nono dígitos
      v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
      //Coloca um hífen depois do bloco de quatro dígitos
      v = v.replace(/(\d{4})(\d)/, "$1-$2");
   }
   return v;
}

//===============================================================================================================================
// CODIGO DE ACOMPANHAMENTO DO GOOGLE ANALYTICS
//===============================================================================================================================
