<?php

class MantenimentPagamentView
{

    public function showMantenimentPagament($ObjectArray, $data = null, $errors = null, $updateData = null, $isCreate = true)
    {
        echo "<!DOCTYPE html><html lang=\"en\">";
        include 'templates/head.tmp.php';
        echo "<body>";
        include 'templates/header.tmp.php';
        echo "  <section class=\"showcase\"><div class=\"overlay\"></div><div class=\"text\">";
        include 'templates/navManteniment.tmp.php';
        $table = $this->generateTable($ObjectArray, $data, $errors, $updateData, $isCreate);
        include 'templates/mantenimentbody.tmp.php';
        echo "</div></section></body></html>";
    }

    public function generateTable($objectArray, $data, $errors, $updateData, $isCreate)
    {
        if ($isCreate) {
            $table = '<form method="post" action="?MantenimentPagament/create">';
        } else {
            $table = '<form method="post" action="?MantenimentPagament/update">';
        }
        $table .= '<table>
    <thead>
        <tr>';

        foreach ($objectArray[0] as $key => $value) {
            $table .= "<th>$key</th>";
        }

        $table .= '<th>Acciones</th>
    </tr>
</thead>
<tbody>
    <tr>';

        foreach ($objectArray[0] as $key => $value) {
            $table .= '<td>';

            if ($key === 'id') {
                $table .= '<input type="text" id="' . $key . '" name="' . $key . '"';
            } elseif ($key === 'estat') {
                $table .= '<select id="' . $key . '" name="' . $key . '">
                <option' . ($data[$key] === 'CONFIRMAT' || $updateData[$key] === 'CONFIRMAT' ? ' selected' : '') . '>CONFIRMAT</option>
                <option' . ($data[$key] === 'PENDENT' || $updateData[$key] === 'PENDENT' ? ' selected' : '') . '>PENDENT</option>
                <option' . ($data[$key] === 'WEB' || $updateData[$key] === 'WEB' ? ' selected' : '') . '>WEB</option>
            </select>';
            } else {
                $table .= '<input type="text" id="' . $key . '" name="' . $key . '"';
            }

            if ($key === 'id') {
                $table .= ' readonly';
            }

            if (isset($data[$key]) && $key !== 'estat') {
                $table .= ' value="' . $data[$key] . '"';
            }

            if (isset($updateData[$key]) && $key !== 'estat') {
                $table .= ' value="' . $updateData[$key] . '"';
            }

            if ($key !== 'estat') {
                $table .= '>';
            }

            if (isset($errors[$key])) {
                $table .= '<p class="error">' . $errors[$key] . '</p>';
            }
            $table .= '</td>';
        }

        if ($isCreate) {
            $table .= '<td><button type="submit" name="create">Crear</button></td></tr>';
        } else {
            $table .= '<td><button type="submit" name="update">Actualizar</button></td></tr>';
        }

        foreach ($objectArray as $result) {
            $table .= '<tr>';
            foreach ($result as $key => $value) {
                $table .= '<td>' . $value . '</td>';
            }
            $table .= '<td>
    <div class="button-container">
        <a href="?MantenimentPagament/showUpdate&id=' . $result->id . '">Actualizar</a>
<a href="?MantenimentPagament/delete&id=' . $result->id . '" class="delete-link" data-id="' . $result->id . '">Eliminar</a>
    </div>
</td>
</tr>';
        }

        $table .= '</tbody></table></form>';

        return $table;
    }
}