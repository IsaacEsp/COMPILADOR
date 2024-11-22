<?php
// Función de análisis semántico
function semanticAnalysis($ast) {
    $variables = [];
    $errors = [];

    foreach ($ast as $node) {
        if ($node['type'] == 'DECLARATION') {
            if (isset($variables[$node['variable']])) {
                $errors[] = "Error: La variable '" . $node['variable'] . "' ya ha sido declarada.";
            } else {
                $variables[$node['variable']] = $node['dataType'];
            }
            // Verificar si el tipo de valor es correcto
            if ($node['dataType'] == "INT" && !is_numeric($node['value'])) {
                $errors[] = "Error: El valor de '" . $node['variable'] . "' debe ser un número entero.";
            } elseif ($node['dataType'] == "FLOAT" && !is_numeric($node['value'])) {
                $errors[] = "Error: El valor de '" . $node['variable'] . "' debe ser un número flotante.";
            } elseif ($node['dataType'] == "STRING" && !is_string($node['value'])) {
                $errors[] = "Error: El valor de '" . $node['variable'] . "' debe ser una cadena de texto.";
            }
        }
    }

    return $errors;
}
?>
