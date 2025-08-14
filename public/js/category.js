$(document).ready(function() {
    $('#checkCompliance').click(function() {
        let inputText = $('#inputText').val();
        let $btn = $(this);
        let $spinner = $('#spinner'); // Spinner element

        $btn.prop('disabled', true).html('Checking... <span id="spinner" class="spinner"></span>');
        $spinner.show();

        $.ajax({
            url: "/api/openai-response",
            type: "GET",
            data: {
                checkText: inputText,
                type: "category"
            },
            success: function(response) {
                let categoryHtml = "";
                let difficultyHtml = "";
                console.log(response);

                if (response.category && response.difficulty) {
                    categoryHtml = "<p>Category: <span class='category tag'>" + response.category + "</span></p>";
                    difficultyHtml = "<p>Difficulty: <span class='difficulty tag " + response.difficulty.toLowerCase() + "'>" + response.difficulty + "</span></p>";
                } else {
                    categoryHtml = "<p>No category found.</p>";
                    difficultyHtml = "<p>No difficulty level found.</p>";
                }

                $('#result').html(categoryHtml + difficultyHtml);
            },
            error: function(xhr, status, error) {
                $('#result').html("<p class='error'>Error occurred: " + error + "</p>");
            },
            complete: function() {
                $btn.prop('disabled', false).html('Categorize text');
                $spinner.hide(); // Hide the spinner
            }
        });
    });
});
