function validateEmptyFields(...ids) {
    let emptyFields = false;

    ids.forEach((id) => {
        const element = document.getElementById(id);
        if (!element.value.trim()) {
            element.style.border = "1px solid red";
            emptyFields = true;
        } else {
            element.style.border = ""; // Remove red border if not empty
        }
    });

    if (emptyFields) {
        Toast.fire({
            icon: "error",
            title: "Por favor, preencha todos os campos obrigatórios!",
        });
        return false;
    }
    return true;
}

function validateEmptySelect(...ids) {
    let emptyFields = false;

    ids.forEach((id) => {
        const element = document.getElementById(id);
        if (!element.value.trim() || element.value.trim() == 0) {
            element.style.border = "1px solid red";
            emptyFields = true;
        } else {
            element.style.border = ""; // Remove red border if not empty
        }
    });

    if (emptyFields) {
        Toast.fire({
            icon: "error",
            title: "Por favor, preencha todos os campos obrigatórios!",
        });
        return false;
    }
    return true;
}

function arrayColumn(arr, columnKey) {
    return arr.map(function (obj) {
        return obj[columnKey];
    });
}

Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});
