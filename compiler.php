<?php
// Incluir los archivos que contienen las funciones
include 'lexer.php';
include 'parser.php';
include 'semantic.php';
include 'codegen.php';
include 'transform.php'; // Incluir el archivo de transformación

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el código fuente
    $sourceCode = $_POST["source_code"];

    // Paso 1: Analizador Léxico
    $tokens = lexer($sourceCode);

    // Paso 2: Analizador Sintáctico (AST)
    $ast = parse($tokens);

    // Paso 3: Análisis Semántico
    $semanticErrors = semanticAnalysis($ast);

    // Paso 4: Transformar el AST
    $transformedAST = transformAST($ast);  // Aplicar la transformación

    // Paso 5: Generación de Código Intermedio
    $generatedCode = generateCode($transformedAST);

    // Preparar la respuesta
    $response = [
        "tokens" => $tokens,
        "ast_parsed" => $ast,
        "ast_transformed" => $transformedAST,  // Usar el AST transformado
        "semantic_errors" => $semanticErrors,
        "generated_code" => $generatedCode
    ];

    // Devolver respuesta en formato JSON
    echo json_encode($response);
}
?>
