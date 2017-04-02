<?php
	
	class SiteController {
		
		public function actionIndex () {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$latestProduct = array();
			$latestProduct = Product::getLatestProducts(6);
			
			$sliderProducts = Product::getRecommendedProducts();
			
			require_once (ROOT . '/views/site/index.php');
			
			return true;
			
		}
		
		public function actionContact () {
			
			$userEmail = '';
			$userText = '';
			$result = false;
			
			if (isset($_POST['submit'])) {
				
				$userEmail = $_POST['userEmail'];
				$userText = $_POST['userText'];
				
				$errors = false;
				
				if (!User::checkEmail($userEmail)) {
					
					$errors[] = 'Неправильный email';
					
				}
				if ($errors == false) {
					
					$adminEmail = 'loding95@mail.ru';
					$message = "Текст {$userText}. от {$userEmail} ";
					$subject = "Тема письма";
					$result = mail($adminEmail, $message, $subject);
					$result = true;
					
				}
				
			}
			
			require_once (ROOT . '/views/site/contact.php');
			
			die;
			
		}
		
	}
	
	
	
?>