<section id="pag-busqueda" class="ocultar">
    <form class="bus-fil">
        <fieldset class="fil-categoria">
            <p>Tipo</p>
            <?php foreach (Producto::cargarCategorias() as $c): ?>
                <div>
                    <label for="<?= $c['categoria'] ?>"><input type="checkbox" name="categorias" id="<?= $c['categoria'] ?>"><?= $c['categoria'] ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <fieldset class="fil-fabricante">
            <p>Marca</p>
            <?php foreach (Producto::cargarFabricantes() as $f): ?>
                <div>
                    <label for="<?= $f['fabricante'] ?>"><input type="checkbox" name="fabricante" id="<?= $f['fabricante'] ?>"><?= $f['fabricante'] ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
    </form>
    <h1>Listado de productos</h1>
    <ul class="bus-pro">
        <?php foreach (Producto::cargarTodosProductos() as $p): ?>
            <li id="<?= $p['id'] ?>" class="tarjetaProducto">
                <img src="/resources/img/productos/<?= $p['id'] ?>.jpg" alt="<?= $p['nombre'] ?>"/>
                <p class="precioGrande"><?= $p['precio'] ?>€</p>
                <p class="stock"></p>
                <h3><?= $p['nombre'] ?></h3>
            </li>
        <?php endforeach; ?>
    </ul>
    <button class="bus-clo">X</button>
</section>
<script src="busqueda/busqueda.js"></script>