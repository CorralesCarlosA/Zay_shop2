document.getElementById("clientLoginForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar recargar la página

    let formData = new FormData(this);

    axios.post('/cliente/login', formData)
        .then(response => {
            console.log("✅ Inicio de sesión exitoso:", response.data);

            // Mostrar mensaje de éxito en la vista
            document.getElementById("responseMessage").innerHTML =
                '<div class="alert alert-success">' + response.data.message + '</div>';

            // Redirigir a otra página si el login es correcto (Opcional)
            setTimeout(() => {
                window.location.href = response.data.redirect; // Cambia a la página de inicio que corresponda
            }, 2000);
        })
        .catch(error => {
            console.error("❌ Error en la solicitud:", error.response.data.errors);

            if (error.response && error.response.data.errors) {
                let errors = error.response.data.errors;
                let errorMessage = '<div class="alert alert-danger">';
                Object.keys(errors).forEach(key => {
                    errorMessage += "<p><strong>" + key + ":</strong> " + errors[key][0] + "</p>";
                });
                errorMessage += "</div>";
                document.getElementById("responseMessage").innerHTML = errorMessage;
            } else {
                document.getElementById("responseMessage").innerHTML =
                    '<div class="alert alert-danger">Error inesperado. Inténtalo de nuevo.</div>';
            }
        });
});