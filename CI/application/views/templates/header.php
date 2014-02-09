   <!-- start nav -->
    <div class="topnav">
        <div class="row collapse">
            <nav class="top-bar" data-topbar>
                <section class="top-bar-section">
                    <div class="large-3 small-4 columns">
                        <a href="/" class="logo">ZoomMarkt<small>.nl</small></a> 
                    </div>
                    <div class="large-9  small-8 columns">
                        <ul class="right">
                            <li>
                                <?php if ($loggedin) {?>
                                <div class="row collapse">
                                   <div class="small-txt"> je bent ingelogd als <a href="/profiel"><?php 
                                   if (isset($user)){ 
                                         echo $user['first_name'] . ' ' . $user['last_name'];
                                      }?></a> 
                                       | <a href="/uitloggen">uitloggen</a></div>
                                </div>
                                <div class="row collapse  show-for-large-up">
                                	<div class="small-9 columns right">
                                		
                                    </div>
                                </div>
                                <?php } else {?>
                                <?php echo form_open("/inloggen");?>
                                <div class="row collapse">
                                    <div class="small-2 small-4 columns">
                                        <input type="text" name="identity" id="identity" placeholder="e-mailadres">
                                      </div>
                                    <div class="small-2 small-4 columns">
                                        <input type="password" name="password" id="password" placeholder="wachtwoord">
                                      </div>
                                    <div class="small-2 small-4 columns"><input type="submit" class="small button expand" style="height:30px;padding-top: 0.45rem;" value="inloggen" /></div>
                                    
                                </div>
                                <div class="row collapse  show-for-large-up">
                                	<div class="small-12 columns">
                                	<div class="small-txt  right"><input style="height:20px;padding-top:-10px" name="remember" id="remember" value="1" type="checkbox"> onthoud mijn login</div>
                                    </div>
                                </div>
                                <?php echo form_close();?>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </section>
            </nav>
        </div>
    </div>
    <div class="subnav">
        <div class="row">
            <div class="small-10 columns"> 
            <a href="/" class="small button nav-button">Home</a> 
            
            <?php if ($loggedin) {?>
            <a href="/profiel" class="small button nav-button dropdown" data-dropdown="profile">Mijn profiel</a> 
            <ul id="profile" class="f-dropdown" data-dropdown-content>
                <li><a href="/profiel">Profiel</a></li>
                <li><a href="/mijn-fotos">Mijn foto's</a></li>
                <li><a href="/foto-toevoegen">Foto's toevoegen</a></li>
                <li><a href="/aanpassen">Profiel wijzigen</a></li>
                <li><a href="/wachtwoord-veranderen">Wachtwoord veranderen</a></li>
                
            </ul>
            <?php } else  {?>
             <a href="/aanmelden" class="small button nav-button">Registreren</a> 
            <?php } ?>
             <a href="/" class="small button nav-button">Zoek foto's</a> 
            <?php if ($isadmin){ ?>
              <a href="/admincms" class="small button nav-button">Admin</a>
             <?php } ?>  
            </div>
            
            <div class="small-2 columns show-for-large-up"> <a href="http://www.zoom.nl" class="small button nav-button"  style="float:right">ZOOM.nl</a> </div>
        </div>
    </div>