<div id="IrVentanaFlotante" class="vtn">
                        <div class="ventana">
                            <a href="#" style='text-decoration:none; color:#B78732;'>X</a>


                            <!-- Carrito -->
                            <section class="shopping-cart">
                                <div class="container">
                                    <h1 class="text-center" style="color: #B78732; font-size: 36px;">Mi Carrito de
                                        Compras</h1>
                                    <hr style="border-top: 2px solid #B78732;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="shopping-cart-header">
                                                <h6>Producto</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6 class="text-truncate">Precio</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6>Cantidad</h6>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="shopping-cart-header">
                                                <h6>Eliminar</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tamaño" class="shopping-cart-items shoppingCartItemsContainer"></div>

                                    <!-- TOTAL -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="shopping-cart-total d-flex justify-content-lg-between align-items-center">
                                                <p class="mb-0" style="color: #B78732; font-size: 24px;">TOTAL:</p>
                                                <p class="text-start ml-4 mb-0 shoppingCartTotal"
                                                    style="color: #000; font-size: 24px;">$0</p>
                                                <div class="toast ml-auto bg-info" role="alert" aria-live="assertive"
                                                    aria-atomic="true" data-delay="2000">
                                                </div>
                                                <br><br><br>
                                                <div class=" btn-container-wrapper">
                                                    <div class="btn-container">
                                                        <button class="btn btn-success comprarButton" type="button"
                                                            data-toggle="modal" data-target="#comprarModal"
                                                            onclick="compra()">Comprar</button>
                                                        <button class="btn btn-success" type="button"
                                                            data-toggle="modal" onclick="mostrarFactura()">Generar
                                                            Factura</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- FACTURA -->
                            <div class="factura" id="miFactura">
                                <button onclick="cerrarFactura()"
                                    style="position: absolute; top: -5px; right: -5px; background-color: transparent; color: red; border: none; font-size: 15px; padding: 5px 10px; border-radius: 50%; cursor: pointer;">X</button>
                                <h2 style="color: #B78732; font-size: 28px;">Factura de Compra</h2>
                                <p style="font-size: 18px;">Cliente: <?php echo @$nombre_user_sesion; ?></p>
                                <table style="width: 100%; margin-top: 20px;">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                    </tr>
                                    <tbody id="carritoFactura">
                                        <!-- Aquí se agregarán las filas de la factura -->
                                    </tbody>
                                </table>
                                <p style="font-size: 18px; margin-top: 20px;">Total: <span id="totalCompra"
                                        style="color: #B78732;">$0.00</span></p>
                                <button id="imprimirBtn" onclick="imprimirFactura()">Imprimir Factura</button>
                                
                            </div>
                        </div>
                    </div>
