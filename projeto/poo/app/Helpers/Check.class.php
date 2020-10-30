<?php

/**
 * Check.class [ HELPER ]
 * CLASSE ERESPONSÁVEL PARA VALIDAR OS DADOS.
 * @copyright (c) 2014, Fabio Augusto CASA DOS SITES
 */
class Check {

   private static $Data;
   private static $Format;

   /**
    * ****************************************
    * ********** VALIDA E-MAIL ***************
    * ****************************************
     COMO USAR:
    * *****************************************
     $Email = 'contato@casadossites.com';
     if(Check::Email($Email)):
     echo 'Válido!';
     else:
     echo 'inválido!';
     endif;
    */
   public static function Email($Email) {
      self::$Data = (string) $Email;
      self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

      if (preg_match(self::$Format, self::$Data)):
         return true;
      else:
         return false;
      endif;
   }

   /**
    * ****************************************
    * ********** CRIAR URL AMIGÁVEIS  ********
    * ****************************************
     COMO USAR:
    * *****************************************
     $nome = 'Estamos aprendendo PHP. Veja você com é!';
     echo  Check::Name($nome);
    */
   public static function Name($Name) {
      self::$Format = array();
      self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
      self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

      self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
      self::$Data = strip_tags(trim(self::$Data));
      self::$Data = str_replace(' ', '-', self::$Data);
      self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

      return strtolower(utf8_encode(self::$Data));
   }

   /**
    * ****************************************
    * ****** VALIDAR FORMATO DA DATA  ********
    * ****************************************
     COMO USAR:
    * *****************************************
     $data = '27/11/2016 10:00:00';
     Esta e a formatação padrão sem o $format;
     Caso chame o $format você pode criar o padrão que quiser;
     exemplo: $format = 'Y-m-d';
     echo  Check::validaData($date, $format);
    */
   public static function validaData($date, $format = 'd/m/Y H:i:s') {
      if (!empty($date) && $v_date = date_create_from_format($format, $date)) {
         $v_date = date_format($v_date, $format);
         return ($v_date && $v_date == $date);
      }
      return false;
   }

   public static function validaData__($dat) {
      $data = explode("/", "$dat"); // fatia a string $dat em pedados, usando / como referência
      $d = $data[0];
      $m = $data[1];
      $y = $data[2];

      // verifica se a data é válida!
      // 1 = true (válida)
      // 0 = false (inválida)
      $res = checkdate($m, $d, $y);
      if ($res == 1) {
         return true;
      } else {
         return false;
      }
   }

   /**
    * ****************************************
    * *ALTERAR FORMATO DA DATA COM HORA *****
    * ****************************************
     COMO USAR:
    * *****************************************
     $data = '27/11/2016 10:00:00'; = $format = true
     $data = '2016-11-27 10:00:00'; = $format = null
     echo  Check::alterarDataHora($dateHora, $format = null);
    */
   public static function alterarDataHora($dateHora, $format = null) {

      if ($format):
         $data_final_data = Check::TimesData(substr($dateHora, 0, 10));
         $data_final_data_hora = substr($dateHora, 11, 18);
         return $data_final = $data_final_data . ' ' . $data_final_data_hora;
      else:
         $data_final_data = Check::Datastamp(substr($dateHora, 0, 10));
         $data_final_data_hora = substr($dateHora, 11, 18);
         return $data_final = $data_final_data . ' ' . $data_final_data_hora;
      endif;
   }

   /**
    * ****************************************
    * ***** TRANSFORMA DATA EM TIMESTAMP  ****
    * ****************************************
     COMO USAR:
    * *****************************************
     $data = '05/01/2014';
     echo Check::Datastamp($data);
    */
   public static function Datastamp($Data) {
      self::$Format = explode(' ', $Data);
      self::$Data = explode('/', self::$Format[0]);

//if (empty(self::$Format[1])):
//  self::$Format[1] = date('H:i:s');
// endif;

      self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0]; //. ' ' . self::$Format[1];
      return self::$Data;
   }

   /**
    * ****************************************
    * ***** TRANSFORMA TIMESTAMP EM DATA  ****
    * ****************************************
     COMO USAR:
    * *****************************************
     $data = '2015-01-15';
     echo Check::TimesData($data);
    */
   public static function TimesData($Data) {
      self::$Format = explode(' ', $Data);
      self::$Data = explode('-', self::$Format[0]);

//        if (empty(self::$Format[1])):
//            self::$Format[1] = date('H:i:s');
//        endif;

      self::$Data = self::$Data[2] . '/' . self::$Data[1] . '/' . self::$Data[0];
      return self::$Data;
   }

   /**
    * ****************************************
    * ******* LIMITADOR DE PALAVRAS  *********
    * ****************************************
     COMO USAR:
    * *****************************************
     $string = 'Olá mundo, estamos estudando PHP na Casa dos sites!';
     echo Check::Limitador($string, 5, '. <small>Continuer lendo</small>');
    */
   public static function Limitador($String, $Limite, $Pointer = null) {
      self::$Data = strip_tags(trim($String));
      self::$Format = (int) $Limite;

      $ArrWords = explode(' ', self::$Data);
      $NumWords = count($ArrWords);
      $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

      $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
      $Result = (self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data);
      return $Result;
   }

   /**
    * ****************************************
    * ****** LIMITADOR DE CARACTERES  ********
    * ****************************************
     COMO USAR:
    * *****************************************
     $string = 'Olá mundo, estamos estudando PHP na Casa dos sites!';
     echo Check::limitcaracter($string, 5,);
    */
   public static function limitcaracter($texto, $limite, $quebra = true) {
      $tamanho = strlen($texto);
      // Verifica se o tamanho do texto é menor ou igual ao limite
      if ($tamanho <= $limite) {
         $novo_texto = $texto;
         // Se o tamanho do texto for maior que o limite
      } else {
         // Verifica a opção de quebrar o texto
         if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)) . '...';
            // Se não, corta $texto na última palavra antes do limite
         } else {
            // Localiza o útlimo espaço antes de $limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
            // Corta o $texto até a posição localizada
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . '...';
         }
      }
      // Retorna o valor formatado
      return $novo_texto;
   }

   /**
    * ****************************************
    * ********** USUARIOS ONLINE  ************
    * ****************************************
     COMO USAR:
    * *****************************************
     echo Check::UserOnline();
    */
   public static function UserOnline() {
      $now = date('Y-m-d H:i:s');
      $deleUserOnline = new Delete;
      $deleUserOnline->ExeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");

      $readUserOnline = new Read;
      $readUserOnline->ExeRead('ws_siteviews_online');
      return $readUserOnline->getRowCount();
   }

   /**
    * ****************************************
    * ****** REDIMENCIONADO IMAGENS  *********
    * ****************************************
     COMO USAR:
    * *****************************************
     echo Check::Imagem('imagens_fixas/sem_imagem.jpg', 'Sem imagem', '200', '100', 'botao');
    */
   public static function Imagem($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null, $Class = null) {
      self::$Data = $ImageUrl;
      $pasta = 'imagens_site/';

      if (file_exists(self::$Data) && !is_dir(self::$Data)):
         $patch = HOME;
         $imagem = self::$Data;
         return "<img src=\"{$patch}{$pasta}tim.php?src={$patch}$imagem&w={$ImageW}&h={$ImageH}&zc=1&q=100\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" class=\"{$Class}\" />";
      else:
         return false;
      endif;
   }

   /**
    * ***********************************************
    * ****** CONTADOR DE VISITA EM PAGINAS  *********
    * **********************************************
     COMO USAR:
    * *****************************************
     echo Check::EstatPagina('1', 'pagina inicial');
    */
   public static function EstatPagina($id_pagina, $nome) {
      $read = new Read;
      $read->ExeRead('contador_pagina', 'WHERE id_atribuido = :email', "email=" . $id_pagina . "");
      if ($read->getRowCount() >= 1):
         foreach ($read->getResult() as $resultado)
            ;
         $resultado['id_contapagina'];
         $resultado['nome_pagina'];
         $resultado['visitas'];
         $resultado['id_atribuido'];

         $dados = array(
             "visitas" => $resultado['visitas'] + 1,
         );
         $updade = new Update;
         $updade->ExeUpdate('contador_pagina', $dados, "WHERE id_atribuido = :id", "id=" . $id_pagina . "");
      else:
         $datas = array(
             "id_contapagina" => '',
             "nome_pagina" => $nome,
             "visitas" => '1',
             "id_atribuido" => $id_pagina
         );
         $Cadastra = new Create;
         $Cadastra->ExeCreate('contador_pagina', $datas);
      endif;
   }

   /**
    * ****************************************
    * ******* CRIADOR DE SITEMAPS  **********
    * ****************************************
     COMO USAR:
    * *****************************************
     Check::Sitemap();
    */
   public static function Sitemap() {
      $xml = fopen("sitemap.xml", "w+");
      fwrite($xml, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<?xml-stylesheet type=\"text/xsl\" href=\"sitemap.xsl\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n\n");

      $conteudo = '  <url>' . "\n";
      $conteudo .= '     <loc>' . HOME . '</loc>' . "\n";
      $conteudo .= '     <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
      $conteudo .= '     <changefreq>daily</changefreq>' . "\n";
      $conteudo .= '     <priority>1.0</priority>' . "\n";
      $conteudo .= '  </url>' . "\n";

      fwrite($xml, $conteudo);

      $readSitemapGeral = new Read;
      $readSitemapGeral->ExeRead("ws_sitemaps", "WHERE mps_status = 1 ORDER BY mps_date DESC");

      if (!$readSitemapGeral->getResult()): else:
         foreach ($readSitemapGeral->getResult() as $geral):
            $conteudo = '  <url>' . "\n";
            $conteudo .= '     <loc>' . HOME . '/' . $geral['mps_link'] . '</loc>' . "\n";
            $conteudo .= '     <lastmod>' . date('Y-m-d', strtotime($geral['mps_date'])) . '</lastmod>' . "\n";
            $conteudo .= '     <changefreq>weekly</changefreq>' . "\n";
            $conteudo .= '     <priority>' . $geral['mps_priority'] . '</priority>' . "\n";
            $conteudo .= '  </url>' . "\n";
            fwrite($xml, $conteudo);
         endforeach;
      endif;


      $readSitemap = new Read;
      $readSitemap->ExeRead("ws_posts", "WHERE post_status = 1 ORDER BY post_date DESC");

      if (!$readSitemap->getResult()): else:
         foreach ($readSitemap->getResult() as $principal):
            $conteudo = '  <url>' . "\n";
            $conteudo .= '     <loc>' . HOME . '/artigo/' . $principal['post_name'] . '</loc>' . "\n";
            $conteudo .= '     <lastmod>' . date('Y-m-d', strtotime($principal['post_date'])) . '</lastmod>' . "\n";
            $conteudo .= '     <changefreq>weekly</changefreq>' . "\n";
            $conteudo .= '     <priority>0.8</priority>' . "\n";
            $conteudo .= '  </url>' . "\n";
            fwrite($xml, $conteudo);
         endforeach;
      endif;
      fwrite($xml, "\n</urlset>");
      fclose($xml);

      $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
      if ($empty):
         SitemapXml();
         unlink("sitemap.xml.gz");
      endif;
   }

   /**
    * ****************************************
    * ******* CRIADOR CODIGOS       **********
    * ****************************************
     COMO USAR:
    * *****************************************
     Check::NewPass($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false);
    */
   public static function NewPass($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
      $lmin = 'abcdefghijklmnopqrstuvwxyz';
      $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $num = '1234567890';
      $simb = '!@#$%*-';
      $retorno = '';
      $caracteres = '';

      $caracteres .= $lmin;
      if ($maiusculas):
         $caracteres .= $lmai;
      endif;
      if ($numeros):
         $caracteres .= $num;
      endif;
      if ($simbolos):
         $caracteres .= $simb;
      endif;

      $len = strlen($caracteres);
      for ($n = 1; $n <= $tamanho; $n++) {
         $rand = mt_rand(1, $len);
         $retorno .= $caracteres[$rand - 1];
      }
      return $retorno;
   }

   /**
    * ****************************************
    * ********** USUARIOS ONLINE  ************
    * ****************************************
     COMO USAR:
    * *****************************************
     echo Check::porcentagem_entre_dois($valor_fipe, $valor_carro);
    */
   public static function porcentagem_entre_dois($valor_fipe = 2615, $valor_carro = 2400) {
      $porcentagem = ($valor_fipe - $valor_carro) / $valor_carro * 100;
      return $porcentagem;
   }

   /**
    * ****************************************
    * ********** ENVIO DE SMS  ************
    * ****************************************
     COMO USAR:
    * *****************************************
     echo Check::sms($numero, $msn);
    */
   public static function sms($numero, $msn) {
      $login = 'casadossites';
      $token = '867d66dd56220d9ef7bfd8a9d959d33e';
      $numero = str_replace("(", "", $numero);
      $numero = str_replace(")", "", $numero);
      $numero = str_replace(" ", "", $numero);
      $numero = str_replace("-", "", $numero);
      $msg = urlencode($msn);

      $send = file_get_contents("http://sms.kingtelecom.com.br/kingsms/api.php?acao=sendsms&login=$login&token=$token&numero=$numero&msg=$msg");
      $send = json_decode($send);
      return TRUE;
   }

}
