<?php
/**
 * The template for displaying the contact page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

      get_template_part( 'template-parts/page-header');

			echo do_shortcode('[contact-form-7 id="35" title="Contact Form"]');

      ?> <section class="location-part"> <?php
        get_template_part( 'template-parts/location-map' );
        get_template_part( 'template-parts/location' );
      ?> </section> <?php

			if (function_exists('have_rows')) {
				if ( have_rows('faq_repeater')) {
          echo "<h2>FAQs</h2>";
					while( have_rows('faq_repeater')) {
						the_row();
						$faq_question = get_sub_field('faq_question');
						$faq_answer = get_sub_field('faq_answer');
						?>

            <section id="faq" class="contact-faq">
              <button class="accordion"><?php echo $faq_question; ?></button>
              <div class="panel">
                  <p><?php echo $faq_answer; ?></p>
              </div> 
            </section>  
					  <?php
					};
				};
			};

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->


	<script type='text/javascript'> 

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

</script>

<style>

/* Style the buttons that are used to open and close the accordion panel */
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
  margin-bottom: 10px;
  border: none;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover,
button:focus {
  background-color: #ccc;
  background: #ccc;
  border: none;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;

}

.accordion:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color: #777;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
}
	
</style>

<?php
get_footer();