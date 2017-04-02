<?php include ROOT . '/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
					<?php
					$res ="";
					if (!$res) { ?>
						<?php if (isset($errors) && is_array($errors)) { ?>
							<ul>
								<?php foreach ($errors as $er):?>
									<li>- <?php echo $er;?></li>
								<?php endforeach;?>
							</ul>
						<?php } ?>
						
						<div class="signup-form"><!--sign up form-->
							<h2>Регистрация на сайте</h2>
							<form action="#" method="post">
								<input type="text" name="name" placeholder="Имя" value="<?php echo @$name;?>"/>
								<input type="email" name="email" placeholder="E-mail" value="<?php echo @$email;?>"/>
								<input type="password" name="password" placeholder="Пароль" value=""/>
								<input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
							</form>
						</div><!--/sign up form-->
					<?php } elseif ($res) { ?>
						<p>Вы зарегестрированы</p>
						
					<?php }?>
                
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/layouts/footer.php'; ?>
<html>
<head>
<title>Регистрация</title>
</head>
</html>