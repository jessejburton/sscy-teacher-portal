<div class="container" ng-controller="profileController" ng-init="getTeacherProfile()" ng-cloak>
    <h2>Teacher Profile</h2>

    <!-- Select a teacher -->
    <div class="input-group u-bottom-space" ng-show="<?php echo $_SESSION['is_admin']; ?>">
        <label for="teacher_select" class="label-select">Select a Teacher</label>
        <select class="input-select input-select-inline"
                ng-model="profile" 
                ng-change="getTeacherProfile()"
                ng-options="teacher.name for teacher in teachers track by teacher.account_id">
        </select>
    </div>

    <form>
        <div ng-show="message.show" class="alert alert-{{message.type}}">
            {{message.text}}
        </div>

        <div class="row input-group">
            <h3>Name</h3>
            <div class="col-1-of-2">
                <input id="name_first" type="text" class="input-text" placeholder="first name" ng-model="profile.name_first" /> 
                <label for="name_first" class="input-text-label">first name</label>      
            </div><!-- .col-1-of-2 -->
            <div class="col-1-of-2">
                <input id="name_last" type="text" class="input-text" placeholder="last name" ng-model="profile.name_last" />
                <label for="name_last" class="input-text-label">last name</label>                              
            </div><!-- .col-1-of-2 -->
        </div>

        <div class="row input-group">
            <h3>Email</h3>
            <div class="col-1-of-1">
                <input id="email" type="text" class="input-text" placeholder="email" ng-model="profile.email" />
                <label for="email" class="input-text-label">email</label>
            </div>
        </div>

        <div class="row input-group">
            <div class="col-1-of-2">
                <h3>Waiver</h3>
                <p>feature coming soon!</p>
            </div>
            <div class="col-1-of-2">
                <h3>Class Cost</h3>
                <input id="price" type="text" class="input-text" placeholder="class cost" ng-model="profile.price" maxlength="100" />
                <label for="price" class="input-text-label">cost of class (i.e. $15, By Donation, Sliding Scale $10-15 etc.)</label>
            </div>
        </div>
        
        <div class="row input-group">
            <div class="col-1-of-2">
                <h3>Teacher Bio</h3>
                <textarea id="bio" class="input-textarea" placeholder="teacher bio" rows="20" ng-model="profile.bio"></textarea>
            </div>
            <div class="col-1-of-2">
                <h3>Photo</h3>
                <div class="profile-photo" ng-click="changePhoto()">
                    <img src="{{profile.photo}}" class="profile-photo-image" />
                    <div class="profile-photo-hover"><div class="profile-photo-text">CHANGE PHOTO</div></div>
                </div>

                <!-- Upload Form -->
                <form action="templates/profile/upload.php?userid=<?php echo $_SESSION['user_id'] ?>" target="upload_frame" method="post" enctype="multipart/form-data" name="photo_form" id="photo_form">
                    <input name="file" type="file" id="photo" size="30" />
                </form>
                <!-- Upload Form Iframe -->
                <iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="templates/profile/upload.php" scrolling="no" scrollbar="no" > </iframe>

            </div>
        </div>

        <div class="button-group u-text-right">
            <a class="button profile__save-button" href="javascript:void(0);" ng-click="saveProfile()">SAVE PROFILE</a>
        </div>
    </form>
</div>
