<?php if(isset($_GET['mess'])) : ?>
	<div class="container">
		<section class="message message-<?php echo $_GET['color']; ?>">
			<h1><?php echo $_GET['mess']; ?></h1>
		</section>
	</div>
<?php endif; ?>