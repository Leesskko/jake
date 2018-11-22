@include('web.header')
<body id="wrapper">
<div class="wrap-body">
    @include('web.top')
    @section('content')
    @show
    @include('web.footer')
    @include('web.js')
</div>
</body>
</html>
