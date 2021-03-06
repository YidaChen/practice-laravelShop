<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @yield('meta')
    <title>@yield('title')</title>
    <link href="/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('link')
  </head>
  <body>
    @yield('body')
    <script src="/js/jquery-1.11.3.min.js"></script>
    <script src="/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    @yield('script')
  </body>
</html>