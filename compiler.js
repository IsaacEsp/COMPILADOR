function compileCode() {
    const sourceCode = document.getElementById("source-code").value;

    // Realizar la petición al backend
    fetch("compiler.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `source_code=${encodeURIComponent(sourceCode)}`
    })
    .then(response => response.json())
    .then(data => {
        // Mostrar los resultados
        document.getElementById("tokens").textContent = JSON.stringify(data.tokens, null, 2);
        document.getElementById("ast-parsed").textContent = JSON.stringify(data.ast_parsed, null, 2);
        document.getElementById("ast-transformed").textContent = JSON.stringify(data.ast_transformed, null, 2);
        document.getElementById("generated-code").textContent = data.generated_code.join("\n");

        // Si hay errores semánticos, mostrarlos
        if (data.semantic_errors.length > 0) {
            alert("Errores semánticos:\n" + data.semantic_errors.join("\n"));
        }
    })
    .catch(error => console.error("Error:", error));
}
