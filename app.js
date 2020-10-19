const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.nav-menu');

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
})

//Modal items
const modal = document.getElementById('email-signup-modal');
const loginModal = document.getElementById('email-login-modal');
const detector = document.querySelector('.detector');

if(detector.classList.contains('main-btn')){
    const openBtn = document.querySelector('.main-btn');
    const closeBtn = document.querySelector('.close-btn');
    const loginCloseBtn = document.querySelector('.login-close-btn');

    //Click events
    openBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    loginCloseBtn.addEventListener('click', () => {
        loginModal.style.display = 'none';
    });

}

const loginLinkBtn = document.getElementById('login-link-btn');
loginLinkBtn.addEventListener('click', function () {
    modal.style.display = 'none';
    loginModal.style.display = 'block';
});

window.addEventListener('click', (e) => {
    if(e.target === modal) {
        modal.style.display = 'none';
    } else if(e.target == loginModal) {
        loginModal.style.display = 'none';
    }
});

//form validation
const loginForm = document.getElementById('login-form');
const form = document.getElementById('form');
const name = document.getElementById('name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordConfirm = document.getElementById('password-confirm');
const loginEmail = document.getElementById('login-email');
const loginPassword = document.getElementById('login-password');

//Error detector
errorBuffer = {'username': false, 'email': false, 'password': false, 'loginEmail': false, 'loginPassword': false};

//show error message
function showError(input, message) {
    errorBuffer[input.name] = true;
    const formValidation = input.parentElement;
    formValidation.className = 'form-validation error';

    const errorMessage = formValidation.querySelector('p');
    errorMessage.innerText = message;
}

//Show valid message
function showValid(input) {
    errorBuffer[input.name] = false;
    const formValidation = input.parentElement;
    formValidation.className = 'form-validation valid'; 
}

//Check required fields
function checkRequired(inputArr) {
    inputArr.forEach(function(input) {
        if(input.value.trim() === '') {
            showError(input, `${getFieldName(input)} is required`);
        } else {
            showValid(input);
        }
    });
}

//Check input length
function checkLength(input, min, max) {
    if(input.value.length < min) {
        showError(input, `${getFieldName(input)} must be at least ${min} characters`);
    } else if(input.value.length > max) {
        showError(input, `${getFieldName(input)} must be less than ${max} characters`);
    } else {
        showValid(input);
    }
}

//Check passwords match
function passwordMatch(input1, input2) {
    if(input1.value !== input2.value) {
        showError(input2, 'Passwords do not match');
    }
}

//Get fieldname
function getFieldName(input) {
    return input.name.charAt(0).toUpperCase() + input.name.slice(1);
}

//Event Listners
form.addEventListener('submit', (e) => {
    checkRequired([name, email, password, passwordConfirm]);
    checkLength(name, 3, 30);
    checkLength(password, 8, 25);
    checkLength(passwordConfirm, 8, 25);
    passwordMatch(password, passwordConfirm);
    if(!errorBuffer['username'] && !errorBuffer['password'] && !errorBuffer['email']) {
        $.ajax({
            method: 'get',
            url: 'validation.php',
            data: {
                'email': email.value,
            },
            async: false,
            dataType: 'json',
            encode: true,
        }).done(function (data) {
            if(data.status) {
                showValid(email);
            } else {
                showError(email, 'There is already an account created for this email');
            }
        });
    }
    if(errorBuffer['username'] || errorBuffer['password'] || errorBuffer['email']) {
        e.preventDefault();
    }
});

loginForm.addEventListener('submit', (e) => {
    $.ajax({
        method: 'get',
        url: 'loginValidation.php',
        data: {
            'loginEmail': loginEmail.value,
            'loginPassword': loginPassword.value,
        },
        async: false,
        dataType: 'json',
        encode: true,
    }).done(function (data) {
        if(data.status) {
            showValid(loginEmail);
            showValid(loginPassword)
        } else {
            showError(loginEmail, 'email is wrong or');
            showError(loginPassword, 'password deosn\'t match');
        }
    });
    if(errorBuffer['loginEmail'] || errorBuffer['loginPassword']) {
        e.preventDefault();
    }
});


//profile links
if(detector.classList.contains('nav-container')){
    const optionArrow = document.querySelector('.dropdown-arrow');
    const profileLinkBtn = document.querySelector('.profile-links-btn');
    const dropDownMenu = document.querySelector('.nav-dropdown-menu');
    optionArrow.addEventListener('click', function () {
        optionArrow.classList.toggle('active');
        profileLinkBtn.classList.toggle('active');
        dropDownMenu.classList.toggle('active');
    });
}
