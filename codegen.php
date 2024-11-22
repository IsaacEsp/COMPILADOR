<?php
// Función de generación de código
function generateCode($ast) {
    $generatedCode = [];

    foreach ($ast as $node) {
        switch ($node['type']) {
            case 'DECLARE_INT':
                $generatedCode[] = "DECLARE " . $node['variable'] . " AS INT = " . $node['value'];
                break;
            case 'DECLARE_FLOAT':
                $generatedCode[] = "DECLARE " . $node['variable'] . " AS FLOAT = " . $node['value'];
                break;
            case 'DECLARE_STRING':
                $generatedCode[] = "DECLARE " . $node['variable'] . " AS STRING = \"" . $node['value'] . "\"";
                break;
            default:
                // Si no es un tipo que esperamos, ignorarlo o lanzar un error.
                break;
        }
    }

    return $generatedCode;
}
?>
