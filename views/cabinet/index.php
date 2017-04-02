<?php include ROOT . '/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

           <h1>Кабинет пользователя</h1>
           <h3>Приветствую, <?php echo $user['name'];?></h3>
			<ul>
				<li><a href="/cabinet/edit">Редактировать данные</a></li>
				<li><a href="/cabinet/histiory/">Список покупок</a></li>
			</ul>
		   
        </div>
    </div>
</section>

<?php include ROOT . '/layouts/footer.php'; ?>
<html>
<head>
<title>Кабинет</title>
</head>
</html>