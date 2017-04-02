<?php include ROOT . '/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
					
						<?php if (isset($errors) && is_array($errors)):?>
							<ul>
								<?php foreach ($errors as $er):?>
									<li>- <?php echo $er;?></li>
								<?php endforeach;?>
							</ul>
						<?php endif;?>
						
						<div class="signup-form"><!--sign up form-->
							<h2>Вход на сайт</h2>
							<form action="#" method="post">
								<input type="email" name="email" placeholder="E-mail" value="<?php echo @$email;?>"/>
								<input type="password" name="password" placeholder="Пароль" value=""/>
								<input type="submit" name="submit" class="btn btn-default" value="Вход" />
							</form>
						</div><!--/sign up form-->
                
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/layouts/footer.php'; ?>
<html>
<head>
<title>Вход</title>
</head>
</html>