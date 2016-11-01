<?php 
	if(empty($_SESSION['user'])) {
		echo "<p>Je moet ingelogd zijn om toegang te krijgen tot jouw account.</p>";
	} else {
?>

<section class="register-sect">
	<h1>wijzig gegevens</h1>
	<form method="post" class="register-form" >
		<div>
	        <label>
	            <span class="form-label">e-mail</span>
	            <input type="email" name="e_mail" value="<?php echo $_SESSION['user']['e_mail']; ?>"/>
	            <?php if(!empty($errors['e_mail'])) echo '<span class="error-message">' . $errors['e_mail'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">wachtwoord</span>
	            <input type="password" name="password" placeholder="kies een wachtwoord"/>
	            <?php if(!empty($errors['password'])) echo '<span class="error-message">' . $errors['password'] . '</span>'; ?>  
	        </label>
	        <label>
	        	<input type="password" name="confirm_password" placeholder="herhaal wachtwoord"/>
	            <?php if(!empty($errors['confirm_password'])) echo '<span class="error-message">' . $errors['confirm_password'] . '</span>'; ?>
	        </label>
	    </div>

		<div class="personal-data">
			<h2>verzendgegevens</h2>
	        <label>
	            <span class="form-label">voornaam</span>
	            <input type="text" name="first_name" value="<?php echo $_SESSION['user']['first_name']; ?>"/>
	            <?php if(!empty($errors['first_name'])) echo '<span class="error-message">' . $errors['first_name'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">familienaam</span>
	            <input type="text" name="last_name" value="<?php echo $_SESSION['user']['last_name']; ?>"/>
	            <?php if(!empty($errors['last_name'])) echo '<span class="error-message">' . $errors['last_name'] . '</span>'; ?>
	        </label>

	        <label>
	            <span class="form-label">adres</span>
	            <input type="text" name="adres" value="<?php echo $_SESSION['user']['adres']; ?>"/>
	            <?php if(!empty($errors['adres'])) echo '<span class="error-message">' . $errors['adres'] . '</span>'; ?>
	        </label>
	        <label>
	        	<span class="form-label">postcode en gemeente</span>
	            <input type="text" name="postal_code" value="<?php echo $_SESSION['user']['postal_code']; ?>" class="postal"/>
	            <?php if(!empty($errors['postal_code'])) echo '<span class="error-message">' . $errors['postal_code'] . '</span>'; ?>
	        </label>
	        <label>
	        	<input type="text" name="city" value="<?php echo $_SESSION['user']['city']; ?>" class="city"/>
	            <?php if(!empty($errors['city'])) echo '<span class="error-message">' . $errors['city'] . '</span>'; ?>
	        </label>
	        <label>
	        	<?php 
					if($_SESSION['user']['visible_map'] == 0) {
						echo '<input type="checkbox" name="visible_map" value="1"/><span class="form-label label-cb">plaats mij op de “pret in jouw buurt”-kaart</span>';
					} else {
						echo '<input type="checkbox" name="visible_map" value="1" checked/><span class="form-label label-cb">plaats mij op de “pret in jouw buurt”-kaart</span>';
					}
				?>
	        </label>
	        <label>
	        	<?php
	        		if($_SESSION['user']['contact_possible'] == 0) {
						echo '<input type="checkbox" name="contact_possible" value="1"/><span class="form-label label-cb">buren mogen mij contacteren</span>';
					} else {
						echo '<input type="checkbox" name="contact_possible" value="1" checked/><span class="form-label label-cb">buren mogen mij contacteren</span>';
					}
	        	?>
	        </label>
	    </div>
	    
	    <div class="sbmt-bg">
	        <input type="submit" name="action" value="wijzig mijn gegevens"/>
	    </div>
	    <?php if(!empty($error)) { echo '<div class="error-message general-error">' . $error . '</div>';} ?>
	</form>
</section>
<?php
	};
?>	