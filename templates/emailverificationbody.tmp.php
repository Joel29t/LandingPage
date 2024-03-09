<?php
$enlace = '<a href="?user/updateStatus/' . $lastId . '">Haz clic aquí para autenticar</a>';
$message = '<p>Estimado/a Usuario/a,
    
Recibimos una solicitud para autenticar tu cuenta, y necesitamos tu colaboración para completar el proceso. Por favor, sigue el enlace a continuación para verificar tu cuenta:</p>';
?>
<body>
	<section class="showcase">
		<div class="overlay"></div>
		<div class="text">
			<div id="guest">
				<div id="verificationEmail">
                    <?php
                    echo $message;
                    echo $enlace;
                    ?>
				</div>
			</div>
		</div>
	</section>
</body>