<html>
    <head>
        <meta charset="utf-8">
        <title>BITLY - Raccourcissez vos urls</title>
        <link rel="stylesheet" href="./../public/design/default.css">
		<link rel="icon" type="image/png" href="./../public/assets/favicon.png">
    </head>
    <body>

        <!-- PRESENTATION -->
        <section id="main">
            
            <!-- CONTAINER -->
			<div class="container">
				
				<!-- EN-TETE -->
<header>
    <a href="./">
        <img src="./../public/assets/logo.png" alt="logo" id="logo">
    </a>
</header>
				<!-- PROPOSITION -->
				<h1>Une url longue ? Raccourcissez-là ?</h1>
				<h2>Largement meilleur et plus court que les autres.</h2>

				<!-- FORM -->
				<form method="post" action="index.php">
					<input type="url" name="url" placeholder="Collez un lien à raccourcir">
					<input type="submit" value="Raccourcir">
				</form>

				<?php if(isset($_GET['error']) && isset($_GET['message'])) { ?>
                    
                    <div class="center">
						<div id="result">
							<b><?php echo htmlspecialchars($_GET['message']); ?></b>
						</div>
                    </div>
                    
                <?php } else if(isset($_GET['short'])) { ?>
                    
					<div class="center">
						<div id="result">
							<b>URL RACCOURCIE : </b>
							http://localhost/?q=<?php echo htmlspecialchars($_GET['short']); ?>
						</div>
                    </div>
                    
				<?php } ?>

			</div>

        </section>

        <!-- MARQUES -->
		<section id="brands">
			
			<!-- CONTAINER -->
			<div class="container">
				<h3>Ces marques nous font confiance</h3>
				<img src="./../public/assets/1.png" alt="1" class="picture">
				<img src="./../public/assets/2.png" alt="2" class="picture">
				<img src="./../public/assets/3.png" alt="3" class="picture">
				<img src="./../public/assets/4.png" alt="4" class="picture">
			</div>

		</section>

		<!-- PIED DE PAGE -->
<footer>
    <img src="assets/logo2.png" alt="logo" id="logo"><br>
    2300 © Bitly<br>
    <a href="#">Contact</a> - <a href="#">À propos</a>
</footer>        
    </body>
</html>