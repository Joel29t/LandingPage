<?php

class IdiomaAcctionsView
{

    public function show($idiomasTrad)
    {
        $idiomaController = new IdiomaController();
        $idioma = $idiomaController->index($_GET['home/show/lang']);

        echo "<!DOCTYPE html><html lang=\"en\">";
        include 'templates/head.tmp.php';
        echo "<body>";
        include 'templates/header.tmp.php';
        echo '<section class="showcase"><div class="overlay"></div><div class="text">';
        $table = $this->generateTable($idiomasTrad);
        include "templates/idiomaacctionbody.tmp.php";
        echo "</div></section></body></html>";
    }

    public function generateTable($idiomasTrad)
    {
        $table = '<table border="1">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th>Flag</th>';
        $table .= '<th>Idioma</th>';
        $table .= '<th>Actions</th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';

        foreach ($idiomasTrad->getTraduccions() as $key => $nombre) {
            $iso = $key;
            $imagePath = "languages/$key.png";

            $table .= '<tr>';
            $table .= '<td><img src="' . $imagePath . '" alt="lang_flag"></td>';
            $table .= '<td>' . $nombre . '</td>';
            $table .= '<td>';
            $table .= '<form method="post" action="?IdiomaAcctions/delete">';
            $table .= '<input type="hidden" name="iso" value="' . $iso . '">';
            $table .= '<button type="submit" name="delete">Delete</button>';
            $table .= '</form>';
            $table .= '<form method="post" action="?IdiomaAcctions/update">';
            $table .= '<input type="hidden" name="iso" value="' . $iso . '">';
            $table .= '<button type="submit" name="update">Update</button>';
            $table .= '</form>';
            $table .= '<form method="post" action="?IdiomaAcctions/create">';
            $table .= '<input type="hidden" name="iso" value="' . $iso . '">';
            $table .= '<button type="submit" name="create">Create</button>';
            $table .= '</form>';
            $table .= '</td>';
            $table .= '</tr>';
        }

        $table .= '</tbody>';
        $table .= '</table>';

        return $table;
    }

    public function showForm($data = null, $errors = null, $tipus)
    {
        $idiomaController = new IdiomaController();
        $idioma = $idiomaController->index($_GET['home/show/lang']);

        echo "<!DOCTYPE html><html lang=\"en\">";
        include 'templates/head.tmp.php';
        echo "<body>";
        include 'templates/header.tmp.php';
        echo '<section class="showcase"><div class="overlay"></div><div class="text">';

        echo '<form method="post" action="?IdiomaAcctions/processForm" enctype="multipart/form-data">';
        echo '<label for="iso">ISO:</label>';
        if ($tipus == "update") {
            echo '<input type="text" name="iso" ' . (is_object($data) && null !== $data->getIso() ? 'value="' . $data->getIso() . '"' : '') . ' readonly><br>';
        } else {
            echo '<input type="text" name="iso" ' . (is_object($data) && null !== $data->getIso() ? 'value="' . $data->getIso() . '"' : '') . '><br>';
        }
      

        echo '<label for="imatge">Imatge:</label>';
        
        if (is_object($data) && $data->getImatge()):
        echo '<img src="' . $data->getImatge() . '" alt="Imatge previa" style="max-width: 200px;">';
        echo '<br>';
        endif;
        

        echo '<input type="file" name="imatge">';
        
        
        
        echo '<label for="actiu">Actiu:</label>';
        echo '<select name="actiu">';
        echo '<option value="1"' . (is_object($data) && $data->getActiu() == 1 ? ' selected' : '') . '>1</option>';
        echo '<option value="0"' . (is_object($data) && $data->getActiu() == 0 ? ' selected' : '') . '>0</option>';
        echo '</select><br>';
        

        if ($tipus == "update") {
            $traduccions = $data->getTraduccions();
        } else {
            $traduccions = $data;
        }
        foreach ($traduccions as $traduccio) {
            $lang = $traduccio->getVariable();

            $translation = null !== $traduccio->getValor() ? $traduccio->getValor() : '';
            echo '<label for="' . $lang . '">' . $lang . ':</label>';
            echo '<input type="text" name="traduccions[' . $lang . ']" value="' . $translation . '"><br>';
        }

        if (! empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }
        }

        echo '<button type="submit" name=' . $tipus . '>Submit</button>';
        echo '</form>';

        echo '</div></section></body></html>';
    }
}
?>
