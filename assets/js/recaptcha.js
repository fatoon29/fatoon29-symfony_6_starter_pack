grecaptcha.ready(function() {
    grecaptcha.execute('', {action: 'homepage'}).then(function(token) {
        document.getElementById('recaptchaResponse').value = token
    });
});