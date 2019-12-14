document.querySelector(submitLoggin).addEventListener('click', (target) => {
    let email = document.querySelector('.email-login').value;
    let password = document.querySelector('.password-login').value;

    document.querySelector('.email-login').value = '';
    document.querySelector('.password-login').value = '';
    console.log("LOGINING THE USER");
    ajax({
        url: `/api/user?email=${email}&password=${password}`,
        method: 'GET',
        success: (response) => {
            let user = JSON.parse(response);
            localStorage.setItem('user', response);
            console.log(user);
            changeNavbar();
            toggleLoginPopup();
        }
    })
});