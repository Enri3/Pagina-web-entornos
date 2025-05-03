<?php
include 'includes/header.php';
include 'includes/footer.php';
include 'includes/redireccion.php';

session_start();
if (isset($_SESSION['nombreUsuario'])) {
    // Si el usuario ya está logueado, redirigir a la página de inicio o a otra página
    redireccion($_SESSION['tipoUsuario']);
    exit;
}
renderHeader("Inicio - Altiora");
?>

<!-- ARREGLAR no me lee el style.css puse aca los css por ahora -->
<style>
 
 	.cards-wrapper {
 	    display: flex;
 	    justify-content: center;
			
 	}

 	.card img {
 	    max-width: 100%;
 	    max-height: 100%;
 	}

 	.card {
 	    margin: 0 0.5em;
 	    box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
 	    border: none;
 	    border-radius: 0;
 	}

 	.carousel-inner {
 	    padding: 1em;
 	}

 	.carousel-control-prev,
 	.carousel-control-next {
 	    background-color: #e1e1e1;
 	    width: 5vh;
 	    height: 5vh;
 	    border-radius: 50%;
 	    top: 50%;
 	    transform: translateY(-50%);
 	}

 	@media (min-width: 768px) {
 	    .card img {
 	        height: 11em;
 	    }
 	}
</style>

<!-- Acá inicia el index -->
<div class="container">
     <h1 class="text-center">Bienvenido a Altiora</h1>
			<?php
			if (!isset($_SESSION['nombreUsuario'])) {
			    echo '<h5 class="text-center "><i><a href=login.php>'.'Inicie sesión</a></i> para disfrutar todos los beneficios'.'</i></h5>';
			}
			?>
</div>

<!-- Carousel -->
<div id="carouselIndex" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
		<!-- Primeros 3 locales del carousel ES NECESARIO QUE HAYA UN CAROUSEL-ITEM ACTIVE -->
    <div class="carousel-item active">
      <div class="cards-wrapper">

				<!-- OPCION 1 DROPUP-->
        <div class="card">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>

            <!-- Boton para arriba -->
						<div class="dropup">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
						    Ver promociones <span class="badge text-bg-secondary">2</span>
						  </button>
								<!-- acordeon -->
								<div class="accordion accordion-flush dropdown-menu" id="accordionFlushExample">
								  <div class="accordion-item">
								    <h2 class="accordion-header">
								      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
								        30 OFF en MOCHILAS
								      </button>
								    </h2>
								    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								      <div class="accordion-body">
												<div>
													<p class= "mb-4">Aprovecha esta promo todos los clientes</p>

												</div>
											</div>
								    </div>
								  </div>

								  <div class="accordion-item">
								    <h2 class="accordion-header">
								      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
								        5 OFF en PERFUMES
								      </button>
								    </h2>
								    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								      <div class="accordion-body">
												<div>
													<p class= "mb-4">Aprovecha esta promo para clientes PREMIUM</p>

												</div>
											</div>
								    </div>
								  </div>

								  <div class="accordion-item">
								    <h2 class="accordion-header">
								      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
								        8 OFF en ZAPATILLAS
								      </button>
								    </h2>
								    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
								      <div class="accordion-body">
												<div>
													<p class= "mb-4">Aprovecha esta promo para clientes MEDIUM</p>

												</div>
											</div>
								    </div>
								  </div>
								</div>
						</div>

          </div>
        </div>

				<!-- OPCION 2 MODAL -->
        <div class="card d-none d-md-block">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>

            <!-- BOTON modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
						  Ver promociones <span class="badge text-bg-secondary">4</span>
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-scrollable">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="exampleModalLabel">Promociones local</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						        
										<!-- acordeon -->
										<div class="accordion accordion-flush" id="accordionFlushExample">
										  <div class="accordion-item">
										    <h2 class="accordion-header">
										      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
										        30 OFF en MOCHILAS
										      </button>
										    </h2>
										    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
										      <div class="accordion-body">
														<div>
															<p class= "mb-4">Aprovecha esta promo todos los clientes</p>

														</div>
													</div>
										    </div>
										  </div>

										  <div class="accordion-item">
										    <h2 class="accordion-header">
										      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
										        5 OFF en PERFUMES
										      </button>
										    </h2>
										    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
										      <div class="accordion-body">
														<div>
															<p class= "mb-4">Aprovecha esta promo para clientes PREMIUM</p>

														</div>
													</div>
										    </div>
										  </div>

										  <div class="accordion-item">
										    <h2 class="accordion-header">
										      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
										        8 OFF en ZAPATILLAS
										      </button>
										    </h2>
										    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
										      <div class="accordion-body">
														<div>
															<p class= "mb-4">Aprovecha esta promo para clientes MEDIUM</p>

														</div>
													</div>
										    </div>
										  </div>
										</div>

						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						      </div>
						    </div>
						  </div>
						</div>
          </div>
        </div>

				<!-- local 3 -->
        <div class="card d-none d-md-block">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>
            <a href="#" class="btn btn-secondary disabled" tabindex="-1" role="button" aria-disabled="true">No hay promociones</a>
          </div>
        </div>
      </div>
    </div>
		
		<!-- Segundo elemento del carousel -->
		<div class="carousel-item ">
      <div class="cards-wrapper">
        <div class="card">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>
            <a href="#" class="btn btn-primary">Ver promociones</a>
          </div>
        </div>
        <div class="card d-none d-md-block">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>
            <a href="#" class="btn btn-primary">Ver promociones</a>
          </div>
        </div>
        <div class="card d-none d-md-block">
          <img src="imagenes/mall1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text">Descripción local</p>
            <a href="#" class="btn btn-primary">Ver promociones</a>
          </div>
        </div>
      </div>
    </div>
    <!-- aca iria otro item carousel -->
  </div>

  <!-- Controles  -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndex" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselIndex" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

      
<?php renderFooter(); ?>
