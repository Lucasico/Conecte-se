<?php
namespace App\Models;
use MF\Model\Model;

class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $curtir;
    private $naoCurtir;
    private $data;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    //valida entrada de twitters
    public function validaTwitter($input){
        $input = preg_replace("/[*,'']/", "", $input);
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return $input;
    }
    //salva
    public function salvar(){
        $query = "insert into tweets(id_usuario,tweet) value (:id_usuario, :tweet)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario',$this->__get('id_usuario'));
        $stmt->bindValue(':tweet',$this->__get('tweet'));
        $stmt->execute();

        return $this;
    }

    //recuperar
    public function getAll(){
        $query = "select 
                    t.id, 
                    t.id_usuario,
                    u.nome, 
                    t.tweet,
                    t.curtir,
                    t.naoCurtir, 
                    DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
                 from 
                    tweets as t
                    left join usuarios as u on (t.id_usuario = u.id)
                 where 
                   t.id_usuario = :id_usuario or 
                   t.id_usuario in(
                       select 
                            id_usuario_seguindo
                       from 
                            usuarios_seguidores
                       where
                            id_usuario = :id_usuario
                   )
                 order by
                    t.data desc";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletaTweet($tweet_id){
        $query = "delete from tweets where id = :tweet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':tweet_id',$tweet_id);
        $stmt->execute();
        return true;
    }

    public function curtirTweet($id){
        $retornoQuantCurtir = "select curtir from tweets where id = :id";
        $stmt = $this->db->prepare($retornoQuantCurtir);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $aux = $stmt->fetch(\PDO::FETCH_ASSOC);
        $incrementaCurtida = $aux['curtir'] + 1;
        $queryUpdate = "update tweets set curtir = :curtida where id = :id";
        $stmt = $this->db->prepare($queryUpdate);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':curtida',$incrementaCurtida);
        $stmt->execute();
        
        return true;
    }

    public function naoCurtirTweet($id){
        $retornoQuantNaoCurtir = "select naoCurtir from tweets where id = :id";
        $stmt = $this->db->prepare($retornoQuantNaoCurtir);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $aux = $stmt->fetch(\PDO::FETCH_ASSOC);
        $incrementaNaoCurtida = $aux['naoCurtir'] + 1;
        $queryUpdate = "update tweets set naoCurtir = :naoCurtida where id = :id";
        $stmt = $this->db->prepare($queryUpdate);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':naoCurtida',$incrementaNaoCurtida);
        $stmt->execute();
        return true;
    }
}
?>