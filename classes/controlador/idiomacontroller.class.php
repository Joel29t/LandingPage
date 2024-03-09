<?php

class IdiomaController extends Controlador
{

    private $idiomaModel;

    public function __construct()
    {
        $this->idiomaModel = new IdiomaModel();
    }

    public function index($getLang = null)
    {
        try {
            $iso = isset($getLang) ? $getLang : (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : "gb");

            $this->idiomaModel->beginTransaction();

            $iso = $this->sanitizeInput($iso);

            $idioma = new Idioma();
            $idioma->setIso($iso);
            $idiomaActual = $this->idiomaModel->getLanguage($idioma);

            if ($idiomaActual->getId() === null) {

                setcookie('lang', "gb", time() + (86400 * 30), "/");
                throw new Exception("Idioma no válido");
            }
            setcookie('lang', $iso, time() + (86400 * 30), "/");

            $idiomasActius = $this->idiomaModel->getIdiomesActius();
            $traduccionesActives = [];

            foreach ($idiomasActius as $idiomaActiu) {
                foreach ($idiomaActual->getTraduccions() as $traduccio) {
                    if ($traduccio->getVariable() === $idiomaActiu['iso']) {
                        $traduccionesActives[$traduccio->getVariable()] = $traduccio->getValor();
                    }
                }
            }

            $idiomaActual->setTraduccions($traduccionesActives);

            $this->idiomaModel->commit();
        } catch (Exception $e) {
            $this->idiomaModel->rollback();
            throw new Exception("Error al cargar la página: " . $e->getMessage());
        }
        $idioma = $idiomaActual;
        return $idioma;
    }

    // public function validateIso($iso){
    // $isos = $this->idiomaModel->getAllIso();

    // if(!in_array($iso, $isos)){
    // throw new Exception("El idioma de la cookie no existeix");

    // }
    // }
}

?>
