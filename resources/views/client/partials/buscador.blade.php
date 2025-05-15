                    <!--Buscar en el buscador-->

                    <!-- Buscador 
                    <form class="form" method="post">
                        <input class="input" id="productoBuscado" placeholder="Buscar" oninput="buscarProducto()">
                        <button onclick="return false" class="button"><i
                                class="fa fa-fw fa-search text-dark mr-2"></i></button>
                    </form> -->
                    <!--Buscar en el buscador-->
                    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="w-100 pt-1 mb-5 text-right">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="inputModalSearch" name="q"
                                        placeholder="Search ...">
                                    <button type="submit" class="input-group-text bg-success text-light">
                                        <i class="fa fa-fw fa-search text-white"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                    function buscarProducto() {
                        var input, filter, productos, producto, i, txtValue;
                        input = document.getElementById('productoBuscado');
                        filter = input.value.toUpperCase();
                        productos = document.getElementById('productos');
                        producto = productos.getElementsByClassName('producto');

                        for (i = 0; i < producto.length; i++) {
                            txtValue = producto[i].textContent || producto[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                producto[i].style.display = '';
                            } else {
                                producto[i].style.display = 'none';
                            }
                        }
                    }
                    </script>


                    <style>
                    .form {
                        display: flex;
                        margin: 10px;
                    }

                    .input[name="Buscar"] {
                        padding: 5px;
                        flex: 1;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        width: 100px;
                    }

                    .button {
                        padding: 5px 10px;
                        background-color: green;
                        border: none;
                    }
                    </style>