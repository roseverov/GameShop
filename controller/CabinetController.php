<?php
	
	class CabinetController {
		
		public function actionIndex () {
			
			$userId = User::checkLogged();
			
			$user = User::getUserById($userId);
			
			require_once (ROOT . '/views/cabinet/index.php');
			
			return true;
			
		}
		
		public function actionEdit () {
			
			$userId = User::checkLogged();
			
			$user = array();
			
			$user = User::getUserById($userId);
			
			$name = $user['name'];
			
			$password = $user["password"];
			
			if (isset($_POST['submit'])) {
				$name = $_POST['name'];
				$password = $_POST['password'];
				
				$errors = false;
				
				if (!User::checkName($name)) {
					$errors[] = 'Имя не должно быть короче 2 символов';
				}
				
				if (!User::checkPassword($password)) {
					$errors[] = 'Пароль не должен быть короче 6 символов';
				}
				
				if ($errors == false) {
					$res = User::edit($userId, $name, $password);
				}
				
			}
			
			require_once (ROOT . '/views/cabinet/edit.php');
			
			return true;
			
		}
		
	}
	
?>