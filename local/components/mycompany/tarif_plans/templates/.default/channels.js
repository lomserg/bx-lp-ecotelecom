

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("channelsModal");
    const channelsList = document.getElementById("channelsList");
    const closeBtn = document.querySelector(".modal-close-bitix");

    document.querySelectorAll(".tarif__channels").forEach(item => {
        item.addEventListener("click", () => {
            console.log('click');
            const packageId = item.dataset.package;
            if (!packageId) return;

            fetch(`/local/channels/${packageId}.json`)
                .then(res => res.json())
                .then(channels => {
                    channelsList.innerHTML = "";
                    channels.forEach(ch => {
                        const li = document.createElement("li");
                        li.textContent = ch;
                        channelsList.appendChild(li);
                    });
                    console.log(channelsList);
                    modal.style.display = "flex";
                    document.body.classList.add("modal-open"); // блокируем скролл фона
                })
                .catch(err => {
                    console.error("Ошибка загрузки каналов", err);
                    channelsList.innerHTML = "<li>Не удалось загрузить список каналов</li>";
                    modal.style.display = "flex";
                    document.body.classList.add("modal-open"); // блокируем скролл фона
                });
        }); // <-- закрыта функция addEventListener
    }); // <-- закрыт forEach

    const closeModal = () => {
        modal.style.display = "none";
        document.body.classList.remove("modal-open"); // разблокируем скролл
    };

    closeBtn.addEventListener("click", closeModal);
    window.addEventListener("click", e => {
        if (e.target === modal) closeModal();
    });
});

//
// fetch("https://fe.smotreshka.tv/channels")
//     .then(res => res.json())
//     .then(data => {
//         const tableData = data.channels.map(item => ({
//             id: item.id,
//             title: item.info?.metaInfo?.title || "Без названия",
//             description: item.info?.metaInfo?.description || "",
//             thumb: item.info?.mediaInfo?.thumbnails?.[0]?.url || "" // безопасная проверка
//         }));
//         console.table(tableData);
//     })
//     .catch(err => console.error(err));
//
// const thumb = "http://smotreshka.server-img.lfstrm.tv/image/aHR0cDovL2ltZy5iNjEyLnRpZ2h0dmlkZW8uY29tL2NoYW5uZWxzLzJ4Mn9uZXcucG5n";
// openModal(`<img src="${thumb}" alt="2x2">`);