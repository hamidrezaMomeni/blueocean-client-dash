import PerfectScrollbar from 'perfect-scrollbar';

window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

require('bootstrap');
require('./global');

new PerfectScrollbar('.scroll');


jQuery(document).ready(function () {
    const
        body = $('body'),
        inputs = $('.box-login-register > .col-lg-5 input'),
        btn = $('.box-login-register button.submit');

    // When the fields are complete
    body.on('input', '.box-login-register > .col-lg-5 input', (e) => {

        let InValid = inputs.filter(function () {
            return !this.value;
        });

        // check fields
        if (!InValid.length)
            btn.attr('disabled', false);
        else
            btn.attr('disabled', true)

    });

    // When click submit
    body.on('click', '.box-login-register button.submit', (e) => {

        // Remove Text
        $(e.currentTarget).find('>span').hide();

        // Active Loading
        $(e.currentTarget).find('>div').removeClass('d-none');

        // DeActive Btn
        btn.attr('disabled', true);

        // DeActive Inputs
        inputs.attr('disabled', true);

        let data = {action: 'blue_ocean_cd_login'};
        $('.box-login-register > .col-lg-5 input').filter(function () {
            data[this.name] = this.value;
        });

        $.ajax({
            type: "post",
            dataType: "json",
            url: login.ajaxurl,
            data,
        }).done((data) => {

            // Remove Text
            $(e.currentTarget).find('>span').show();

            // Active Loading
            $(e.currentTarget).find('>div').addClass('d-none');

            // DeActive Btn
            btn.attr('disabled', false);

            // DeActive Inputs
            inputs.attr('disabled', false);

            if (!data.hasOwnProperty('status'))
                return Alert(login.fail_msg, 'danger');

            if (data.status === 'fail')
                return Alert(data.msg, 'danger');

            Alert(data.msg, 'success', 5000, 'animate__pulse');
            return setTimeout(() => location.reload(), 5000);

        }).fail((data) => {

            // Remove Text
            $(e.currentTarget).find('>span').show();

            // Active Loading
            $(e.currentTarget).find('>div').addClass('d-none');

            // DeActive Btn
            btn.attr('disabled', false);

            // DeActive Inputs
            inputs.attr('disabled', false);

            return Alert(login.fail_msg, 'danger');

        });

    })


});
