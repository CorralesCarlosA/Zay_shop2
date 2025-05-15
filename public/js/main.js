
    // Selecciona la imagen principal y las miniaturas
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail');

    // Función para establecer la imagen principal
    const setMainImage = (src) => {
        mainImage.src = src;
    };

    // Escoge la primera miniatura como imagen principal al cargar
    if (thumbnails.length > 0) {
        setMainImage(thumbnails[0].src);
    }

    // Agrega eventos de clic a cada miniatura para cambiar la imagen principal
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            setMainImage(thumbnail.src);
        });
    });



    function mostrarSeccion(id) {
        // Ocultar todas las secciones
        const secciones = document.querySelectorAll('.seccion');
        secciones.forEach(seccion => {
          seccion.style.display = 'none';
        });
      
        // Mostrar la sección deseada
        const seccionActiva = document.getElementById(id);
        seccionActiva.style.display = 'block';
      }

      const opciones = document.querySelectorAll('.opcion');


 //sidebar de perfil     

// Obtén todas las opciones del menú
const opcionesSidebar = document.querySelectorAll('.opcion');

// Función para activar la opción seleccionada
function activarOpcionSidebar(opcion) {
  // Elimina la clase activa de todas las opciones
  opcionesSidebar.forEach(op => op.classList.remove('activo'));

  // Agrega la clase activa a la opción seleccionada
  opcion.classList.add('activo');
}

// Activa la primera opción por defecto al cargar la página
activarOpcionSidebar(opcionesSidebar[0]);

// Agrega el evento de clic a todas las opciones
opcionesSidebar.forEach(opcion => {
  opcion.addEventListener('click', () => {
    activarOpcionSidebar(opcion); // Activa la opción seleccionada al hacer clic
  });
});

// aqui termina sidebar 


//para el header 

//document.getElementById("navbar-toggler").addEventListener("click", function () {
  //document.getElementById("templatemo_main_nav").classList.toggle("show");
//});



//scrip del perfil y el inicio de sesion 

//aqui termina scrip del perfil y el inicio de sesion