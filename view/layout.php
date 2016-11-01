<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pretpakket</title>

    <meta name="description" content="Met Pretpakket bouw je zelf jouw pretparkattractie. Volledig aanpasbaar voor jouw tuin.">
    <meta name="author" content="Katia Smet &amp;copy 2015">
    <meta name="viewport" content="width=device-width,initial-scale=1">

   

    <!-- CSS -->
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

    <!--[if gte IE 8]> <link rel="stylesheet" type="text/css" href="css/all-ie-only.css"/> <![endif]-->

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:700,900,300' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="wrapper">
    <?php
        $pages = array(
            'pakketten' => 'pretpakketten',
            'workshops' => 'workshops',
            'pretinjouwbuurt' => 'pret in jouw buurt',
        )
    ?>
    <header>
        <h1 class="header-logo"><a href="index.php">pretpakket<span class="header-underline"></span></a></h1>

        <nav>
            <ul class="nav-left">
                <?php foreach($pages as $url => $page): ?>
                   
                <li id="<?php echo $url; ?>" <?php if($_GET['page'] == $url) {echo "class='active'";} ?>>
                    <a href="<?php echo "index.php?page=" . $url; ?>"><?php echo $page ?></a>
                </li>

                <?php endforeach ?>
            </ul>

            <ul class="nav-right">
                <?php 
                    if(!empty($_SESSION['user'])) {
                        echo "<li><a class='nav-account' href='index.php?page=mijnprofiel'>" . $_SESSION['user']['first_name'] . "</li>";
                        echo "<li><a class='nav-account' href='index.php?page=logout'>afmelden</a></li>";
                    } else {
                        echo "<li class='nav-aanmelden'><a href='#login'>aanmelden</a></li>";
                    }
                ?>  
                <li class="nav-winkelwagen"><a href='#winkelwagen'><i class="winkelwagen"></i></a></li>
                <li class="no-margin nav-zoeken"><a href='#zoeken'><i class="zoeken"></i></a></li>
            </ul>
        </nav>
    </header>

    <div class="overlap-box login" id="login">
        <a class="close-btn" href="#">x</a>
        <h1>aanmelden</h1>
        <form method="post" action="index.php?page=login" class="login-form white-bg" >
            <input type="hidden" name="action" value="login" />
            <div>
                <label>
                    <span class="form-label">e-mail</span>
                    <input type="email" name="e_mail" placeholder="email@voorbeeld.com"/>
                    <?php if(!empty($errors['e_mail'])) echo '<span class="error-message">' . $errors['e_mail'] . '</span>'; ?>
                </label>

                <label>
                    <span class="form-label">wachtwoord</span>
                    <input type="password" name="password" placeholder="jouw wachtwoord"/>
                    <?php if(!empty($errors['password'])) echo '<span class="error-message">' . $errors['password'] . '</span>'; ?>
                </label>
            </div>
            <div class="sbmt-bg sbmt-bg-yellow">
                <input type="submit" name="action" value="mij aanmelden"/>
            </div>
        </form>

        <a href="index.php?page=registreren" class="no-account">Nog geen account? Registreer nu.</a>
    </div>

    <div class="my-cart-results">
    <div class="mycart overlap-box mycart-box" id="winkelwagen">
        <a class="close-btn" href="#">x</a>
        <h1>jouw winkelwagen</h1>

        <?php 
            if(!empty($_SESSION['cart'])) {
        ?>
        <form action="index.php?page=cart" method="post" class="cart-form" >
            <input type="hidden" name="action" value="update-cart" />
            <table class='mycart-tbl'>
                <thead>
                    <tr>
                        <th class='packet-name' colspan='2'>Pretpakket</th>
                        <th class='packet-quantity'>Aantal</th>
                        <th class='price'>Prijs</th>
                        <th class='remove-item'></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $total = 10;
                        foreach($items as $item) {
                            $itemTotal = number_format($item['package']['price'] * $item['amount'], 2, ',', '');
                            $total += $itemTotal;
                    ?>
                    <tr class='item'>
                        <td class='packet-name' colspan='2'><?php echo $item['package']['title'] ;?></td>
                        <td class='packet-quantity'>
                            <div class="amount">
                                <a class='amount-button' href='index.php?action=change&amp;id=<?php echo $item['package']['id']; ?>&amp;amount=<?php echo ($item['amount'] - 1); ?>#winkelwagen'>-</a>
                                <a class='amount-button' href='index.php?action=change&amp;id=<?php echo $item['package']['id']; ?>&amp;amount=<?php echo ($item['amount'] + 1); ?>#winkelwagen'>+</a>
                            </div> 
                            <?php echo $item['amount']; ?> 
                        </td>
                        <td class='price'>€ <?php echo $itemTotal ;?></td>
                        <td class='remove-item'><a href="index.php?action=change&amp;id=<?php echo $item['package']['id'];?>&amp;amount=0#winkelwagen">x</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>

            <table class="total-tbl">
                <tr class='shipment'>
                        <td>verzendkosten</td>
                        <td class="price">€ 10,00</td>
                </tr>
                <tr class='total'>
                        <td>totaal</td>
                        <td class="price">€ <?php echo number_format($total, 2, ',', '') ;?></td>
                </tr>
            </table>
            <div class="mycart-buttons">
                <a class="button yellow-button" href="index.php?page=bestellen">bestelling afronden</a>
                <a class="close-btn back-shop" href="#"><i class="fa fa-caret-left"></i> verder winkelen</a>
            </div>

        </form> 
        <?php
            } else {
                echo "<p class='empty-cart'>Je winkelwagen is leeg.</p>";
                echo "<a class='close-btn back-shop' href='#'><i class='fa fa-caret-left'></i> verder winkelen</a>";
            }
        ?>
    </div>
    </div>

    <div class="search overlap-box" id="zoeken">
        <input type="hidden" name="action" value="search" />
        <a class="close-btn" href="#">x</a>
        <form method="get" action='index.php?page=search' class="search-form white-bg">
            <input type="hidden" name="page" value="search" />
            <input type="text" name="search_term" class="search-input" placeholder="zoek een pakket"/>
            <button type="submit" name="action" value="search">&#xf0da;</button>
        </form>
    </div>


    <main class="results">

    <?php
        if(!empty($error)) {
            echo '<div class="error box">' . $error . '</div>';
        }
        if(!empty($info)) {
            echo '<div class="info box">' . $info . '</div>';
        }
    ?>
    
	<?php echo $content; ?>

    </main>
    <div class="push"></div>
    </div>

    <footer>
        <div class="footer-grid">
            <h2>Contacteer ons</h2>  
            <ul>
                <li>Jakobijnenstraat 8</li>
                <li>9000 Gent</li>
            </ul>
            <ul class="contact">
                <li><a href="mailto:pret@pretpakket.be">pret@pretpakket.be</a></li>
                <li>0497 34 57 25</li>
            </ul>
        </div>

        <div class="footer-grid">
            <h2>Nieuwsbrief</h2>
            <form method="post" action="index.php?page=newsletter" class="newsletter-form white-bg">
                <label>
                    <span class="form-label">e-mailadres</span>
                    <input type="email" name="e_mail" class="form-input" placeholder="email@voorbeeld.com"/>
                    <?php if(!empty($errors['e_mail'])) echo '<span class="error-message">' . $errors['e_mail'] . '</span>'; ?>
                </label>
                <button type="submit" name="action" value="subscribe-newsletter">&#xf0da;</button>
            </form>
        </div>

        <div class="footer-grid no-margin">
            <h2>Volg ons online</h2>
            <ul class="social">
                <li><a href="http://www.facebook.com"><i class="fa fa-facebook-square fa-fw"></i></a></li>
                <li><a href="http://www.twitter.com"><i class="fa fa-twitter-square fa-fw"></i></a></li>
                <li><a href="http://www.pinterest.com"><i class="fa fa-pinterest-square fa-fw"></i></a></li>
                <li><a href="http://www.instagram.com"><i class="fa fa-instagram fa-fw"></i></a></li>
            </ul>
        </div>
    </footer>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;signed_in=true&amp;libraries=places"></script>
    <script src="js/neighbourhood.js"></script>
    <script src="js/script.js"></script>
</body>
</html>