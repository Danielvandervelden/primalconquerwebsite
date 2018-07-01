<?php get_header()?>

<div class="main-content-container single">
    <div class="parallax-container flex flex-row-column" style="background-image: url('<?php echo $GLOBALS['contentImage'] ?>');">
        <div class="single-post-container flex-70">
            <main class="single-post-content margin-center blog-post-content">
                <?php if (have_posts()) {
                    while (have_posts()) {
                        the_post();?>
                <div class="padding-top">
                    <div class="featured-image-single">
                        <?php echo get_the_post_thumbnail(); ?>
                    </div>
                    <h2 class="hm">
                        <?php the_title();?>
                    </h2>

                    <div>
                        <?php the_content();?>
                    </div>
                </div>
                <?php } // end while ?>
                <?php } // end if
            ?>

            <form method="POST" action="<?php echo site_url('/support') ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input required type="text" name="support_name" placeholder="Type your name here">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" name="support_email" placeholder="Type your email address here">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input required type="text" name="support_subject" placeholder="The subject of your support ticket">
                </div>
                <div style="visibility: hidden; position: absolute; top: 0;" class="form-group">
                <label>Random</label>
                <input name="support_security" class="form-control" type="text" placeholder="security">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea required rows="5" cols="69" name="support_message" placeholder="What is your issue/question?"></textarea>
                </div>
                    <button name="submit-support" class="btn btn-large float-l" type="submit">Submit message</button>
            </form>
            </main>
        </div>

        <div class="flex-30 spacing-top spacing-bottom margin-center">
            <iframe src="https://discordapp.com/widget?id=393293613448298497&theme=dark" width="300" height="450" allowtransparency="true" frameborder="0"></iframe>
        </div>
    </div>
</div>

<?php get_footer()?>