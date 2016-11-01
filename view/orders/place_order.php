<section class="place-order">
	<h1>bestellen</h1>
	<?php
		if(!empty($_SESSION['user'])) {
	?>
		<div class="profile-personal-data">
		<ul>
			<li><?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']; ?></li>
			<li><?php echo $_SESSION['user']['adres']; ?></li>
			<li><?php echo $_SESSION['user']['postal_code'] . " " . $_SESSION['user']['city']; ?></li>
		</ul>
		<p class="personal-data-mail"><?php echo $_SESSION['user']['e_mail']; ?></p>
		
		<a class="edit-data" href="index.php?page=wijzig">Wijzig mijn gegevens</a>
		<form method="post" class="order-form" >
			<div class="sbmt-bg">
		        <input type="submit" name="action" value="plaats bestelling"/>
		    </div>
		</form>
	</div>
	<?php
		} else {
	?>
	<p>Door te bestellen maak je een account aan.<br /> Op die manier kun je later je gegevens nog aanpassen. </p>
	<form method="post" class="order-form register-form" >
		<div>
	        <label>
	            <span class="form-label">e-mail</span>
	            <input type="email" name="e_mail" placeholder="email@voorbeeld.com"/>
	            <?php if(!empty($errors['e_mail'])) echo '<span class="error-message error-email">' . $errors['e_mail'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">wachtwoord</span>
	            <input type="password" name="password" placeholder="kies een wachtwoord"/>
	            <?php if(!empty($errors['password'])) echo '<span class="error-message error-password">' . $errors['password'] . '</span>'; ?>
	            
	        </label>
	        <label>
	        	<input type="password" name="confirm_password" placeholder="herhaal wachtwoord"/>
	            <?php if(!empty($errors['confirm_password'])) echo '<span class="error-message error-password">' . $errors['confirm_password'] . '</span>'; ?>
	        </label>
	    </div>

		<div class="personal-data">
			<h2>verzendgegevens</h2>
	        <label>
	            <span class="form-label">voornaam</span>
	            <input type="text" name="first_name" placeholder="Sofie"/>
	            <?php if(!empty($errors['first_name'])) echo '<span class="error-message error-firstname">' . $errors['first_name'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">familienaam</span>
	            <input type="text" name="last_name" placeholder="Verveken"/>
	            <?php if(!empty($errors['last_name'])) echo '<span class="error-message error-lastname">' . $errors['last_name'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">adres</span>
	            <input type="text" name="adres" placeholder="Jakobijnstraat 8"/>
	            <?php if(!empty($errors['adres'])) echo '<span class="error-message error-adres">' . $errors['adres'] . '</span>'; ?>
	        </label>
	        <label>
	        	<span class="form-label">postcode en gemeente</span>
	            <input type="text" name="postal_code" placeholder="9000" class="postal"/>
	            <?php if(!empty($errors['postal_code'])) echo '<span class="error-message error-postal">' . $errors['postal_code'] . '</span>'; ?>
	        </label>
	        <label>
	        	<input type="text" name="city" placeholder="Gent" class="city"/>
	            <?php if(!empty($errors['city'])) echo '<span class="error-message error-city">' . $errors['city'] . '</span>'; ?>
	        </label>
	        <label>
	            <input type="checkbox" name="visible_map" value="1"/><span class="form-label label-cb">plaats mij op de “pret in jouw buurt”-kaart</span>
	        </label>
	        <label>
	            <input type="checkbox" name="contact_possible" value="1"/><span class="form-label label-cb">buren mogen mij contacteren</span> 
	        </label>
	    </div>
	    
	    <div class="sbmt-bg">
	        <input type="submit" name="action" value="plaats bestelling"/>
	    </div>
	</form>

	<?php
		}
	?>
</section>
<section class="mycart place-order-cart">
	<h1>Jouw bestelling</h1>
	<?php
		if(!empty($items)) {
	?>
	<form action="index.php?page=bestellen" method="post" class="cart-form">
		<table class='mycart-tbl'>
			<thead>
				<tr>
					<th class='packet-name' colspan='2'>Pretpakket</th>
					<th class='packet-quantity'>Aantal</th>
					<th class='price'>Prijs</th>
					<th class='remove-item'></th>
				</tr>
			</thead>

			<tbody>
				<?php
					$total = 10;
					foreach($items as $item) {
						$itemTotal = number_format($item['package']['price'] * $item['amount'], 2, ',', '');
						$total += $itemTotal;
				?>
				<tr class='item'>
					<td class='packet-name' colspan='2'><?php echo $item['package']['title'] ;?></td>
					<td class='packet-quantity'>
						<div class="amount">
							<a class='amount-button' href='index.php?page=bestellen&amp;action=change&amp;id=<?php echo $item['package']['id']; ?>&amp;amount=<?php echo ($item['amount'] - 1); ?>'>-</a>
							<a class='amount-button' href='index.php?page=bestellen&amp;action=change&amp;id=<?php echo $item['package']['id']; ?>&amp;amount=<?php echo ($item['amount'] + 1); ?>'>+</a>
						</div> 
						<?php echo $item['amount']; ?> 
					</td>
					<td class='price'>€ <?php echo $itemTotal ;?></td>
					<td class='remove-item'><a href="index.php?page=bestellen&amp;action=change&amp;id=<?php echo $item['package']['id'];?>&amp;amount=0">x</a></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>

		<table class="total-tbl">
			<tr class='shipment'>
					<td>verzendkosten</td>
					<td class="price">€ 10,00</td>
			</tr>
			<tr class='total'>
					<td>totaal</td>
					<td class="price">€ <?php echo number_format($total, 2, ',', '') ;?></td>
			</tr>
		</table>
	</form>
	<?php
		} else {
			echo "<p class='empty-cart'>Je winkelwagen is leeg.</p>";
		}
	?>
</section>