function showLoader() {
    document.getElementById("loader").classList.remove("d-none");
}

function hideLoader() {
    document.getElementById("loader").classList.add("d-none");
}

function successToast(message) {
    Toastify({
        text: message,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        style: {
            background: "green",
        },
    }).showToast();
}

function errorToast(message) {
    Toastify({
        text: message,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        style: {
            background: "red",
        },
    }).showToast();
}
