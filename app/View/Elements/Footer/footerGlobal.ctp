<div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="logo">
                         <i id="icon" class="fa fa-500px" style="text-shadow: rgb(42, 43, 46) 0px 0px 0px, rgb(43, 44, 47) 1px 1px 0px, rgb(44, 45, 48) 2px 2px 0px, rgb(45, 46, 49) 3px 3px 0px, rgb(46, 47, 50) 4px 4px 0px, rgb(47, 48, 51) 5px 5px 0px, rgb(48, 49, 52) 6px 6px 0px, rgb(49, 50, 54) 7px 7px 0px, rgb(50, 51, 55) 8px 8px 0px, rgb(52, 52, 56) 9px 9px 0px, rgb(53, 53, 57) 10px 10px 0px, rgb(54, 55, 58) 11px 11px 0px, rgb(55, 56, 59) 12px 12px 0px, rgb(56, 57, 60) 13px 13px 0px, rgb(57, 58, 62) 14px 14px 0px, rgb(58, 59, 63) 15px 15px 0px, rgb(59, 60, 64) 16px 16px 0px; font-size: 73px; color: rgb(148, 169, 255); height: 123px; width: 123px; line-height: 123px; border-radius: 30%; text-align: center; background-color: rgb(60, 61, 65);"></i>
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
                    <h5>About us</h5>
                    <ul>
                        <li><?= $this->html->link('Contattaci',array('controller' => 'pages', 'action' => 'contact')); ?></li>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="social-networks">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="google"><i class="fa fa-google"></i></a>
                    </div>
                    <button type="button" class="btn btn-default">Contact us</button>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© <?php echo date("Y"); ?> Copyright </p>
        </div>
    </footer>
</div>
