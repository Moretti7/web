let registerButton = '.register-button';
let loginButton = '.login-button';
let submitLoggin = '.submit-login';
let logoutButton = '.logout-button';

function loadUsers() {
    ajax({
        url: "/api/users.php",
        method: "GET",
        success: response => {
            document.querySelector('.table-body').innerHTML = '';
            let users = JSON.parse(response);
            users.forEach(user => {
                document.querySelector('.table-body').innerHTML +=
                `<tr>
                    <td><a href="/userPage.php?user=${user.id}">${user.id}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                </tr>`;
            })
        }
    })
}

loadUsers();

changeNavbar();

function changeNavbar() {
    let user = JSON.parse(localStorage.getItem('user'));
    if (user != undefined) {
        document.querySelector('.user-name').innerHTML = `${user.firstName} ${user.lastName}`;
        removeAuthButtons();
        let logoutButton = '<button class="btn btn-primary logout-button">Logout</button>';
        document.querySelector('.navbar-collapse').innerHTML += logoutButton;
        initLogoutEvent();
    } else {
        let registerButton = '<button class="btn btn-primary mr-3 register-button">Register</button>';
        let loginButton = '<button class="btn btn-primary login-button">Login</button>';
        document.querySelector('.navbar-collapse').innerHTML += registerButton + loginButton;
        initLoginEvent();
        initRegisterEvent();
    }
}

function removeAuthButtons() {
    if (document.querySelector(registerButton) != undefined)
        document.querySelector(registerButton).remove();
    if (document.querySelector(loginButton) != undefined)
        document.querySelector(loginButton).remove();
}

function initRegisterEvent() {
    document.querySelector(registerButton).addEventListener('click', (target) => {
        toggleRegisterPopup();
    });
    addRegisterEventListener();
}

function initLoginEvent() {
    document.querySelector(loginButton).addEventListener('click', (target) => {
        toggleLoginPopup();
    });
}

function initLogoutEvent() {
    document.querySelector(logoutButton).addEventListener('click', (target) => {
        localStorage.removeItem('user');
        document.querySelector('.user-name').innerHTML = '';
        document.querySelector('.logout-button').remove();
        changeNavbar();
    });
}

function toggleRegisterPopup() {
    document.querySelector('.register-popup').classList.toggle('hide');
    document.querySelector('.content').classList.toggle('blur');
    document.querySelector('.register-popup').classList.toggle('show');
}

function toggleLoginPopup() {
    document.querySelector('.login-popup').classList.toggle('hide');
    document.querySelector('.content').classList.toggle('blur');
    document.querySelector('.login-popup').classList.toggle('show');
}

function addRegisterEventListener() {
    document.querySelector('.submit-register').onclick = () => {
        let form = prepareForm();
        ajax({
            url: '/api/user.php',
            method: 'POST',
            data: form,
            success: (response) => {
                console.log(response)
                toggleRegisterPopup();
                toggleLoginPopup();
                loadUsers();
            }
        })
    };
}

function prepareForm() {
    let email = document.querySelector('.register-email').value;
    let password = document.querySelector('.register-password').value;
    let name = document.querySelector('.name').value;
    let surname = document.querySelector('.surname').value;
    let avatar = document.querySelector('.avatar').files[0];
    let role = document.querySelector('.role').value;
    clearRegisterForm();
    let form = new FormData();
    form.append('email', email);
    form.append('password', password);
    form.append('name', name);
    form.append('surname', surname);
    form.append('avatar', avatar);
    form.append('role', role);
    return form;
}
function clearRegisterForm() {
    document.querySelector('.register-email').value = '';
    document.querySelector('.register-password').value = '';
    document.querySelector('.name').value = '';
    document.querySelector('.surname').value = '';
    document.querySelector('.avatar').files = null;
    document.querySelector('.role').value = '';
}

