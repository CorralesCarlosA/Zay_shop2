<!DOCTYPE html>
<html lang="en">




@include('client.partials.header')

    <main>
        <section class="product-details item">
            <div class="product-images ">
                <img id="mainImage" src="" alt="Imagen del producto" class="main-image">
                <div class="thumbnail-images">
                    <img src="img/Image.png" alt="Color rojo" class="thumbnail item-image">
                    <img src="img/Image1.png" alt="Color verde" class="thumbnail">
                    <img src="img/Image2.png" alt="Color gris" class="thumbnail">
                    <img src="img/Image4.png" alt="Color naranja" class="thumbnail">
                </div>
            </div>
       
            <div class="product-info producto" id="producto1">
                <h2 class="item-title">Zapatos Deportivos Transpirables</h2>
                <p>Descripción breve sobre el producto.</p>
                <strong>Precio:</strong><h4 class="item-price precio">$243956</h4>
                <form>
                    <label for="size">Talla:</label>
                    <select id="size">
                        <option value="34">34</option>
                        <!-- Agregar más tallas -->
                    </select>
                    <label for="quantity">Cantidad:</label>
                    <input type="number" id="quantity" value="1" min="1">
                    <div style="margin-top: 10px;">

                    <button onclick="producto()"  class=" addToCart add-to-cart">Agregar al Carrito</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="product-reviews">
            <h3>Opiniones del Producto</h3>
            <div class="review">
                <p><strong>Juan:</strong> Producto excelente. ⭐⭐⭐⭐⭐</p>
                <p>La calidad superó mis expectativas.</p>
            </div>
            <!-- Agregar más opiniones -->
        </section>
    </main>
    

    @include('client.partials.footer')

    <!-- Start Script -->
    <script src="frontend/js/foto_move.js"></script>
    <!-- End Script -->

</body>
</html>