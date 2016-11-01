<div class="back-btn"><a href="index.php?page=pakketten"><i class="fa fa-caret-left"></i>terug naar overzicht</a></div>

<section class="package-detail">
	<div class="halfw">
		<h1>
			<?php 
				if(!empty($package[`promo`])) {
					echo '<span class="promo">promo:</span><br />';
				}
			?>
			<?php echo $package['title']; ?>
		</h1>

		<form method='post' action='index.php?page=add-package&amp;id=<?php echo $package['id']; ?>' class="add-package" >
			<input type='submit' name='add' class='button red-line-button' value='voeg toe aan mijn winkelwagen'>
		</form>
		<a class="button" href="index.php?page=pretinjouwbuurt">zoek pretpakketten in mijn buurt</a>
	</div>

	<div class="halfw halfw-right detail-info">
		<?php echo $package['long_description']; ?>
		<p class="detail-price"><em>€ <?php echo $package['price']; ?></em>
			<?php 
				if(!empty($package[`promo`])) {
					echo '<span class="promo">';
				  	echo '+ promo:';
					echo $package['promo'];
					echo '</span>';
				}
			?>
		</p>
		<p class="side-info">Dit pakket werd <?php echo $package['views']; ?> keer bekeken.</p>
	</div>

	<figure class="large-image <?php echo $package['id']; ?>"><img src="<?php echo $package['large_image']; ?>" alt="<?php echo $package['title']; ?>"/></figure>
</section>

<div class="yellow-sect">
<section>
	<h1>in dit pakket</h1>

	<ul class="package-content">

		<?php 
			foreach($packageItems as $packageItem): 
		?>
		<li>
			<figure><img src="<?php echo $packageItem['image'] ?>" alt="package item"/></figure>
			<div class="content-info">
				<h2><?php echo $packageItem['item'] ?></h2>
				<p><?php echo $packageItem['description'] ?></p>
			</div>
		</li>
		<?php endforeach ?>
	</ul>
</section>
</div>