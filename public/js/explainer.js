$(function () {
    $('#btnExplain').on('click', function () {
        const code = $('#inputCode').val().trim();
        const $btn = $(this);
        const $spinner = $('#spinner');
        const $result = $('#result');
        const $resultSection = $('.result-section');

        if (!code) {
            alert('Please paste a code snippet first.');
            return;
        }

        $btn.prop('disabled', true).contents().first()[0].textContent = 'Explaining... ';
        $spinner.show();
        $result.html('');
        $resultSection.hide();

        $.ajax({
            url: '/api/openai-response',
            type: 'GET',
            data: {
                type: 'explain',
                code: code
            },
            success: function (res) {
                if (res && res.result) {
                    // Format the explanation with proper HTML structure
                    let formattedExplanation = res.result;
                    
                    // Convert markdown-style headers to HTML
                    formattedExplanation = formattedExplanation.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                    formattedExplanation = formattedExplanation.replace(/^(\d+\.\s+\*\*.*?\*\*)/gm, '<h4>$1</h4>');
                    
                    // Convert numbered lists
                    formattedExplanation = formattedExplanation.replace(/^(\d+\.\s+)(.*)$/gm, '<li>$2</li>');
                    formattedExplanation = formattedExplanation.replace(/(<li>.*<\/li>)/s, '<ul>$1</ul>');
                    
                    // Convert bullet points
                    formattedExplanation = formattedExplanation.replace(/^[-•]\s+(.*)$/gm, '<li>$1</li>');
                    
                    // Convert inline code
                    formattedExplanation = formattedExplanation.replace(/`([^`]+)`/g, '<code>$1</code>');
                    
                    // Convert line breaks to paragraphs
                    formattedExplanation = formattedExplanation.replace(/\n\n/g, '</p><p>');
                    formattedExplanation = formattedExplanation.replace(/^(.+)$/gm, '<p>$1</p>');
                    
                    // Clean up empty paragraphs
                    formattedExplanation = formattedExplanation.replace(/<p><\/p>/g, '');
                    formattedExplanation = formattedExplanation.replace(/<p>(<h4>.*?<\/h4>)<\/p>/g, '$1');
                    formattedExplanation = formattedExplanation.replace(/<p>(<ul>.*?<\/ul>)<\/p>/g, '$1');
                    
                    $('#result').html(formattedExplanation);
                    $resultSection.show();
                } else {
                    $('#result').html('<p>No explanation returned. Please try again.</p>');
                    $resultSection.show();
                }
            },
            error: function (xhr, status, err) {
                $result.html('<p>Error: ' + err + '</p>');
                $resultSection.show();
            },
            complete: function () {
                $btn.prop('disabled', false).contents().first()[0].textContent = 'Explain Code ';
                $spinner.hide();
            }
        });
    });
}); 