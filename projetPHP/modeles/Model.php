<?php

class Model{
    public function nbNews(){
        global $user, $pass, $dsn;
        $gateway= new NewsGateway(new Connection($dsn, $user, $pass));
        return $gateway->nbNews();
    }

    public function get_Newsdemande($premiereNews,$nbNews):array{
        global $user, $pass, $dsn;
        $gateway= new NewsGateway(new Connection($dsn, $user, $pass));
        return $gateway->getNewsPage($premiereNews,$nbNews);
    }

    public function newNews($channel){
        global $user, $pass, $dsn;
        $gateway = new NewsGateway(new Connection($dsn, $user, $pass));
        foreach ($channel->xpath('//item') as $item) {
            $titre = $item->title;
            $description = $item->description;
            $lien = $item->link;
            $date = $item->pubDate;
            $news = new News($titre, $description, $lien, $date);
            $bool=$gateway->newsExiste($titre);
            if(!$bool){
                $gateway->insertNews($news);
            }
        }
    }

    public function suppNewsEnTrop(){
        global $user, $pass, $dsn;
        $gateway = new NewsGateway(new Connection($dsn, $user, $pass));
        $nbNewsMaxEnBase = 60;
        $nb = $gateway->nbNews();
        if ($nb > $nbNewsMaxEnBase) {
            for ($i = 1; $i <= $nb - $nbNewsMaxEnBase; $i++) {
                $gateway->suppNewsPlusAncienne();
            }
        }
    }
}