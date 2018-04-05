<?php
    // echo $this->Html->css('pages/home',array('inline' => false));
    echo $this->Html->script('pages/home.js',array('inline' => false));
?>
<header class="masthead text-center text-white" id='home'>
    <div class="container my-auto">
        <div class="row" style='padding-top:30%'>
            <div class="col-lg-10 mx-auto">
                <h1 class='title'>
                    <strong>PostIT</strong>
                </h1>
                <hr>
            </div>
            <div class="col-lg-8 mx-auto ">
                <p class='description'>Blog Site</p>
                <?php
                echo $this->Html->link('About Us','#about',array('class' => 'btn btn-primary btn-outline btn-xl btn-circle js-scroll-trigger'))
                ?>

            </div>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h1 class="section-heading text-white">About Us</h1>
        <hr>
        <p class='mb-4'>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        <?= $this->Html->link('Contattaci','#contact',array('class' => 'btn btn-light btn-xl js-scroll-trigger')) ?>
      </div>
    </div>
  </div>
</section>
