<body>
    <section class="showcase">
        <div class="overlay"></div>
        <div class="text">
        <div id="guest">

            <form method="post" action="">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" <?php if (isset($data['name'])) { echo 'value="' . $data['name'] . '"'; } ?>>
                <?php if (isset($errors['name'])) { echo '<br><p class="error">' . $errors['name'] . '</p>'; } ?>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" <?php if (isset($data['email'])) { echo 'value="' . $data['email'] . '"'; } ?>>
                <?php if (isset($errors['email'])) { echo '<br><p class="error">' . $errors['email'] . '</p>'; } ?>
                <?php if (isset($errors['email_domain'])) { echo '<p class="error">' . $errors['email_domain'] . '</p>'; } ?>

                <label for="message">Mensaje:</label>
                <select id="message" name="message">
                    <option value="" <?php if (!isset($data['message'])) echo 'selected'; ?>>Selecciona una opción</option>
                    <option value="excelente" <?php if (isset($data['message']) && $data['message'] === 'excelente') echo 'selected'; ?>>Excelente</option>
                    <option value="muy_bueno" <?php if (isset($data['message']) && $data['message'] === 'muy_bueno') echo 'selected'; ?>>Muy Bueno</option>
                    <option value="bueno" <?php if (isset($data['message']) && $data['message'] === 'bueno') echo 'selected'; ?>>Bueno</option>
                    <option value="regular" <?php if (isset($data['message']) && $data['message'] === 'regular') echo 'selected'; ?>>Regular</option>
                    <option value="malo" <?php if (isset($data['message']) && $data['message'] === 'malo') echo 'selected'; ?>>Malo</option>
                </select>
                <?php if (isset($errors['message'])) { echo '<br><p class="error">' . $errors['message'] . '</p>'; } ?>

                <input type="submit" value="Enviar">
            </form>
			
            <?php echo $guestBook->renderEntries(); ?>
        </div>
        </div>
    </section>
</body>
