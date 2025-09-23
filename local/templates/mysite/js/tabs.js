
console.log('test tab')

document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab_btn");
    const cards = document.querySelectorAll(".tarif-item");

    console.log("tabs.js работает ✅");

    function filterCards(category) {
        cards.forEach(card => {
            if (card.getAttribute("data-category") === category) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                tab.classList.add("active");

                const category = tab.getAttribute("data-category");

                cards.forEach(card => {
                    if (card.getAttribute("data-category") === category) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    }

    // По умолчанию показываем интернет+тв
    filterCards("internet-tv");
});
