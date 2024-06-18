<div class="container create">

   <?php  include_once __DIR__ . '/../templates/name-page.php'?>


   

    <div class="container-sm">
        <p class="description-page">Crea una nueva cuneta en UpTask</p>
        <?php  include_once __DIR__ . '/../templates/alerts.php'    ?>

        <form class="form" method="POST" action="/create">

        <div class="field">
            <label for="name">Nombre</label>
            <input type="name" id="name" placeholder="Nombre" name="name" value="<?php echo $user->name ?>">
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email" name="email" value="<?php echo $user->email ?>">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password">
        </div>

        <div class="field">
            <label for="verifyPassword">Verifica tu password</label>
            <input type="password" id="verifyPassword" placeholder="Verifica tu password" name="verifyPassword">
        </div>


        <input type="submit" value="Crear cuenta">
        </form>

        <div class="actions">
            <a href="/">Ya tienes una cuenta? Inicia session</a>
            <a href="/forgot">Olvidate tu password?</a>

        </div>

    </div>


</div>