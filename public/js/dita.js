$(function () {
    $('#btnTransform').on('click', function () {
        const html = $('#inputHtml').val().trim();
        const topicType = $('#topicType').val();
        const $btn = $(this);
        const $spinner = $('#spinner');
        const $result = $('#result');
        const $resultSection = $('.result-section');

        if (!html) {
            alert('Please paste HTML content first.');
            return;
        }

        $btn.prop('disabled', true).contents().first()[0].textContent = 'Transforming... ';
        $spinner.show();
        $result.text('');
        $resultSection.hide();

        $.ajax({
            url: '/api/openai-response',
            type: 'GET',
            data: {
                type: 'dita',
                html: html,
                topicType: topicType
            },
            success: function (res) {
                if (res && res.result) {
                    // Format the XML output
                    const formattedXml = formatXml(res.result);
                    $('#result').text(formattedXml);
                    $resultSection.show();
                    
                    // Apply syntax highlighting
                    hljs.highlightElement($('#result')[0]);
                } else {
                    $('#result').text('No DITA output returned. Please try again.');
                    $resultSection.show();
                }
            },
            error: function (xhr, status, err) {
                $result.text('Error: ' + err);
                $resultSection.show();
            },
            complete: function () {
                $btn.prop('disabled', false).contents().first()[0].textContent = 'Transform to DITA ';
                $spinner.hide();
            }
        });
    });

    // Copy XML to clipboard
    $('#btnCopy').on('click', function () {
        const xmlContent = $('#result').text();
        if (xmlContent) {
            navigator.clipboard.writeText(xmlContent).then(function() {
                const $btn = $(this);
                const originalText = $btn.text();
                $btn.text('Copied!');
                setTimeout(() => {
                    $btn.text(originalText);
                }, 2000);
            }.bind(this)).catch(function(err) {
                console.error('Could not copy text: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = xmlContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                
                const $btn = $(this);
                const originalText = $btn.text();
                $btn.text('Copied!');
                setTimeout(() => {
                    $btn.text(originalText);
                }, 2000);
            });
        }
    });

    // Download DITA file
    $('#btnDownload').on('click', function () {
        const xmlContent = $('#result').text();
        if (xmlContent) {
            const blob = new Blob([xmlContent], { type: 'application/xml' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'transformed.dita';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }
    });

    // XML formatting function
    function formatXml(xml) {
        let formatted = '';
        let indent = '';
        const tab = '    ';
        
        xml.split(/>\s*</).forEach(function(node) {
            if (node.match(/^\/\w/)) { // Closing tag
                indent = indent.substring(tab.length);
            }
            formatted += indent + '<' + node + '>\r\n';
            if (node.match(/^<?\w[^>]*[^\/]$/)) { // Opening tag
                indent += tab;
            }
        });
        
        return formatted.substring(1, formatted.length - 3);
    }
}); 