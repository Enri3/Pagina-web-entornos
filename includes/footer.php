<!--
De la misma forma que el header,  el footer se incluye en todas las pags.
-->

<?php
function renderFooter() {
    echo <<<HTML
        </main>

        <footer class="text-white pt-4 pb-2 mt-5 letra fondo_Barras fixed-bottom">
            <div class="container">
                <div class="justify-content-center d-flex gap-3">
                    <h5><a href="info_contacto.php" class="text-white hover-subrayado">Sobre Nosotros</a></h5>
                    <p>|</p>
                    <h5><a href="#" class="text-white hover-subrayado">Mapa del Sitio</a></h5>
                </div>
                <hr class="border-top border-light">
                <div class="text-center small">
                    © 2025 Altiora. Todos los derechos reservados.
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    HTML;
}
?>