<?php
    include 'config.php';
    include 'cart.php';
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        $str_bienvenida = "Iniciar sesión";
        $str_link = "login";
    } else {
        $str_bienvenida = $_SESSION["nombre"];
        $str_link = "my-account";
    }

    $query = $link->query("SELECT * FROM novedades");
    $row = $query->fetch_assoc();

    $id = array();
    $nombre = array();
    $artista = array();
    $cover = array();
    $tipo = array();
    $precio = array();
    $precioV = array();
    $precioD = array();
    $cont = 0;
    $descuento = "0.00";

    while ($row = mysqli_fetch_array($query)) {
        $id[$cont] = $row['id'];
        $nombre[$cont] = $row['nombre'];
        $artista[$cont] = $row['artista'];
        $cover[$cont] = base64_encode($row['img']);
        $tipo[$cont] = $row['tipo'];
        $precioV[$cont] = $row['precioV'];
        $precioD[$cont] = $row['precioD'];
        $cont++;

        if($precioD[$cont] === $descuento) {
            $precio[$cont] = $precioV[$cont];
            $descStyle = "rebaja";
        } else {
            $precio[$cont] = $precioD[$cont];
            $descStyleD = "precioD";
        }
    }
?>

<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <meta name="description" content="Bienvenido a BandUp, la tienda musical en línea donde puedes conseguir la música de tus artistas favoritos en cualquier formato.">
    <meta property="og:image" content="/img/600x315.png">
    <title>BandUp</title>

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/cc543942d6.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Montserrat:wght@700&display=swap"
        rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/styles.css" as="style" rel="preload">
    <link href="css/styles.css" rel="stylesheet">

</head>

<body class="">
    <div class="slider-superior">
        <div class="slider-superior-movimiento">
            <div class="ofertas">
                <a href="#">ENVÍO GRATIS EN ÓRDENES CON VALOR IGUAL O MAYOR A $799</a>
            </div>
            <div class="ofertas">
                <a href="#">20% DE DESCUENTO EN TODA LA COLECCIÓN "CAMBIOS DE LUNA"</a>
            </div>
            <div class="ofertas">
                <a href="#">SUSCRÍBETE AL NEWSLETTER Y LLÉVATE UN 10% DE DESCUENTO</a>
            </div>
            <div class="ofertas">
                <a href="#">POR TIEMPO LIMITADO: ARTÍCULOS DE PREVENTA EN OFERTA</a>
            </div>
        </div>
    </div>

    <div id="logoR" class="logo-responsivo">
        <div class="usuario">
            <nav >
                <label class="lupa-carrito" for="menu-toggle">
                    <div class="botonMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </label>
                <input type="checkbox" id="menu-toggle" />
                    <ul id="trickMenu">
                        <li><a href="https://bandup.monkeydevs.mx">INICIO</a></li>
                        <li><a href="https://bandup.monkeydevs.mx/quienes-somos">QUIÉNES SOMOS</a></li>
                        <li><a href="#">CATÁLOGO</a></li>
                        <li><a href="https://bandup.monkeydevs.mx/contacto">CONTACTO</a></li>
                        <br>
                        <li>
                            <label class="" for="menu-toggle3">
                                <a>DEPARTAMENTOS</a>
                            <input type="checkbox" id="menu-toggle3" style="display:none;" />
                                    <ul id="trickMenu3">
                                        <li><a href="https://bandup.monkeydevs.mx">CD</a></li>
                                        <li><a href="https://bandup.monkeydevs.mx/quienes-somos">LP</a></li>
                                        <li><a href="#">Cassette</a></li>
                                        <li><a href="https://bandup.monkeydevs.mx/contacto">Boxset</a></li>
                                    </ul>
                        </li>
                        <li><a href="#top-sellers">TOP SELLERS</a></li>
                        <li><a href="#novedades">NOVEDADES</a></li>
                        <li><a href="#preventas">PREVENTAS</a></li>
                        <li><a href="#">OFERTAS</a></li>
                    </ul>
                </ul>
            </nav>
            <a href="/<?php echo htmlspecialchars($str_link); ?>">
                <svg viewBox="0 0 20 20" width="30" height="30" xmlns="http://www.w3.org/2000/svg" class="rhf-icon-user">
                    <path d="M9.773.813c4.971 0 9 3.827 9 8.55 0 4.722-4.029 8.55-9 8.55-4.97 0-9-3.828-9-8.55 0-4.723 4.03-8.55 9-8.55zm.787 11.257H8.975c-1.964.004-3.554 1.515-3.558 3.38h0v.388l-.03-.018a8.311 8.311 0 004.385 1.236 8.27 8.27 0 004.345-1.212h0v-.394c-.003-1.865-1.594-3.376-3.557-3.38h0zM9.778 1.668h-.022c-4.47 0-8.094 3.442-8.094 7.689 0 2.348 1.108 4.451 2.868 5.86.14-2.219 2.076-3.977 4.445-3.98h1.584c2.37.003 4.305 1.762 4.457 3.982 1.747-1.41 2.856-3.514 2.856-5.862 0-4.247-3.623-7.69-8.094-7.69h0zm-.005 1.71c1.989 0 3.6 1.53 3.6 3.42 0 1.889-1.611 3.42-3.6 3.42-1.988 0-3.6-1.531-3.6-3.42 0-1.89 1.612-3.42 3.6-3.42zm0 .855c-1.49.003-2.696 1.15-2.7 2.565 0 1.416 1.21 2.565 2.7 2.565 1.491 0 2.7-1.149 2.7-2.565 0-1.417-1.209-2.565-2.7-2.565h0z" fill="#282d35" fill-rule="nonzero" stroke="#282d35" stroke-width=".25"> 
                    </path>
                </svg>
            </a>
        </div>
        
        <div id="logo" class="logo-principal">
            <a href="https://bandup.monkeydevs.mx">
                <img id="logo" src="/img/BandUp.svg" width="160">
            </a>
        </div>
        <div class="carrito lupa-carrito">
            <a href="/busqueda.php">
            <svg width="50" height="43" viewBox="-10 -9 44 38" preserveAspectRatio="none"
                            xmlns="http://www.w3.org/2000/svg" alt="search" class="brand">
                            <path
                                d="M7.886 13.54c3.266 0 5.914-2.54 5.914-5.672 0-3.134-2.648-5.673-5.914-5.673-3.266 0-5.914 2.54-5.914 5.673.007 3.13 2.65 5.665 5.913 5.672h.001zM0 7.867v-.011C0 3.679 3.53.29 7.886.29c4.355 0 7.885 3.388 7.885 7.565a7.34 7.34 0 01-1.668 4.654l6.584 6.287a.923.923 0 01.313.692c0 .522-.441.945-.986.945-.283 0-.54-.115-.72-.3l-6.572-6.305a8.047 8.047 0 01-4.836 1.59C3.535 15.42.007 12.04 0 7.868v-.001z"
                                fill="#282d35" fill-rule="evenodd">
                            </path>
            </svg>
        </a>
            <a href="viewCart.php">
                <span>
                    <?php 
                        $cart = new Cart;
                        echo $cart->total_items() 
                    ?>
                </span>
                <svg class="carrito" width="27" height="32" xmlns="http://www.w3.org/2000/svg" alt="cart" class="brand">
                    <path d="M23.097 18.988l-.165.783H7.77L5.75 8.862H25.25l-2.154 10.126zm-14.89 7.955c.934 0 1.692.713 1.692 1.591s-.758 1.59-1.693 1.59c-.933 0-1.691-.712-1.691-1.59 0-.878.758-1.591 1.691-1.591zm13.014 0c.934 0 1.691.713 1.691 1.591s-.757 1.59-1.691 1.59-1.692-.712-1.692-1.59c0-.872.746-1.58 1.672-1.591h.02zm5.802-19.454H5.5L4.241.689a.714.714 0 00-.713-.564H.471v1.363h2.447l4.476 24.21c-1.338.358-2.303 1.496-2.303 2.847 0 1.631 1.407 2.955 3.142 2.955 1.736 0 3.142-1.324 3.142-2.954 0-.595-.187-1.15-.508-1.613l7.695.01c-.308.449-.49.996-.49 1.583 0 1.627 1.401 2.946 3.132 2.946 1.73 0 3.133-1.32 3.133-2.946 0-1.627-1.403-2.945-3.133-2.945H8.844l-.822-4.446H24.15l.397-1.918.356-1.727.234-1 1.886-9.001z" fill="#282d35" fill-rule="evenodd">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    <nav id="nav" class="nav">
        <ul class="menu">
            <li><a href="https://bandup.monkeydevs.mx/">INICIO</a></li>
            <li><a href="/quienes-somos">QUIÉNES SOMOS</a></li>
            <li><a href="#">CATÁLOGO</a></li>
            <li><a href="/contacto">CONTACTO</a></li>
        </ul>
    </nav>
    <nav id="navReg" class="nav-reg">
        <ul class="menu">
            <li class="mayus"><a href="/<?php echo htmlspecialchars($str_link); ?>" style="text-transform: uppercase;">
                <svg class="usuario-reg" viewBox="0 0 20 20" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.773.813c4.971 0 9 3.827 9 8.55 0 4.722-4.029 8.55-9 8.55-4.97 0-9-3.828-9-8.55 0-4.723 4.03-8.55 9-8.55zm.787 11.257H8.975c-1.964.004-3.554 1.515-3.558 3.38h0v.388l-.03-.018a8.311 8.311 0 004.385 1.236 8.27 8.27 0 004.345-1.212h0v-.394c-.003-1.865-1.594-3.376-3.557-3.38h0zM9.778 1.668h-.022c-4.47 0-8.094 3.442-8.094 7.689 0 2.348 1.108 4.451 2.868 5.86.14-2.219 2.076-3.977 4.445-3.98h1.584c2.37.003 4.305 1.762 4.457 3.982 1.747-1.41 2.856-3.514 2.856-5.862 0-4.247-3.623-7.69-8.094-7.69h0zm-.005 1.71c1.989 0 3.6 1.53 3.6 3.42 0 1.889-1.611 3.42-3.6 3.42-1.988 0-3.6-1.531-3.6-3.42 0-1.89 1.612-3.42 3.6-3.42zm0 .855c-1.49.003-2.696 1.15-2.7 2.565 0 1.416 1.21 2.565 2.7 2.565 1.491 0 2.7-1.149 2.7-2.565 0-1.417-1.209-2.565-2.7-2.565h0z" fill="#282d35" fill-rule="nonzero" stroke="#282d35" stroke-width=".25"> 
                </path>
                </svg>
                <?php echo htmlspecialchars($str_bienvenida); ?></a></li>
            <li><a href="/wishlist.html">
            <svg class="wishlist-reg" viewBox="0 -2.5 20 20" width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M11 .143A4.654 4.654 0 007.85 1.618l-.135.153-.134-.153A4.647 4.647 0 004.214.138C1.863.138.04 1.889.04 4.188c0 .737.192 1.447.568 2.161.464.882 1.183 1.75 2.348 2.902l.257.25c.45.437 3.159 2.948 4.032 3.796l.47.456.703-.68c1.045-.998 3.384-3.169 3.8-3.571 1.318-1.278 2.108-2.208 2.605-3.153.376-.714.567-1.424.567-2.161 0-2.299-1.823-4.05-4.175-4.05l-.213.005zm.214 1.345c1.618 0 2.825 1.16 2.825 2.7 0 .507-.134 1.004-.412 1.533-.386.734-1.033 1.514-2.112 2.579l-.377.365-3.424 3.212-3.562-3.344C2.928 7.346 2.216 6.507 1.802 5.72c-.278-.529-.413-1.026-.413-1.533 0-1.54 1.208-2.7 2.825-2.7 1.242 0 2.455.782 2.874 1.826l.626 1.562.627-1.562c.419-1.044 1.63-1.826 2.873-1.826z" fill="#282d35" fill-rule="nonzero">
            </path></svg>
            WISHLIST</a></li>
        </ul>
    </nav>

    <div class="logo">
        <a id="logoP" href="https://bandup.monkeydevs.mx">
            <img src="/img/BandUp.svg" width="160">
        </a>
        <div id="divS" class="search-wrapper">
            <form action="" method="post" target="_blank">
                <input class="search" name="busquedamusica" placeholder="Busca por título, artista o ISRC" />
                <button>
                    <svg width="50" height="43" viewBox="-10 -5 44 38" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg" alt="search" class="brand">
                        <path
                            d="M7.886 13.54c3.266 0 5.914-2.54 5.914-5.672 0-3.134-2.648-5.673-5.914-5.673-3.266 0-5.914 2.54-5.914 5.673.007 3.13 2.65 5.665 5.913 5.672h.001zM0 7.867v-.011C0 3.679 3.53.29 7.886.29c4.355 0 7.885 3.388 7.885 7.565a7.34 7.34 0 01-1.668 4.654l6.584 6.287a.923.923 0 01.313.692c0 .522-.441.945-.986.945-.283 0-.54-.115-.72-.3l-6.572-6.305a8.047 8.047 0 01-4.836 1.59C3.535 15.42.007 12.04 0 7.868v-.001z"
                            fill="#ffffff" fill-rule="evenodd">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="carrito">
            <label class="" for="menu-toggle4">
                <input type="checkbox" id="menu-toggle4" />
                <?php
                                if($cart->total_items() > 0){
                ?>
                        <ul id="carritoMenu" class="items">
                        <!--svg height="20" width="20">
  <polygon points="10,0 20,14 0,14" fill="#374a5d"/> 
</svg--> 
                            <?php
                                    //get cart items from session
                                    $cartItems = $cart->contents();
                                    foreach($cartItems as $item){
                            ?>
                            <li>
                                <div class="carritoItem">
                                <?php echo '<img src="data:image/png;base64,'.base64_encode($item["cover"]).'" width="50px" height="50px" />';?>
                                <a href="/product.php?action=ver&id=<?php echo $item["id"]; ?>"><?php echo "<b>" . str_replace("`", "'", $item["name"]) . "</b> por <b>" . $item["artist"] . "</b><br> Tipo: <b>" . $item["type"] ."</b><br> Cantidad: <b>" . $item["qty"] ."</b>"; ?></a>                            </div>
                            </li>
                            <?php }?>
                            <li><a>Subtotal: <b><?php echo 'MX$'.$cart->total(); ?></b></a></li>
                            <li><a href="/viewCart.php"><b>></b> Ver carrito</a></li>
                            <?php }else{ ?>
                                <ul id="carritoMenu" <?php echo $styleCarrito ?>>
                            <li><a href="#top-sellers">Tu carrito está vacío. <br><b>> Añade artículos para continuar.</b></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <span>
                    <?php 
                        $cart = new Cart;
                        echo $cart->total_items() 
                    ?>
                </span>
                <svg class="carrito" width="27" height="32" xmlns="http://www.w3.org/2000/svg" alt="cart" class="brand">
                    <path d="M23.097 18.988l-.165.783H7.77L5.75 8.862H25.25l-2.154 10.126zm-14.89 7.955c.934 0 1.692.713 1.692 1.591s-.758 1.59-1.693 1.59c-.933 0-1.691-.712-1.691-1.59 0-.878.758-1.591 1.691-1.591zm13.014 0c.934 0 1.691.713 1.691 1.591s-.757 1.59-1.691 1.59-1.692-.712-1.692-1.59c0-.872.746-1.58 1.672-1.591h.02zm5.802-19.454H5.5L4.241.689a.714.714 0 00-.713-.564H.471v1.363h2.447l4.476 24.21c-1.338.358-2.303 1.496-2.303 2.847 0 1.631 1.407 2.955 3.142 2.955 1.736 0 3.142-1.324 3.142-2.954 0-.595-.187-1.15-.508-1.613l7.695.01c-.308.449-.49.996-.49 1.583 0 1.627 1.401 2.946 3.132 2.946 1.73 0 3.133-1.32 3.133-2.946 0-1.627-1.403-2.945-3.133-2.945H8.844l-.822-4.446H24.15l.397-1.918.356-1.727.234-1 1.886-9.001z" fill="#282d35" fill-rule="evenodd">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    

    <nav id="menu" class="nav-inf">
        <ul class="menu">
            <li><label class="" for="menu-toggle2"><a>DEPARTAMENTOS</a>
            <input type="checkbox" id="menu-toggle2" />
                    <ul id="trickMenu2">
                        <li><a href="https://bandup.monkeydevs.mx">CD</a></li>
                        <li><a href="https://bandup.monkeydevs.mx/quienes-somos">LP</a></li>
                        <li><a href="#">Cassette</a></li>
                        <li><a href="https://bandup.monkeydevs.mx/contacto">Boxset</a></li>
                    </ul>
                </li>
            <li><a href="#top-sellers">TOP SELLERS</a></li>
            <li><a href="#novedades">NOVEDADES</a></li>
            <li><a href="#preventas">PREVENTAS</a></li>
            <li><a href="#">OFERTAS</a></li>
        </ul>
    </nav>

    <div id="carrusel-contenido">
        <div id="carrusel-caja">
            <div class="carrusel-elemento">
                <a href="/product.php?action=ver&id=10000">
                    <img class="imagenes crop" src="/img/Slider-PP_HolyFvck.png"/>
                </a>
            </div>
            <div class="carrusel-elemento">
                <a href="/product.php?action=ver&id=10001">
                    <img class="imagenes" src="/img/Slider-PP_BetterMistakes.png"/>
                </a>
            </div>
            <div class="carrusel-elemento">
                <a href="/product.php?action=ver&id=10071">
                    <img class="imagenes" src="/img/Slider-PP_Special.png"/>
                </a>
            </div>
            <div class="carrusel-elemento">
                <a href="#">
                    <img class="imagenes" src="/img/Slider-PP_Positions.png"/>
                </a>
            </div>
        </div>
    </div>

    <br><br>

    <main id="main1" class="contenedor sombra">
        <a name="top-sellers" class="titulos-body">TOP SELLERS</a>
        <div class="slider-ts">
            <div class="slider-ts-inner">
                <input class="slider-ts-open" type="radio" id="slider-ts-1" name="slider-ts" aria-hidden="true" hidden=""
                    checked="checked">
                <div class="slider-ts-item">
                    <div class="servicios">
                        <a href="/product.php?action=ver&id=10000">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img src="https://is1-ssl.mzstatic.com/image/thumb/Music112/v4/c3/f7/6a/c3f76a82-5bc5-e291-e88e-56672a2b23f6/22UMGIM60461.rgb.jpg/1000x1000.png"/>
                                </div>
                                <h3>HOLY FVCK</h3>
                                <h4><span>por</span>Demi Lovato</h4>
                                <h5>MX$1099</h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=10067">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img src="https://is1-ssl.mzstatic.com/image/thumb/Music123/v4/8a/49/83/8a498383-03bb-27bd-000c-572d5e362f01/07UMGIM08937.rgb.jpg/1000x1000.png" width="100%" height="100%" />
                                </div>
                                <h3>Underclass Hero</h3>
                                <h4><span>por</span>Sum 41</h4>
                                <h5><span class="strikethrough">MX$989</span>MX$789</h5>
                            </section>
                        </a>
                        <a href="#">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img src="https://is3-ssl.mzstatic.com/image/thumb/Music114/v4/a1/09/bc/a109bc6a-21d2-53c5-248a-be19b20ba9da/20UMGIM53351.rgb.jpg/1000x1000.png"
                                        width="100%" height="100%" />
                                </div>
                                <h3>Smile</h3>
                                <h4><span>por</span>Katy Perry</h4>
                                <h5><span class="strikethrough">MX$219</span>MX$189</h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=10070">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img
                                        src="https://is1-ssl.mzstatic.com/image/thumb/Music112/v4/cb/58/8b/cb588bc8-1872-b1ba-afb3-45c8b3e17e1d/886449876266.jpg/1000x1000.png" />
                                </div>
                                <h3>MOTOMAMI +</h3>
                                <h4><span>por</span>ROSALÍA</h4>
                                <h5><span class="strikethrough">MX$209</span>MX$169</h5>
                            </section>
                        </a>
                    </div>
                </div>
                <input class="slider-ts-open" type="radio" id="slider-ts-2" name="slider-ts" aria-hidden="true" hidden="">
                <div class="slider-ts-item">
                    <div class="servicios">
                        <a href="/nine-blink-182">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img
                                        src="https://is2-ssl.mzstatic.com/image/thumb/Music125/v4/67/af/48/67af480a-0702-2fcf-6ff8-8639feab9b6a/886447823101.jpg/1000x1000.png" />
                                </div>
                                <h3>NINE</h3>
                                <h4><span>por</span>blink-182</h4>
                                <h5>$689</h5>
                            </section>
                        </a>
                        <a href="/love-sux-avril-lavigne">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img
                                        src="https://is2-ssl.mzstatic.com/image/thumb/Video116/v4/2a/11/7c/2a117cc9-9861-53ff-0b5e-e57e1924ec98/Joba324bb3e-a044-4f43-8ea1-12637dd5d217-127648231-PreviewImage_preview_image_nonvideo_sdr-Time1642018709692.png/1000x1000.png" />
                                </div>
                                <h3>Love Sux</h3>
                                <h4><span>por</span>Avril Lavigne</h4>
                                <h5>MX$799</h5>
                            </section>
                        </a>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-lp">LP</span>
                                <img src="https://is2-ssl.mzstatic.com/image/thumb/Music115/v4/7a/6b/b5/7a6bb597-9be0-a995-6aec-cef4bc0e353f/21UMGIM26666.rgb.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Tell Me You Love Me</h3>
                            <h4><span>por</span>Demi Lovato</h4>
                            <h5><span class="strikethrough">MX$1199</span>MX$829</h5>
                        </section>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-cd">CD</span>
                                <img src="https://is2-ssl.mzstatic.com/image/thumb/Music126/v4/2a/19/fb/2a19fb85-2f70-9e44-f2a9-82abe679b88e/886449990061.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Harry's House</h3>
                            <h4><span>por</span>Harry Styles</h4>
                            <h5><span class="strikethrough">MX$299</span>MX$219</h5>
                        </section>
                    </div>
                </div>
                <input class="slider-ts-open" type="radio" id="slider-ts-3" name="slider-ts" aria-hidden="true" hidden="">
                <div class="slider-ts-item">
                    <div class="servicios">
                        <a href="/nine-blink-182">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img
                                        src="https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/f5/25/50/f5255039-699c-c6d7-463e-ae291c663897/886449983476.jpg/1000x1000.png" />
                                </div>
                                <h3>Cambios de Luna</h3>
                                <h4><span>por</span>Kenia Os</h4>
                                <h5><span class="strikethrough">MX$249</span>MX$199</h5>
                            </section>
                        </a>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-cd">CD</span>
                                <img src="https://is3-ssl.mzstatic.com/image/thumb/Music115/v4/d8/8f/4b/d88f4b28-d500-03e2-adc0-62dba9342ea6/190295092665.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Future Nostalgia</h3>
                            <h4><span>por</span>Dua Lipa</h4>
                            <h5>MX$209</h5>
                        </section>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-boxset">BoxSet</span>
                                <img src="https://is3-ssl.mzstatic.com/image/thumb/Music116/v4/e7/f3/d7/e7f3d7dc-4bf6-e15d-ca28-3105f713e693/192641938573_Cover.jpg/1000x1000.png"
                                    />
                            </div>
                            <h3>CRAZY IN LOVE</h3>
                            <h4><span>por</span>ITZY</h4>
                            <h5>MX$1099</h5>
                        </section>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-cd">CD</span>
                                <img src="https://is1-ssl.mzstatic.com/image/thumb/Music125/v4/df/32/8f/df328f45-8c72-9f91-e365-93997207fbc7/cover.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Nothing Personal</h3>
                            <h4><span>por</span>All Time Low</h4>
                            <h5><span class="strikethrough">MX$209</span>MX$129</h5>
                        </section>
                    </div>
                </div>
                <label for="slider-ts-3" class="slider-ts-control prev control-1">‹</label>
                <label for="slider-ts-2" class="slider-ts-control next control-1">›</label>
                <label for="slider-ts-1" class="slider-ts-control prev control-2">‹</label>
                <label for="slider-ts-3" class="slider-ts-control next control-2">›</label>
                <label for="slider-ts-2" class="slider-ts-control prev control-3">‹</label>
                <label for="slider-ts-1" class="slider-ts-control next control-3">›</label>
            </div>
        </div>
    </main>

    <br><br>

    <main id="main2" class="contenedor sombra">
        <a name="novedades" class="titulos-body">NOVEDADES</a>
        <div class="slider-novedades">
            <div class="slider-novedades-inner">
                <input class="slider-novedades-open" type="radio" id="slider-novedades-1" name="slider-novedades" aria-hidden="true" hidden=""
                    checked="checked">
                <div class="slider-novedades-item">
                    <div class="servicios">
                        <?php
                            $cont = 0;
                            $query = $link->query("SELECT * FROM novedades LIMIT 4");

                            while($row = $query->fetch_assoc()) {
                        ?>
                        <a href="/product.php?action=ver&id=<?php echo $id[$cont] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[$cont]) ?>"><?php echo $tipo[$cont] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[$cont].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[$cont] ?></h3>
                                <h4><span>por</span><?php echo $artista[$cont] ?></h4>
                                <h5>MX$<?php echo $precioV[$cont] ?></h5>
                            </section>
                        </a>
                        <?php
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
                <input class="slider-novedades-open" type="radio" id="slider-novedades-2" name="slider-novedades" aria-hidden="true" hidden="">
                <div class="slider-novedades-item">
                    <div class="servicios">
                        <?php
                            $cont = 4;
                            $query = $link->query("SELECT * FROM novedades LIMIT 4");
                            
                            while($row = $query->fetch_assoc()) {
                        ?>
                        <a href="/product.php?action=ver&id=<?php echo $id[$cont] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[$cont]) ?>"><?php echo $tipo[$cont] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[$cont].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[$cont] ?></h3>
                                <h4><span>por</span><?php echo $artista[$cont] ?></h4>
                                <h5>MX$<?php echo $precioV[$cont] ?></h5>
                            </section>
                        </a>
                        <?php
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
                <input class="slider-novedades-open" type="radio" id="slider-novedades-3" name="slider-novedades" aria-hidden="true" hidden="">
                <div class="slider-novedades-item">
                    <div class="servicios">
                    <?php
                            $cont = 8;
                            $query = $link->query("SELECT * FROM novedades LIMIT 4");
                            
                            while($row = $query->fetch_assoc()) {
                        ?>
                        <a href="/product.php?action=ver&id=<?php echo $id[$cont] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[$cont]) ?>"><?php echo $tipo[$cont] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[$cont].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[$cont] ?></h3>
                                <h4><span>por</span><?php echo $artista[$cont] ?></h4>
                                <h5>MX$<?php echo $precioV[$cont] ?></h5>
                            </section>
                        </a>
                        <?php
                            $cont++;
                            }
                        ?>
                    </div>
                </div>
                <label for="slider-novedades-3" class="slider-novedades-control prev control-1">‹</label>
                <label for="slider-novedades-2" class="slider-novedades-control next control-1">›</label>
                <label for="slider-novedades-1" class="slider-novedades-control prev control-2">‹</label>
                <label for="slider-novedades-3" class="slider-novedades-control next control-2">›</label>
                <label for="slider-novedades-2" class="slider-novedades-control prev control-3">‹</label>
                <label for="slider-novedades-1" class="slider-novedades-control next control-3">›</label>
            </div>
        </div>
    </main>

    <br>


    <!--main class="contenedor sombra">
        <a class="titulos-body">NOVEDADES</a>
        <div class="slider-novedades">
            <div class="slider-novedades-inner">
                <input class="slider-novedades-open" type="radio" id="slider-novedades-1" name="slider-novedades" aria-hidden="true" hidden=""
                    checked="checked">
                <div class="slider-novedades-item">
                    <div class="servicios">
                        <a href="/product.php?action=ver&id=<?php echo $id[0] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[0]) ?>"><?php echo $tipo[0] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[0].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[0] ?></h3>
                                <h4><span>por</span><?php echo $artista[0] ?></h4>
                                <h5>MX$<?php echo $precioV[0] ?></h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=<?php echo $id[1] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[1]) ?>"><?php echo $tipo[1] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[1].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[1] ?></h3>
                                <h4><span>por</span><?php echo $artista[1] ?></h4>
                                <h5>MX$<?php echo $precioV[1] ?></h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=<?php echo $id[2] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[2]) ?>"><?php echo $tipo[2] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[2].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[2] ?></h3>
                                <h4><span>por</span><?php echo $artista[2] ?></h4>
                                <h5>MX$<?php echo $precioV[2] ?></h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=<?php echo $id[3] ?>">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-<?php echo strtolower($tipo[3]) ?>"><?php echo $tipo[3] ?></span>
                                    <?php echo '<img src="data:image/png;base64,'.$cover[3].'"/>';?>
                                </div>
                                <h3><?php echo $nombre[3] ?></h3>
                                <h4><span>por</span><?php echo $artista[3] ?></h4>
                                <h5>MX$<?php echo $precioV[3] ?></h5>
                            </section>
                        </a>
                    </div>
                </div>
                <input class="slider-novedades-open" type="radio" id="slider-novedades-2" name="slider-novedades" aria-hidden="true" hidden="">
                <div class="slider-novedades-item">
                    <div class="servicios">
                        <a href="/nine-blink-182">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img
                                        src="https://is4-ssl.mzstatic.com/image/thumb/Video112/v4/be/b8/53/beb85380-ea21-ae83-923d-8d5fe9ed9c28/Jobb5e359dd-48a5-4885-845a-83355177e70a-132484104-PreviewImage_preview_image_nonvideo_sdr-Time1654116543657.png/1000x1000.png" />
                                </div>
                                <h3>Let Go (Edición Especial)</h3>
                                <h4><span>por</span>Avril Lavigne</h4>
                                <h5><span class="strikethrough">MX$1019</span>MX$749</h5>
                            </section>
                        </a>
                        <a href="/love-sux-avril-lavigne">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img
                                        src="https://is1-ssl.mzstatic.com/image/thumb/Music114/v4/82/8d/08/828d0880-b191-1848-383b-1dfa13657e6c/00602527120911.rgb.jpg/1000x1000.png" />
                                </div>
                                <h3>Gran City Pop</h3>
                                <h4><span>por</span>Paulina Rubio</h4>
                                <h5>MX$699</h5>
                            </section>
                        </a>
                        <a href="/hold-me-closer-elton-john-britney-spears">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img
                                        src="https://is4-ssl.mzstatic.com/image/thumb/Music122/v4/44/79/8d/44798d46-1503-f69a-03a0-050762fd0e8b/22UMGIM92163.rgb.jpg/1000x1000.png" />
                                </div>
                                <h3>Hold Me Closer</h3>
                                <h4><span>por</span>Elton John & Britney Spears</h4>
                                <h5>MX$109</h5>
                            </section>
                        </a>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-lp">LP</span>
                                <img src="https://is3-ssl.mzstatic.com/image/thumb/Music115/v4/c6/27/9c/c6279c07-9329-827d-31c4-f5d4c7d99ff4/21UM1IM25046.rgb.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Red (Taylor's Version)</h3>
                            <h4><span>por</span>Taylor Swift</h4>
                            <h5><span class="strikethrough">MX$1899</span>MX$989</h5>
                        </section>
                    </div>
                </div>
                <input class="slider-novedades-open" type="radio" id="slider-novedades-3" name="slider-novedades" aria-hidden="true" hidden="">
                <div class="slider-novedades-item">
                    <div class="servicios">
                        <a href="/hold-me-closer-elton-john-britney-spears">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img
                                        src="https://is5-ssl.mzstatic.com/image/thumb/Music114/v4/0a/09/0d/0a090dc9-7486-4b17-6ced-a1e65396bd46/150.jpg/1000x1000.png" />
                                </div>
                                <h3>Canciones Pa' Mi Ex, Vol. 1</h3>
                                <h4><span>por</span>Kenia Os</h4>
                                <h5>MX$109</h5>
                            </section>
                        </a>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-cd">CD</span>
                                <img src="https://is1-ssl.mzstatic.com/image/thumb/Music122/v4/dd/60/21/dd6021b7-3bc5-f69c-ba7b-c231ec0659ce/196589197382.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Todo My Love</h3>
                            <h4><span>por</span>Kenia Os</h4>
                            <h5>MX$89</h5>
                        </section>
                        <section class="servicio">
                            <div class="iconos">
                                <span class="span-lp">LP</span>
                                <img src="https://is1-ssl.mzstatic.com/image/thumb/Music115/v4/76/fa/23/76fa232c-2e97-88de-9558-3302ed9d6656/21UMGIM11941.rgb.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>Positions (Edición Especial)</h3>
                            <h4><span>por</span>Ariana Grande</h4>
                            <h5><span class="strikethrough">MX$899</span>MX$599</h5>
                        </section>
                        <section class="servicio">
                            <div class="iconos">
                                <img src="https://is1-ssl.mzstatic.com/image/thumb/Music112/v4/cb/58/8b/cb588bc8-1872-b1ba-afb3-45c8b3e17e1d/886449876266.jpg/1000x1000.png"
                                    width="100%" height="100%" />
                            </div>
                            <h3>MOTOMAMI +</h3>
                            <h4><span>por</span>ROSALÍA</h4>
                            <h5><span class="strikethrough">MX$999</span>MX$699</h5>
                        </section>
                    </div>
                </div>
                <label for="slider-novedades-3" class="slider-novedades-control prev control-1">‹</label>
                <label for="slider-novedades-2" class="slider-novedades-control next control-1">›</label>
                <label for="slider-novedades-1" class="slider-novedades-control prev control-2">‹</label>
                <label for="slider-novedades-3" class="slider-novedades-control next control-2">›</label>
                <label for="slider-novedades-2" class="slider-novedades-control prev control-3">‹</label>
                <label for="slider-novedades-1" class="slider-novedades-control next control-3">›</label>
            </div>
        </div>
    </main-->

    <br>

    <main id="main3" class="contenedor sombra">
        <a name="preventas" class="titulos-body">PREVENTAS</a>
        <div class="slider-preventas">
            <div class="slider-preventas-inner">
                <input class="slider-preventas-open" type="radio" id="slider-preventas-1" name="slider-preventas" aria-hidden="true" hidden=""
                    checked="checked">
                <div class="slider-preventas-item">
                    <div class="servicios">
                        <a href="/better-mistakes-bebe-rexha">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-lp">LP</span>
                                    <img
                                        src="https://is1-ssl.mzstatic.com/image/thumb/Music125/v4/5f/02/1b/5f021b51-68d3-e519-4c78-4f5a43064ef2/093624881438.jpg/1000x1000.png" />
                                </div>
                                <h3>Better Mistakes</h3>
                                <h4><span>por</span>Bebe Rexha</h4>
                                <h5>MX$679</h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=10065">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-boxset">Boxset</span>
                                    <img src="https://is2-ssl.mzstatic.com/image/thumb/Music112/v4/05/05/f3/0505f338-9873-feb4-af7f-27a470405e5f/196589246974.jpg/1000x1000.png"/>
                                </div>
                                <h3>RENAISSANCE</h3>
                                <h4><span>por</span>Beyoncé</h4>
                                <h5>MX$1519</h5>
                            </section>
                        </a>
                        <a href="/product.php?action=ver&id=10066">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img src="https://pbs.twimg.com/media/Fe_PEd7VEAAauUf?format=jpg&name=large"
                                        width="100%" height="100%" />
                                </div>
                                <h3>K23</h3>
                                <h4><span>por</span>Kenia Os</h4>
                                <h5><span class="strikethrough">MX$229</span>MX$179</h5>
                            </section>
                        </a>
                        <a href="#">
                            <section class="servicio">
                                <div class="iconos">
                                    <span class="span-cd">CD</span>
                                    <img
                                        src="https://is4-ssl.mzstatic.com/image/thumb/Video112/v4/69/c2/23/69c223cf-1b97-8f02-81e1-54f13034c903/Jobb3243dad-5c44-4031-9489-91f45c67d8dc-133810727-PreviewImage_preview_image_nonvideo_sdr-Time1657289708009.png/1000x1000.png" />
                                </div>
                                <h3>CHARLIE</h3>
                                <h4><span>por</span>Charlie Puth</h4>
                                <h5><span class="strikethrough">MX$209</span>MX$149</h5>
                            </section>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <br>

    <footer class="footer">
        <div><p>
            <button class="darkBtn" id="dark">
            <span><i class="fa-regular fa-sun"></i></span>
            <span><i class="fa-regular fa-moon"></i></span>
            </button>
        </p>
        <section>
    <p>
        <span id="days"></span> días / <span id="hours"></span> horas / <span id="minutes"></span> minutos / <span id="seconds"></span> segundos
    </p>
</section>
        <p> © 2022 BandUp.com | Todos los derechos reservados | <a href="/aviso-de-privacidad">Aviso de Privacidad</a></p>
        </div>
    </footer>

    <br>
</body>

<script lenguage="javascript">
            //===
// VARIABLES
//===
const DATE_TARGET = new Date('11/30/2022 0:01 AM');
// DOM for render
const SPAN_DAYS = document.querySelector('span#days');
const SPAN_HOURS = document.querySelector('span#hours');
const SPAN_MINUTES = document.querySelector('span#minutes');
const SPAN_SECONDS = document.querySelector('span#seconds');
// Milliseconds for the calculations
const MILLISECONDS_OF_A_SECOND = 1000;
const MILLISECONDS_OF_A_MINUTE = MILLISECONDS_OF_A_SECOND * 60;
const MILLISECONDS_OF_A_HOUR = MILLISECONDS_OF_A_MINUTE * 60;
const MILLISECONDS_OF_A_DAY = MILLISECONDS_OF_A_HOUR * 24

//===
// FUNCTIONS
//===

/**
 * Method that updates the countdown and the sample
 */
function updateCountdown() {
    // Calcs
    const NOW = new Date()
    const DURATION = DATE_TARGET - NOW;
    const REMAINING_DAYS = Math.floor(DURATION / MILLISECONDS_OF_A_DAY);
    const REMAINING_HOURS = Math.floor((DURATION % MILLISECONDS_OF_A_DAY) / MILLISECONDS_OF_A_HOUR);
    const REMAINING_MINUTES = Math.floor((DURATION % MILLISECONDS_OF_A_HOUR) / MILLISECONDS_OF_A_MINUTE);
    const REMAINING_SECONDS = Math.floor((DURATION % MILLISECONDS_OF_A_MINUTE) / MILLISECONDS_OF_A_SECOND);
    // Thanks Pablo Monteserín (https://pablomonteserin.com/cuenta-regresiva/)

    // Render
    SPAN_DAYS.textContent = REMAINING_DAYS;
    SPAN_HOURS.textContent = REMAINING_HOURS;
    SPAN_MINUTES.textContent = REMAINING_MINUTES;
    SPAN_SECONDS.textContent = REMAINING_SECONDS;
}

//===
// INIT
//===
updateCountdown();
// Refresh every second
setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);
        </script>

<script lenguage="javascript">
    const btnDark = document.querySelector('#dark');
    var main1 = document.getElementById('main1');
    var main2 = document.getElementById('main2');
    var main3 = document.getElementById('main3');
    var divS = document.getElementById('divS');
    
    var nav = document.getElementById('nav');
    var navReg = document.getElementById('navReg');
    var menu = document.getElementById('menu');

    load();

    btnDark.addEventListener('click', () => {
        btnDark.classList.toggle('active');
        document.body.classList.toggle('dark');
        store(document.body.classList.contains('dark'));
        main1.classList.toggle('dark');
        main2.classList.toggle('dark');
        main3.classList.toggle('dark');
        divS.classList.toggle('dark');
        nav.classList.toggle('dark');
        navReg.classList.toggle('dark');
        menu.classList.toggle('dark');
        document.getElementById('logo').src = "/img/BandUp-O.svg";
    });

    function load () {
        const darkmode = localStorage.getItem('dark');

        if(!darkmode){
            store('false');
        } else if(darkmode == 'true'){
            btnDark.classList.toggle('active');
            document.body.classList.toggle('dark');
            main1.classList.toggle('dark');
            main2.classList.toggle('dark');
            main3.classList.toggle('dark');
            divS.classList.toggle('dark');
            nav.classList.toggle('dark');
            navReg.classList.toggle('dark');
            menu.classList.toggle('dark');
            document.getElementById('logo').src = "/img/BandUp-O.svg";
        }
    }

    function store(value) {
        localStorage.setItem('dark', value);    
    }
</script>
</html>