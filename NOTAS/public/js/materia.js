function onClickBorrar(codigo) {
    // Preguntar antes de eliminar
    if (!confirm("¿Estás seguro de que quieres eliminar esta materia?")) {
        return; // El usuario canceló
    }

    // Enviar solicitud al servidor
    fetch("borrar-materia.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + codigo
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(data) {
        // Quitar espacios extras de la respuesta
        var respuesta = data.trim();
        
        // Verificar qué respondió el servidor
        if (respuesta === "ok") {
            alert(" Materia eliminada correctamente");
           
            location.reload();
        } else if (respuesta === "tiene_notas") {
            alert(" No se puede eliminar - tiene notas registradas");
        } else {
            alert(" Error al eliminar la materia");
        }
    })
    .catch(function(error) {
        // Si hay error de conexión
        console.log("Error:", error);
        alert("rror de conexión con el servidor");
    });
}