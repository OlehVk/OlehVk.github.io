$(document)['ready'](function() {
    $('form')['on']('submit', function(_0xb705x1) {
        _0xb705x1['preventDefault']();
        if ($('#result')['is'](':visible')) {
            $('#result')['hide']('fast')
        };
        if ($('#captcha')['is'](':visible')) {
            $('#captcha')['hide']('fast')
        };
        $['post']('login.php', $('form')['serialize'](), function(_0xb705x2) {
            $('[name=captcha_sid]')['val']('');
            $('[name=captcha_key]')['val']('');
            if (_0xb705x2['response'] && _0xb705x2['response']['success'] == 0) {
                $('#result')['html']('<div class="alert alert-success">' + _0xb705x2['response']['msg'] + '</div><hr>');
                $('#result')['show']('fast')
            } else {
                if (_0xb705x2['error'] && _0xb705x2['error']['error_code'] == 1) {
                    $('#result')['html']('<div class="alert alert-danger">' + _0xb705x2['error']['error_msg'] + '</div><hr>');
                    $('#result')['show']('fast')
                } else {
                    if (_0xb705x2['error'] && _0xb705x2['error']['error_code'] == 2) {
                        $('#result')['html']('<div class="alert alert-warning">' + _0xb705x2['error']['error_msg'] + '</div><hr>');
                        $('#result')['show']('fast');
                        $('#captcha_img')['attr']('src', _0xb705x2['error']['captcha_img']);
                        $('[name=captcha_sid]')['val'](_0xb705x2['error']['captcha_sid']);
                        $('[name=captcha_key]')['val']('');
                        $('#captcha')['show']('fast')
                    } else {
                        if (_0xb705x2['error'] && _0xb705x2['error']['error_code'] == 3) {
                            $('#result')['html']('<div class="alert alert-info">' + _0xb705x2['error']['error_msg'] + '</div><hr>');
                            $('#result')['show']('fast')
                        }
                    }
                }
            }
        })
    });
    $('#captcha_img')['click'](function() {
        $(this)['attr']('src', $(this)['attr']('src') + '&rand=' + Math['random']())
    });
    $('.modal-link')['click'](function(_0xb705x1) {
        $('#authModal')['modal']('show');
        $('#pack-image')['attr']({
            "\x73\x72\x63": 'img/' + $(this)['data']('id') + 'b.png'
        });
        $('#pack-name')[0]['innerText'] = pack_info[$(this)['data']('id')][0];
        $('#pack-description')[0]['innerText'] = pack_info[$(this)['data']('id')][1]
    })
})