<div class="row">

    <div class="large-9 medium-8 columns">
        
           <div id="infoMessage"><?php echo $message;?></div>
            <?php $attributes = array('data-abide' => '','novalidate' => 'novalidate' );
            echo form_open(uri_string(), $attributes);
            ?>
            
            <fieldset>
    		<legend>Contactgegevens </legend>
                  <div class="row">
                    <div class="large-6 columns">
                        <label for="voornaam">Voornaam <small>verplicht</small></label>
                        <input type="text" name="first_name" id="voornaam" value="<?php if(isset($account['first_name'])) echo htmlspecialchars($account['first_name']);?>" placeholder="Uw voornaam" required pattern="alpha">
                        <small class="error">U moet uw voornaam opgeven</small> </div>
                    <div class="large-6 columns">
                        <label for="Achternaam">Achternaam <small>verplicht</small></label>
                        <input type="text" name="last_name" id="achternaam" value="<?php if(isset($account['last_name'])) echo htmlspecialchars($account['last_name']);?>" placeholder="Uw achternaam" required pattern="alpha">
                        <small class="error">U moet uw achternaam opgeven</small> </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label for="email">E-mail (login) <small>verplicht</small></label>
                        <input type="text" id="email" name="email" value="<?php if(isset($account['email'])) echo htmlspecialchars($account['email']);?>" placeholder="Uw e-mailadres" pattern="email" required>
                        <small class="error">Voer een geldig e-mailadres in</small> </div>
                </div>
                <?php if (!isset( $account['id'] ))  {?>
                <div class="row">
                    <div class="large-12 columns">
                        <label for="password1">Wachtwoord <small>verplicht</small></label>
                        <input type="password" id="password1" name="password"  value="<?php if(isset($account['password'])) echo htmlspecialchars($account['password']);?>" autocomplete="off" placeholder="Uw wachtwoord" pattern="password" <?php if (!isset( $account['id'] )) echo "required";?>>
                        <small class="error">Het wachtwoord mag niet leeg zijn</small> </div>
                    <div class="large-12 columns">
                        <label for="password2">Bevestig wachtwoord <small>verplicht</small></label>
                        <input type="password" id="password2" placeholder="Uw controle wachtwoord" name="password_confirm"  value="<?php if(isset($account['password_confirm'])) echo htmlspecialchars($account['password_confirm']);?>" <?php if (!isset( $account['id'] )) echo 'required data-equalto="password1"';?>>
                        <small class="error">De wachtwoorden moeten hetzelfde zijn</small> </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="large-12 columns">
                        <label for="iban_number">IBAN <small>verplicht</small></label>
                        <input type="text" name="iban_number" id="iban_number" value="<?php if(isset($account['iban_number'])) echo  htmlspecialchars($account['iban_number']);?>" placeholder="Uw bankrekeningnummer" required pattern="alpha_numeric">
                        <small class="error">U moet uw bankrekeningnummer opgeven</small>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label for="geslacht">Geslacht</label>
                        
                        <input type="radio" name="gender" value="m" <?php if(isset($account['gender']) && $account['gender'] == 'm') echo 'checked';?> /> Man
                        <input type="radio" name="gender" value="v" <?php if(isset($account['gender']) && $account['gender'] == 'v') echo 'checked';?> /> Vrouw
          
                    </div>
                </div>
                
             </fieldset>
                
               <fieldset>
               <?php if (!isset( $account['id'] ))  {?>
                <div class="row">
                    <div class="large-12 columns">
                        <label for="checkbox1">
                            <input type="checkbox" id="checkbox1" name="akkoord" value="" onClick="if (this.checked){this.value='1';}else{this.value='';}" pattern="checkbox" required>
                            Ja, ik ga akkoord met de voorwaarden van zoommarkt.nl</label>
                    </div>
                </div>
               <?php }?>
                <div class="row">
                    <div class="large-12 columns">
                        <button type="submit" id="submitknop"  class="medium button radius">Verstuur</button>
                    </div>
                </div>
            </fieldset>
            
            <?php if (isset( $account['id'] )) echo form_hidden('id', $account['id']);?>
              <?php echo form_hidden($csrf); ?>

        <?php echo form_close();?>
</div>
</div>
