<?php 

class Posts {
    public function fetch_all() {
        global $pdo;

        $query = $pdo->prepare('SELECT * FROM posts');
        $query->execute();

        return $query->fetchAll();
    }  
    
    public function fetch_data($post_id) {
        global $pdo;
        
        $query = $pdo->prepare('SELECT * FROM posts WHERE post_id = ?');
        $query->bindValue(1, $post_id);
        $query->execute();

        return $query->fetch();
    }
}
