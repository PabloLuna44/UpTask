<div class="container recover">

  <?php    include_once __DIR__ . '/../templates/name-page.php'     ?>
    <div class="container-sm">
    <?php    include_once __DIR__ . '/../templates/alerts.php'     ?>

    <?php    if(empty($alerts)):    ?>

        <p class="description-page">Agrega tu nuevo password</p>

        <form class="form" method="POST">


        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password">
        </div>

        <div class="field">
            <label for="verifyPassword">Verifica tu password</label>
            <input type="password" id="verifyPassword" placeholder="Verifica tu password" name="verifyPassword">
        </div>


        <input type="submit" value="Guardar Password">
        </form>
        <?php    endif;     ?>
        <div class="actions">
            <a href="/create">Aun no tienes una cuenta? Crea una</a>
            <a href="/forgot">Olvidate tu password?</a>

        </div>
        

    </div>


</div>