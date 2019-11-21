let registerButton = '.register-button';
let loginButton = '.login-button';
let submitLoggin = '.submit-login';
let logoutButton = '.logout-button';



function sort(field) {
    ajax({
        url: `/api/users.php?sort=${field}`,
        method: 'GET',
        success: response => {
            document.querySelector('.table-body').innerHTML = '';
            let users = JSON.parse(response);
            users.forEach(user => {
                document.querySelector('.table-body').innerHTML +=
                `<tr>
                    <td class="user-id">${user.id}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                </tr>`;
                initId();
            })
        }
    })
}

function search(field, input) {
    ifPresent(input, () => console.log(input.value))
    ajax({
        url: `/api/users.php?search=${field}&value=${input.value}`,
        method: 'GET',
        success: response => {
            document.querySelector('.table-body').innerHTML = '';
            let users = JSON.parse(response);
            users.forEach(user => {
                document.querySelector('.table-body').innerHTML +=
                `<tr>
                    <td class="user-id">${user.id}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                </tr>`;
                initId();
            })
        }
    })
}

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
                    <td class="user-id">${user.id}</td>
                    <td>${user.first_name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                </tr>`;
                initId();
            })
        }
    })
}


function initId() {
    document.querySelectorAll('.user-id').forEach(id => {
        id.addEventListener('click', (event) => {
            let id = event.target.innerHTML;
            ajax({
                method: 'GET',
                url: `/api/user.php?id=${id}`,
                success: (response) => {
                    let user = JSON.parse(response);
                    let userPopup = '.user-popup';

                    let logginedUser = JSON.parse(localStorage.getItem('user'));
                    showPasswordFiled(logginedUser, id);
                    showRoleField(logginedUser);
                    toggleUserData(userPopup);
                    setUserData(user);
                    showSaveButton(logginedUser, id);
                    showPhotoElement(logginedUser, id);
                    showDeleteButton(logginedUser, id);
                }
            })
        })
    });
}

loadUsers();
changeNavbar();

function showDeleteButton(logginedUser, userId) {
    if (logginedUser.role == 'admin') {
        if (document.querySelector('.user-delete-button').classList.contains('hide')) {
            document.querySelector('.user-delete-button').classList.remove('hide');
        }
    }
    else {
        if (!document.querySelector('.user-delete-button').classList.contains('hide')) {
            console.log('HIDED BUTTON')
            document.querySelector('.user-delete-button').classList.add('hide');
        }
    }

    document.querySelector('.user-delete-button').onclick = () => {
        ajax({
            url: `/api/user.php`,
            method: 'DELETE',
            data: `id=${userId}`,
            contentType: 'application/x-www-form-urlencoded',
            success: (response) => {
                loadUsers();
                toggleUserData('.user-popup');
            }
        })
    }
}

function showSaveButton(logginedUser, id) {
    if (logginedUser.role != 'admin' && logginedUser.id != id) {
        if (!document.querySelector('.user-save-button').classList.contains('hide')) {
            document.querySelector('.user-save-button').classList.add('hide');
        }
    }
    else {
        if (document.querySelector('.user-save-button').classList.contains('hide')) {
            document.querySelector('.user-save-button').classList.remove('hide');
        }
    }

    document.querySelector('.user-save-button').onclick = () => {
        let data = prepareDataForUpdate(id);
        
        ajax({
            url: `/api/user.php`,
            method: 'PUT',
            data: data,
            contentType: 'application/x-www-form-urlencoded',
            success: (response) => {
                loadUsers();
                ajax({
                    method: 'GET',
                    url: `/api/user.php?id=${id}`,
                    success: (response) => {
                        let user = JSON.parse(response);
                        localStorage.setItem('user', response);
                        document.querySelector('.user-name').innerHTML = `${user.firstName} ${user.lastName}`;
                    }
                })
                toggleUserData('.user-popup');
            }
        })
    }
}

function prepareDataForUpdate(id) {
    let email = document.querySelector('.user-email').value;
    let password = document.querySelector('.user-password').value;
    let name = document.querySelector('.first-name').value;
    let surname = document.querySelector('.last-name').value;
    let role = document.querySelector('.user-role').value;

    clearRegisterForm();
    
    let data = `id=${id}&`;

    ifPresent(email,    () => data += `email=${email}&`);
    ifPresent(password, () => data += `password=${password}&`);
    ifPresent(name,     () => data += `name=${name}&`);
    ifPresent(surname,  () => data += `surname=${surname}&`);
    ifPresent(role,     () => data += `role=${role}`);

    // form.append('email', email);
    // form.append('password', password);
    // form.append('name', name);
    // form.append('surname', surname);
    // form.append('avatar', avatar);
    // form.append('role', role);
    return data;
}

function ifPresent(element, func) {
    if (element !== undefined && element != '') {
        func();
    }
}

function showPhotoElement(logginedUser, id) {
    if (logginedUser.role != 'admin' && logginedUser.id != id) {
        if (!document.querySelector('.photo-element').classList.contains('hide')) {
            document.querySelector('.photo-element').classList.add('hide');
        }
    }
    else {
        if (document.querySelector('.photo-element').classList.contains('hide')) {
            document.querySelector('.photo-element').remove('hide');
        }
    }
}

function setUserData(user) {
    let email = document.querySelector('.user-email');
    let firstName = document.querySelector('.first-name');
    let lastName = document.querySelector('.last-name');
    let avatar = document.querySelector('.user-avatar');
    email.value = `${user.email}`;
    firstName.value = `${user.firstName}`;
    lastName.value = `${user.lastName}`;
    avatar.src = `${user.photo}`;
}

function toggleUserData(userPopup) {
    document.querySelector(userPopup).classList.toggle('hide');
    document.querySelector('.content').classList.toggle('blur');
}

function showRoleField(logginedUser) {
    if (logginedUser.role == 'admin') {
        if (document.querySelector('.role-element').classList.contains('hide')) {
            document.querySelector('.role-element').classList.remove('hide');
        }
    }
    else {
        if (!document.querySelector('.role-element').classList.contains('hide')) {
            document.querySelector('.role-element').classList.add('hide');
        }
    }
}

function showPasswordFiled(logginedUser, id) {
    if (logginedUser.role != 'admin' && logginedUser.id != id) {
        if (!document.querySelector('.user-password').classList.contains('hide')) {
            document.querySelector('.user-password').classList.add('hide');
            document.querySelector('.password-element').classList.add('hide');
        }
    }
    else if (document.querySelector('.user-password').classList.contains('hide')) {
        document.querySelector('.user-password').classList.remove('hide');
        document.querySelector('.password-element').classList.remove('hide');
    }
}

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

