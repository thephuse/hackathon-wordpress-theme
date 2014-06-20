Hackathon WordPress Theme
=========================

This WordPress theme was originally developed for [National Day of Civic Hacking 2014](http://hackforchange.org/).


The Homepage
------------

### Before the Event



### During the Event



### After the Event



Conent Pages
------------


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


Organizers
----------


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

Challenges
----------


Datasets
--------


Projects
--------




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



