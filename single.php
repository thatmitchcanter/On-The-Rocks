<?php
/*
Theme Name: On The Rocks
Theme URI: http://jonathandean.com/
Description: Lightweight WordPress theme using SASS, Bourbon and Neat
Author: Jonathan E. Dean
Author URI: http://jonathandean.com/
Version: 0.1

License: 

   Copyright 2012 Jonathan E. Dean
   
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
   
License URI: http://www.apache.org/licenses/LICENSE-2.0

*/
get_header(); ?>
<div id="content" role="main">
  <div class="container">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; // end while ( have_posts() ) ?>
    <?php /* TODO is <article> most appropriate here? Chosen over <section> or <div> because contents can be syndicated */ ?>
    <article class="comments">
    <?php
      // If comments are open or we have at least one comment, load up the comment template
      if ( comments_open() || '0' != get_comments_number() )
        comments_template( '', true );
      ?>
    </article>
  <?php else : ?>
    <p>No posts found.</p>
  <?php endif; // end have_posts() ?>
  </div>
</div>
<?php get_footer(); ?>