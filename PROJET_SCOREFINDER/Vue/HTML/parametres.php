
<div class = "panneauParam nonafficheParam" id="panneauParam">
	<div id='titleParam'><h2>Mes Paramètres</h2></div>

	
	<ul>
		
		<li id="pseudoStable" name="pseudo" onClick="changePseudo()"><div class="valSpanPseudo"><?php echo $aCompte->getUserName(); ?></div></li>
		<li><div class="valSpanNom"><?php echo $aCompte->getNom(); ?></div></li>
		<li><div class="valSpanPrenom"><?php echo $aCompte->getPrenom(); ?></div></li>
		<li><div class="valSpanMail"><?php echo $aCompte->getMail(); ?></div></li>
		<li><div class="valSpanAutorisations">Accès aux comptes :</div></li>
	</ul>
	<div id="deezer">
		<label class="nomPlateforme">Deezer</label>
		<div class="onoffswitch">

			<?php 
				if(isset($_SESSION['user']) && $aCompte->getAutorisationDeezer()==1)
				{
			?>
				<input type="checkbox" name="onoffDeezer" class="onoffswitch-checkbox" id="myonoffswitch" onclick="setStatutDeezer(this)" checked>
			<?php	
				}else{
			?>
				<input type="checkbox" name="onoffDeezer" class="onoffswitch-checkbox" id="myonoffswitch" onclick="setStatutDeezer(this)">
			<?php
			}?>			
			<label class="onoffswitch-label" for="myonoffswitch">
				 <div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>
	</div>
	<div id="spotify">	
		<label class="nomPlateforme">Spotify</label>
		<div class="onoffswitch">
			<?php 

				if(isset($_SESSION['user']) && $aCompte->getAutorisationSpotify()==1)
				{
			?>
				<input type="checkbox" name="onoffSpotify" class="onoffswitch-checkbox" id="myonoffswitch2" onclick="setStatutSpotify(this)"checked>
			<?php	
			}else{
			?>
				<input type="checkbox" name="onoffSpotify" class="onoffswitch-checkbox" id="myonoffswitch2" onclick="setStatutSpotify(this)" >
			<?php
			}?>	
		
			<label class="onoffswitch-label" for="myonoffswitch2">
				 <div class="onoffswitch-inner"></div>
				<div class="onoffswitch-switch"></div>
			</label>
		</div>	
	</div>
	<div id="changePWD">
			<span id="buttonMdp" class="mdpDivNonAffiche"  onclick="apparaitreChampsNewPw(this)">Changer Mot de passe</span>
			<form id="seDeco" method="post" action="../../Controleur/deconnexion.php" >
				<input type="submit" id="seDeconnecter"  class="seDeconnecter" name="seDeconnecter" value="" />
			</form>
			
				<div class="saisieNewMdp buttonMdp">
					<h3>Changer mot de passe</h3>
					<form id="form" method="post" action="#" onsubmit="return validerFormSaisieNewMdp(this)">
							<input type="password" id="pw" oninput="verifEtSaisieMdpTempsReel(this)" class="mdp" name="mdp" placeholder="Saisir nouveau mot de passe"/><br>
							<input type="password" id="mdpconf" disabled="" oninput="verifMdpTempsReel(this)" class="passWordConf" name="mdpConf" placeholder="Confirmer le nouveau mot de passe"/><br>
							<span class="erreurMdp"></span>
							<span id="mdpChange"></span>
							<input type="submit" id="validerModif"  class="validModif" name="validerModif" value="Valider" />
					</form>
				</div>
			
		</div>
		
			
	
</div>
<div class="btnParam">
		<input type="button" id="param" class="param" value="Paramètres">
</div>









