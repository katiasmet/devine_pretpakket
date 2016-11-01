<div class="back-btn"><a href="index.php?page=workshops"><i class="fa fa-caret-left"></i>terug naar overzicht</a></div>
<?php
	$datum = date("d/m/Y", strtotime($workshop['date_hr']));
	$uur = date("H", strtotime($workshop['date_hr']));
?>
<section class="workshop-detail">
	<div class="halfw workshop-info">
		<h1><?php echo $workshop['workshop_title']; ?></h1>
		<p><?php echo $workshop['location']; ?></p>
		<p><?php echo $datum; ?> van <?php echo $uur; ?>u tot <?php echo $uur + 3 ; ?>u</p>
		<?php
			if($workshop_subscriptions['subscriptions'] == $workshop['max_subscriptions'] ) {
				echo '<p class="side-info volzet">Deze workshop is volzet.</p>';
			} else {
				echo "<p>huidig aantal deelnemers: " . $workshop_subscriptions['subscriptions'] . "/" . $workshop['max_subscriptions'] . "</p>";
			}
		?>
	</div>

	<div class="halfw halfw-right detail-info">
		<?php echo $workshop['long_description']; ?>
		<p class="detail-price"><em>€ <?php echo $workshop['price']; ?></em></p>
		<p class="price-owners">eigenaars van het <?php echo $workshop['title']; ?>: € <?php echo $workshop['price_owners']; ?></p>
	</div>

	<figure class="workshop-img workshop-detailid-<?php echo $workshop['id']; ?>"><img src="<?php echo $workshop['image']; ?>" alt="<?php echo $workshop['workshop_title']; ?>"/></figure>
</section>

<div class="yellow-sect">
<section class="workshop-subscription">
	<h1>schrijf me in</h1>
	
	<div class="workshop-subscribe">
	<?php
		if(!empty($_SESSION['user'])) {
			if(!empty($workshop_subscribed)) {
				echo '<p>Je bent ingeschreven voor deze workshop. De betaling gebeurt contant op de dag zelf.</p>';
				echo '<p><a href="index.php?page=mijnprofiel">In je profiel</a> kun je je nog uitschrijven tot 5 dagen voor de workshop.</p> ';
			} else {
	?>
		<p>Er kunnen maximaal <?php echo $workshop['max_subscriptions']; ?> mensen deelnemen aan de workshop. </p>
		<p>huidig aantal deelnemers: <?php echo $workshop_subscriptions['subscriptions'] ?>/<?php echo $workshop['max_subscriptions']; ?></p>
		<p>In je profiel kun je je nog uitschrijven tot 5 dagen voor de workshop. De betaling gebeurt contant op de dag zelf.</p> 

		<form method="post" class="workshop-form" action="index.php?page=workshop_detail&amp;id=<?php echo $workshop['id'];?>">
			<div>
				<label>
		            <input type="checkbox" name="workshop_subscribe" value="1" checked/><span class="form-label label-cb">schrijf mij in voor deze workshop</span> 
		        	<?php if(!empty($errors['workshop_subscribe'])) echo '<span class="error-message">' . $errors['workshop_subscribe'] . '</span>'; ?>
		        </label>
		    </div>
		    
		    <div class="sbmt-bg">
		        <input type="submit" name="action" value="bevestig mijn deelname"/>
		    </div>
		</form>
	
	<?php
			}
		} else {
			echo '<p>Enkel geregistreerde gebruikers kunnen deelnemen aan de workshop. <a href="index.php?page=registreren">Registreer nu</a>.</p>';
		}
	?>
	</div>

</section>
</div>