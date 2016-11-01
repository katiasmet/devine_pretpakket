<section>
	<figure class="pretpakket_home">
		<img src="img/home_logo.svg" alt="pretpakket"/>
		<div class="pretpakket_home_fish"></div>
	</figure>

	<div class="onethirdw">
		<ul>
			<li><a class="button yellow-button no-margin" href="index.php?page=pakketten">bekijk de pretpakketten</a></li>
			<li><a class="button red-button" href="index.php?page=workshops">bekijk de workshops</a></li>
			<li><a class="button orange-button" href="index.php?page=pretinjouwbuurt">zoek pretpakketten in jouw buurt</a></li>
		</ul>
	</div>
	
	<div class="twothirdw home_intro">
		<p><em>Pretparkattracties</em> in je achtertuin? Met het pretpakket <em>bouw</em> je dit <em>zelf</em> en op je eigen manier.</p>
		<p>Meerwaarde van dit pakket:</p>
		<ul class="custom-list">
			<li>duurzame en veelzijdige materialen</li>
			<li>workshops: samen bouwen stap voor stap</li>
			<li>gezellig met de hele buurt samenwerken</li>
		</ul>
	</div>
</section>

<div class="yellow-sect">
<section>
	<h1 class="alt_indent">Voordeelpakketten</h1>
	<ul class="package-grid">
		<?php 
			foreach($packages as $package): 
		?>
		
		<li>
			<figure class="<?php echo 'id-' . $package['id']; ?>" ><a href="index.php?page=pakket_detail&amp;id=<?php echo $package['id']; ?>"><img src="<?php echo $package['small_image']; ?>" alt="<?php echo $package['title']; ?>"/></a></figure>
			<div class="package-info">
				<h2><span class="promo">promo:</span><?php echo $package['title']; ?></h2>
				<p><?php echo $package['short_description']; ?></p>
				<p><em>€ <?php echo $package['price']; ?></em><span class="promo"> + promo: <?php echo $package['promo']; ?></span></p>
				<a class="button" href="index.php?page=pakket_detail&amp;id=<?php echo $package['id']; ?>">Ontdek dit pretpakket</a>
				<p class="side-info"><?php echo $package['views']; ?> keer bekeken</p>
			</div>
		</li>

		<?php endforeach ?>
	</ul>
</section>
</div>

<div class="red-sect">
<section>
	<h1 class="alt_indent">Pretpakketten in jouw buurt</h1>
	<figure class="onethirdw">
		<img src="img/home_kaart.jpg" alt="kaart" class="home-kaart"/>
	</figure>
	<div class="twothirdw twothirdw-alt home-buurt">
		<p>Waarom deelnemen aan pretpakket in jouw buurt?</p>
		<ul class="custom-list">
			<li>ontdek welke buren een pretpakket hebben besteld</li>
			<li>lees hun ervaringen of voeg je eigen ervaring toe</li>
			<li>contacteer je buren, organiseer een buurtfeest en test <br /> <a href="index.php?page=pakketten">alle attracties van Pretpakket</a> uit</li>
		</ul>
		<a class="button" href="index.php?page=pretinjouwbuurt">zoek pretpakketten in jouw buurt</a>
	</div>
</section>
</div>