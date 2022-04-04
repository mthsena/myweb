(() => {
    'use strict';
    var app = () => {
        $('input[data-m=field]').mask('A', { translation: { 'A': { pattern: /[a-z_]/, recursive: true } } });
        $('input[data-m=numeric]').mask('N', { translation: { 'N': { pattern: /[0-9]/, recursive: true } } });
        $('input[data-m=alpha]').mask('A', { translation: { 'A': { pattern: /[a-zA-Z ]/, recursive: true } } });
        $('input[data-m=alpha-numeric]').mask('A', { translation: { 'A': { pattern: /[0-9a-zA-Z ]/, recursive: true } } });
        $('input[data-m=money]').mask('000.000.000.000.000,00', { reverse: true });
        $('input[data-m=cep]').mask('00000-000');
        $('input[data-m=rg]').mask('00.000.000-00');
        $('input[data-m=cpf]').mask('000.000.000-00');
        $('input[data-m=cnpj]').mask('00.000.000/0000-00');
        $('input[data-m=date]').mask('00/00/0000');
        $('input[data-m=time]').mask('00:00:00');
        $('input[data-m=date-time]').mask('00/00/0000 00:00:00');
        $('input[data-m=phone]').mask('(00) 00000-0000');
        $('body').on('keyup', 'input[data-m=uppercase]', function () {
            var value = $(this).val().toUpperCase();
            $(this).val(value);
        });
        $('body').on('keyup', 'input[data-m=lowercase]', function () {
            var value = $(this).val().toLowerCase();
            $(this).val(value);
        });
        console.log('App loaded.');
    };
    $(app);
})();
