<nav class="navbar navbar-default navbar-fixed-top bg-main">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src='images/banner-logo.png' style='width:175px;'/></a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" style="width:250px;" class="form-control" name="username" placeholder="Where do you want to go?">
                    </div>
                    <button type="submit" class="btn bg-accent text-color-light hover-darken-accent transition-normal"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>

                @if (Auth::check())
                    <form class="navbar-form navbar-right space-outside-up-sm" role="search">
                        <div class="form-group">
                            <p class='text-color-light font-md'>{{ Auth::user()->name }} <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                        </div>
                    </form>
                @else
                    <form class="navbar-form navbar-right" role="search">
                        <a class='text-color-accent text-hover-light transition-normal space-outside-right-sm' href='register'>No account?</a>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn bg-accent text-color-light hover-darken-accent transition-normal">Sign In</button>
                    </form>
                @endif

            </div>
        </center>
    </div>
</nav>