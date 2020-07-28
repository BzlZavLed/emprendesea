<?php
    definiciones(true);
    /**
     *
     */
    class Template{
        public $siteURL = DIRECCION_BLOG;
        public $titulo = K_TITULO;
        public $sitio = K_SITIO;
        public $keywords = K_KEYWORDS;
        public $description = K_DESCRIPTION;
        public $img = K_IMG;
        public $urlPage = DIRECCION_BLOG;
        public $canonical = DIRECCION_BLOG;
        function __construct(){
            // code...
        }
        function head(){
            ?>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="author" content="Comunicación Institucional UM" />
            <link rel="icon" type="image/png" href="<?php echo $this->siteURL; ?>assets/images/Temporal/logo-movil-color.png">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Document title -->
            <title><?php echo $this->sitio; ?> | <?php echo $this->titulo; ?></title>
            <!-- Stylesheets & Fonts -->

            <!-- Canonical SEO -->
            <link rel="canonical" href="<?php echo $this->canonical; ?>" />
            <!--  Social tags      -->
            <meta name="keywords" content="<?php echo $this->keywords; ?>">
            <meta name="description"
                content="<?php echo $this->description; ?>">
            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="<?php echo $this->sitio . " | " . $this->titulo; ?>">
            <meta itemprop="description" content="<?php echo $this->description; ?>">
            <meta itemprop="image" content="<?php echo $this->img; ?>">
            <!-- Twitter Card data -->
            <meta name="twitter:card" content="post">
            <meta name="twitter:site" content="@UniMontemorelos">
            <meta name="twitter:title" content="<?php echo $this->sitio . " | " . $this->titulo; ?>">
            <meta name="twitter:description"
                content="<?php echo $this->description; ?>">
            <meta name="twitter:creator" content="@UniMontemorelos">
            <meta name="twitter:image"
                content="<?php echo $this->img; ?>">
            <!-- Open Graph data -->
            <meta property="fb:app_id" content="2767020349985770">
            <meta property="og:title" content="<?php echo $this->sitio . " | " . $this->titulo; ?>" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="<?php echo $this->urlPage; ?>" />
            <meta property="og:image"
                content="<?php echo $this->img; ?>" />
            <meta property="og:description"
                content="<?php echo $this->description; ?>" />
            <meta property="og:site_name" content="<?php echo $this->sitio; ?>" />

            <link href="<?php echo $this->siteURL; ?>assets/css/plugins.css" rel="stylesheet">
            <link href="<?php echo $this->siteURL; ?>assets/css/style.css" rel="stylesheet">
            <link href="<?php echo $this->siteURL; ?>assets/css/custom.css" rel="stylesheet">
            <?php
        }
        function menu($transparent = true){
            ?>
            <!-- Header -->
            <header id="header" <?php if($transparent){echo "data-transparent='true'";} ?> data-fullwidth="true" class="header-mini dark">
                <div class="header-inner">
                    <div class="container">
                        <!--Logo-->
                        <div id="logo">
                            <a href="index.html">
                                <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/logo-lap.png" class="logo-default" alt="logo">
                                <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/logo-lap.png" class="logo-dark" alt="logo">
                                <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/logo-movil.png" class="logo-responsive" alt="logo">
                            </a>
                        </div>
                        <!--End: Logo-->
                        <!--Navigation Resposnive Trigger-->
                        <div id="mainMenu-trigger">
                            <a class="lines-button x"><span class="lines"></span></a>
                        </div>
                        <!--end: Navigation Resposnive Trigger-->
                        <!--Navigation-->
                        <div id="mainMenu">
                            <div class="container">
                                <nav>
                                    <ul>
                                        <li><a href="<?php echo $this->siteURL; ?>">INICIO</a></li>
                                        <li><a href="<?php echo $this->siteURL; ?>historias.php">NUESTRA HISTORIA</a></li>
                                        <li><a href="<?php echo $this->siteURL; ?>universitarios.php">UNIVERSITARIOS</a></li>
                                        <li><a href="index.html">LIBRERIA</a></li>
                                        <li><a href="index.html">CARRITO</a></li>
                                        <li><a href="index.html">MI PEDIDO</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!--end: Navigation-->
                    </div>
                </div>
            </header>
            <!-- end: Header -->
            <?php
        }
        function footer(){
            ?>
            <!-- Footer -->
            <footer id="footer" style="background-color: #25338C;">
                <div class="container p-t-30">
                    <div class="row text-white">
                        <div class="col-lg-4">
                            <div class="widget">
                                <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/logo-lap.png" width="100%" alt="logo">
                                <div class="row m-t-30 align-items-end">
                                    <div class="col-4">
                                        <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/vivir_sano.png" width="100%" alt="logo">
                                    </div>
                                    <div class="col-8">
                                        <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/frase.png" width="100%" alt="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="widget">
                                        <div class="widget-title">Explorar</div>
                                        <ul class="list">
                                            <li><a href="#">Inicio</a></li>
                                            <li><a href="#">Súmate al esfuerzo</a></li>
                                            <li><a href="#">Librería</a></li>
                                            <li><a href="#">Carrito</a></li>
                                            <li><a href="#">Mi pedido</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget">
                                        <div class="widget-title">Conócenos</div>
                                        <ul class="list">
                                            <li><a href="#">Nuestra historia</a></li>
                                            <li><a href="#">BLog de historias</a></li>
                                            <li><a href="#">Contacto</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget">
                                        <div class="widget-title">Legal</div>
                                        <ul class="list">
                                            <li><a href="#">Aviso de privacidad</a></li>
                                            <li><a href="#">Términos y condiciones</a></li>
                                            <li><a href="#">Preguntas frecuentes</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <div class="widget">
                                        <div class="widget-title">Síguenos</div>
                                        <div class="social-icons social-icons-colored-hover">
                                            <ul>
                                                <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                                <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="<?php echo $this->siteURL; ?>assets/images/Temporal/mm.png" width="100%" alt="logo">
                                        <div class="text-center">
                                            &copy; 2020 EMPRENDUM
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end: Footer -->
            <?php
        }
        function scripts(){
            ?>
            <!-- Scroll top -->
            <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
            <!--Plugins-->
            <script src="<?php echo $this->siteURL; ?>assets/js/jquery.js"></script>
            <script src="<?php echo $this->siteURL; ?>assets/js/plugins.js"></script>
            <!--Template functions-->
            <script src="<?php echo $this->siteURL; ?>assets/js/functions.js"></script>
            <?php
        }
    }
    function definiciones($local = true){
        // Datos de sitio web
        define('K_SITIO','Emprendum');
        define('K_TITULO','Inicio');
        define('K_KEYWORDS','UM,Universidad de Montemorelos,Montemorelos,Emprendum, Colportaje, Colportor');
        define('K_DESCRIPTION','Para sumarte a la causa y poder ayudarte también, contamos con una librería dedicada al fondo de becas de nuestros universitarios.');
        if ($local) {
            // Conexion base de datos
            define('KIBOU_DB','KIBOU');
            define('KIBOU_USUARIO','sistema');
            define('KIBOU_PASS','1234');
            define('KIBOU_SERVIDOR','localhost');

            //URL de navegacion de todos los archivos
            define('DIRECCION_BLOG','http://localhost/Emprendum-web/');
            define('K_IMG','https://localhost/Emprendum-web/images/blogUM/logo_social.jpg');
        } else {
            // Conexion base de datos
            define('KIBOU_DB','blog');
            define('KIBOU_USUARIO','blog');
            define('KIBOU_PASS','unimon2020');
            define('KIBOU_SERVIDOR','localhost');

            //URL de navegacion de todos los archivos
            define('DIRECCION_BLOG','https://emprendum.um.edu.mx/');
            define('K_IMG','https://eventos.um.edu.mx/eventos/assets/images/desarrollo/sld2.jpg');
        }
    }
?>
