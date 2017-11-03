<div class="container" style="padding: 70px 0;">
    <div style="width:400px; margin:0 auto;padding: 70px 0;">

      <form class="form-signin" action="/dentist/authentication" method="post">
        <h2 class="form-signin-heading"><i class="fa fa-user-md fa-5x"></i></h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-block" type="submit">Sign in</button>
      </form>

    </div> 
</div>