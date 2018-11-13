<div class="container" style="width: 50%;" ng-controller="loginController">
    <h1>Please Log In</h1>
    <form>
        <div ng-if="message.show" class="alert alert-{{message.type}}" ng-cloak>
            {{message.text}}
        </div>

        <div class="input-group">
            <input type="text" class="input-text" id="username" placeholder="username" ng-model="username" />
            <label for="username" class="input-text-label">username</label>
        </div>

        <div class="input-group">
            <input type="password" class="input-text" id="password" placeholder="password" ng-model="password" />
            <label for="password" class="input-text-label">password</label>
        </div>

        <div class="button-group">
            <button class="button" id="login" ng-click="checkUserLogin()">Login</button>
        </div>
    </form>
</div>
