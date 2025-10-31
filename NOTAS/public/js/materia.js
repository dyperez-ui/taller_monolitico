function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar esta materia?")) {
        return; // cancelado
    }

    fetch("eliminar-materia.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Materia eliminada correctamente.");
            location.reload();
        } else if (data.trim() === "tiene_notas") {
            alert("No se puede eliminar la materia porque tiene notas registradas.");
        } else {
            alert("Error al eliminar la materia.");
        }
    })
    .catch(err => {
        console.error("Error al eliminar materia:", err);
        alert("Error en el servidor al intentar eliminar la materia.");
    });
}
