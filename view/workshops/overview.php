<section class="packages-overview">
	<ul class="package-grid">

		<?php foreach($workshops as $workshop): ?>
		<li>
			<figure class="<?php echo 'workshop-id-' . $workshop['id']; ?>"><a href="index.php?page=workshop_detail&amp;id=<?php echo $workshop['id']; ?>"><img src="<?php echo $workshop['image']; ?>" alt="<?php echo $workshop['workshop_title']; ?>"/></a></figure>
			<div class="package-info">
				<h2><?php echo $workshop['workshop_title']; ?></h2>
				<p><?php echo $workshop['short_description']; ?></p>
				<p><em>€ <?php echo $workshop['price']; ?></em></p>
				<p class="price-owners">eigenaars van het <?php echo $workshop['title']; ?>: € <?php echo $workshop['price_owners']; ?></p>
				<a class="button" href="index.php?page=workshop_detail&amp;id=<?php echo $workshop['id']; ?>">Ontdek deze workshop</a>
				<?php
					if($workshop['subscriptions'] == $workshop['max_subscriptions']) {
						echo '<p class="side-info volzet">Deze workshop is volzet.</p>';
					} else {
						echo '<p class="side-info">Huidig aantal deelnemers: ' . $workshop['subscriptions'] . '/' . $workshop['max_subscriptions'] . '</p>';
					}
				?>
			</div>
		</li>
		<?php endforeach ?>

	</ul>
</section>