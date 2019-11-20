function ajax(ajaxObj) {
    console.log(`send ajax request method: ${ajaxObj.method} to ${ajaxObj.url}`)
    let xhr = new XMLHttpRequest();
    xhr.open(ajaxObj.method, ajaxObj.url);
    xhr.onload = () => {
        console.log(`Response status: ${xhr.status}`);
        console.log(`Response : ${xhr.response}`);
        ajaxObj.success(xhr.response);
    }

    if (ajaxObj.method == 'DELETE') {
        xhr.setRequestHeader('Content-Type', ajaxObj.contentType);
    }   

    console.log(`data: ${ajaxObj.data}`);
    xhr.send(ajaxObj.data);
}