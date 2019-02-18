<section class="busqueda">
    <form class="bus-fil">
        <fieldset>
            <legend>Tipo</legend>
    
        </fieldset>
        <fieldset>
            <legend>Marca</legend>

        </fieldset>
    </form>
    <ul class="bus-pro">
        <?php Producto::cargarTodosProductos() as $p: ?>
            <li id="pr-<?= $p['id'] ?>">
                <img src="/resources/img/productos/<?= $p['id'] ?>.jpg" alt="<?= $p['nombre'] ?>"/>
                <p class="precioGrande"><?= $p['precio'] ?>€</p>
                <p class="stock"></p>
                <h3><?= $p['nombre'] ?></h3>
            </li>
        <?php endforeach; ?>
    </ul>
</section>