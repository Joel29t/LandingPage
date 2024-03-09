<body>
	<section class="showcase">
		<div class="overlay"></div>
		<div class="text">
			<section id="contact">
				<div class="content">
					<div id="form">
						<form action="" id="contactForm" method="post">
							<span>Nom i cognoms</span>
							<input type="text" name="name" class="name" placeholder="Nom i cognoms" tabindex=1 <?php if (isset($data['name'])) { echo 'value="' . $data['name']. '"'; } ?> />
							<?php if (isset($errors['name'])) { echo '<p class="error">' . $errors['name'] . '</p>'; } ?>
							
							<span>Email</span>
							<input type="text" name="email" class="email" placeholder="Email" tabindex=2 <?php if (isset($data['email'])) { echo 'value="' . $data['email'] . '"'; } ?> />
							<?php if (isset($errors['email'])) { echo '<p class="error">' . $errors['email'] . '</p>'; } ?>
							<?php if (isset($errors['email_domain'])) { echo '<p class="error">' . $errors['email_domain'] . '</p>'; } ?>
							
							<span>Missatge</span>
							<textarea class="message" name="message" placeholder="Enter your message" maxlength="255"><?php if (isset($data['message'])) { echo $data['message']; } ?></textarea>
							<?php if (isset($errors['message'])) { echo '<p class="error">' . $errors['message'] . '</p>'; } ?>
							
							<input type="submit" name="submit" value="Envia" class="submit" tabindex=5>
						</form>
					</div>
					<?php echo '<p>' . $guardados . '</p>'; ?>
				</div>
			</section>
		</div>
	</section>
</body>
