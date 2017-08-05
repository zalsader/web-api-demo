<?php
/**
 * Created by PhpStorm.
 * User: zuhair
 * Date: 5/8/2017
 * Time: 1:30 AM
 * @var $this \Cake\View\View
 */
use Cake\Core\Configure;

echo $this->Form->create(null, ['type' => 'file']);?>
<fb:login-button
    scope="<?= Configure::read('Facebook.scope') ?>"
    onlogin="checkLoginState();">
</fb:login-button>
<?php
echo $this->Form->hidden('fbtoken', ['id' => 'fbtoken']);
echo $this->Form->file('photo', ['required' => 'required']);
echo $this->Form->textarea('caption');
echo $this->Form->submit('Upload');
echo $this->Form->end();
?>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?= Configure::read('Facebook.appId') ?>',
            cookie     : true,
            xfbml      : true,
            version    : '<?= Configure::read('Facebook.version') ?>'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    $('#fbtoken').val(response.authResponse.accessToken);
                }
            });
        });
    }
</script>
