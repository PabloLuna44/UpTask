<div class="container login">

  <?php    include_once __DIR__ . '/../templates/name-page.php'     ?>

    <div class="container-sm">
        <p class="description-page">Login</p>
        <?php    include_once __DIR__ . '/../templates/alerts.php'     ?>
        <form class="form" method="POST" action="/">

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" name="email">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password">
        </div>


        <input type="submit" value="Login">
        </form>

        <div class="actions">
            <a href="/create">Aun no tienes una cuenta? Crea una</a>
            <a href="/forgot">Olvidate tu password?</a>

        </div>

    </div>


</div>