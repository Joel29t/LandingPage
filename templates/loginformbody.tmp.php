<!-- loginformbody.tmp.php -->
<body>
    <section class="showcase">
        <div class="overlay"></div>
        <div class="text">
            <div class="form-container">
                <form action="?user/login" method="post" enctype="multipart/form-data">

                    <label for="username">Usuario:</label>
                    <input type="text" name="username" <?php if (isset($data['email'])) { echo 'value="' . $data['email'] . '"'; } ?>>
                    <?php if (isset($errors['email'])) { echo '<p class="error">' . $errors['email'] . '</p>'; } ?>

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password">
                    <?php if (isset($errors['password'])) { echo '<p class="error">' . $errors['password'] . '</p>'; } ?>

                    <p>
                        <a href="?user/showRegistrationForm">¿No estás registrado?</a>
                    </p>
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </section>
</body>
