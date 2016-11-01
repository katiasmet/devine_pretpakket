<section class="register-sect">
	<h1>registreren</h1>
	<form method="post" class="register-form" >
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
	        <input type="submit" name="action" value="registreer mij"/>
	    </div>
	    <?php if(!empty($error)) { echo '<div class="error-message general-error">' . $error . '</div>';} ?>
	</form>
</section>