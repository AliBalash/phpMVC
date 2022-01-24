<?php

class Posts extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

//    Blog show All post
    public function blog()
    {
        $data = $this->postModel->getAllPost();

        $this->view('posts/blog', $data);
    }

//    show table post for admin
    public function panelPost()
    {
        if (isset($_SESSION['role'])) {

            $data = $this->postModel->getAllPost();
            $this->view('posts/panelPost', $data);
        } else {
            die("User not access this page");
        }
    }

//   ------------------------------- CRUD Posts -------------------------------

    public function createPost()
    {

//        this page only for Admin
        if (isset($_SESSION['role'])) {

            $data = [
                "titlePage" => 'Add Post',
                "user_id" => '',
                "title" => '',
                "description" => '',
                "image" => '',
                "created_at" => '',
                "user_idError" => '',
                "titleError" => '',
                "descriptionError" => '',
                "imageError" => '',
                "created_atError" => '',
            ];
            if (isset($_POST['submit'])) {


                $data = [
                    "titlePage" => 'Add Post',
                    "user_id" => $_SESSION['user_id'],
                    "title" => $_POST['title'],
                    "description" => $_POST['description'],
                    "image" => $_FILES['image']['name'],
                    "created_at" => $_POST['created_at'],
                    "user_idError" => '',
                    "titleError" => '',
                    "descriptionError" => '',
                    "imageError" => '',
                    "created_atError" => '',
                ];
//          --------Validate Posts

                if (empty($data['user_id'])) {
                    $data['user_idError'] = "you dont know Authentication";
                }

//               validate password
                if (empty($data['title'])) {
                    $data['titleError'] = "Please Enter the title";
                }

//              validate title
                if (empty($data['description'])) {
                    $data['descriptionError'] = "Please Enter the Description";
                } elseif (str_word_count($data['description']) < 10) {
                    $data['descriptionError'] = "Minimum Description is 10 word";

                }
//              validate created_at
                if (empty($data['created_at'])) {
                    $data['created_atError'] = "Please Enter Date of create this post";
                }

                if (empty($data['user_idError']) and empty($data['titleError']) and empty($data['descriptionError']) and empty($data['created_atError'])) {

//                    Create Post
                    if ($this->postModel->createPost($data)) {
                        header('location:' . URLROOT . "public/posts/blog");
                    }
                }

            }

            $this->view('posts/createpost', $data);


        } else {
            die("User not access this page");
        }
    }

    public function Edit($id)
    {
        //        this page only for Admin
        if (isset($_SESSION['role'])) {

//                  select post by id
            if ($rowPost = $this->postModel->getPostById($id)) {

                $data = [
                    "titlePage" => 'Edit Post',
                    "post_id" => $rowPost->id,
                    "user_id" => $rowPost->user_id,
                    "title" => $rowPost->title,
                    "description" => $rowPost->description,
                    "image" => $rowPost->image,
                    "created_at" => $rowPost->created_at,
                    "user_idError" => '',
                    "titleError" => '',
                    "descriptionError" => '',
                    "imageError" => '',
                    "created_atError" => '',
                ];

                if (isset($_POST['submit'])) {

                    $data = [
                        "titlePage" => 'Edit Post',
                        "post_id" => $rowPost->id,
                        "user_id" => $_SESSION['user_id'],
                        "title" => $_POST['title'],
                        "description" => $_POST['description'],
                        "image" =>  $_FILES['image']['name'],
                        "created_at" => $_POST['created_at'],
                        "user_idError" => '',
                        "titleError" => '',
                        "descriptionError" => '',
                        "imageError" => '',
                        "created_atError" => '',
                    ];

//                    /*Validate Posts */
//
                    if (empty($data['user_id'])) {
                        $data['user_idError'] = "you dont know Authentication";
                    }

//               validate password
                    if (empty($data['title'])) {
                        $data['titleError'] = "Please Enter the title";
                    }

//              validate title
                    if (empty($data['description'])) {
                        $data['descriptionError'] = "Please Enter the Description";
                    } elseif (str_word_count($data['description']) < 10) {
                        $data['descriptionError'] = "Minimum Description is 10 word";

                    }
//              validate created_at
                    if (empty($data['created_at'])) {
                        $data['created_atError'] = "Please Enter Date of create this post";
                    }
//              validate image
                    if (empty($data['image'])) {
                        $data['imageError'] = "Please Enter Image this post";
                    }

                    if (empty($data['user_idError']) and empty($data['titleError']) and empty($data['descriptionError']) and empty($data['created_atError'])) {

//                    Update post
                        if ($this->postModel->updatePost($data)) {
                            header('location:' . URLROOT . "public/posts/panelpost");
                        } else {

                        }
                    }
                }
                $this->view('posts/editPost', $data);
            }
        }
    }

    public function delete($id)
    {
        //        this page only for Admin
        if (isset($_SESSION['role'])) {

//                  select post by id
            if ($this->postModel->deletePostById($id)) {
                header('location:' . URLROOT . "public/posts/panelpost");
            }
        }

    }

    public function detail($id)
    {
        $data = $this->postModel->getPostById($id);

        $this->view('posts/detail',$data);
    }

}






