
jQuery(document).ready(function () {
  /*"use strict";*/
  var images = [
    '../../../img/risk-calculator/images/1.jpg',
    '../../../img/risk-calculator/images/2.jpg',
    '../../../img/risk-calculator/images/3.jpg',
    '../../../img/risk-calculator/images/4.jpg',
    '../../../img/risk-calculator/images/5.jpg',
    '../../../img/risk-calculator/images/8.jpg',
    '../../../img/risk-calculator/images/9.jpg',
    '../../../img/risk-calculator/images/10.jpg',
    '../../../img/risk-calculator/images/scroll_text.png'
  ];

  var $list = $('#imagesList');

  $.each(images, function (i, src) {
    var $li = $('<li class="loading">').appendTo($list);
    $('<img>').appendTo($li).one('load', function () {
      $li.removeClass('loading');
    }).attr('src', src);
  });


  $('.clickAttr').bind('tap', function () {
    window.location.href = $(this).attr('goto');
  });

  $('#next1').bind('click', function () {

    $('#layer2').show();
    $('#layer1').hide();

  });

  $('#next2').bind('click', function () {

    $('#layer3').show();
    $('#layer2').hide();

  });

  $('#prev2').bind('click', function () {

    $('#layer1').show();
    $('#layer2').hide();

  });

  $('#prev3').bind('click', function () {

    $('#layer2').show();
    $('#layer3').hide();

  });

  var status = 1;
  var image = document.getElementById("layer1");
  var image2 = document.getElementById("layer2");
  var image3 = document.getElementById("layer3");
  document.addEventListener('keydown', nextSlide, true);

  function nextSlide(e) {

    if (e.keyCode == 39) {
      if (status == 1) {
        image.style.display = 'none';
        image2.style.display = 'block';
        status = 2;

      } else if (status == 2) {
        image2.style.display = 'none';
        image3.style.display = 'block';
        status = 3;
      }
    }
    if (e.keyCode == 37) {
      if (status == 3) {
        image3.style.display = 'none';
        image2.style.display = 'block';
        status = 2;

      } else if (status == 2) {
        image2.style.display = 'none';
        image.style.display = 'block';
        status = 1;
      }
    }
  }


  $("#layer1").swipe({

    swipe: function (event, direction, distance, duration, fingerCount) {

      if (!$(event.target).hasClass('noSwipe')) {

        if (direction == 'left' && distance > 100) {
          $('#layer2').show();
          $('#layer1').hide();

        } else if (direction == 'right' && distance > 100) {

          //document.location = "veeva:prevSlide()";
        }
      }
      /* event.stopImmediatePropagation();
       event.preventDefault();*/
    },
    threshold: 200
  });

  $("#layer2").swipe({

    swipe: function (event, direction, distance, duration, fingerCount) {
      console.log(direction);
      if (!$(event.target).hasClass('noSwipe')) {

        if (direction == 'left' && distance > 100) {
          $('#layer3').show();
          $('#layer2').hide();

        } else if (direction == 'right' && distance > 100) {

          $('#layer1').show();
          $('#layer2').hide();

        }
      }
      /* event.stopImmediatePropagation();
       event.preventDefault();*/
    },
    threshold: 200
  });

  $("#layer3").swipe({

    swipe: function (event, direction, distance, duration, fingerCount) {
      console.log(direction);
      if (!$(event.target).hasClass('noSwipe')) {

        if (direction == 'left' && distance > 100) {
          //$('#layer3').show();
          //$('#layer2').hide();

        } else if (direction == 'right' && distance > 100) {

          $('#layer2').show();
          $('#layer3').hide();

        }
      }
      /* event.stopImmediatePropagation();
       event.preventDefault();*/
    },
    threshold: 200
  });

  $('.clickAttr').bind('tap', function () {
    sessionStorage.noThumb = "true";
    window.location.href = $(this).attr('goto');
    sessionStorage.wheresliderrisc2 = "";
  });

  if (sessionStorage.wheresliderrisc2 != "" && sessionStorage.wheresliderrisc2 != undefined && sessionStorage.noThumb) {
    var slidename = sessionStorage.wheresliderrisc2;
    $('.' + slidename).show();
    sessionStorage.removeItem("noThumb");
    //sessionStorage.wheresliderrisc2 ="";
  } else {
    $('.wrapper').show();
    sessionStorage.wheresliderrisc2 = "wrapper";
  }

  $('.home').bind('click', function () {
    //alert("Hello! I am an alert box!!");
    $('#layer1').show();
    $('#layer2').hide();
    $('#layer3').hide();
    status = 1;

  });

  $('#pop').bind('click', function () {
    //alert("Hello! I am an alert box!!");
    $('#popup_1').show();

  });
  $('#close').bind('click', function () {
    $('#popup_1').hide();
  });


});
