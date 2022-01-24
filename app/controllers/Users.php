<?php

class Users extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $data = [
            'title' => 'Login Page',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
        ];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'role' => "USR",
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
            ];
            $validateUsername = "/^[a-zA-z0-9]*$/";

//          Validate name on word/number
            if (empty($data['username'])) {
                $data['usernameError'] = "Please Enter the username";

            } elseif (!preg_match($validateUsername, $data['username'])) {
                $data['usernameError'] = "Please Enter username only number and word ";
            }
//          validate Email
            if (empty($data['email'])) {
                $data['emailError'] = "Please Enter the Email";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Please Enter correct Email ";
            }

//              Check if email is exists
            if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = "Email is already taken";

            }
//           validate password
            if (empty($data['password'])) {
                $data['passwordError'] = "Please Enter the password";
            }

//          validate password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = "Please Enter confirm Password";
            } elseif ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = "Password do not match";
            }
//            if empty error and register success
            if (empty($data['usernameError']) and empty($data['emailError']) and empty($data['passwordError']) and empty($data['confirmPasswordError'])) {

//                Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

//                Register User
                if ($this->userModel->register($data)) {
//                    Redirect to Login page after success register
                    header('location:' . URLROOT . 'public/users/login');
                } else {
                    die("something went wrong");
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login Page',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
        ];

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Login Page',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];

            $validateUsername = "/^[a-zA-z0-9]*$/";

//          Validate name on word/number
            if (empty($data['username'])) {
                $data['usernameError'] = "Please Enter the username";

            } elseif (!preg_match($validateUsername, $data['username'])) {
                $data['usernameError'] = "Please Enter username only number and word ";
            }
//          validate Email
            if (empty($data['email'])) {
                $data['emailError'] = "Please Enter the Email";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Please Enter correct Email ";
            }
//           validate password
            if (empty($data['password'])) {
                    $data['passwordError'] = "Please Enter the password";
            }

//          if empty error check for login user
            if (empty($data['usernameError']) and empty($data['emailError']) and empty($data['passwordError'])) {

//            check exist entity
                if ($this->userModel->login($data)) {
                    $this->createUserSession($this->userModel->login($data));
                    header('location:' . URLROOT . 'public/');

                }else{
                    $data['passwordError'] = "User not found. Please try again";

                    $this->view('users/login',$data);
                }
            }

        }

        $this->view('users/login', $data);

    }

    public function logout()
    {
        session_destroy();
        header('location:' . URLROOT . 'public/pages/login');
    }

    public function createUserSession($user){

        if ($user->role == 'ADM'){
            $_SESSION['role'] = 'ADM';
        }
        $_SESSION['AUTH'] ='login';
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username ;
        $_SESSION['email'] = $user->email;
    }


}














