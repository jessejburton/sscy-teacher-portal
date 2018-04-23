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
                        <h3>Teacher Bio</h3>
                        <textarea id="bio" class="input-textarea" placeholder="teacher bio" rows="20">“From the very first time I stepped on to my mat, I felt as if I had come home to myself.” John brings this sense of gratitude to both his practice and his teaching. His classes are challenging and fun, giving each student a chance to explore pranayama, meditation and asana. Knowing that we are both teachers and students, John shares his understanding of the transformative nature of yoga, while at the same time encourages each student to be guided by their own inner wisdom.
                        </textarea>
                    </div>
                    <div class="col-1-of-2">
                        <h3>Photo</h3>
                        <div class="profile-photo">
                            <img src="img/john.jpg" class="profile-photo-image" />
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