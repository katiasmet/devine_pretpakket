(function(){

	var searchForm, searchInput, userForm, errorEl, reviewForm, workshopSubscribeForm, cartForm;
	var emailInputField, passwordInputField, firstnameInputField, lastnameInputField, adresInputField, postalInputField, cityInputField;

	function init() {
		searchForm = document.querySelector('.search-form');
		if(searchForm) {
			initSearchForm();
		}

		userForm = document.querySelector('.register-form');
		if(userForm) {
			userFormInput();
		}

		reviewForm = document.querySelector('.review-form');
		if(reviewForm) {
			reviewFormInput();
		}

		workshopSubscribeForm = document.querySelector('.workshop-form');
		if(workshopSubscribeForm) {
			workshopSubscribeForm.addEventListener('submit', workshopSubscribeHandler);
		}
	}

	function initSearchForm() {
		searchInput = searchForm.querySelector('.search-input');
		searchForm.addEventListener('button', doSearch);
		searchInput.addEventListener('input', doSearch);
	}

	function doSearch(event) {
		event.preventDefault();
		var req = new XMLHttpRequest();
		
		req.onload = function() {
			var main = document.createElement('main');
			main.innerHTML = req.responseText;
			var newContent = main.querySelector('.results');
			var origContent = document.querySelector('.results');
			origContent.parentNode.replaceChild(newContent, origContent);
		}

		req.open('get', searchForm.getAttribute('action') + '&search_term=' + searchInput.value , true);
		req.setRequestHeader('X_REQUESTED_WITH', 'XMLhttprequest');
		req.send();
	}

	function workshopSubscribeHandler() {
		event.preventDefault();
		var req = new XMLHttpRequest();
		req.addEventListener('load', function(e) {
	    	var main = document.createElement('main');
			main.innerHTML = req.responseText;
			var newContent = main.querySelector('.results');
			var origContent = document.querySelector('.results');
			origContent.parentNode.replaceChild(newContent, origContent);
	    });
	    req.open('post', event.currentTarget.getAttribute('action'), true);
	    req.setRequestHeader('X_REQUESTED_WITH', 'xmlhttprequest');
	    req.send(new FormData(workshopSubscribeForm));
	}

	function userFormInput() {
		emailInputField = userForm.querySelector('input[name=e_mail]');
		emailInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=e_mail]', emailInputField, 'Gelieve je e-mailadres in te vullen.', 'error-email');}
		);

		passwordInputField = userForm.querySelector('input[name=password]');
		passwordInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=password]', passwordInputField, 'Gelieve je wachtwoord in te vullen.', 'error-password');}
		);

		firstnameInputField = userForm.querySelector('input[name=first_name]');
		firstnameInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=first_name]', firstnameInputField, 'Gelieve je voornaam in te vullen.', 'error-firstname');}
		);

		lastnameInputField = userForm.querySelector('input[name=last_name]');
		lastnameInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=last_name]', lastnameInputField, 'Gelieve je familienaam in te vullen.', 'error-lastname');}
		);

		adresInputField = userForm.querySelector('input[name=adres]');
		adresInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=adres]', adresInputField, 'Gelieve je adres in te vullen.', 'error-adres');}
		);

		postalInputField = userForm.querySelector('input[name=postal_code]');
		postalInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=postal_code]', postalInputField, 'Gelieve je postcode in te vullen.', 'error-postal');}
		);

		cityInputField = userForm.querySelector('input[name=city]');
		cityInputField.addEventListener(
			'focusout', 
			function() {userFormInit('input[name=city]', cityInputField, 'Gelieve je gemeente in te vullen.', 'error-city');}
		);

		userForm.addEventListener('submit', checkErrors);
	}

	function userFormInit(inputType, parentField, errorMessage, errorClass) {
		valueInput = userForm.querySelector(inputType).value;
		checkErrors(valueInput, inputType, parentField, errorMessage, errorClass);
	}

	function reviewFormInput() {
		reviewInputField = reviewForm.querySelector('textarea[name=review]');
		reviewInputField.addEventListener(
			'focusout', 
			function() {reviewFormInit('textarea[name=review]', reviewInputField, 'Gelieve je ervaring in te vullen.', 'error-review');}
		);
	}

	function reviewFormInit(inputType, parentField, errorMessage, errorClass) {
		valueInput = reviewForm.querySelector(inputType).value;
		checkErrors(valueInput, inputType, parentField, errorMessage, errorClass);
	}

	function checkErrors(valueInput, inputType, parentField, errorMessage, errorClass) {
		errorEl = document.createElement('span');
		errorExist = document.querySelector('.' + errorClass);
		if(valueInput != '') {
			errorExist.style.display = 'none';
		} else if(valueInput == '') {
			if(!errorExist) {
				errorEl.style.display = 'block';
				errorEl.classList.add('error-message');
				errorEl.classList.add(errorClass);
				errorEl.innerText = errorMessage;
				parentField.parentNode.appendChild(errorEl, parentField);
			} 
			if(errorExist) {
				errorExist.style.display = 'block';
			}
		}
	}

	init();
}())