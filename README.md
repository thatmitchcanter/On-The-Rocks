On-The-Rocks
============

Lightweight and responsive WordPress theme that uses SASS, Bourbon and Neat. Although anyone can run this theme, this is intended to be more a developer theme to get you started with some basic functionality and tools to build your own. It is essentially going to be the new theme for my website (jonathandean.com) minus a few design elements that are unique to my own "brand".

Status
======

I'd consider this a beta release since I'm using it now on my website (http://www.jonathandean.com) but it's still pretty rough around the edges. Let me know if you find something wrong, bad or just have a suggestion to approve. Or even better, fork and submit a pull request :)

Features
========

- Responsive design to support all screen types from Desktop to Tablet to Mobile (using Neat: https://github.com/thoughtbot/neat)
- Clean CSS source using SASS (http://sass-lang.com/) and Bourbon (http://thoughtbot.com/bourbon/), though for your purposes you are free to just edit the compiled CSS or just use normal CSS in your child theme. Pull requests must modify the SASS (.scss) files to accepted.
- HTML5 and CSS3
- Image free, CSS only
- "Retina" screen helpers:
    - SASS mixin for targeting retina screens
    - JavaScript for using SVG images and falling back to a non-SVG version on unsupported browsers
- Settings page in Appearance > Theme Options
    - Hide or specially display a particular category (I use this for posts created from my twitter updates, courtesy of the twitter tools plugin: http://wordpress.org/extend/plugins/twitter-tools/) You can hide a category from the main blog loop, "collapse" that category in a special smaller display format or keep in the page but hide via CSS. Check out the theme settings page in WordPress admin to see all options.
    - Show summaries on the home page (when supplied for the post) or always show the full post
    - Whether or not to indent paragraphs, also with the option of whether or not the first paragraph is also indented
- Threaded comments support when enabled in Settings > Discussions
- Main nav supports WordPress Menus or will fall back to displaying all pages if none is created in your Appearance > Menus settings

Browser support
===============

I don't care much about catering to older browsers, especially Internet Explorer. My audience wouldn't be using them and I don't believe in supporting out of date software that is free to upgrade unless critical to your users or business. You can support browsers that don't support CSS3 yourself.
    
Examples
========

My website uses a Child Theme of On The Rocks that is only slightly customized: http://www.jonathandean.com

Download
========

If you don't wish (or don't know how) to download the source code version, you can download a ZIP file that can be uploaded to your WordPress site. Just select the latest tag version above and click the ZIP download icon. If are a bad ass, like to live dangerously, and want the bleeding edge version, just download it without switching to a different tag. Here's a visual example of how that works if you aren't familiar with GitHub: http://jonathandean.s3.amazonaws.com/download_otr.png

You can install the downloaded .zip file by going to Appearance > Themes > Install Themes > Upload

Creating your own Child Theme
=============================

This is probably the best way to use On The Rocks in our own site. Rather than modifying this theme's files directly, you can create your own Child Theme and still be able to pull in updates to On The Rocks. (Changes to contribute to On The Rocks itself should come in the form of a fork and pull request for the benefit of the community.) For more information see http://codex.wordpress.org/Child_Themes

The simpliest Child Theme contains just a style.css where you adjust the visual display of the theme with your own look and branding. A basic Child Theme looks something like this, where you import the On The Rocks compiled style.css in your own css file and then override or add styles below. For example, create a directory in your wp-content/themes/ directory for your new theme and put something like this in it:

    /*
    Theme Name: On The Rocks Child
    Description: Child theme for the On The Rocks theme 
    Author: Your name here
    Template: on_the_rocks
    */
    
    @import url("../on_the_rocks/style.css");
    
    // Custom CSS goes here

If you are using SCSS then you can also make the import statement compile the On The Rocks CSS into it by pointing to the SCSS source instead. This will prevent an extra request in the browser. This would look like:

    /*
    Theme Name: On The Rocks Child using SCSS
    Description: Child theme for the On The Rocks theme 
    Author: Your name here
    Template: on_the_rocks
    */
    
    @import "../../on_the_rocks/scss/on-the-rocks.scss";
    
    // Custom SCSS goes here

Note that in this version you don't use the "url" method and the path points to the .scss file instead of .css.

To take advantage of the variables and mixins of On The Rocks, you can import those as well:

    /*
    Theme Name: On The Rocks Child using SCSS
    Description: Child theme for the On The Rocks theme
    Author: Your name here
    Template: on_the_rocks
    */

    @import "../../on_the_rocks/scss/variables";
    @import "../../on_the_rocks/scss/mixins";
    @import "../../on_the_rocks/scss/on-the-rocks.scss";

    // Custom SCSS goes here

You can also modify markup, add functionaliy, etc. by adding template files and other functionality. See http://codex.wordpress.org/Child_Themes for more information.

Customizing via variables
=========================

If you are using SASS in your Child Theme (as described above) you can customize a lot of the display of On The Rocks simply by defining your own values for the variables in scss/_variables.scss. They all use !default to make it easy to define your own values. The advantage to customizing here instead of providing your own complete CSS rules is to better ensure compatibility with future updates.

Adding your logo in header
==========================

You can easily customize the logo area by making a file in your child theme called logo.php. To use an image there, you can do something like this:

    <h1><a href="<?php echo site_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>"/></a></h1>

Customizing the main navigation
===============================

There are three options for the main navigation. You can create a menu via Appearance > Menus and select Primary Menu under the Theme Locations menu. (More on WordPress menus at http://codex.wordpress.org/Appearance_Menus_Screen)

In the absence of a WordPress Menu, On The Rocks will automatically list all of your pages in the main navigation.

You can also fully customize the navigation in any way you wish by making your own. Just create a file called navigation.php in your child theme and put anything you like in it.

Using the retina-display SASS mixin
===================================

Also included a SASS mixin for targeting high density ("retina") screens. It's essentially the retina screen media query by Thomas Fuchs wrapped into a mixin: https://gist.github.com/4161897

For this you will have to import the mixins file in your Child Theme as described above:

    @import "../../on_the_rocks/scss/mixins";

Use it like this:

    body{
      background: $page-background-color url("images/bg.jpg");
      @include retina-display {
        background: $page-background-color url("images/bg2x.jpg");
        background-size: 171px 171px, auto;
      }
    }

In this example, I have a 171x171 pixel background image called bg.jpg that is used for normal screen densities. I also created a "retina" version of the same image that is 342x342 pixels and use that specifically in high density screens. Then I scale it down to the original image size to make it look much better on retina screens. More on this technique in the retinafy.me book: http://retinafy.me/

That code is equivalent to:

    body{
      background: $page-background-color url("images/bg.jpg");
      @media (min--moz-device-pixel-ratio: 1.5),
      (-o-min-device-pixel-ratio: 3/2),
      (-webkit-min-device-pixel-ratio: 1.5),
      (min-device-pixel-ratio: 1.5),
      (min-resolution: 144dpi),
      (min-resolution: 1.5dppx) {
        background: $page-background-color url("images/bg2x.jpg");
        background-size: 171px 171px, auto;
      }
    }

Using the SVG image fallback script
===================================

There are two small JavaScript scripts included that will automatically replace all SVG images on the page (using an <img> tag with a .svg extension) with a fallback format when SVG is not supported by the browser. If the image has the attribute data-svg-fallback replaces the image src with that value. If it doesn't have that attribute it sets the image src to the same filename but with a .png extension. Therefore, if you intended to use .svg images, you should either provide an alternative via the data-svg-fallback attribute or by putting a .png image with the same name in the same directory.

Both versions work the same way and the the only difference is whether or not it uses jQuery.

functions.php (in your Child Theme)

    add_action( 'wp_footer', 'load_svg_fallback_jquery' );

or the non-jQuery version:

    add_action( 'wp_footer', 'load_svg_fallback_js' );

For more information on the scripts, see https://github.com/jonathandean/svg_fallback

Debugging responsive breakpoints
================================

As described in this blog post, the WordPress admin bar indicates the currently active CSS breakpoint: http://www.jonathandean.com/2013/01/showing-the-current-breakpoint-name-when-testing-responsive-designs-using-only-css/

See screen shots in that blog post to see what it looks like. Since this is only shown in the admin bar, it will not be visible to guests of the site and only to admins (and is unobtrustive to them as well.)

The breakpoint name shown in the admin bar matches the breakpoint names defined in scss/_grid-settings.scss

Some tips on using LiveReload
-----------------------------

If you use the highly convenient LiveReload app (http://livereload.com/) here are some tips/random comments.

I renamed the main SCSS from scss/style.scss to scss/on-the-rocks.scss because if you are using a child theme that is importing the On The Rocks SCSS file as outlined above, LiveReload's compile options were seeing an import with style.scss and not enabling it as a compile option. Renaming removed the ambiguity between your style.scss (or whatever you name it) and On The Rocks's main SCSS file. You're welcome.

If you happen to want to work on On The Rocks and your Child Theme at the same time (as in you are going to submit pull requests to On The Rocks as well as creating your Child Theme) I found this to be the best setup:

 * In your local WordPress install, install both themes
 * In LiveReload add either your site root or themes directory
 * In LiveReload, select your Child Theme's main SCSS file as the Source and the Output as your Child Theme's style.css. (So the source would be something like themes/my_theme/scss/my_theme.scss and the output themes/my_theme/style.css
 * In a terminal window, go into the on_the_rocks/ theme directory and use this command to also compile the style.css for On The Rocks: sass --watch --style nested scss/on-the-rocks.scss:style.css  (Please be sure to use the nested output for pull requests to be accepted! This is not because I prefer this format, but because it preserves the required comments at the top of the file that WordPress needs for the theme to be valid.)
 * Try to use the same version of SASS for both: http://feedback.livereload.com/knowledgebase/articles/86281-using-custom-compiler-versions
 * If you use the JavaScript snippet instead of the browser plugin, do not commit that!

Clone the repository
====================

Go into your project's wp-content/themes/ directory and run:

    cd [project root]/wp-content/themes/
    git clone git@github.com:jonathandean/On-The-Rocks.git on_the_rocks

To get the latest version of On The Rocks in a repostory where you added it as a submodule:

    cd [project root]/wp-content/themes/on_the_rocks/
    git checkout master
    git pull
    cd [project root]
    git commit -am "Updated On The Rocks with the latest version in master"
    
Compiling the SCSS
==================

First you must install SASS if you don't already have it. I would recommend at least version 3.2.1

    gem install sass
    sass --watch --style nested scss/on-the-rocks.scss:style.css

The nested style is important because it preserves the comments at the top that WordPress needs in order for it to be a valid theme. If you know how to use compressed and also preserve these, please let me know!

More information at http://sass-lang.com/

See the section "Some tips on using LiveReload" if you are a LiveReload user

Use as a git submodule
======================

You may wish to use this as a submodule in your existing git repository. For instance, if you have your whole WordPress site in your repository, you can do something like this to add On The Rocks to your themes directory as a submodule:

    cd [project root]
    git submodule add git@github.com:jonathandean/On-The-Rocks.git wp-content/themes/on_the_rocks

Now the directory wp-content/themes/on_the_rocks acts as its own repository inside of your main repository. Now you can go into this directory and pull the latest or checkout a particular revision. Then when you commit the directory in the parent repository it essentially commits the info that you are using a particular revision of On The Rocks there.

This allows you to stay up to date with On The Rocks using git rather than manually pasting in the files into your own repository.

For more on git submodules, see http://git-scm.com/book/en/Git-Tools-Submodules

Setup
=====

These are the steps I used to set up bourbon and neat. You don't need to do this when you clone the repository, but I thought it might be useful for you to see how I did it and also for my own future reference:

Install bourbon (first time)

    gem install bourbon
    cd scss/
    bourbon install
    
Update bourbon (when needed)

    gem update bourbon
    cd scss/
    bourbon update
    
Install neat (first time)

    gem install neat
    cd scss/
    neat install

Update neat (when needed)

    gem update neat
    cd scss/
    rm -rf neat/
    neat install
    
Compile SCSS

    gem install sass
    cd [project root]
    sass --watch --style nested scss/on-the-rocks.scss:style.css

