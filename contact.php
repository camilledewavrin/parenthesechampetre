<?php
if(!empty($_POST)) {
  extract($_POST);
  $valid = true;
  if(empty($nom)){  $valid=false; $erreurnom="Nom obligatoire";}
  if(empty($prenom)){ $valid=false; $erreurprenom="Prenom obligatoire";}
  if(!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i",$email))
   {
    $valid=false;
    $erreurmail ="votre mail n'est pas valide";
   }
  if(empty($email)){  $valid=false; $erreurmail="mail obligatoire";}
  if(empty($phone)){  $valid=false; $erreurphone="Numéro de téléphone obligatoire";}
  if(empty($texte)){  $valid=false; $erreurtexte="message obligatoire"; }
  if($valid){ 
     $to = "contact@parenthesechampetre.fr";
    //=====Définition du sujet.
    $subject = $nom. " a contacté le site";
    //=========
    //=====Création du header de l'e-mail.
    $header = "From: $nom <$email>";
    //==========
    //=====Création du message.
    $message = "\n";
    $message.= "Content-Type: multipart/alternative;";
    $message.= "\n";
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"";
    $message.= "Content-Transfer-Encoding: 8bit";
    $message.= "\n";
    $message = "Nom: $nom - Prénom: $prenom\nEmail: $email - Numéro de téléphone: $phone\n\n$texte"; 
    //========== 
    $nom = stripslashes($nom);
    $prenom = stripslashes($prenom);
    $email= stripcslashes($email);
    $phone= stripcslashes($phone);
    $texte= stripcslashes($texte);

    if(mail($to,$subject,$message,$header)){
      $erreur = "Votre message nous est bien parvenu";
      unset($nom);
      unset($prenom);
      unset($email);
      unset($phone);
      unset($texte);
    }
    else{
      $erreur = "Une erreur est survenue";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parenthèse Champêtre | Contact</title>
    <link rel="icon" type="image/png" href="style/image/tbcoquelicot.png" />
    <link href="bootstrap/bootstrap.css" rel="stylesheet">
    <link href="style/css/style.css" rel="stylesheet">   
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> 

    <script src="style/js/jquery.js"></script>
  </head>
  <body>
   
   <section class="content_all">
      <section class="header">
        <div class="row">
          <div class="col-md-3">
              <a href="http://www.clevacances.com/fr/location/21570" target="_blank"><img id="logo_vacance" src="style/image/clevacances.png" alt="Clevacances"></a>
              <a href="http://www.facebook.com/giteparenthesechampetre" target="_blank"><img id="logo_fb" src="style/image/icon/facebook.png" alt="Facebook"></a>
              <a href="http://www.cheminsdememoire-nordpasdecalais.fr" target="_blank"><img id="logo_1418" src="style/image/icon/logo1418.jpg" alt="Nothern France"></a>        
          </div>
          <div class="col-md-6">
              <img class="logo" src="style/image/logo-horizontal.png" alt="logo">
          </div>
            <div class="col-md-3 drapeau">
                <a href="contact.php"><img class="drapeau" src="style/image/icon/fr.gif" alt="FR"></a>
                <a href="EN/contact.php"><img class="drapeau" src="style/image/icon/en.gif" alt="EN"></a>
         </div>
        </div>
      </section> <!-- fin section header   -->
      <section class="content_menu">
        <div class="row">
            <div class="col-lg-12 menu">
              <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="gite.html">Gîte</a></li>
                    <li><a href="balneo.html">Balnéothérapie</a></li>
                    <li><a href="tarifs.html">Tarifs</a></li>
                    <li class="active"><a href="contact.php">Contact / Accès</a></li>
                    <li><a href="liens.html">Découvrir</a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
            </div><!-- menu col -->
          </div>
      </section>  <!-- fin section menu   -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <p>Isabelle et Jean-Pierre DANET</br> 4 rue du Moulin 59940 Neuf-Berquin, France</p>
          </div>
          <p>Téléphone: +(33) 3 28 40 43 70 Portable: +(33) 6 84 58 59 84 </br>Email : contact@parenthesechampetre.fr</p>
        </div>
        <div class="row">
          <div class="col-lg-6 gauche">
            <strong>Pour accéder à « Parenthèse Champêtre » : </strong>
                  <p>Coordonnées GPS :
                  N50° 39.7284', E002° 39.2408'</p>
              <span id="error-message"><?php if(isset($erreur)) { echo $erreur;} ?></span>
              <form class="form-horizontal" role="form" action="contact.php" method="post">
                <strong>Contactez-nous par le formulaire:</strong>
                    <div class="form-group">
                    <label for="Nom" class="col-sm-2 control-label">Nom</label>
                      <div class="col-sm-7">
                        <input type="text"  class="form-control" id="Nom" name="nom" placeholder="Nom" value="<?php if(isset($nom)) echo $nom; ?>">
                        <span id="error-message"><?php if(isset($erreurnom)) echo $erreurnom; ?></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Prenom" class="col-sm-2 control-label">Prénom</label>
                        <div class="col-sm-7">
                          <input type="text"  class="form-control" id="Prenom" name="prenom" placeholder="Prénom" value="<?php if(isset($prenom)) echo $prenom; ?>">
                          <span id="error-message"><?php if(isset($erreurprenom)) echo $erreurprenom; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-7">
                          <input type="email"  class="form-control" id="email" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>">
                          <span id="error-message"><?php if (isset($erreurmail)) echo $erreurmail; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Téléphone</label>
                        <div class="col-sm-7">
                          <input type="tel"  class="form-control" id="telephone" name="phone" placeholder="telephone" value="<?php if(isset($phone)) echo $phone; ?>">
                          <span id="error-message"><?php if (isset($erreurphone)) echo $erreurphone; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="message" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-7">
                          <textarea class="form-control" rows="3" name="texte"><?php if(isset($texte)) echo $texte; ?></textarea>
                          <span id="error-message"><?php if (isset($erreurtexte)) echo $erreurtexte; ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                      </div>
                    </div>
                  </form>

                </div>
         
          <div class="col-lg-6">
                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=4+rue+du+Moulin+59940+NEUF+BERQUIN&amp;aq=&amp;sll=50.529025,3.160487&amp;sspn=2.042828,5.410767&amp;ie=UTF8&amp;hq=&amp;hnear=4+Rue+du+Moulin,+59940+Neuf-Berquin&amp;ll=50.662186,2.652565&amp;spn=1.02096,2.705383&amp;t=h&amp;z=9&amp;output=embed"></iframe>           
          </div>
        </div>   
      </section> <!-- fin section content   -->
      
      <div id="footer">
        <div class="row">
              <p class="texte_footer">Gite Parenthèse Champètre dans le Nord  - 4 rue du Moulin 59940 NEUF BERQUIN<br/>
 
                Isabelle et Jean Pierre DANET - Tél + (33) 3 28 40 43 70 -  + (33) 6 84 58 59 84 Email : contact@parenthesechampetre.fr</p>
                <!-- <a href="http://www.parenthesechampetre.fr" target="about_blank">www.parenthesechampetre.fr</a>  |  -->
        </div>
      </div>

  </section> <!-- fin section content All   -->
  <span class="CC"><a href="http://camilledewavrin.github.io/" target="about_blanck"><img src="style/image/icon/avatar.png" alt="Camille D" width="50"></a><a href="http://charleslamarque.com/" target="about_blanck"><img src="style/image/icon/C.png" alt="Charles L" width="38"></a></span>
      

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/bootstrap.min.js"></script>
  </body>
</html>