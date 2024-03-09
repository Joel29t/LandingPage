
<div class="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="E13_Cotitzacions.php">E13_Cotitzacions</a></li>
		<li><a href="E11_Formulari_contacte.php">E11_Formulari_contacte</a></li>
		<li><a href="index.php?MantenimentEntrada/showMantenimentEntrada">Manteniment</a></li>
		<li><a href="index.php?IdiomaAcctions/showIdiomaAccions">Idiomes</a></li>

<?php
$user_authenticated = isset($_SESSION['user_data']);

if ($user_authenticated) {
    echo '<li><a href="E01_GuestBook.php">E01_GuestBook</a></li>';
    echo '<li><a href="index.php?user/logout">Cerrar Sesión</a></li>';
} else {
    echo '<li><a href="index.php?user/showLoginForm">Iniciar Sesión</a></li>';
}

$lang = isset($_GET['Home/show/lang']) ? $_GET['Home/show/lang'] : (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : "gb");

?>
	</ul>
</div>
<header>
    <h2 class="logo">TRAVEL</h2>
    <ul class="language-switch">
        <?php if ($idioma !== null): ?>
            <?php foreach ($idioma->getTraduccions() as $iso => $valor): ?>
                <li>
                    <a href="?Home/show/lang=<?php echo $iso; ?>" <?php echo ($lang == $iso) ? 'class="active"' : ''; ?>>
                        <?php echo $valor; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <?php
    $img = isset($_SESSION['user_data']["imatge"]) ? $_SESSION['user_data']["imatge"] : 'default';
    ?>
    <img alt="" src="img/<?php echo $img.'.png'; ?>">

    <div class="toggle"></div>
</header>




