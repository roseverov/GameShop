<?php

	class CartController {
		
		public function actionAdd($id) {
			
			Cart::addProduct($id);
			
			$referer = $_SERVER['HTTP_REFERER'];
			header ("Location: $referer");
			
		}
		
		public function actionAddAjax($id) {
			
			echo Cart::addProduct($id);
			
			return true;
			
		}
		
		public function actionDelete($id) {
			
			Cart::deleteProduct($id);
			
			header("Location: /cart/");
			
		}
		
		public function actionIndex() {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$productsInCart = false;
			$productsInCart = Cart::getProducts();
			
			if ($productsInCart) {
				
				$productsIds = array_keys($productsInCart);
				$products = Product::getProductsByIds($productsIds);
				
				$totalPrice = Cart::getTotalPrice($products);
				
			}
			
			require_once (ROOT . "/views/cart/index.php");
			
			return true;
			
		}
		
		public function actionCheckout() {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$result = false;
			
			if (isset($_POST['submit'])) {
				
				$userName = $_POST['userName'];
				$userPhone = $_POST['userPhone'];
				$userComment = $_POST['userComment'];
				
				$errors = false;
				
				if (!User::checkName($userName)) {
					$errors[] = "Неправильное имя";
				}
				if (!User::checkPhone($userPhone)) {
					$errors[] = "Неправильный телефон";
				}
				
				if ($errors == false) {
					
					$productsInCart = Cart::getProducts();
					if (User::isGuest()) {
						$userId = false;
					} else {
						$userId = User::checkLogged();
					}
					
					$result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
					
					if ($result) {
						$adminMail = "loding95@mail.ru";
						$message = "Поступил новый заказ";
						$subject = "Новый заказ";
						mail($adminMail, $message, $subject);
						
						Cart::clear();
					}
					
				}
				
				else {
					
					$productsInCart = Cart::getProducts();
					$productsIds = array_keys($productsInCart);
					$products = Product::getProductsByIds($productsIds);
					$totalPrice = Cart::getTotalPrice($products);
					$totalQuantity = Cart::countItems();
					
					
					
				}
				
			} else {
				
				$productsInCart = Cart::getProducts();
				
				if ($productsInCart == false) {
					header("Location: /");
				}
				else {
					
					$productsIds = array_keys($productsInCart);
					$products = Product::getProductsByIds($productsIds);
					$totalPrice = Cart::getTotalPrice($products);
					$totalQuantity = Cart::countItem();
					
					$userName = false;
					$userPhone = false;
					$userComment = false;
					
					if (User::isGuest()) {
						
					} else {
						
						$userId = User::checkLogged();
						$user = User::getUserById($userId);
						
						$userName = $user['name'];
						
					}
					
				}
			}
			
			require_once ( ROOT . '/views/cart/checkout.php' );
			
			return true;
			
		}
		
	}

?>