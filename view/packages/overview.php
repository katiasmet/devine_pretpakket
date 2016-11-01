<section class="packages-overview">
	<ul class="package-grid">
		<?php foreach($packages as $package): ?>
		
		<li>
			<figure class="<?php echo 'id-' . $package['id']; ?>"><a href="index.php?page=pakket_detail&amp;id=<?php echo $package['id']; ?>"><img src="<?php echo $package['small_image']; ?>" alt="<?php echo $package['title']; ?>"/></a></figure>
			<div class="package-info">
				<h2>
					<?php 
						if(!empty($package['promo'])) {
							echo '<span class="promo">promo:</span>';
						}

						if($package['id'] == $mostViewed['id']) {
							echo '<span class="populair">populair:</span>';
						}
					?>
					
					<?php echo $package['title']; ?>
				</h2>
				<p><?php echo $package['short_description']; ?></p>
				<p><em>€ <?php echo $package['price']; ?></em> 
					<?php 
						if(!empty($package['promo'])) {
							echo '<span class="promo">';
						  	echo '+ promo:';
							echo $package['promo'];
							echo '</span>';
						}
					?>
					</p>
				<a class="button" href="index.php?page=pakket_detail&amp;id=<?php echo $package['id']; ?>">Ontdek dit pretpakket</a>
				<p class="side-info"><?php echo $package['views']; ?> keer bekeken</p>
			</div>
		</li>

		<?php endforeach ?>
	</ul>
	<div class="yellow-sect"></div>
	<div class="red-sect"></div>
</section>