function onClickBorrarNota(id) {
    if (!confirm("¿Seguro que deseas eliminar esta nota?")) return;

    fetch("../../views/operaciones-notas/eliminar-notas.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id),
    })
    .then(res => res.text())
    .then(data => {
        console.log("Respuesta del servidor:", data);
        const respuesta = data.trim();

        if (respuesta === "ok") {
            alert("Nota eliminada correctamente.");
            location.reload();
        } else if (respuesta === "error") {
            alert("Error al eliminar la nota.");
        } else {
            alert("Respuesta inesperada del servidor: " + respuesta);
        }
    })
    .catch(err => {
        console.error("Error al eliminar la nota:", err);
        alert("Error al conectar con el servidor.");
    });
}
