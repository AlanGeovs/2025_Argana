<?php
session_start();

require_once "model/model.php";
require_once "model/carrito.php";

if (!isset($_SESSION["idUser"])) {
    header("Location: index.php?error=2");
} else {
?>

    <!DOCTYPE html>
    <html lang="es">

    <!-- Header -->
    <?php require_once "header.php"; ?>

    <body class="light sidebar-mini sidebar-collapse">
        <!-- Pre loader -->
        <div id="loader" class="loader">
            <div class="plane-container">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="app">
            <?php include "menu.php" ?>
            <div class="container-fluid relative animatedParent animateOnce my-3">

                <div class="col-md-12">
                    <div class=" card b-0">
                        <div class="card-body p-5">
                        </div>
                    </div>
                </div>


                <div class="col-md-6 mt-5">
                    <div class=" card no-b">
                        <div class="card-body">
                            ads
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!-- Right Sidebar -->
        <?php include_once "right_sidebar_cart.php"; ?>
        <!-- End Right Sidebar -->


    </body>

    <!--/#app -->
    <script src="assets/js/app.js"></script>

    </html>

<?php
}//termina else