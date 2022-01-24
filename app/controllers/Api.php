<?php
class Api extends Controller {

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-requested-With');
        $this->postModel = $this->model('post');

    }

    public function read(){

        $data = $this->postModel->getAllPost();
        if ($data){
            echo json_encode($data);
        }else{

            echo json_encode([
                'message'=>'post not found'
            ]);
        }
    }

    public function read_single($id)
    {
        $rowPost = $this->postModel->getPostById($id);
        if ($rowPost){
            echo json_encode($rowPost);
        }else{
            echo json_encode([
                'status'=>'error',
                'message'=>'Post not found',
            ]);
        }
    }


    public function creat(){

        $post = json_decode(file_get_contents('php://input'));
        $user_id = '15';
        $title = $post->title;
        $description = $post->description;
        $data = [
            'user_id' => $user_id,
            'title' => $title,
            'description' => $description,

        ];
        if ($this->postModel->apiCreate($data)){
            echo json_encode([
                'status' => 'successful',
                'data' => $data,
                'message' => 'post saved',

            ]);
        }else{
            echo json_encode([
                'status' => 'Error',
                'message' => 'post not saved',
            ]);
        }

    }




}
