<!-- registerformbody.tmp.php -->

<body>
    <section class="showcase">
        <div class="overlay"></div>
        <div class="text">
            <div class="form-container">
                <form action="?user/register" method="post" enctype="multipart/form-data">
                  <!-- Usuario y contraseña -->
                    <label for="email">Usuario:</label>
                    <input type="email" name="email" <?php if (isset($data['email'])) { echo 'value="' . $data['email']. '"'; } ?>>
                    <?php if (isset($errors['email'])) { echo '<p class="error">' . $errors['email'] . '</p>'; } ?>

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password">
                    <?php if (isset($errors['password'])) { echo '<p class="error">' . $errors['password'] . '</p>'; } ?>

                    <!-- Datos personales -->
                    <label for="tipusIdent">Tipo de Identificación:</label>
                    <select name="tipusIdent">
                        <option value="DNI" <?php if (isset($data['tipusIdent']) && $data['tipusIdent'] === 'DNI') { echo 'selected'; } ?>>DNI</option>
                        <option value="NIE" <?php if (isset($data['tipusIdent']) && $data['tipusIdent'] === 'NIE') { echo 'selected'; } ?>>NIE</option>
                    </select>
                    <?php if (isset($errors['tipusIdent'])) { echo '<p class="error">' . $errors['tipusIdent'] . '</p>'; } ?>

                    <label for="numeroIdent">Número de Identificación:</label>
                    <input type="text" name="numeroIdent" <?php if (isset($data['numeroIdent'])) { echo 'value="' . $data['numeroIdent']. '"'; } ?>>
                    <?php if (isset($errors['numeroIdent'])) { echo '<p class="error">' . $errors['numeroIdent'] . '</p>'; } ?>

                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" <?php if (isset($data['nom'])) { echo 'value="' . $data['nom']. '"'; } ?>>
                    <?php if (isset($errors['nom'])) { echo '<p class="error">' . $errors['nom'] . '</p>'; } ?>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" <?php if (isset($data['cognoms'])) { echo 'value="' . $data['cognoms']. '"'; } ?>>
                    <?php if (isset($errors['cognoms'])) { echo '<p class="error">' . $errors['cognoms'] . '</p>'; } ?>

                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" <?php if (isset($data['naixement'])) { echo 'value="' . $data['naixement']. '"'; } ?>>
                    <?php if (isset($errors['naixement'])) { echo '<p class="error">' . $errors['naixement'] . '</p>'; } ?>

                    <label for="sexo">Sexo:</label>
                    <select name="sexo">
                        <option value="M" <?php if (isset($data['sexe']) && $data['sexe'] === 'M') { echo 'selected'; } ?>>Masculino</option>
                        <option value="F" <?php if (isset($data['sexe']) && $data['sexe'] === 'F') { echo 'selected'; } ?>>Femenino</option>
                        <option value="otro" <?php if (isset($data['sexe']) && $data['sexe'] === 'otro') { echo 'selected'; } ?>>Otro</option>
                    </select>
                    <?php if (isset($errors['sexe'])) { echo '<p class="error">' . $errors['sexe'] . '</p>'; } ?>

                    <!-- Dirección -->
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" <?php if (isset($data['adreca'])) { echo 'value="' . $data['adreca']. '"'; } ?>>
                    <?php if (isset($errors['adreca'])) { echo '<p class="error">' . $errors['adreca'] . '</p>'; } ?>

                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" name="codigo_postal" <?php if (isset($data['codigo_postal'])) { echo 'value="' . $data['codigo_postal']. '"'; } ?>>
                    <?php if (isset($errors['codigo_postal'])) { echo '<p class="error">' . $errors['codigo_postal'] . '</p>'; } ?>

                    <label for="poblacion">Población:</label>
                    <input type="text" name="poblacion" <?php if (isset($data['poblacio'])) { echo 'value="' . $data['poblacio']. '"'; } ?>>
                    <?php if (isset($errors['poblacio'])) { echo '<p class="error">' . $errors['poblacio'] . '</p>'; } ?>

                    <label for="provincia">Provincia:</label>
                    <input type="text" name="provincia" <?php if (isset($data['provincia'])) { echo 'value="' . $data['provincia']. '"'; } ?>>
                    <?php if (isset($errors['provincia'])) { echo '<p class="error">' . $errors['provincia'] . '</p>'; } ?>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" <?php if (isset($data['telefon'])) { echo 'value="' . $data['telefon']. '"'; } ?>>
                    <?php if (isset($errors['telefon'])) { echo '<p class="error">' . $errors['telefon'] . '</p>'; } ?>

                    <!-- Imagen de usuario -->
                    <label for="imagen">Imagen de usuario:</label>
                    <input type="file" name="imagen">
					<?php if (isset($errors['imagen'])) { echo '<p class="error">' . $errors['imagen'] . '</p>'; } ?>

                    <!-- Botón de registro -->
                    <input type="submit" name="Registrar">
                </form>
            </div>
        </div>
    </section>
</body>
