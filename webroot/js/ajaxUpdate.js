$(document).ready(function() {
    $('.validationUpdate').click(function() {
        $.post(
            'user/updateInfos',
            {
                'email': $('#email').val(),
                'nom': $('#nom').val(),
                'prenom': $('#prenom').val()
            },
            function (data) {
                let infos = data.split('|');
                $.each(infos, function(key, value) {
                    if(value !== '') {
                        M.toast({html: value, classes: 'rounded'});
                    }
                });
            },
            'text'
        );
    });
    $('.passwordUpdate').click(function() {
        $.post(
            'user/updatePassword',
            {
                'oldPwd': $('#oldPwd').val(),
                'newPwd': $('#pwd').val()
            },
            function (data) {
                    M.toast({html: data, classes: 'rounded'});
            },
            'text'
        );
    });
    $('.addFilmBtn').click(function() {
        $.post(
            'http://localhost/PiePHP/film/addValidation',
            {
                'nom': $('#nom').val(),
                'duree': $('#duree').val(),
                'genre': $('#genre').val(),
                'resume': $('#resume').val()
            },
            function (data) {
                M.toast({html: data, classes: 'rounded'});
            },
            'text'
        )
    });
});