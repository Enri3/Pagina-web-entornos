<?php
require_once 'includes/header.php';
require_once 'includes/footer.php';

renderHeader("Sobre Nosotros");
?>

<section class="bg-white p-5 rounded shadow-sm">
    <h1 class="text-center mb-4">Sobre Nosotros</h1>
    <p class="text-justify">
        Bienvenido a <strong>Altiora</strong>, el portal que revoluciona la forma en la que accedés a descuentos y promociones en tu shopping favorito.
    </p>
    <p class="text-justify">
        Nuestro objetivo es ofrecerte una experiencia cómoda, moderna y eficiente para encontrar las mejores oportunidades de compra, tanto para clientes como para los dueños de locales.
    </p>

    <div class="row mt-5">
        <div class="col-md-6">
            <h3>Misión</h3>
            <p>
                Facilitar la conexión entre los comercios y los usuarios, digitalizando el acceso a promociones de forma segura, simple y rápida.
            </p>
        </div>
        <div class="col-md-6">
            <h3>Visión</h3>
            <p>
                Ser la plataforma líder en gestión de beneficios dentro de centros comerciales, mejorando continuamente la experiencia de compra.
            </p>
        </div>
    </div>

    <div class="mt-5">
        <h3>Contacto</h3>
        <ul class="list-unstyled">
            <li><strong>Email:</strong> administrador@shopping.com.ar</li>
            <li><strong>Teléfono:</strong> (0341) 123-4567</li>
            <li><strong>Dirección:</strong> Bv. Oroño 1234, Rosario, Argentina</li>
        </ul>
    </div>
    <div class="mt-5">
    <h3 class="text-center mb-4">Nuestro Equipo</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Agustín -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-circle display-3 text-primary mb-3"></i>
                    <h5 class="card-title">Agustín Barroso</h5>
                    <p class="card-text">Rol: Novio de Juanchi</p>
                    <p class="card-text"><small>Email: agusbarrosobollero@gmail.com</small></p>
                </div>
            </div>
        </div>

        <!-- Lautaro -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-circle display-3 text-primary mb-3"></i>
                    <h5 class="card-title">Lautaro Ponce</h5>
                    <p class="card-text">Rol: Desarrollo Backend</p>
                    <p class="card-text"><small>Email: lautaroponce03@gmail.com</small></p>
                </div>
            </div>
        </div>

        <!-- Enrico -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-circle display-3 text-primary mb-3"></i>
                    <h5 class="card-title">Enrico Reschini</h5>
                    <p class="card-text">Rol: Tralalero tralala</p>
                    <p class="card-text"><small>Email: ereschini06@gmail.com</small></p>
                </div>
            </div>
        </div>

        <!-- Victoria -->
        <div class="col">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-circle display-3 text-primary mb-3"></i>
                    <h5 class="card-title">Victoria Caracchi</h5>
                    <p class="card-text">Rol: Desarrollo Frontend</p>
                    <p class="card-text"><small>Email: vickypau1d@gmail.com</small></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?php renderFooter(); ?>