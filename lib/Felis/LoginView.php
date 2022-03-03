<?php


namespace Felis;


class LoginView extends View {
    public function __construct(array &$session, array $get) {
        $this->setTitle('Felis Investigations');
        if(isset($get['e'])){
            if(isset($session['e'])){
                if($session['e'] == true){
                    $this->failedLogin = true;
                    $session['e'] = false;
                }

            }
        }
    }

    public function presentForm() {
        $html = '';




        $html .= <<<HTML
<form method="post" action="post/login.php">
    <fieldset>
        <legend>Login</legend>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
        </p>
        <p><a href="./">Felis Agency Home</a></p>

    </fieldset>
</form>
HTML;
        if($this->failedLogin){
            $html .= '<p class="msg">Invalid login credentials</p>';
        }

        return $html;
    }





    private $failedLogin = false;
}