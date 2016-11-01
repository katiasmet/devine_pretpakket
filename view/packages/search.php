<section class="search-result">
	<div class="search-result">
	<ul class="package-grid">
		<?php 
			foreach($searchResults as $searchResult){
		?>
		
		<li>
			<figure class="<?php echo 'id-' . $searchResult['id']; ?>"><a href="index.php?page=pakket_detail&amp;id=<?php echo $searchResult['id']; ?>"><img src="<?php echo $searchResult['small_image']; ?>" alt="<?php echo $searchResult['title']; ?>"/></a></figure>
			<div class="package-info">
				<h2>
					<?php 
						if(!empty($searchResult['promo'])) {
							echo '<span class="promo">promo:</span>';
						}
					?>
					
					<?php echo $searchResult['title']; ?>
				</h2>
				<p><?php echo $searchResult['short_description']; ?></p>
				<p><em>€ <?php echo $searchResult['price']; ?></em> 
					<?php 
						if(!empty($searchResult['promo'])) {
							echo '<span class="promo">';
						  	echo '+ promo:';
							echo $searchResult['promo'];
							echo '</span>';
						}
					?>
					</p>
				<a class="button" href="index.php?page=pakket_detail&amp;id=<?php echo $searchResult['id']; ?>">Ontdek dit pretpakket</a>
			</div>
		</li>

		<?php 
			}
		?>
	</ul>
	</div>
</section>