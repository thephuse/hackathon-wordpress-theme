var headerHeight = $('.site-header').outerHeight();
var prevScrollY = 0;
var latestScrollY = 0;
var animating = false;

var ww = document.body.clientWidth;
var checkHeader = function () {
  $('body').css({
    'padding-top': headerHeight
  });
  $(window).on('scroll', function () {
    prevScrollY = latestScrollY;
    latestScrollY = window.scrollY;
    requestAnim();
  });
};
var update = function () {
  animating = false;

  var currentScrollY = latestScrollY;
  var fromTop = $(document).scrollTop();
  var offset = $('main').offset();
  if ($('body').hasClass('home')) {
    offset = $('.hero').next().offset();
  }
  offset = offset.top - headerHeight;
  if (fromTop >= offset){
    $('.site-header').addClass('scrolled');
  } else {
    $('.site-header').removeClass('scrolled');
  }
};
var requestAnim = function () {
  if (!animating) {
    requestAnimationFrame(update);
  }
  animating = true;
};

var heroContentHeight = $('.hero .container').outerHeight();
var $heroSocial = $('.hero .social');
var positionSocial = function () {
  if ($heroSocial.length > 0) {
      $heroSocial.css('position','absolute');
    
  }
};

var reportHeader = function () {
  var $reportNav = $('.report-nav');
  if ($reportNav.length) {
    var $sections = $('section');
    var $links = $('.report-nav li a');

    $(window).on('scroll', function () {
      var fromTop = $(document).scrollTop();
      var $main = $('main');
      var offset = $main.offset().top;
      var reportNavHeight = $reportNav.outerHeight();

      if (fromTop >= offset){
        $reportNav.addClass('scrolled');
        $main.css('paddingTop', reportNavHeight);
      } else {
        $reportNav.removeClass('scrolled');
        $main.css('paddingTop', 0);
      }

      $links.removeClass('active');      
      $sections.each(function() {
          var top = $(this).offset().top - reportNavHeight,
              bottom = top + $(this).outerHeight();
          
          if (fromTop >= top && fromTop <= bottom) {
              $('a[href="#' + this.id + '"]').addClass('active');
          }
      });
          
    });
    $reportNav.find('li a').click(function (e) {
      e.preventDefault();
      var $scrollTo = $($(this).attr('href')).offset().top - $reportNav.outerHeight();
      $('body').animate({ scrollTop: $scrollTo }, 1000);
    });
  }
};

var animateMargin = function (target, njumps, jumpcount) {
  target.animate({'margin-bottom': 15}, 500, 'swing', function () {
    target.animate({'margin-bottom': 5}, 500, 'swing', function () {
      if (jumpcount < 1)
        animateMargin(target, njumps, jumpcount + 1);
    });
  });
};

var scrollDown = function () {
  var $scrollDown = $('.scroll-down');

  // Animate scroll arrow
  if ($(window).width() > 580) {
    $scrollDown.fadeIn(800);
    animateMargin($scrollDown.find('img'), 2, 0);
  }

  $scrollDown.click(function (e) {
    e.preventDefault();
    var scrollTo = $('main').offset().top;
    $('html, body').animate({ scrollTop: scrollTo }, 1000);
  });
};

var toggleMenu = function () {
  $('.site-header .show-second-menu').click(function (e) {
    e.preventDefault();
    $('.hidden-menu').slideDown('fast');
    $('body').animate({
      'padding-top' : '70px'
    }, 'fast', function () {
      newSpacing = $('.hidden-menu').outerHeight();
      menuHeight = $('.main-header').outerHeight();
      newSpacing += menuHeight;
      $('body').animate({
        'padding-top' : newSpacing
      });
    });
    $('.site-header').addClass('open');
    headerHeight = $('.site-header').outerHeight();
    requestAnim();
  });
  $('.site-header .hide-second-menu').click(function (e) {
    e.preventDefault();
    $('.hidden-menu').slideUp('fast', function () {
      $('.site-header').removeClass('open');
      headerHeight = $('.site-header').outerHeight();
      requestAnim();
    });
    newSpacing = $('.main-header').outerHeight();
    $('body').animate({
      'padding-top' : newSpacing
    }, 'fast');
  });
};

var pageMenu = function () {
  $('.page-menu li').each(function () {
    var itemClass = $(this).attr('class');
    if ($('body').hasClass(itemClass)) {
      $(this).addClass('active');
    }
  });
};

var menuFX = function () {
  $('.main-header nav li').clone().addClass('hide').prependTo('.hidden-menu nav ul');
};

var mapFX = function () {
  $('.trigger-map, .hero-content').click(function (e) {
    e.preventDefault();
    if ($('.trigger-map').hasClass('top')){
      $('.hero-content, .search-box, .map-inner').fadeIn('fast');
      $(this).parent().find('.map-overlay').animate({
        'height' : '100%'
      },'fast');
      $('.trigger-map').removeClass('top').text('View Map').css({
        bottom: 0,
        top: 'auto'
      });
    } else {
      $('.hero-content, .search-box, .map-inner').fadeOut('fast');
      $(this).parent().find('.map-overlay').animate({
        'height' : 0
      },'fast');
      $('.trigger-map').addClass('top').text('Hide Map').animate({
        'top' : 0
      },'fast');
    }
  });
  $('.hero-content .container, .hero-content .social').click(function (e) {
    e.stopPropagation();
  });
};

var jess3FX = function () {
  $('.trigger-visualization').click(function (e) {
    e.preventDefault();
    if ($('.trigger-visualization').hasClass('top')){
      $('.jess3-microsite .form, .after-event-content .container').fadeIn('fast');
      $('.map-overlay').animate({
        'height' : '100%'
      },'fast');
      $('.trigger-visualization').removeClass('top').text('View Visualization').css({
        bottom: 0,
        top: 'auto'
      });
    } else {
      $('.jess3-microsite .form, .after-event-content .container').fadeOut('fast');
      $('.map-overlay').animate({
        'height' : 0
      },'fast');
      $('.trigger-visualization').addClass('top').text('Hide Visualization').animate({
        'top' : 0
      },'fast');
    }
  });
  $('.hero-content .container, .hero-content .social').click(function (e) {
    e.stopPropagation();
  });
};

var timelineLoad = function () {
  if ($('.timeline-load').length > 0) {
    //assumes limit is same for all timelines
    limit = $('.timeline').first().find('li:visible').length - 1;
    $('.timeline-load').click(function (e) {
      e.preventDefault();
      i = 0;
      $timeline = $(this).parents('.timeline');
      $bubbles = $timeline.find('.hide');
      $bubbles.each(function () {
        if (i < limit) {
          $(this).removeClass('hide');
        }
        i++;
        if ($timeline.find('.hide').length == 0) {
          $timeline.find('.timeline-load').parent('li').remove();
        }
      });
    });
  }
};

var appendLine = function (text) {
  $('.consolebody').append($('<div/>').addClass('line').text(text));
};

var newConsoleLine = function () {
  var $consolebody = $('.consolebody');
  var $command = $consolebody.find('.current').text().toLowerCase();
  $consolebody
    .find('.current').removeClass('current').attr('contenteditable', false).end()
    .find('.cursor').remove().end();

  if ($command == 'home') {
    // Go home
    window.location.href = '/';
  } else if ($command == 'back') {
    // Go back
    window.history.back();
  } else if (~$command.indexOf('cowsay')) {
    appendLine('Moooooooooooooooooooooooooo!');
  }  else if ($command == 'hi' || $command == 'hello' || $command == 'hey') {
    appendLine('Hello there! How are you today?');
  } else if ($command == 'help') {
    appendLine('Type `HOME` to visit the homepage or type `BACK` to return ' +
      'to the previous page. Made with love by Michelle at the Phuse.');
  } else if ($command.length) {
    appendLine('-bash: ' + $command + ': command not found');
  }

  $consolebody.append(
    $('<div/>').addClass('line').text('National-day-of-Civic-Hacking:~ ')
      .append($('<span/>').addClass('input').addClass('current').attr('contenteditable', true))
      .append($('<span/>').addClass('cursor')));
  
  var $input = $('.current')[0];
  $input.onfocus = function () {
    window.setTimeout(function () {
      var sel, range;
      if (window.getSelection && document.createRange) {
        range = document.createRange();
        range.selectNodeContents($input);
        range.collapse(false);
        sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
      } else if (document.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText($input);
        range.collapse(false);
        range.select();
      }
    }, 1);
  };

  $input.onclick = $input.onfocus;
  $input.focus();
  $('.window').click(function () {
    $input.focus();
  });

  $('.input').on("keypress", function (e) {
    if (e.which === 13) {
      e.preventDefault();
      newConsoleLine();
    }
  });
};

var errorConsole = function () {
  newConsoleLine();
};

var showTeamMember = function ($teamMember) {
  $teamMember
    .find('.required').attr('required', 'required').end()
    .slideDown();
}
var hideTeamMember = function ($teamMember) {
  $teamMember
    .find('.required').removeAttr('required').end()
    .find('input').val('').end()
    .slideUp();
}

var submitProjectForm = function () {
  $('#add-team-member').click(function (e) {
    e.preventDefault();
    var $invisibleRows = $('.team-member-form-row:hidden');
    if ($invisibleRows.length == 1) {
      $(this).hide();
    }
    showTeamMember($invisibleRows.eq(0));
    $('#no-team-members').slideUp();
  });
  $('.team-member-form-row .email').blur(function () {
    var val = $(this).val();
    if (val.length) {
      var hash = md5(val.trim().toLowerCase());
      $(this)
        .parents('.team-member-form-row')
        .find('.photo')
          .attr('src', 'http://www.gravatar.com/avatar/' + hash + '?s=100&d=mm')
        .end();
    }
  });
  $('.team-member-form-row .close').click(function (e) {
    e.preventDefault();
    if ($('.team-member-form-row:visible').length <= 1) {
      $('#no-team-members').slideDown();
    }
    hideTeamMember($(this).parents('.team-member-form-row'));

    $('#add-team-member').show();
  });
  $('#submit_project').validate();
};

var accordion = function () {
  $('.accordion-toggle').click(function () {
    var $content = $(this).parent('.accordion').find('.accordion-content');
    if ($content.is(':visible')) {
      $content.slideUp();
      $(this).removeClass('active');
    } else {
      $content.slideDown();
      $(this).addClass('active');
    }
  });
};

var reportBackdropResize = function () {
  var $reportHeroThankYou = $('.report-hero-thank-you');
  var $scrollDown = $('.scroll-down');
  var bottomHeight = $reportHeroThankYou.outerHeight() + 
    parseInt($reportHeroThankYou.css('margin-bottom')) + 
    $scrollDown.height() + 
    parseInt($scrollDown.css('margin-bottom')) +
    20;
  var newBorderWidth = '0 0 ' + ($('.report-hero').height() - bottomHeight) + 'px ' + ww + 'px';
  $('.report-hero-backdrop-bottom').height(bottomHeight);
  $('.report-hero-backdrop').css('borderWidth', newBorderWidth);
}

var animateSVGpaths = function ($el) {
  var $paths = $el.find('.animate');
  
  $paths.each(function () {
    var length = $(this)[0].getTotalLength();
    var transition = 'stroke-dashoffset 4s ease-in-out';
    // Show the path
    $(this).css('opacity', 1);
    // Clear any previous transition
    $(this).css({'transition': 'none', 'WebkitTransition': 'none'});
    // Set up the starting positions
    $(this).css('strokeDasharray', length + ' ' + length);
    $(this).css('strokeDashoffset', length);
    // Trigger a layout so styles are calculated & the browser
    // picks up the starting position before animating
    $(this)[0].getBoundingClientRect();
    // Define our transition
    $(this).css({'transition': transition, 'WebkitTransition': transition});
    // Go!
    $(this).css('strokeDashoffset', '0');
    $(this).attr('class', '');
  });
};

var animateLogo = function () {
  if ($(window).width() > 768) {
    var $letters = $('.animated-logo img');
    var i = 0;
    var startDistance = $(document).height() * 2;
    $('#report-thanks').height($(window).height());

    for (i = 0; i < $letters.length; i++) {
      var $letter = $letters.eq(i);
      $letter.data('top', $letter.css('top'));
      $letter.data('left', $letter.css('left'));
    }

    $(window).scroll(function () {
      if ($(window).scrollTop() + $(window).height() > $(document).height() - $('#report-thanks').height()/2) {
        $letters.fadeIn();
        var percent = 1 - ($(window).height() + $(window).scrollTop()) / $(document).height();
        
        for (i = 0; i < $letters.length; i++) {
          var $letter = $letters.eq(i);
          var endTop = parseInt($letter.data('top'));
          var endLeft = parseInt($letter.data('left'));
          var theta = (Math.PI / 4.5) * i;
          var distance = startDistance * percent;
          var deltaTop = Math.sin(theta) * distance;
          var deltaLeft = Math.cos(theta) * distance;
          $letter.css({'left': deltaLeft + endLeft, 'top': deltaTop + endTop});
        }
      } else {
        $letters.fadeOut();
      }
    });
  }
};

var init = function () {
  checkHeader();
  toggleMenu();
  pageMenu();
  menuFX();
  positionSocial();
  mapFX();
  jess3FX();
  timelineLoad();
  submitProjectForm();
  accordion();
  reportBackdropResize();
  reportHeader();
  scrollDown();
  animateLogo();

  $(window).on('scroll load', function () {
    $('.graphic-1, .graphic-2, .graphic-3').each(function () {
      var triggerPoint = $(this).offset().top - $(window).height() + 200;
      if (triggerPoint < window.scrollY) {
        animateSVGpaths($(this));
      }
    }); 
  });

  if ($('.error404').length) {
    errorConsole();
  }
  $('.main-content').fitVids();
  $('#report-event').fitVids();

  $('.tweet-details time').timeago();

  $('a[data-tooltip]').tipTip({
    defaultPosition: 'top',
    maxWidth: '400px',
    attribute: 'data-tooltip',
    delay: 0,
    fadeIn: 0,
    fadeOut: 0,
    edgeOffset: -8
  });

  $('.trigger-info, .avatars-small a').click(function (e) {
    e.preventDefault();
  });
}

jQuery(function ($) {
  init();
});

$(window).bind('resize orientationchange', function () {
  //update window width measurement
  ww = document.body.clientWidth;

  //recalculate for header animation
  headerHeight = $('.site-header').outerHeight();
  checkHeader();

  //positioning of social footer part of hero
  heroContentHeight = $('.hero .container').outerHeight();
  $heroSocial.css('position','absolute');
  positionSocial();

  //report hero backdrop triangle size
  reportBackdropResize();
});
