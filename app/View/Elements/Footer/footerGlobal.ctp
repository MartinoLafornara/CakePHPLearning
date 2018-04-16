<div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="logo">
                        <?php echo $this->Html->link($this->Html->image('p_icon.png', array('alt' => 'icon_postIT', 'border' => '1')),
                            '#home',
                            array('escape' => false,'class' => 'js-scroll-trigger')
                        );
                        ?>
                    </h2>
                </div>
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><?= $this->html->link('Home',array('controller' => 'pages', 'action' => 'home')); ?> </li>
                        <li><?= $this->html->link('Signup',array('controller' => 'users', 'action' => 'signup')); ?></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Information</h5>
                    <p> Lorem ipsum dolor amet, consectetur adipiscing elit. Etiam consectetur aliquet aliquet. Interdum et malesuada fames ac ante ipsum primis in faucibus. </p>
                </div>
                <div class="col-sm-3">
                    <div class="social-networks">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="google"><i class="fa fa-google"></i></a>
                    </div>
                    <!-- <button type="button" class="btn btn-default">Contact us</button> -->
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© <?php echo date("Y"); ?> Copyright </p>
        </div>
    </footer>
</div>
