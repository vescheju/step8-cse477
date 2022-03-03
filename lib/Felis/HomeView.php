<?php


namespace Felis;


class HomeView extends View {
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    public function addTestimonial($quote, $name){
        $this->testimonials[] = ["quote" => $quote, "name" => $name];
    }

    public function testimonials(){
        $count = count($this->testimonials);
        $half = ceil($count/2.0);
        $html = <<<HTML
<section class="testimonials">
<h2>TESTIMONIALS</h2>
<div class="left">
HTML;

        for($i = 0; $i < $half; $i++){
            $html .= "<blockquote>";
            $html .= "<p>" . $this->testimonials[$i]['quote'] . "</p>";
            $html .= "<cite>" . $this->testimonials[$i]['name'] . "</cite>";
            $html .= "</blockquote>";
        }
        $html .= "</div>";
        $html .= "<div class='right'>";
        for($i = $half; $i < $count; $i++){
            $html .= "<blockquote>";
            $html .= "<p>" . $this->testimonials[$i]['quote'] . "</p>";
            $html .= "<cite>" . $this->testimonials[$i]['name'] . "</cite>";
            $html .= "</blockquote>";

        }
        $html .= "</div>";
        $html .= "</section>";
        return $html;

    }




    private $testimonials = [];

}