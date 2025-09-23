function validateForm(event, form) {
    var isValid = true;

    var name = form.querySelector("[data-field='NAME']");
    var phone = form.querySelector("[data-field='PHONE']");
    var address = form.querySelector("[data-field='ADDRESS']");

    [name, phone, address].forEach(function(field) {
        if (field) field.classList.remove("error-border");
    });

    if (!name || name.value.trim() === "") {
        if (name) name.classList.add("error-border");
        isValid = false;
    }

    if (!phone || phone.value.trim().length < 10 || phone.value.trim().length > 18) {
        if (phone) phone.classList.add("error-border");
        isValid = false;
    }

    if (!address || address.value.trim() === "") {
        if (address) address.classList.add("error-border");
        isValid = false;
    }

    return isValid;
}