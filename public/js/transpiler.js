$(function () {
    $('#btnTranspile').on('click', function () {
        const code = $('#inputCode').val().trim();
        const sourceLang = $('#sourceLang').val();
        const targetLang = $('#targetLang').val();
        const $btn = $(this);
        const $spinner = $('#spinner');
        const $result = $('#result');
        const $title = $('.result-title');

        if (!code) {
            alert('Please paste a code snippet first.');
            return;
        }

        $btn.prop('disabled', true).contents().first()[0].textContent = 'Transpiling… ';
        $spinner.show();
        $result.text('');
        $title.hide();

        $.ajax({
            url: '/api/openai-response',
            type: 'GET',
            data: {
                type: 'transpile',
                code: code,
                sourceLang: sourceLang,
                targetLang: targetLang
            },
            success: function (res) {
                if (res && res.result) {
                    const match = res.result.match(/```(\w+)?\s*([\s\S]*?)\s*```/);
                    let lang, code;

                    if (match) {
                        lang = match[1] || '';
                        code = match[2];
                    } else {
                        lang = '';
                        code = res.result;
                    }

                    const codeElem = $('<code>')
                        .addClass(lang ? 'language-' + lang : '')
                        .text(code.trim());

                    $('#result').empty().append(codeElem);
                    hljs.highlightElement(codeElem[0]);
                    $('.result-title').show();
                } else {
                    $('#result').text('No output returned.');
                }
            },
            error: function (xhr, status, err) {
                $result.text('Error: ' + err);
            },
            complete: function () {
                $btn.prop('disabled', false).contents().first()[0].textContent = 'Transpile code ';
                $spinner.hide();
            }
        });
    });
});
