<?php
	
	class CatalogController {
		
		public function actionIndex () {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$latestProduct = array();
			$latestProduct = Product::getLatestProducts(12);
			
			require_once (ROOT . '/views/catalog/index.php');
			
			return true;
			
		}
		
		public function actionCategory ($catId, $page = 1) {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$catProduct = array();
			$catProduct = Product::getProductListMyCategory($catId, $page);
			
			$total = Product::getTotalProductsInCategory($catId);
			
			$pagination = new Pagination($total, $page, Product::DEFAULT_COUNT, 'page-');
			
			require_once ( ROOT . '/views/catalog/category.php' );
			
			return true;
			
		}
		
	}
	
	
	
?>