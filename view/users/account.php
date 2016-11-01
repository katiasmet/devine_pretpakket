<?php 
	if(empty($_SESSION['user'])) {
		echo "<p>Je moet ingelogd zijn om toegang te krijgen tot jouw account.</p>";
	} else {
?>

<section class="myprofile sect-1">
	<h1>jouw gegevens</h1>
	<div class="profile-personal-data">
		<ul>
			<li><?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']; ?></li>
			<li><?php echo $_SESSION['user']['adres']; ?></li>
			<li><?php echo $_SESSION['user']['postal_code'] . " " . $_SESSION['user']['city']; ?></li>
		</ul>
		<p><?php echo $_SESSION['user']['e_mail']; ?></p>

		<p class="neighbour-data">
		<?php 
			if($_SESSION['user']['visible_map'] == 0) {
				echo 'Onzichtbaar op de “pret in jouw buurt”-kaart.<br />';
			} else {
				echo 'Zichtbaar op de “pret in jouw buurt”-kaart.<br />';
			}
			if($_SESSION['user']['contact_possible'] == 0) {
				echo 'Buren kunnen jou niet contacteren.';
			} else {
				echo 'Buren kunnen jou contacteren.';
			}
		?>
		</p>
		
		<a class="button" href="index.php?page=wijzig">Wijzig mijn gegevens</a>
	</div>
</section>

<div class="yellow-sect">
<section  class="myprofile sect-2">
	<h1>jouw bestellingen</h1>
	<?php
		if(!empty($orders)) {
	?>
	<table class='my-profile myorders-tbl'>
		<thead>
			<tr>
				<th class='packet-name' colspan='2'>Pretpakket</th>
				<th class='packet-date'>Datum</th>
				<th class='packet-quantity'>Aantal</th>
				<th class='price'>Prijs</th>
			</tr>
		</thead>

		<tbody>
			<?php 
				foreach($orders as $order) {
					$price = $order['price'] * $order['amount'];
					$totalPrice = number_format($price, 2, ',', '');

					$datum = date("d/m/Y", strtotime($order['creation_date']));
			?>
			<tr class='item'>
				<td class='packet-name' colspan='2'><?php echo $order['title']; ?></td>
				<td class='packet-date'><?php echo $datum; ?></td>
				<td class='packet-quantity'><?php echo $order['amount']; ?></td>
				<td class='price'>€ <?php echo $totalPrice; ?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>

	<?php
		if(!empty($reviews)) {
	?>
	<h1>Jouw ervaringen</h1>
	<ul class="latest-reviews">
		<?php

			foreach($reviews as $review) {
				$datum = date("d/m/Y", strtotime($review['creation_date']));
		?>
		<li>
			<p class="review-name"><?php echo $review['title']; ?></p>
			<p class="side-info">Gepost op <?php echo $datum; ?> - 	<a href='index.php?page=mijnprofiel&amp;action=delete-review&amp;review-id=<?php echo $review['id']; ?>'>verwijder</a>
			</p>
			<q><?php echo $review['review']; ?></q>
		</li>
		<?php
			}
		?>
	</ul>
	<?php
		}
	?>


	<h1>deel jouw ervaring</h1>
	<form method="post" class="review-form" >
		<div>
	        <label class="select-form">
	            <span class="form-label">mijn pretpakket</span>

	            <select placeholder="jouw bestelde pretpakketten" name='package_id'>
	            	<?php
	            		foreach($emptyReviews as $emptyReview) {
							echo "<option value='". $emptyReview['package_id'] ."'>" . $emptyReview['title'] . "</option>";
						}
	            	?>
				</select>
	        </label>

	        <label>
	            <span class="form-label">mijn ervaring</span>
	            <textarea name="review" placeholder="schrijf hier jouw ervaring (max. 150 tekens)" rows="5" maxlength="150"></textarea>
	           	<?php if(!empty($errors['review'])) echo '<span class="error-message error-review">' . $errors['review'] . '</span>'; ?>
	        </label>
	    </div>

	    <div class="sbmt-bg">
	        <input type="submit" name="action" value="voeg mijn ervaring toe"/>
	    </div>
	</form>
	<?php
		} else {
			echo "<p>Je heb nog geen pretpakket besteld.</p>";
		}
	?>


</section>
</div>

<div class="red-sect">
<section  class="myprofile sect-3">
	<h1>jouw workshops</h1>
	<div class='my-profile myworkshops-tbl'>
		<?php
			if(!empty($workshops)) {
		?>

		<table class="tbl-hd">
			<tr>
				<td class='workshop-name' colspan='2'>Pretpakket</td>
				<td class='workshop-date'>Datum</td>
				<td class='place'>Plaats</td>
			</tr>
		</table>

		<?php 
				foreach($workshops as $workshop) {
					$datum = date("d/m/Y", strtotime($workshop['date_hr']));
					$uur = date("H", strtotime($workshop['date_hr']));
		?>

		<div class="workshop">
			<table>
				<tr>
					<td class='workshop-name' colspan='2'><?php echo $workshop['workshop_title']; ?></td>
					<td class='workshop-date'><?php echo $datum; ?> <br /> <?php echo $uur; ?>u</td>
					<td class='place'><?php echo $workshop['location']; ?></td>
				</tr>
			</table>
	
			<a class="button unsubscribe-workshop" href='index.php?page=mijnprofiel&amp;action=unsubscribe&amp;workshop-id=<?php echo $workshop['id']; ?>'>schrijf mij uit</a>
		</div>

		<?php
				}
			} else {
				echo "<p>Je bent niet ingeschreven voor een workshop.</p>";
			}
		?>

	</div>
</section>
</div>

<?php
	};
?>	