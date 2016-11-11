
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
            <li role="presentation" class="active"><a href="/">Home</a></li>
            <li role="presentation"><a href="recent">Recent</a></li>
            <li role="presentation"><a href="top">Top</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Mutiny URL Shortener</h3>
      </div>
      @if (session('status'))
        <div class="alert alert-info">
          {!! session('status') !!}
        </div>
      @endif
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="jumbotron">
        <h1>Shorten URL</h1>
        <form class="form-horizontal" action="/create" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="url" class="col-sm-4 control-label">URL to Shorten: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="url" id="url" placeholder="http://google.com">
            </div>
          </div>
          <div class="form-group">
            <label for="desired_id" class="col-sm-4 control-label">Desired ID:</label>
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-addon">mutiny.co/</div>
                  <input type="text" class="form-control" name="desired_id" id="desired_id" placeholder="123">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-10">
              <div class="g-recaptcha" data-sitekey="6LdBe_cSAAAAAA-l16FZ0Fcn6RoqCRe0RbSlfkfX"></div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Shorten URL!</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
