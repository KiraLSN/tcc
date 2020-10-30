<?php

/**
 * Sitemap.class [ HELPER ADMIN ]
 * Respnsável por gerenciar o Sitemap e o RSS do sistema
 * 
 * @copyright (c) 2014, Dimar Luiz dos Santos
 */

class Sitemap {

//GERA SITEMAP
    static function geraSitemap() {
        //gera sitemap
        //Abre o diretorio raiz
        $handle = @opendir(".");
        // abre ou cria o arquivo xml
        $xml = fopen("../../sitemap.xml", "w+");
        //Gravamos os dados iniciais do xml
        fwrite($xml, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
                . "<?xml-stylesheet type=\"text/xsl\" href=\"sitemap.xsl\"?>\n"
                . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n\n");

        //Abre url
        $conteudo = '  <url>' . "\n";
        //pega o Dominio e o nome do arquivo
        $conteudo .= '     <loc>'.SITE.'</loc>' . "\n";
        //pega a data atual e informa no xml
        $conteudo .= '     <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        //informa a frequencia de atualização da pagina
        $conteudo .= '     <changefreq>daily</changefreq>' . "\n";
        //informa a prioridade da pagina
        $conteudo .= '     <priority>1.0</priority>' . "\n";
        //Fecha url
        $conteudo .= '  </url>' . "\n";
        fwrite($xml, $conteudo);
        
        //Outras páinas
        $conteudo = '  <url>' . "\n";
        $conteudo .= '     <loc>'.SITE.'empresa</loc>' . "\n";
        $conteudo .= '     <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        $conteudo .= '     <changefreq>daily</changefreq>' . "\n";
        $conteudo .= '     <priority>1.0</priority>' . "\n";
        $conteudo .= '  </url>' . "\n";
        fwrite($xml, $conteudo);
        
         //Outras páinas
        $conteudo = '  <url>' . "\n";
        $conteudo .= '     <loc>'.SITE.'contato</loc>' . "\n";
        $conteudo .= '     <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        $conteudo .= '     <changefreq>daily</changefreq>' . "\n";
        $conteudo .= '     <priority>1.0</priority>' . "\n";
        $conteudo .= '  </url>' . "\n";
        fwrite($xml, $conteudo);
        
        
        $conteudo = '  <url>' . "\n";
        $conteudo .= '     <loc>'.SITE.'noticias</loc>' . "\n";
        $conteudo .= '     <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        $conteudo .= '     <changefreq>daily</changefreq>' . "\n";
        $conteudo .= '     <priority>1.0</priority>' . "\n";
        $conteudo .= '  </url>' . "\n";
        fwrite($xml, $conteudo);

        $readSitemap = new Read();
        $readSitemap->ExeRead("noticia", "ORDER BY id DESC");
        if ($readSitemap->getResult()):
            foreach ($readSitemap->getResult() as $sitemap):

                //Abre url
                $conteudo = '  <url>' . "\n";
                //pega o Dominio e o nome do arquivo
                $conteudo .= '     <loc>' . SITE . 'noticia/' . $sitemap['url'] . '</loc>' . "\n";
                //pega a data atual e informa no xml
                $conteudo .= '     <lastmod>' .$sitemap['data']. '</lastmod>' . "\n";
                //informa a frequencia de atualização da pagina
                $conteudo .= '     <changefreq>weekly</changefreq>' . "\n";
                //informa a prioridade da pagina
                $conteudo .= '     <priority>0.5</priority>' . "\n";
                //Fecha url
                $conteudo .= '  </url>' . "\n";
                fwrite($xml, $conteudo);

            endforeach;
        else:
            $this->Error = ["Aconteceu um erro ao ler conteúdo para gerar sitemap sitemap!", WS_ERROR];
        endif;

        closedir($handle);
        //Fechamos a estrutura do xml
        fwrite($xml, "\n</urlset>");
        //Fecha o arquivo aberto (para liberar memoria do servidor)
        fclose($xml);
        //fim sitemap
    }

//GERA RSS
    static function geraRss() {
        //gera sitemap
        //Abre o diretorio raiz
        $handle = @opendir(".");
        // abre ou cria o arquivo xml
        $xml = fopen("../../rss.xml", "w+");
        //Gravamos os dados iniciais do xml

        fwrite($xml, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<rss version=\"2.0\">\n\n");

        //Abre url
        $conteudo = '  <channel>' . "\n";
        //pega o Dominio e o nome do arquivo
        $conteudo .= '<title>'.NOMECLIENTE.'</title>' . "\n";
        $conteudo .= '<link>'.SITE.'</link>' . "\n";
        //informa a prioridade da pagina
        $conteudo .= '<description>' . SITEDESCR . '</description>' . "\n";
        $conteudo .= '<language>pt-br</language>' . "\n";

        fwrite($xml, $conteudo);

        $readRss = new Read();
        $readRss->ExeRead("noticia", "ORDER BY id DESC");
        if ($readRss->getResult()):
            foreach ($readRss->getResult() as $rss):

                //Abre url
                $conteudo = '<channel>' . "\n";
                $conteudo = '<item>' . "\n";

                //pega o Dominio e o nome do arquivo
                $conteudo .= '<title>' . $rss['titulo'] . '</title>' . "\n";
                $conteudo .= '<link>' . SITE . 'noticia/' . $rss['url'] . '</link>' . "\n";
                //pega a data atual e informa no xml
                $conteudo .= '<pubDate>' . $rss['data'] . '</pubDate>' . "\n";
                $conteudo .= '<description>' . $rss['chamada'] . '</description>' . "\n";
                $conteudo .= '</item>' . "\n";
                fwrite($xml, $conteudo);

            endforeach;
        else:
            $this->Error = ["Aconteceu um erro ao ler conteúdo para gerar rss!", WS_ERROR];
        endif;

        closedir($handle);
        //Fechamos a estrutura do xml
        fwrite($xml, "\n</channel>\n</rss>");
        //Fecha o arquivo aberto (para liberar memoria do servidor)
        fclose($xml);
        //fim rss
    }

}
