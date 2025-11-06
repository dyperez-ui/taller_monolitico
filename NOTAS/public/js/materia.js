// ✅ /public/js/materia.js
function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar esta materia?")) return;

    fetch("../../views/operaciones-materias/borrar-materia.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(res => res.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Materia eliminada correctamente");
            location.reload();
        } else if (data.trim() === "tiene_notas") {
            alert("No se puede eliminar la materia porque tiene notas registradas.");
        } else if (data.trim() === "tiene_estudiantes") {
            alert("No se puede eliminar: la materia tiene estudiantes inscritos.");
        } else {
            alert("Error al eliminar la materia");
            console.error("Respuesta del servidor:", data);
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert(" Error en el servidor al eliminar la materia.");
    });
}
