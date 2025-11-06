function onClickBorrarNota(id) {
    if (!confirm("¿Seguro que deseas eliminar esta nota?")) return;

    fetch("../../views/operaciones-notas/borrar-nota.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id),
    })
    .then(res => res.text())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.trim() === "ok") {
            alert("Nota eliminada correctamente.");
            location.reload();
        } else if (data.trim() === "not_found") {
            alert("No se encontró la nota en la base de datos.");
        } else if (data.trim() === "invalid_request") {
            alert("Solicitud inválida.");
        } else {
            alert(" Error al eliminar la nota.");
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Error de conexión con el servidor.");
    });
}
