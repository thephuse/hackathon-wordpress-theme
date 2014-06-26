Hackathon WordPress Theme
=========================

This WordPress theme was originally developed for [National Day of Civic Hacking 2014](http://hackforchange.org/).

The theme is meant for multi-location events, like National Day of Civic Hacking.

Since this was not developed with the primary intention of being a theme, it is not very customizable. However, we're making it open source to encourage developers to reuse, extend, and customize the theme freely.


The Homepage
------------

The homepage comes with two templates, the *before* event template and the *after* event template. The main difference is that the *before* event template has a large map as the hero background, whereas the *after* event template uses an image. Feel free to use each template in any situation - they are not constrained to be "before" or "after", we just happened to use them that way on hackforchange.org.

###Before Event Template

![Before Event Template](/examples/example-before-event.png?raw=true "Before Event Template")

The hero content on the "Before" Home Page includes a Latest Tweets widget (http://hackathontheme.localhost/wp-admin/plugins.php) that must be connected to your twitter account before the theme will work. (Settings > Twitter API).

The hero also includes a full-width [Mapbox](https://www.mapbox.com/). Head over to the mapbox site and create your map, then use the Map ID on this page to add it as a backdrop to the header.

###After Event Template

![After Event Template](/examples/example-after-event.png?raw=true "After Event Template")

The background image used for the hero can be found here: `images/after-event-bg.jpg`. 	

Menus
-----

There are 3 menus available with this theme:
1) Main Menu (white bar at the top of every page)
2) Secondary Menu (grey bar that appears above the main menu when you click the red hamburger icon in the main menu)
3) Footer Menu (simple text links that will appear centered at the very bottom of the page)

The events, challenges, datasets, and projects pages are generated automatically (e.g. `archive-event.php`). To add these pages to the navigation menu, simply add a custom link to `/events/`, `/challenges/`, etc.


Content Pages
------------

The default template can be used for plain, single column pages. If you add sub-pages they will appear as a second navigation menu below the hero/title. To change the background image behind the title, use the *Featured Image*.

Contact Form
------------

We heartily recommend the use of [Contact Form 7](http://wordpress.org/plugins/contact-form-7/). The elements are styled to match the theme, so all you need to do is:
1. Install contact form 7 and create a new contact form
2. Create a new page
3. Choose the "Contact" page template
4. Fill out information for the side bar in the "Contact Information" field.
5. Add the shortcode to the *Contact Form Code* field

If you'd like to use a form layout similar to contact form used on the [Hack for Change](http://hackforchange.org/contact/) website, you can use the following code when setting up your contact form:

```html
<div class="form-row">
	<div class="grid grid-half">
		<label>Name</label>[text* your-name placeholder "Please enter your name"]
	</div>
	<div class="grid grid-half">
		<label>Email</label>[email* your-email placeholder "Please enter your email"]
	</div>
</div>
<div class="form-row">
	<label>What can we help you with today?</label>[text* your-subject placeholder "Please enter your subject"]
</div>
<div class="form-row">
	<label>Your Message</label>[textarea* your-message placeholder "Please enter your message"]
</div>
<div class="form-row submit">
	[submit class:btn "Send Message"]
</div>
```

Footer Information
------------------

To add social icons and your contact email to the footer, edit your information under Appearance > Theme Options.


Organizers
----------

To give event organizers access to the main WordPress install, we used the [User Access Manager Plugin](http://wordpress.org/plugins/user-access-manager/). With this, you can add a new user role called "Organizer" and assign certain permissions to that type of user. Organizers on hackforchange.org could only add and edit their own events. All other functionality is hidden using the UAM plugin.


Events
------

Each event has a location specified by a City, a State/Province (if applicable), and a Country. These locations come from a file so that (a) you get consistent naming of locations by event organizers, and (b) you have a list to start from (as opposed to having to create the location list from scracth).

To add or remove locations, navigate to `/wp-admin/theme-editor.php?file=php%2Flocations.php&theme=hackathon-wordpress-theme` (Appearance > Editor > php/locations.php). The cities are stored in this format:

```php
$location_city = array(
  '0' => 'None Selected',
  'akron' => 'Akron',
  'albany' => 'Albany',
  ...
  'virginiabeach' => 'Virginia Beach',
  'washington' => 'Washington, DC'
);
```

Submit a Project
----------------

You can build a [Submit Page](http://hackforchange.org/submit/) for your projects using the "Submit Project" template. When users submit projects through this form they will be added as a Project custom post type and will be available in the WordPress backend for you to approve/deny.


Plugins
-------

### Required:
- *Fluid Video Embeds* - If you want your videos to scale down mobile and not break the site.
- *Latest Tweets Widget* - If you want to use the latest tweets on the blog sidebar.
- *User Access Manager* - If you want to manage the permissions of various users.

### Recommended:
- *Comment Form 7* - All elements stlyed and ready to go!
- *Disqus Comment System* - Normal Comments are styled, but Disqus looks better.

### Nice to have:
- *All in One SEO Pack* - You need SEO!



