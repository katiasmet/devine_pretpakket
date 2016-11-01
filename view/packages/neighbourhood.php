<section>
	<h1>pretpakketten in jouw buurt</h1>
	<div class="neighbour-info">
		<p>Waarom deelnemen aan pretpakket in jouw buurt?</p>
		<ul class="custom-list">
			<li>ontdek welke buren een pretpakket hebben besteld</li>
			<li>lees hun ervaringen of voeg je eigen ervaring toe</li>
			<li>contacteer je buren, organiseer een buurtfeest en test <br /> <a href="index.php?page=pakketten">alle attracties van Pretpakket</a> uit</li>
		</ul>
	</div>
	<input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas"></div>
</section>

<div class="yellow-sect">
<section>
	<h1>Recentste ervaringen</h1>
	<ul class="latest-reviews">
		<?php
			foreach($reviews as $review) {
				$datum = date("d/m/Y", strtotime($review['creation_date']));
		?>
		<li>
			<p class="review-name"><?php echo $review['first_name']; ?> <?php echo $review['last_name']; ?></p>
			<p class="side-info">Gepost op <?php echo $datum; ?><br />
				Besteld pakket: <?php echo $review['title']; ?>
			</p>
			<q><?php echo $review['review']; ?></q>
		</li>
		<?php
			}
		?>
	</ul>
</section>
</div>

<div class="red-sect">
<section>
	<?php
		if(!empty($userReviews)) {
	?>
	<h1>Jouw ervaringen</h1>
	<ul class="latest-reviews">
		<?php
			foreach($userReviews as $userReview) {
				$datum = date("d/m/Y", strtotime($userReview['creation_date']));
		?>
		<li>
			<p class="review-name"><?php echo $userReview['title']; ?></p>
			<p class="side-info">Gepost op <?php echo $datum; ?> - <a href='index.php?page=pretinjouwbuurt&amp;action=delete-review&amp;review-id=<?php echo $userReview['id']; ?>'>verwijder</a>
			</p>
			<q><?php echo $userReview['review']; ?></q>
		</li>
		<?php
			}
		?>
	</ul>
	<?php
		}
	?>


	<h1>deel jouw ervaring</h1>
	<?php
		if(!empty($_SESSION['user'])) {
	?>
	<form method="post" class="review-form" >
		<div>
	        <label class="select-form">
	            <span class="form-label">mijn pretpakket</span>
	            <select placeholder="jouw bestelde pretpakketten" name='package_id'>
	            	<?php
	            		foreach($orders as $order) {
	            			echo "<option value='". $order['ordered_package_id'] ."'>" . $order['title'] . "</option>";
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
			echo '<p class="user-review">Je moet aangemeld zijn om een ervaring te delen.</p>';
		}
	?>
</section>
</div>