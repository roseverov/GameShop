<?php
	
	class UserController {
		
		public function actionRegister () {
			
			if (isset($_POST['submit'])) {
				$name = $_POST['name'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$errors = false;
				
				if (!User::checkName($name)) {
					$errors[] = 'Имя не должно быть короче 2 символов';
				}
				
				if (!User::checkEmail($email)) {
					$errors[] = 'Неправильный e-mail';
				}
				
				if (!User::checkPassword($password)) {
					$errors[] = 'Пароль не должен быть короче 6 символов';
				}
				
				if (User::checkEmailExists($email)) {
					$errors[] = 'Такой e-mail уже занят';
				}
				
				if ($errors == false) {
					$res = User::register($name, $email, $password);
				}
				
			}
			
			require_once (ROOT . '/views/user/register.php');
			
			return true;
			
		}
		
		public function actionLogin () {
			
			if (isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$errors = false;
				
				if (!User::checkEmail($email)) {
					$errors[] = 'Неправильный e-mail';
				}
				
				if (!User::checkPassword($password)) {
					$errors[] = 'Пароль не должен быть короче 6 символов';
				}
				
				$userId = User::checkUserData($email, $password);
				
				if ($userId == false) {
					$errors[] = 'Неправильно введены данные для входа на сайт';
				}
				else {
					User::auth($userId);
					header ("Location: /cabinet/");
				}
			}
			
			require_once (ROOT . '/views/user/login.php');
			
			return true;
			
		}
		
		public function actionLogout () {
			
			
			unset ($_SESSION['user']);
			header ("Location: /");
			
		}
	}
	
	
	
?>