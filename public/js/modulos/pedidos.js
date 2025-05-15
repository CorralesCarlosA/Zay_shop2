let tblPendientes, tblFinalizados, tblProceso;

const myModal = new bootstrap.Modal(document.getElementById("modalPedidos"));

document.addEventListener("DOMContentLoaded", function () {
    tblPendientes = $("#tblPendientes").DataTable({
        ajax: {
            url: listarPedidosUrl,
            dataSrc: "",
        },
        columns: [
            { data: "id_transaccion" },
            { data: "monto" },
            { data: "estado" },
            { data: "fecha" },
            { data: "email" },
            { data: "nombre" },
            { data: "apellido" },
            { data: "direccion" },
            { data: "accion" },
        ],
        language,
        dom,
        buttons,
    });

    tblProceso = $("#tblProceso").DataTable({
        ajax: {
            url: listarProcesoUrl,
            dataSrc: "",
        },
        columns: [
            { data: "id_transaccion" },
            { data: "monto" },
            { data: "estado" },
            { data: "fecha" },
            { data: "email" },
            { data: "nombre" },
            { data: "apellido" },
            { data: "direccion" },
            { data: "accion" },
        ],
        language,
        dom,
        buttons,
    });

    tblFinalizados = $("#tblFinalizados").DataTable({
        ajax: {
            url: listarFinalizadosUrl,
            dataSrc: "",
        },
        columns: [
            { data: "id_transaccion" },
            { data: "monto" },
            { data: "estado" },
            { data: "fecha" },
            { data: "email" },
            { data: "nombre" },
            { data: "apellido" },
            { data: "direccion" },
            { data: "accion" },
        ],
        language,
        dom,
        buttons,
    });
});

function cambiarProceso(idPedido, proceso) {
    Swal.fire({
        title: "Aviso",
        text: "¿Está seguro de cambiar el estado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.get(actualizarPedidoUrl.replace("__ID__", idPedido).replace("__PROCESO__", proceso))
                .then(response => {
                    const res = response.data;
                    if (res.icono === "success") {
                        tblPendientes.ajax.reload();
                        tblProceso.ajax.reload();
                        tblFinalizados.ajax.reload();
                    }
                    Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
                })
                .catch(error => console.error(error));
        }
    });
}

function verPedido(idPedido) {
    axios.get(verPedidoUrl)
        .then(response => {
            const res = response.data;
            let html = '';
            res.productos.forEach(row => {
                let subTotal = parseFloat(row.precio) * parseInt(row.cantidad);
                html += `<tr>
                    <td>${row.producto}</td>
                    <td><span class="badge bg-warning">${res.moneda} ${row.precio}</span></td>
                    <td><span class="badge bg-primary">${row.cantidad}</span></td>
                    <td>${subTotal.toFixed(2)}</td>
                </tr>`;
            });
            document.querySelector('#tablePedidos tbody').innerHTML = html;
            myModal.show();
        })
        .catch(error => console.error(error));
}