<?php
// Función de análisis sintáctico
function parse($tokens) {
    $ast = [];
    $i = 0;
    while ($i < count($tokens)) {
        $token = $tokens[$i];
        if ($token['type'] == 'KEYWORD' && in_array($token['value'], ["INT", "FLOAT", "STRING"])) {
            $varType = $token['value'];  // Guardamos el tipo de variable (INT, FLOAT, STRING)
            $variable = $tokens[$i + 1]['value'];  // El siguiente token es el nombre de la variable
            $i += 2;  // Avanzamos dos tokens, ya que los siguientes son el nombre y el operador
            
            if ($tokens[$i]['value'] == '=') {
                $i++; // Avanzamos por el operador de asignación
                $value = $tokens[$i]['value'];  // El valor a asignar
                $ast[] = [
                    "type" => "DECLARATION",
                    "variable" => $variable,
                    "value" => $value,
                    "dataType" => $varType
                ];
                $i++;
            }
        } else {
            $i++;
        }
    }
    return $ast;
}
?>
