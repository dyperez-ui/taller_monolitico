function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar este estudiante?")) {
        return;
    }

    fetch("eliminar-estudiante.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Estudiante eliminado correctamente.");
            location.reload();
        } else if (data.trim() === "tiene_notas") {
            alert("No se puede eliminar el estudiante porque tiene notas registradas.");
        } else {
            alert("Error al eliminar el estudiante.");
        }
    })
    .catch(err => {
        console.error("Error al eliminar estudiante:", err);
        alert("Ocurrió un error al intentar eliminar el estudiante.");
    });
}
