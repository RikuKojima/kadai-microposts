<style>
    .navbar-brand {
        font-family:'Times New Roman';
    }
</style>
<header>
    <nav class="navbar">
        <div class="container">
            <div class="header-navbar">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">Microposts</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!--ログイン中ならナビバーにユーザ情報を表示する-->
                    @if(Auth::check())
                        <li><a href="#">Users</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role='button' aria-haspopup='true' aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">My Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li>{!! link_to_route('logout.get','Logout')!!}</li>
                            </ul>
                        </li>
                    @else
                        <li>{!! link_to_route('signup.get','Signup') !!}</li>
                        <li>{!! link_to_route('login','Login') !!}</li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>