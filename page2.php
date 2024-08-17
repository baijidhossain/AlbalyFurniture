<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change URL and Load Content</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <button id="changeUrlBtn">Change URL and Load Content</button>

  <div id="page2-content">
    <h1>Page 2 Content</h1>
    <p>This is the content of Page 2.</p>
  </div>

  <script>
    $(document).ready(function() {

      $('#changeUrlBtn').click(function() {
        // The new URL you want to set
        var newUrl = '/test.php';

        // Change the URL without reloading the page
        history.pushState(null, '', newUrl);

        // Load new content dynamically
        $.ajax({
          url: 'new-page-content.html', // URL to the content you want to load
          method: 'GET',
          success: function(data) {
            // Replace the content in the div with the new content
            $('#content').html(data);
          },
          error: function() {
            // Handle error
            $('#content').html('<p>Failed to load content.</p>');
          }
        });
      });

    });

    // Handle the back and forward buttons
    window.onpopstate = function(event) {
      var currentUrl = window.location.pathname;
      // Load the appropriate content based on the current URL
      $.ajax({
        url: currentUrl + 'test.php', // Adjust as needed
        method: 'GET',
        success: function(data) {
          $('#content').html(data);
        },
        error: function() {
          $('#content').html('<p>Failed to load content.</p>');
        }
      });
    };
  </script>

</body>

</html>