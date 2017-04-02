<?php

	class Category{
		
		public static function getCategoriesList() {
			
			$db = Db::getConection();
			
			$categoryList = array();
			
			$result = $db->query('SELECT * FROM category ORDER BY sort_order ASC');
			
			$i = 0;
			while ($row = $result->fetch()) {
				$categoryList[$i]['id'] = $row['id'];
				$categoryList[$i]['name'] = $row['name'];
				$i++;
			}
			
			return $categoryList;
			
		}
		
		public static function getCategoriesListAdmin() {
			
			$db = Db::getConection();
			
			$result = $db->query("SELECT * FROM category ORDER BY sort_order ASC");
			
			$categoryList = array();
			$i = 0;
			while ($row = $result->fetch()) {
				
				$categoryList[$i]['id'] = $row['id'];
				$categoryList[$i]['name'] = $row['name'];
				$categoryList[$i]['sort_order'] = $row['sort_order'];
				$categoryList[$i]['status'] = $row['status'];
				$i++;
				
			}
			
			return $categoryList;
			
		}
		
		public static function deleteCategoryById($id){
		
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = 'DELETE FROM category WHERE id = :id';
			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			return $result->execute();
		}
		/**
		 * Редактирование категории с заданным id
		 * @param integer $id <p>id категории</p>
		 * @param string $name <p>Название</p>
		 * @param integer $sortOrder <p>Порядковый номер</p>
		 * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
		 * @return boolean <p>Результат выполнения метода</p>
		 */
		public static function updateCategoryById($id, $name, $sortOrder, $status){
		
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = "UPDATE category
				SET 
					name = :name, 
					sort_order = :sort_order, 
					status = :status
				WHERE id = :id";
			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
			$result->bindParam(':status', $status, PDO::PARAM_INT);
			return $result->execute();
		}
		/**
		 * Возвращает категорию с указанным id
		 * @param integer $id <p>id категории</p>
		 * @return array <p>Массив с информацией о категории</p>
		 */
		public static function getCategoryById($id){
		
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = 'SELECT * FROM category WHERE id = :id';
			// Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			// Указываем, что хотим получить данные в виде массива
			$result->setFetchMode(PDO::FETCH_ASSOC);
			// Выполняем запрос
			$result->execute();
			// Возвращаем данные
			return $result->fetch();
		}
		/**
		 * Возвращает текстое пояснение статуса для категории :<br/>
		 * <i>0 - Скрыта, 1 - Отображается</i>
		 * @param integer $status <p>Статус</p>
		 * @return string <p>Текстовое пояснение</p>
		 */
		public static function getStatusText($status){
		
			switch ($status) {
				case '1':
					return 'Отображается';
					break;
				case '0':
					return 'Скрыта';
					break;
			}
		}
		/**
		 * Добавляет новую категорию
		 * @param string $name <p>Название</p>
		 * @param integer $sortOrder <p>Порядковый номер</p>
		 * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
		 * @return boolean <p>Результат добавления записи в таблицу</p>
		 */
		public static function createCategory($name, $sortOrder, $status){
		
			// Соединение с БД
			$db = Db::getConection();
			// Текст запроса к БД
			$sql = 'INSERT INTO category (name, sort_order, status) '
					. 'VALUES (:name, :sort_order, :status)';
			// Получение и возврат результатов. Используется подготовленный запрос
			$result = $db->prepare($sql);
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
			$result->bindParam(':status', $status, PDO::PARAM_INT);
			return $result->execute();
		}
		
	}

?>