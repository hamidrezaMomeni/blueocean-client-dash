window.getRndInteger = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

window.Alert = ($msg = '', $type = 'success', limit = 5000, animate = 'animate__shakeX', target = '.alert-box') => {

    const rand = getRndInteger(10000000, 99999999),
        template = `
                    <div class="alert alert-${$type} alert-dismissible animate__animated ${animate} show" role="alert" id="${rand}">
                    ${$msg}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>`;

    setTimeout(() => document.getElementById(rand).remove(), limit);

    return document.querySelector(target).insertAdjacentHTML('afterbegin', template);
};
