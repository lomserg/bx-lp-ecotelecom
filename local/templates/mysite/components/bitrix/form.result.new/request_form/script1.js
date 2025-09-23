function ajaxForm(obForm, link) {
    BX.bind(obForm, 'submit', BX.proxy(function(e) {
        BX.PreventDefault(e);
        let msgBox = obForm.getElementsByClassName('error-msg')[0];
        msgBox.innerHTML = '';

        let xhr = new XMLHttpRequest();
        xhr.open('POST', link);

        xhr.onload = function() {
            if (xhr.status != 200) {
                alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
            } else {
                var json = JSON.parse(xhr.responseText);
console.log(json)
                if (!json.success) {
                    // Выводим ошибки
                    let errorStr = '';
                    for (let fieldKey in json.errors) {
                        errorStr += json.errors[fieldKey] + '<br>';
                    }
                    msgBox.innerHTML = errorStr;
                } else {
                    // Скрываем форму и показываем сообщение об успехе
                    obForm.innerHTML = '<div class="success-msg">Спасибо, ваша заявка принята!</div>';
                }
            }
        };

        xhr.onerror = function() {
            alert("Запрос не удался");
        };

        xhr.send(new FormData(obForm));
    }, obForm, link));
}