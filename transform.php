<?php
function transformAST($ast) {
    $transformed = [];
    foreach ($ast as $node) {
        switch ($node['dataType']) {
            case "INT":
                $transformed[] = [
                    "type" => "DECLARE_INT",
                    "variable" => $node['variable'],
                    "value" => (int)$node['value']
                ];
                break;
            case "FLOAT":
                $transformed[] = [
                    "type" => "DECLARE_FLOAT",
                    "variable" => $node['variable'],
                    "value" => (float)$node['value']
                ];
                break;
            case "STRING":
                $transformed[] = [
                    "type" => "DECLARE_STRING",
                    "variable" => $node['variable'],
                    "value" => trim($node['value'], "\"")
                ];
                break;
        }
    }
    return $transformed;
}
?>
