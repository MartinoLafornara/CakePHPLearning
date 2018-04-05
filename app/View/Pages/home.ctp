<?php
    echo $this->Html->css('pages/home',array('inline' => false));
    echo $this->Html->script('pages/home.js',array('inline' => false));
?>
<header class="masthead text-center text-white">
    <div class="container my-auto">
        <div class="row" style='padding-top:30%'>
            <div class="col-lg-10 mx-auto">
                <h1 class='title'>
                    <strong>PostIt</strong>
                </h1>
                <hr>
            </div>
            <div class="col-lg-8 mx-auto ">
                <p class='description'>Blog Site</p>
                <a class="btn btn-primary btn-outline btn-circle js-scroll-trigger" href="#about">About Us</a>
            </div>
        </div>
    </div>
</header>
