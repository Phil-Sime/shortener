
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Mutiny URL Shortener</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Google reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="/">Home</a></li>
            <li role="presentation"><a href="recent">Recent</a></li>
            <li role="presentation" class="active"><a href="top">Top</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Mutiny URL Shortener</h3>
      </div>
      <div class="container">
        <table class="table table-striped table-bordered">
          <caption>Top URLs</caption>
          <thead>
            <tr>
              <td>ID</td>
              <td>Count</td>
              <td>Actual URL</td>
            </tr>
          </thead>
          <tbody>
            @foreach($urls as $url)
              <tr>
                <td>{{ $url->tag }}</td>
                <td>{{ $url->counter }}</td>
                <td>{{ $url->url }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
