function ajax(ajaxObj) {
    console.log(`send ajax request method: ${ajaxObj.method} to ${ajaxObj.url}`)
    let xhr = new XMLHttpRequest();
    xhr.open(ajaxObj.method, ajaxObj.url);
    xhr.onload = () => {
        console.log(`Response status: ${xhr.status}`);
        ajaxObj.success(xhr.response);
    }
    xhr.setRequestHeader('Content-Type', ajaxObj.contentType);
    console.log(`data: ${ajaxObj.data}`);
    xhr.send(ajaxObj.data);
}