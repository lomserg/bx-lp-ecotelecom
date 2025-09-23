function ajaxForm(obForm, link) {
    BX.bind(obForm, 'submit', BX.proxy(function(e) {
        BX.PreventDefault(e);

        let msgBox = obForm.getElementsByClassName('error-msg')[0];
        let loading = document.getElementById('loading');
        let popup = document.getElementById('form-success-popup');
        msgBox.innerHTML = '';

        // показываем загрузку
        if (loading) loading.style.display = 'block';

        let xhr = new XMLHttpRequest();
        xhr.open('POST', link);

        xhr.onload = function() {
            if (loading) loading.style.display = 'none'; // убираем загрузку

            if (xhr.status != 200) {
                alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
            } else {
                var json = JSON.parse(xhr.responseText);
                console.log(json);

                if (!json.success) {
                    // выводим ошибки
                    let errorStr = '';
                    for (let fieldKey in json.errors) {
                        errorStr += json.errors[fieldKey] + '<br>';
                    }
                    msgBox.innerHTML = errorStr;
                } else {
                    // показываем попап
                    if (popup) popup.style.display = 'flex';

                    // сбрасываем форму
                    obForm.reset();
                }
            }
        };

        xhr.onerror = function() {
            if (loading) loading.style.display = 'none';
            alert("Запрос не удался");
        };

        xhr.send(new FormData(obForm));
    }, obForm, link));
}
// обработчики закрытия попапа
document.addEventListener("DOMContentLoaded", function() {
    let popup = document.getElementById('form-success-popup');
    if (!popup) return;

    let closeBtn = popup.querySelector('.popup-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    }

    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
});
