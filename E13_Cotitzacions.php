<?php

session_start();

$url = 'https://www.inversis.com/trans/inversis/SvlCotizaciones?accion=cotizacionesValores&codigoIndice=3';

$web = iconv('ISO-8859-1', 'UTF-8', file_get_contents($url));

$pos_inici = strpos($web, '<table id="tabCotizaciones" class="tabDatosInterior1">');
$pos_final = strpos($web, '</table>', $pos_inici);

if ($pos_inici !== false && $pos_final !== false) {
    $table = substr($web, $pos_inici, $pos_final - $pos_inici + strlen('</table>'));

    $table = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $table);

    $rows = explode('</tr>', $table);
    $data = array();

    foreach ($rows as $row) {
        $cells = explode('</td>', $row);
        $rowData = array();

        foreach ($cells as $cell) {
            $cell = strip_tags($cell);
            $cell = trim($cell);

            if (! empty($cell)) {
                // \n salto de línea.
                // \r coincide con un retorno de carro????.
                // \t tabulación.
                // \s cualquier carácter de espacio en blanco.
                $cell = preg_replace('/[\n\r\t\s]+/', ' ', $cell);
                $cell = trim($cell);

                $rowData[] = $cell;
            }
        }

        if (count($rowData) >= 2) {

            $name = $rowData[0];

            $ticker = '';

            if (count($rowData) > 1) {
                // Si hay al menos dos celdas en la fila, verifica si el ticker está dividido por espacios
                if (strpos($rowData[1], ' ') !== false) {
                    // Divide la segunda celda por espacios
                    $name_parts = explode(' ', $rowData[1]);
                    // Agrega la primera parte a la variable de nombre
                    $name .= ' ' . $name_parts[0];
                    // La segunda parte es el ticker
                    $ticker = $name_parts[1];
                } else {
                    // la segunda celda es el ticker
                    $ticker = $rowData[1];
                }
            }

            // nombre ajustado
            $rowData[0] = $name;
            // ticker
            $rowData[1] = $ticker;

            // fila procesada
            $data[] = $rowData;
        }
    }

    $column_names = array(
        'nom',
        'ticker',
        'mercat',
        'ultima_coti',
        'divisa',
        'variacio',
        'variacio_percent',
        'volum',
        'mínim',
        'màxim',
        'data',
        'hora'
    );
    $scrapedData = array();

    foreach ($data as $row) {
        $formattedRow = array();
        $originalHora = '';
        $originalData = '';
        foreach ($row as $index => $cell) {
            if ($column_names[$index] === 'ultima_coti' && strpos($cell, '=') !== false) {
                $cell = str_replace('=', '', $cell);
                $originalData = substr($row[11], 0, 5);
                $originalHora = substr($row[12], 0, 5);
            }
            if ($column_names[$index] === 'data') {
                $formattedRow['data'] = substr($cell, 0, 5);
            } elseif ($column_names[$index] === 'hora') {
                $formattedRow['hora'] = substr($cell, 0, 5);
            } else {
                $formattedRow[$column_names[$index]] = $cell;
            }
        }
        if ($originalData) {
            $formattedRow['ultima_coti'] = $formattedRow['divisa'];
            $formattedRow['divisa'] = $formattedRow['variacio'];
            $formattedRow['variacio'] = $formattedRow['variacio_percent'];
            $formattedRow['variacio_percent'] = $formattedRow['volum'];
            $formattedRow['volum'] = $formattedRow['mínim'];
            $formattedRow['mínim'] = $formattedRow['màxim'];
            $formattedRow['màxim'] = $formattedRow['data'];
            $formattedRow['data'] = $originalData;
            $formattedRow['hora'] = $originalHora;
        }
        $scrapedData[] = $formattedRow;
    }

    $output = '<div id="table-container"><table id="scraped-table" border="1">';
    $output .= '<tr>';
    foreach ($column_names as $columnName) {
        $output .= '<th>' . $columnName . '</th>';
    }
    $output .= '</tr>';
    foreach ($scrapedData as $indexRow => $row) {
        $output .= '<tr>';
        foreach ($column_names as $indexColumn => $columnName) {
            $cellValue = $row[$columnName];

            if ($indexColumn == 3) {
                $ultima_coti_key = 'ultima_coti_' . $indexRow;

                if (isset($_SESSION[$ultima_coti_key])) {
                    $ultima_coti = $_SESSION[$ultima_coti_key];
                } else {
                    $ultima_coti = 0;
                }

                $ultima_coti = floatval(str_replace(",", ".", $ultima_coti));
                $cellValue = floatval(str_replace(",", ".", $cellValue));

                if ($cellValue < $ultima_coti) {
                    $output .= '<td style="background-color:red;">' . $cellValue . '</td>';
                } elseif ($cellValue > $ultima_coti && $ultima_coti != 0) {
                    $output .= '<td style="background-color:green;">' . $cellValue . '</td>';
                } else {
                    $output .= '<td>' . $cellValue . '</td>';
                }

                $_SESSION[$ultima_coti_key] = $cellValue;
            } elseif ($indexColumn == 5 || ($indexColumn == 6 && $cellValue != 0)) {
                if ($cellValue < 0) {
                    $output .= '<td style="background-color:red;">' . $cellValue . '</td>';
                } elseif ($cellValue > 0) {
                    $output .= '<td style="background-color:green;">' . $cellValue . '</td>';
                } else {
                    $output .= '<td>' . $cellValue . '</td>';
                }
            } else {
                $output .= '<td>' . $cellValue . '</td>';
            }
        }
        $output .= '</tr>';
    }

    $output .= '</table></div>';

    $output .= "<br /><input type='submit' name='submitAdd' value='Refresca les dades' onclick='window.location.reload();'>";
} else {
    $output = "No se encontró la tabla en la página.";
}


?>

<!DOCTYPE html>
<?php include 'templates/head.tmp.php';?>
<html lang="en">
<?php include 'templates/header.tmp.php';?>
<?php include 'templates/cotitzacionsBody.tmp.php';?>
</html>

