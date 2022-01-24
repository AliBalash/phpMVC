<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $data = $this->postModel->lastPost();

        $this->view('pages/home',$data);
    }

    public function about()
    {

        if (isset($_SESSION['AUTH'])){
            $this->view('pages/about');
        }else
            echo "first Login";
    }


    public function read (){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $data = $this->postModel->getAllPost();
        echo json_encode([
            'message'=>'<h1>heloo</h1>'
        ]);
    }
}
