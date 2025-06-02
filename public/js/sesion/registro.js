document.getElementById("clientRegisterForm").addEventListener("submit", function (event) {
    event.preventDefault();
    
    let formData = new FormData(this);

    axios.post('/cliente/registro', formData)
        .then(response => {
            console.log("✅ Registro exitoso:", response.data);
            document.getElementById("responseMessage").innerHTML =
                '<div class="alert alert-success">' + response.data.message + '</div>';
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




/*document.getElementById("clientRegisterForm").addEventListener("submit", function (event) {
    event.preventDefault();
    
    let formData = new FormData(this);

    axios.post('/cliente/registro', formData)
        .then(response => {
            console.log("✅ Registro exitoso:", response.data);
            alert("✔ " + response.data.message); // Mostrar alerta de éxito
        })
        .catch(error => {
            console.error("❌ Error en la solicitud:", error.response.data.errors);

            // Si hay errores de validación, mostrarlos en un alert
            if (error.response && error.response.data.errors) {
                let errors = error.response.data.errors;
                let errorMessage = "⚠️ Error en la validación:\n";
                Object.keys(errors).forEach(key => {
                    errorMessage += "- " + errors[key][0] + "\n";
                });
                alert(errorMessage); // Mostrar errores en alerta
            } else {
                alert("⚠️ Error inesperado. Inténtalo de nuevo.");
            }
        });
});
*/



/*
document.getElementById("clientRegisterForm").addEventListener("submit", function (event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    console.log(formData)

    axios.post('/cliente/registro', formData)
        .then(response => {
            console.log("Respuesta del servidor:", response.data); // Mue
            document.getElementById("responseMessage").innerHTML =
                '<div class="alert alert-success">' + response.data.message + '</div>';
        })
        .catch(error => {
            let errors = error.response.data.errors;
            let errorMessage = '<div class="alert alert-danger">';
            Object.values(errors).forEach(msg => {
                errorMessage += "<p>" + msg[0] + "</p>";
            });
            errorMessage += "</div>";
            document.getElementById("responseMessage").innerHTML = errorMessage;
        });
});*/