<!-- This here is a modal that can be called by using AJAX -->
<div id="modal" style="display: none;" onclick="if (event.target.id == 'modal') document.getElementById('modal').style.display = 'none';">
    <div id="modal-box">
        <div id="modal-header" class="row">
            <div id="modal-title" class="ten columns">
                
            </div>
            <div class="two columns">
                <span id="modal-close" class="u-pull-right" onclick="document.getElementById('modal').style.display = 'none'">&times;</span>
            </div>
        </div>
        <div id="modal-content" class="row">
        </div>
    </div>
</div>

        </main>
        <footer>
        <div class="container" id="footer-container">
            <div class="row">
                <div class="four columns">
                    <a id="logo" href="<?php echo BASEURL; ?>"><img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/favicon.png" alt="logo">lighter framework</a>
                    <br>
                    <p id="desc"><b>"It's a lighter-ning fast framework!"</b></p>
                </div>
                <div class="eight columns">
                    <div class="row">
                        <div class="logos">
                            <div class="three columns">
                                <a href="https://www.imo-official.org/">                               
                                    <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/php.svg" alt="PHP Logo">                              
                                </a>
                            </div>
                            <div class="three columns">
                                <a href="http://www.apmo-official.org/">
                                    <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/mysql.svg" alt="MySQL Logo">                              
                                </a>
                            </div>
                    
                            <div class="three columns">
                                <a href="http://www.worldimo.org/">
                                    <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/skeleton.svg" alt="Skeleton Logo">                             
                                </a>
                            </div>
                            <div class="three columns">
                                <a href="https://www.hongkongimo.com/">
                                    <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/jquery.svg" alt="JQuery Logo">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="copyright">
            <hr>
            Copyright &copy;2021 <b>Lighter Framework</b>, All rights reserved.
        </div>
        </footer>
    </body>
</html>

