<?
session_start();
include('kcaptcha/kcaptcha.php');
require_once("config.php");
require_once("kcaptcha/util/script.php");

if ($_POST['act']== "y")
{
    if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring'])
    {
        
        if (isset($_POST['posName']) && $_POST['posName'] == "")
        {
         $statusError = "$errors_name";
        }
        elseif (isset($_POST['posEmail']) && $_POST['posEmail'] == "")
        {
         $statusError = "$errors_mailfrom";
        }
        elseif(isset($_POST['posEmail']) && !preg_match("/^([a-z,._,0-9])+@([a-z,._,0-9])+(.([a-z])+)+$/", $_POST['posEmail']))
        {
         $statusError = "$errors_incorrect";

         unset($_POST['posEmail']);
        }
        elseif (isset($_POST['posPhone']) && $_POST['posPhone'] == "")
        {
         $statusError = "$errors_subject";
        }
		elseif(isset($_POST['posPhone']) && !preg_match("/^([0-9])+$/", $_POST['posPhone']))
        {
         $statusError = "$errors_incorrect2";

         unset($_POST['posEmail']);
        }
       
elseif (!empty($_POST))
{   
 $headers  = 'MIME-Version: 1.0\r\n';
 $headers .= "Content-Type: $content  charset=$charset\r\n";
 $headers .= "Date: ".date("Y-m-d (H:i:s)",time())."\r\n";
 $headers .= "From: \"".$_POST['posName']."\" <".$_POST['posEmail'].">\r\n";
 $headers .= "X-Mailer: My Send E-mail\r\n";

 $message.="Namn :  ".$CustName." , "." \r\n "."Telefon :  ".$phone." , "." \r\n "."Epost :  ".$CustEmail." , "." \r\n ";
 $message.="Region/Område :  ".$ListRegion." , "." \r\n "."Annan Region :  ".$DiffRegion." , "." \r\n"."Adress :  ".$CustAdress." , "."\r\n"."Postnummer : ".$CustPostnummer." , "."\r\n"."Onskad taktyp : ".$OnskadTak." , "." \r\n "."När planerar : ".$Planer." , "." \r\n "." Byggställning behövs :  ".$Stallning." , "." \r\n "."Takyta, m2 :  ".$TakYta." , "." \r\n "."Höjd på huset :  ".$HusHojd." , "." \r\n "."Taklutning:  ".$TakLutning." , "." \r\n "."Byggnaddsår :  ".$HusAlder." , "." \r\n "."Kunden meddelar :  ".$ExtraMeddelande;
 mail( "$mailto1" , "$subject", "$message", $headers);
mail( "$mailto2" , "$subject", "$message", $headers);

 unset($name, $posText, $mailto1, $mailto2, $subject, $posPhone, $message);

 $statusSuccess = "$send";
}

       }else{
             $statusError = "$captcha_error";
             unset($_SESSION['captcha_keystring']);
        }
}
?>
<html>
<head>
<html lang="sv">

	<head>
		<title>
			RR Tak Teknik AB - taklaggare och fasadrenovering taklaggning takarbeten takrenovering 
		</title>
			
			<link  rel="stylesheet" type="text/css" href="style.css"/>
			
	</head>

	<body>
		<div id="wrap">
			<div id="header">
				<div id="header_left">
						<a href="index.html"><img src="img/logo.png" alt="Startsida"></a>
				</div><!--end header_left-->
				<!--<div id="header_right">
							<li>Ormangsgatan 45,16556 Hasselby</li>
							<li>0707999016</li>
							<li><a href="mailto:info@rrentreprenad.se">
							info@rrentreprenad.se</a>
				</div><!--end header_right-->
			</div><!--end header-->
			<div id="navigation">
					<ul id="nav">
						<li class="navi"><a href="Omoss.html">OM OSS</a></li>
						<li class="navi"><a href="Tjanster.html">TJÄNSTER</a></li>
						<li class="navi"><a href="Kungtrygghet.html">KUNDTRYGGHET</a></li>
						<li class="navi"><a href="prisforfragan.php">PRISFÖRFRÅGAN</a></li>
						<li class="navi"><a href="ROTavdrag.html">ROT-AVDRAG</a></li>
                        <!-- <li class="navi"><a href="Referencer.html">REFERENCER</a></li>-->
						<li class="navi"><a href="Kontaktaoss.html">KONTAKTA OSS</a></li>				
					</ul>
				</div><!-- end navigation-->
			<div id="prisform">
							<h3>PRISFÖRFRÅGAN</h3><p>Vänligen fyll in information </p>
							<form method="post" action="prisforfragan.php">
							<p id="emailSuccess"><strong style="font-size: 25px;color:green;"><?php echo $statusSuccess.$r0; ?></strong></p>
								<p id="emailError"><strong style="font-size: 25px; color:red;"><?php echo $statusError.$r1; ?></strong></p>
							<input type="hidden" name="act" value="y" />
				<div class="floatleft">
							<label for="posName"><span>*</span>Namn/Företag:</label>
							<input name="posName" placeholder="Skriv här" />
							<label for="posEmail"><span>*</span>E-post:</label>
							<input name="posEmail" type="email" placeholder="Skriv här" />
							<label for="posPhone"><span>*</span>Telefon:</label>
							<input name="posPhone" placeholder="Skriv här" />
							<label for="regionomrade">Region/Omrade:</label>
						<select id="region" name="region">	
							<option value="">Valj i listan</option>
							<option value="Bagarmossen" >Bagarmossen</option>
							<option value="Bandhagen" >Bandhagen</option>
							<option value="Bro" >Bro</option>
							<option value="Bromma" >Bromma</option>
							<option value="Danderyd" >Danderyd</option>
							<option value="Djursholm" >Djursholm</option>
							<option value="Ekero" >Ekerö</option>
							<option value="Enebyberg" >Enebyberg</option>
							<option value="Enskede" >Enskede</option>
							<option value="Farsta" >Farsta</option>
							<option value="Gustavsberg" >Gustavsberg</option>
							<option value="Haninge" >Haninge</option>
							<option value="Hemmesta" >Hemmesta</option>
							<option value="Huddinge" >Huddinge</option>
							<option value="Hagersten" >Hägersten</option>
							<option value="Hasselby" >Hässelby</option>
							<option value="Johanneshov" >Johanneshov</option>
							<option value="Jordbro" >Jordbro</option>
							<option value="Jarfalla" >Järfalla</option>
							<option value="Kista" >Kista</option>
							<option value="Kungsangen" >Kungsängen</option>
							<option value="Lidingo" >Lidingö</option>
							<option value="Marsta" >Märsta</option>
							<option value="Nacka" >Nacka</option>
							<option value="Nacka Strand" >Nacka Strand</option>
							<option value="Norsborg" >Norsborg</option>
							<option value="Rosersberg" >Rosersberg</option>
							<option value="Ronninge" >Rönninge</option>
							<option value="Saltsjo-Boo" >Saltsjö-Boo</option>
							<option value="Saltsjo-Duvnas" >Saltsjö-Duvnas</option>
							<option value="Saltsjobaden" >Saltsjöbaden</option>
							<option value="Segeltorp" >Segeltorp</option>
							<option value="Sigtuna" >Sigtuna</option>
							<option value="Skarpnack" >Skarpnäck</option>
							<option value="Skogas" >Skogås</option>
							<option value="Skarholmen" >Skärholmen</option>
							<option value="Skondal" >Skondal</option>
							<option value="Sollentuna" >Sollentuna</option>
							<option value="Solna" >Solna</option>
							<option value="Spanga" >Spånga</option>
							<option value="Stockholm" >Stockholm</option>
							<option value="Stocksund" >Stocksund</option>
							<option value="Sundbyberg" >Sundbyberg</option>
							<option value="Tomteboda" >Tomteboda</option>
							<option value="Trangsund" >Trångsund</option>
							<option value="Tullinge" >Tullinge</option>
							<option value="Tumba" >Tumba</option>
							<option value="Tungelsta" >Tungelsta</option>
							<option value="Tyreso" >Tyresö</option>
							<option value="Taby" >Täby</option>
							<option value="Upplands Vasby" >Upplands Väsby</option>
							<option value="Vallentuna" >Vallentuna</option>
							<option value="Vaxholm" >Vaxholm</option>
							<option value="Vallingby" >Vallingby</option>
							<option value="Varmdo" >Varmdö</option>
							<option value="Vasterhaninge" >Västerhaninge</option>
							<option value="Akersberga" >Akersberga</option>
							<option value="Arsta" >Årsta</option>
							<option value="Alta" >Alta</option>
							<option value="Alvsjo" >Alvsjö</option>
							<option value="Orby" >Örby</option>
							<option value="Osterskar" >Österskär</option>
							<option value="Annan region/omrade">Annan region/omrade</option>
						</select>
							<label for="annanregion">Annan region/omrade:</label>
							<input name="annanregion" placeholder="Skriv här" />
							<label for="adress">Adress:</label>
							<input name="adress" placeholder="Skriv här" />
				</div><!--end floatleft-->
				<div class="center">
							<label for="postnummer">Postnummer:</label>
							<input name="postnummer" placeholder="Skriv här" />
							<label for="ort">Ort:</label>
							<input name="ort" placeholder="Skriv här" />
							<label for="onskadtaktyp"><span>*</span>Önskad taktyp:</label>
						<select id="onskad" name="onskad">			
							<option value="">Valj i listan</option>
							<option value="Shingel tak">Shingel tak</option>
							<option value="Plat profiltak">Plåt profiltak</option>
							<option value="Yt papp">Yt papp</option>
							<option value="Snoskottning">Snökottning</option>
							<option value="Takfonster montering">Takfönster montering</option>
							<option value="Taklaggning(tegel,betong)">Taklaggning(tegel,betong)</option>
							<option value="Taksakerhet">Taksäkerhet</option>
						</select>
							<label for="planera">Planerar installation:</label>
						<select id="planerar" name="planerar">
							<option value="Ej valt">Valj i listan</option>
							<option value="Snarast mojligt">Snarast mojligt</option>
							<option value="Om 1 manad">Om 1 månad</option>
							<option value="Om 3 manader">Om 3 månader</option>
							<option value="Om 6 manader">Om 6 månader</option>
							<option value="Om 12 manader">Om 12 månader</option>
							<option value="Om 2 ar">Om 2 år</option>
							<option value="Om 3 ar">Om 3 år</option>
						</select>
							<label for="byggnad">Behövs byggnadsstallning?</label>
							<input type="radio" id="Ja" name="byggnad" class="inlineinput" value="Ja">Ja
							<input type="radio" id="Nej" name="byggnad" class="inlineinput" value="Nej">Nej
							<input type="radio" id="Vetej" name="byggnad" class="inlineinput" checked="checked" value="Vet ej">Vet ej
							<label for="takytans">Takytan, m2:</label>
							<input name="takytans" placeholder="Skriv har" />
				</div><!--end center-->
				<div class="floatright">
							<label for="hojd">Höjd pa huset i meter:</label>
							<input name="hojd" placeholder="Skriv här" />
							<label for="takvinkel">Taklutning:</label>
							<input name="takvinkel" placeholder="Skriv här" />
							<label for="fastighet">Fastighetens byggnadsår:</label>
							<input name="fastighet" placeholder="Skriv här" />
							<label for="meddelande">Meddelande:</label>
							<textarea name="meddelande" placeholder="Skriv här"></textarea>
		
				<div id="q"><label for="posCaptcha"><b>Vänligen fyll säkerhetskoden nedan</b>:</label>
									<img src="kcaptcha/index.php?<?php echo session_name()?>=<?php echo session_id()?>"><?php echo $r1; ?><br>
									<input class="inputIE" type="text" size="32" name="keystring" id="keystring" />
								</div>
							<p><input id="submit" name="submit" type="submit" value="Skicka" /></p>
	</form>
				</div><!--end floatright-->
	</div>

			<div id="footer">
				<!--<div id="Solid">
					<a href="http://www.soliditet.se/lang/sv_SE/RatingGuideline" target="_blank" style="text-decoration: none;"><img style="border:0px;" oncontextmenu="return false" title="Vi &auml;r ett kreditv&auml;rdigt f&ouml;retag enligt Soliditets v&auml;rderingssystem som baserar sig p&aring; en m&auml;ngd olika beslutsregler. Denna uppgift &auml;r alltid aktuell&#44; informationen uppdateras dagligen via Soliditets databas." alt="Vi &auml;r ett kreditv&auml;rdigt f&ouml;retag enligt Soliditets v&auml;rderingssystem som baserar sig p&aring; en m&auml;ngd olika beslutsregler. Denna uppgift &auml;r alltid aktuell&#44; informationen uppdateras dagligen via Soliditets databas." id="img_273_73_px" src="http://merit.soliditet.se/merit/imageGenerator/display?lang=SE&country=SE&cId=hdiusnevL%2FMJGRHGorii7Q%3D%3D&cUid=ycnQj7K2m6I%3D&imgType=img_273_73_px" /> </a>  
				</div><!--end of solid-->
				<div id="copyright"> Copyright &#169 2013  <a href='mailto:e.protsyuk@gmail.com'>YeP</a>
				</div><!--end of copyright>
			</div><!--end of footer-->
</div><!--end of wrap-->
</body>
</html>