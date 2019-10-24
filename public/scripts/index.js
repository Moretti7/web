$.ajax({
    url: "/api/users.php",
    method: "GET",
    success: response => {
        let users = JSON.parse(response);
        users.forEach(user => {
            $('.table-body').append(`
            <tr>
                <td><a href="/userPage.php?user=${user.id}">${user.id}</td>
                <td>${user.first_name}</td>;
                <td>${user.last_name}</td>;
                <td>${user.email}</td>;
                <td>${user.role}</td>;
            </tr>`)
        })
    }
})