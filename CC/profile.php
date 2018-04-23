<?php require_once('header.php'); ?>


    <section>
        <article class="row">
            <h2 class="u-bottom-space">My Profile</h2>

            <form>
                <div class="row">
                    <h3>Name</h3>
                    <div class="col-1-of-2">
                        <input id="name_first" type="text" class="input-text" placeholder="first name" value="John" /> 
                        <label for="name_first" class="input-text-label">first name</label>      
                    </div><!-- .col-1-of-2 -->
                    <div class="col-1-of-2">
                        <input id="name_last" type="text" class="input-text" placeholder="last name" value="Howes" />
                        <label for="name_last" class="input-text-label">last name</label>                              
                    </div><!-- .col-1-of-2 -->
                </div>

                <div class="row">
                    <h3>Email</h3>
                    <div class="col-1-of-1">
                        <input id="email" type="text" class="input-text" placeholder="email" value="" />
                        <label for="email" class="input-text-label">email</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-1-of-2">
                        <h3>Bio</h3>
                        <textarea id="bio" class="input-textarea" placeholder="cc member bio" rows="20">
                        </textarea>
                    </div>
                    <div class="col-1-of-2">
                        <h3>Photo</h3>
                        <div class="profile-photo">
                            <img src="img/sn.jpg" class="profile-photo-image" />
                            <div class="profile-photo-hover"><div class="profile-photo-text">CHANGE PHOTO</div></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <a class="button" href="#">SAVE PROFILE</a>
                </div>
            </form>
        </article><!-- .row -->
    </section><!-- .section -->


<?php require_once('footer.php'); ?>          