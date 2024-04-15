document.getElementById('loginForm').addEventListener('submit', function(event) {
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');
  
    if (!isValidEmail(emailInput.value)) {
      emailInput.classList.add('is-invalid');
      emailError.textContent = 'Correo electrónico inválido';
      event.preventDefault();
    } else {
      emailInput.classList.remove('is-invalid');
      emailError.textContent = '';
    }
  });
  
  function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
  