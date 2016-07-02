<?php
$contactus_shortcode = get_theme_mod('cf_shtcd_','[lead-form form-id=1 title=Contact Us]');
$nameError = '';
$emailError = '';
$commentError = '';
if (isset($_POST['submitted'])) {
    if (trim($_POST['contactName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }
    if (trim($_POST['email']) === '') {
        $emailError = 'Please enter your email address.';
        $hasError = true;
   } else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email'])) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
    if (trim($_POST['comments']) === '') {
        $commentError = 'Please enter a message.';
        $hasError = true;
    } else {
        if (function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }
    if (!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '')) {
           $emailTo = get_theme_mod('cf_email_',get_option('admin_email'));
        }
        $subject = $name.'('.$email.')';
        $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
        $headers= "Reply-To: ".$name." <".$email.">";
        mail($emailTo, $subject, $body,$headers);
        $emailSent = true;
    }
}
?>
<!-- blog title -->
<!-- blog title ends -->
<?php if (get_theme_mod('cf_image','') != '') { ?>
<section id="section5" class="contact_section" style="background: url(<?php echo get_theme_mod('cf_image',''); ?>) center repeat fixed;">
<?php } else { ?>
<section id="section5" class="contact_section">
 <?php } ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php if (get_theme_mod('cf_head_','') != '') { ?>
                    <h2 class="section-heading"><?php echo get_theme_mod('cf_head_',''); ?></h2>
                    <?php } else { ?>
                    <h2 class="section-heading">Contact Us</h2>
                    <?php } ?>                  
                    <?php if (get_theme_mod('cf_desc_','') != '') { ?>
                    <h3 class="section-subheading text-muted contact"><?php echo get_theme_mod('cf_desc_',''); ?></h3>
                    <?php } else { ?>
                    <h3 class="section-subheading text-muted contact">Lorem ipsum dolor sit amet consectetur.</h3>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="cnt-div  wow fadeInRight" data-wow-delay="0s">
                <?php do_shortcode($contactus_shortcode); ?>
                </div>
            </div>
        </div>
    </section>