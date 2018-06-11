<div class="container" ng-controller="profileController" ng-init="getLoggedInProfile()" ng-cloak>
    <h2>My Profile</h2>
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
                <!--
                <h3>Pin</h3>
                <input id="pin" type="text" class="input-text" placeholder="pin" ng-model="profile.pin" maxlength="4" />
                <label for="pin" class="input-text-label">pin</label>
                <small>* This pin will be used to unlock the screen when in class mode.</small>       
                -->         
            </div>
        </div>
        
        <div class="row input-group">
            <div class="col-1-of-2">
                <h3>Teacher Bio</h3>
                <textarea id="bio" class="input-textarea" placeholder="teacher bio" rows="20" ng-model="profile.bio"></textarea>
            </div>
            <div class="col-1-of-2">
                <h3>Photo</h3>
                <div class="profile-photo">
                    <img src="{{profile.photo}}" class="profile-photo-image" />
                    <div class="profile-photo-hover"><div class="profile-photo-text">CHANGE PHOTO</div></div>
                </div>
            </div>
        </div>

        <div class="button-group u-text-right">
            <a class="button profile__save-button" href="javascript:void(0);" ng-click="saveProfile()">SAVE PROFILE</a>
        </div>
    </form>
</div>
