<?php
/**
 * The footer for the theme.
 *
 * Displays all of the footer section and everything after.
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 */
?>

<footer id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 to-animate">
                <h3 class="section-title">About Us</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                <p class="copy-right">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <br>All Rights Reserved. <br>
                    Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a><br>
                    Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a>
                </p>
            </div>

            <div class="col-md-4 to-animate">
                <h3 class="section-title">Our Address</h3>
                <ul class="contact-info">
                    <li><i class="icon-map-marker"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
                    <li><i class="icon-phone"></i>+ 1235 2355 98</li>
                    <li><i class="icon-envelope"></i><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                    <li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
                </ul>
                <h3 class="section-title">Connect with Us</h3>
                <ul class="social-media">
                    <li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
                    <li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
                </ul>
            </div>

            <div class="col-md-4 to-animate">
                <h3 class="section-title">Drop us a line</h3>
                <form class="contact-form" action="#" method="post">
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="message" class="sr-only">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="7" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
