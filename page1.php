<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Page Loading</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <button id="loadPage1">Load Page 1</button>
  <button id="loadPage2">Load Page 2</button>

  <div id="main-content">
    <h1>Welcome to the Main Page</h1>
    <p>Click the buttons to load different pages.</p>
  </div>

  <script>
    $(document).ready(function() {
      // Load Page 1
      $('#loadPage1').click(function() {
        // Change the URL without reloading the page
        history.pushState(null, '', 'page1.php');

        // Load Page 1 content dynamically
        $.ajax({
          url: 'page1.php',
          method: 'GET',
          success: function(data) {
            $('#main-content').html(data);
          },
          error: function() {
            $('#main-content').html('<p>Failed to load Page 1.</p>');
          }
        });
      });

      // Load Page 2
      $('#loadPage2').click(function() {
        // Change the URL without reloading the page
        history.pushState(null, '', 'page2.php');

        // Load Page 2 content dynamically
        $.ajax({
          url: 'page2.php',
          method: 'GET',
          success: function(data) {
            $('#main-content').html(data);
          },
          error: function() {
            $('#main-content').html('<p>Failed to load Page 2.</p>');
          }
        });
      });
    });

    // Handle back and forward buttons
    window.onpopstate = function(event) {
      var currentUrl = window.location.pathname;
      $.ajax({
        url: currentUrl,
        method: 'GET',
        success: function(data) {
          $('#main-content').html(data);
        },
        error: function() {
          $('#main-content').html('<p>Failed to load content.</p>');
        }
      });
    };
  </script>

</body>

</html>