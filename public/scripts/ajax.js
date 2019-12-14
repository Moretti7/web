function ajax(ajaxObj) {
    console.log(`send ajax request method: ${ajaxObj.method} to ${ajaxObj.url}`)
    let xhr = new XMLHttpRequest();
    xhr.open(ajaxObj.method, ajaxObj.url);
    xhr.onload = () => {
        console.log(`Response status: ${xhr.status}`);
        console.log(`Response : ${xhr.response}`);
        ajaxObj.success(xhr.response);
    }

    console.log(`data: ${ajaxObj.data}`);
    xhr.send(ajaxObj.data);
}