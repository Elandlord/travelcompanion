
<nav class="navbar navbar-default navbar-fixed-top bg-main">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src='images/banner-logo.png' style='width:175px;'/></a>

        </div>
        <div class='navbar pull-left'>
             <search-bar></search-bar>
        </div>
        <div class="navbar-collapse collapse bg-main" id="navbar-main">

                @if (Auth::check())
                    <div class="dropdown navbar-right space-outside-up-sm sm-space-outside-xl xs-space-outside-xl">
                      <button class="btn hover-darken-accent transition-normal dropdown-toggle bg-accent  text-color-light" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @include ('layouts.nav-vue')
                      </ul>
                    </div>
                @else
                    <form class="navbar-form navbar-right border-accent sm-space-outside-xl xs-space-outside-xl" role="form" method="POST" action="{{ url('/login') }}">
                         {{ csrf_field() }}
                         <router-link tag="li" to="/register">
                            <a class='text-color-accent text-hover-light transition-normal'>No account?</a>
                        </router-link>  
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <button type="submit" class="btn bg-accent text-color-light hover-darken-accent transition-normal">Sign In</button>
                    </form>
                @endif

            </div>
    </div>
</nav>




