<?php
class LoginController extends Controller
{
    public function index() {
        if (isset($_POST['action'])) {
            $theUser = $this->model('User')->findUser($_POST['username']);
            if ($theUser != null && password_verify($_POST['password'], $theUser->password_hash)) {
                $_SESSION['user_id'] = $theUser->user_id;
                $_SESSION['role'] = $theUser->role;
                header('location:/medivia/library/home/index');
            }
            else {
                $this->view('login/index', 'Incorrect username or password');
            }
        }
        else {
            $this->view('login/index');
        }
    }

    public function register() {
        // $this->view('login/register', 'Registration currently closed');

        if (isset($_POST['action'])) {
            $newUser = $this->model('User');
            $theUser = $newUser->findUser($_POST['username']);
            if ($theUser == null) {
				if ($_POST['password'] == $_POST['password_confirm']) {
					$newUser->username = $_POST['username'];
					$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$newUser->create();
					header('location:/medivia/library/login/index');
				}
				else {
					$this->view('login/register', 'Passwords do not match');
				}
            }
            else {
                $this->view('login/register', 'Username already in use');
            }
        }
        else {
            $this->view('login/register');
        }
    }

    public function logout() {
        session_destroy();
        header('location:/medivia/library/login/index');
    }
}
?>