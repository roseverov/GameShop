<?php

	class Product{
		
		const DEFAULT_COUNT = 3;
		
		public static function getLatestProducts($count = self::DEFAULT_COUNT) {
			
			$count = intval($count);
			
			$db = Db::getConection();
			
			$productList = array();
			
			$result = $db->query('SELECT * FROM product WHERE status = 1 ORDER BY id DESC LIMIT '.$count);
			
			$i = 0;
			while ($row = $result->fetch()) {
				$productList[$i]['id'] = $row['id'];
				$productList[$i]['name'] = $row['name'];
				$productList[$i]['image'] = $row['image'];
				$productList[$i]['price'] = $row['price'];
				$productList[$i]['is_new'] = $row['is_new'];
				$i++;
			}
			
			return $productList;
			
		}
		
		public static function getProductListMyCategory($catId, $page = 1) {
			
			if ($catId) {
				
				$count = self::DEFAULT_COUNT;
				$count = intval($count);
				
				$page = intval($page);
				$offset = ($page - 1) * $count;
				
				$db = Db::getConection();
				$product = array();
				$result = $db->query("SELECT * FROM product WHERE category_id = $catId AND status = 1 ORDER BY id DESC LIMIT $count OFFSET $offset ");
				
				$i = 0;
				while ($row = $result->fetch()) {
					$product[$i]['id'] = $row['id'];
					$product[$i]['name'] = $row['name'];
					$product[$i]['image'] = $row['image'];
					$product[$i]['price'] = $row['price'];
					$product[$i]['is_new'] = $row['is_new'];
					$i++;
				}
				return $product;
			}
			
		}
		
		public static function getProductById($id) {
			
			$id = intval($id);
			
			if ($id) {
				$db = Db::getConection();
				
				$result = $db->query("SELECT * FROM product WHERE id=".$id);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				
				return $result->fetch();
			}
			
		}
		
		public static function getTotalProductsInCategory($catId) {
			
			$db = Db::getConection();
			
			$result = $db->query("SELECT count(id) AS count FROM product WHERE status = '1' AND category_id = $catId");
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$row = $result->fetch();
			
			return $row['count'];
			
		}
		
		public static function getProductsByIds($idsArray) {
			
			$products = array();
			
			$db = Db::getConection();
			$idsString = implode(',',$idsArray);
			
			$sql = "SELECT * FROM product WHERE status = 1 AND id IN ($idsString)";
			$result = $db->query($sql);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			
			$i = 0;
			while ($row = $result->fetch()) {
				$products[$i]['id'] = $row['id'];
				$products[$i]['code'] = $row['code'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['price'] = $row['price'];
				$i++;
			}
			
			return $products;
			
		}
		
		public static function getRecommendedProducts() {
			
			$db = Db::getConection();
			
			$result = $db->query('SELECT * FROM product WHERE status = "1" AND is_recommended = "1" ORDER BY id DESC');
			
			
			$productsList = array ();
			$i = 0;
			while ($row = $result->fetch()) {
				$productsList[$i]['id'] = $row['id'];
				$productsList[$i]['name'] = $row['name'];
				$productsList[$i]['price'] = $row['price'];
				$productsList[$i]['is_new'] = $row['is_new'];
				$productsList[$i]['image'] = $row['image'];
				$i++;
			}
			
			return $productsList;
			
		}
		
		public static function getProductList() {
			
			$db = Db::getConection();
			
			$result = $db->query('SELECT * FROM product ORDER BY id ASC');
			
			
			$productsList = array ();
			$i = 0;
			while ($row = $result->fetch()) {
				$productsList[$i]['id'] = $row['id'];
				$productsList[$i]['name'] = $row['name'];
				$productsList[$i]['price'] = $row['price'];
				$productsList[$i]['code'] = $row['code'];
				$i++;
			}
			
			return $productsList;
			
		}
		
		public static function deleteProductById($id) {
			
			$db = Db::getConection();
			
			$sql = "DELETE FROM product WHERE id = :id";
			
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			
			return $result->execute();
			
		}
		
		 public static function createProduct($options){
		
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = 'INSERT INTO product '
					. '(name, code, price, category_id, brand, availabillity,'
					. 'description, is_new, is_recommended, status)'
					. 'VALUES '
					. '(:name, :code, :price, :category_id, :brand, :availabillity,'
					. ':description, :is_new, :is_recommended, :status)';
			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':name', $options['name'], PDO::PARAM_STR);
			$result->bindParam(':code', $options['code'], PDO::PARAM_STR);
			$result->bindParam(':price', $options['price'], PDO::PARAM_STR);
			$result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
			$result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
			$result->bindParam(':availabillity', $options['availabillity'], PDO::PARAM_INT);
			$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
			$result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
			$result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
			$result->bindParam(':status', $options['status'], PDO::PARAM_INT);
			if ($result->execute()) {
				// Если запрос выполенен успешно, возвращаем id добавленной записи
				return $db->lastInsertId();
			}
			// Иначе возвращаем 0
			return 0;
		}
		
		 public static function updateProductById($id, $options) {
    
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = "UPDATE product
				SET 
					name = :name, 
					code = :code, 
					price = :price, 
					category_id = :category_id, 
					brand = :brand, 
					availabillity = :availabillity, 
					description = :description, 
					is_new = :is_new, 
					is_recommended = :is_recommended, 
					status = :status
				WHERE id = :id";
			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->bindParam(':name', $options['name'], PDO::PARAM_STR);
			$result->bindParam(':code', $options['code'], PDO::PARAM_STR);
			$result->bindParam(':price', $options['price'], PDO::PARAM_STR);
			$result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
			$result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
			$result->bindParam(':availabillity', $options['availabillity'], PDO::PARAM_INT);
			$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
			$result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
			$result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
			$result->bindParam(':status', $options['status'], PDO::PARAM_INT);
			return $result->execute();
		}
		
		
	}

?>