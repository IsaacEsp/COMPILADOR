<?php
// Función de análisis léxico
function lexer($code) {
    $tokens = [];
    preg_match_all("/[a-zA-Z_][a-zA-Z0-9_]*|[0-9]+(?:\.[0-9]+)?|\"[^\"]*\"|\+|\-|\*|\/|\=|\;|\{|\}|\(|\)/", $code, $matches);
    foreach ($matches[0] as $match) {
        if (is_numeric($match)) {
            $tokens[] = ["type" => "NUMBER", "value" => $match];
        } elseif (in_array($match, ["INT", "FLOAT", "STRING"])) {
            $tokens[] = ["type" => "KEYWORD", "value" => $match];
        } elseif ($match[0] == "\"") {
            $tokens[] = ["type" => "STRING", "value" => $match];
        } elseif (preg_match("/[a-zA-Z_][a-zA-Z0-9_]*/", $match)) {
            $tokens[] = ["type" => "IDENTIFIER", "value" => $match];
        } else {
            $tokens[] = ["type" => "OPERATOR", "value" => $match];
        }
    }
    return $tokens;
}
?>
