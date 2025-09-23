let channelsLine = false;

const initChannelsPopup = () => {
	setTimeout(() => { 
		channelsLine = document.querySelectorAll('.tv__channels-line');
		chSetClick();
	}, 1000);
}

const chSetClick = () => {
	if(channelsLine)
	channelsLine.forEach((el) => {
		el.addEventListener('click', (e) => {
			e.preventDefault();
			$.ajax({
            url: '/get_ajax_connect.php',
            type: "POST",
            data: {
                TYPE: 'tarif_channels',
                ID: el.dataset.id,
            },
            success: function (data) {
               	document.querySelector('.js-popup_channels .tariffs__channels-list').innerHTML = data;
               	document.querySelector('.js-popup_channels').classList.add('tariffs__channels_is-active');

                document.querySelectorAll('.js-popup_channels .tariffs__channels-column .tariffs__channels-item').forEach((item, index) => {
                    setTimeout(function () {
                        item.classList.add('tariffs__channels-item_is-active');
                    }, 30 * index);
                });
            }
        });
		})
	});
}

let closeBtnJsPopup = document.querySelector('.js-popup_channels .tariffs__channels-close');
if(closeBtnJsPopup)
	closeBtnJsPopup.addEventListener('click', (e) => {
		let popup = document.querySelector('.js-popup_channels');
		if(popup) popup.classList.remove('tariffs__channels_is-active');
	});

let btnFilter = document.querySelectorAll('.js-filter-button');
if(btnFilter)
	btnFilter.forEach((btn) => {
		btn.addEventListener('click', (e) => {
			initChannelsPopup();
		});
	});

initChannelsPopup();