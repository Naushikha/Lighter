<!-- Lighter modal that can be called by using showModal() -->
<div id="modal" style="display: none;" onclick="if (event.target.id == 'modal') hideModal();">
    <div id="modal-box">
        <div id="modal-header" class="row">
            <div id="modal-title" class="ten columns">
            </div>
            <div class="two columns">
                <span id="modal-close" class="u-pull-right" onclick="hideModal()">&times;</span>
            </div>
        </div>
        <div id="modal-content" class="row">
        </div>
    </div>
</div>

</main>
<footer>
    <div class="container">
        <div class="row">
            <div id="footer-contact" class="three columns">
                <b> Sri Lanka Olympiad Mathematics Foundation </b><br>
                <u>SLOMF Branch Office</u> <br />
                13 1/2, Tissa Avenue, <br />
                Off Galviharaya Road, <br />
                Dehiwela, Sri Lanka. <br />
                Hotline: <br />
                ☎ +94 11 272 4788 <br />
                ☎ +94 76 455 3217 <br />
                <a href="mailto:info@slmathsolympiad.org"> info@slmathsolympiad.org </a>
            </div>
            <div class="three columns">
                <a href="https://www.imo-official.org/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/imo.png" alt="IMO Logo">
                        <figcaption> IMO </figcaption>
                    </figure>
                </a>
                <a href="http://www.worldimo.org/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/wimo.png" alt="WIMO Logo">
                        <figcaption> WIMO </figcaption>
                    </figure>
                </a>
            </div>
            <div class="three columns">
                <a href="http://www.apmo-official.org/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/apmo.png" alt="APMO Logo">
                        <figcaption> APMO </figcaption>
                    </figure>
                </a>
                <a href="https://www.thaiimo.com/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/hkimo.png" alt="HKIMO Logo">
                        <figcaption> HKIMO </figcaption>
                    </figure>
                </a>
            </div>
            <div class="three columns">
                <a href="https://chiuchang.org/imc/en/home-en/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/imc.png" alt="IMC Logo">
                        <figcaption> IMC </figcaption>
                    </figure>
                </a>
                <a href="https://www.hongkongimo.com/">
                    <figure>
                        <img class="u-max-full-width" src="<?php echo BASEURL; ?>/public/img/competitions/timo.png" alt="TIMO Logo">
                        <figcaption> TIMO </figcaption>
                    </figure>
                </a>
            </div>
        </div>
    </div>
    <div id="copyright" class="row">
        Copyright &copy;2021 <b>Lighter Framework</b>, All rights reserved.
    </div>
</footer>
</body>

</html>