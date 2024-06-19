<div class="container forgot">

    <?php include_once __DIR__ . '/../templates/name-page.php'    ?>

    <div class="container-sm">

        <p class="description-page">Recupera el acceso a UpTask</p>
        <?php include_once __DIR__ . '/../templates/alerts.php'     ?>
        <form class="form" method="POST" action="/forgot">


            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" name="email">
            </div>


            <input type="submit" value="Recuperar">
        </form>

        <div class="actions">
            <a href="/">Ya tienes una cuenta? Inicia session</a>
            <a href="/create">Aun no tienes una cuenta? Crea una</a>

        </div>

    </div>


</div>