
document.addEventListener("DOMContentLoaded", () => {
    console.log('asdasd')
    const headers = document.querySelectorAll(".accordion-header");
    headers.forEach((header) => {
        header.addEventListener("click", () => {
            console.log("accordion");
            const isActive = header.classList.contains("active");

            // Если нужно закрыть все, чтобы был открыт только один:
            // headers.forEach(h => {
            //   h.classList.remove('active');
            //   h.nextElementSibling.style.maxHeight = null;
            // });

            if (!isActive) {
                header.classList.add("active");
                const body = header.nextElementSibling;
                body.style.maxHeight = body.scrollHeight + "px";
            } else {
                header.classList.remove("active");
                header.nextElementSibling.style.maxHeight = null;
            }
        });
    });
});