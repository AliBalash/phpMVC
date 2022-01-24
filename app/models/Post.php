<?php

class Post
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPost()
    {
        $this->db->query('SELECT * FROM posts ORDER BY id DESC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function createPost($data)
    {
        $imgName = rand(0, 9999) . $_FILES['image']['name'];
        $imgPath = 'assets/upload/';
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imgPath . $imgName)) {

            $this->db->query("INSERT INTO posts (user_id, title, description , image,created_at) VALUES (:user_id,:title,:description,:image,:created_at)");
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':image', $imgName);
            $this->db->bind(':created_at', $data['created_at']);
            if ($this->db->execute()) {
                $_SESSION['message'] = "Post Saved";
                return true;
            } else {
                die("data not Insert");
            }
            return true;
        }

    }

    public function getPostById($id)
    {
        $this->db->query("SELECT * from posts where id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        if ($row) {
            return $row;
        } else {
            die("post not found by ID");
        }
    }

    public function updatePost($data)
    {
        $imgName = rand(0, 9999) . $_FILES['image']['name'];
        $imgPath = 'assets/upload/';
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imgPath . $imgName)) {

//            Delete last img In folder Upload (cascade)
            $this->deletelastImg($data['post_id']);
            $this->db->query("UPDATE posts SET user_id = :user_id,title = :title ,description = :description, image = :image , created_at =:created_at   WHERE id = :post_id");
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':image', $imgName);
            $this->db->bind(':created_at', $data['created_at']);
            $this->db->bind(':post_id', $data['post_id']);
            if ($this->db->execute()) {
                $_SESSION['message'] = "Post Updated";
                return true;
            } else {
                die("Post dont updated!");
            }
        } else {
            die('Post not Updated');
        }
    }

    public function deletelastImg($id)
    {
        $this->db->query('SELECT image from posts where id = :id');
        $this->db->bind(':id', $id);
        if ($filename = $this->db->single()) {
            $imgPath = 'assets/upload/' . $filename->image;
            if (unlink($imgPath)) {
                return true;
            } else
                echo "last image not found";
        }

    }

    public function lastPost()
    {
        $this->db->query('select *from posts ORDER BY id DESC LIMIT 4');
        $result = $this->db->resultSet();
        return $result;
    }

    public function deletePostById($id)
    {
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);
        $delete = $this->db->execute();

        if ($delete) {
            $_SESSION['message'] = "Post Deleted";

            return true;
        } else {
            die("post not found by ID");
        }
    }

    public function apiCreate($data)
    {

        $this->db->query("INSERT INTO posts (user_id, title, description ) VALUES (:user_id,:title,:description)");
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':description',$data['description']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }













}


