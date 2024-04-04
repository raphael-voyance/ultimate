// Tarot 7
var cards = [
    "7-carreau",
    "7-coeur",
    "7-pique",
    "7-trefle",
    "8-carreau",
    "8-coeur",
    "8-pique",
    "8-trefle",
    "9-carreau",
    "9-coeur",
    "9-pique",
    "9-trefle",
    "10-carreau",
    "10-coeur",
    "10-pique",
    "10-trefle",
    "valet-carreau",
    "valet-coeur",
    "valet-pique",
    "valet-trefle",
    "dame-carreau",
    "dame-coeur",
    "dame-pique",
    "dame-trefle",
    "roi-carreau",
    "roi-coeur",
    "roi-pique",
    "roi-trefle",
    "as-carreau",
    "as-coeur",
    "as-pique",
    "as-trefle"
  ];

  var names = [
    "Le 7 de carreau",
    "Le 7 de coeur",
    "Le 7 de pique",
    "Le 7 de trefle",
    "Le 8 de carreau",
    "Le 8 de coeur",
    "Le 8 de pique",
    "Le 8 de trefle",
    "Le 9 de carreau",
    "Le 9 de coeur",
    "Le 9 de pique",
    "Le 9 de trefle",
    "Le 10 de carreau",
    "Le 10 de coeur",
    "Le 10 de pique",
    "Le 10 de trefle",
    "Le Valet de carreau",
    "Le Valet de coeur",
    "Le Valet de pique",
    "Le Valet de trefle",
    "La Dame de carreau",
    "La Dame de coeur",
    "La Dame de pique",
    "La Dame de trefle",
    "Le Roi de carreau",
    "Le Roi de coeur",
    "Le Roi de pique",
    "Le Roi de trefle",
    "L'As de carreau",
    "L'As de coeur",
    "L'As de pique",
    "L'As de trefle"
  ];

  var names1 = [];
  var names2 = [];

  var tirage1 = [];
  var tirage2 = [];

  var cardsToGo1 = [];
  var cardsToGo2 = [];
  var cardsToGo3 = [];
  var cardsToGo4 = [];

  var selected = false;
  var count = 12;
  var step = "step1";

  var ssTitre = false;

  var isMobile;
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
      isMobile = true;
  else
      isMobile = false;


  $(window).on('load', function(){

    initJeu0();
  });



  /**** GO DIRECT TOJEU ?toJeu=2 ****/
  function getToPart() {
    var query = window.location.search.substring(1);
    var value = query.split("=");
    var jeu = value[1];

    if (jeu === "2") {
      tirage1 = [
        'img/le-bateleur.jpg',
        'img/la-papesse.jpg',
        'img/l-imperatrice.jpg',
        'img/l-empereur.jpg',
        'img/le-pape.jpg',
        'img/l-amoureux.jpg',
        'img/le-chariot.jpg',
        'img/la-justice.jpg',
        'img/l-hermite.jpg',
        'img/la-roue-de-fortune.jpg',
        'img/la-force.jpg',
        'img/le-pendu.jpg'
      ];
      count = 1;
      countJeu1();

    } else if (jeu === "F") {
      tirage2 = [
        'img/le-bateleur.jpg',
        'img/la-papesse.jpg',
        'img/l-imperatrice.jpg',
        'img/l-empereur.jpg',
        'img/le-pape.jpg',
        'img/l-amoureux.jpg',
        'img/le-chariot.jpg',
        'img/la-justice.jpg',
        'img/l-hermite.jpg',
        'img/la-roue-de-fortune.jpg',
        'img/la-force.jpg',
        'img/le-pendu.jpg'
      ];
      count = 1;
      step = "step5";
      countJeu2();

    } else {

      $('body').waitForImages({
        finished: function() {
          TweenMax.to($("#loader"), 2, {
            opacity: 0,
            ease: "Cubic.easeOut",
            onComplete: function() {
              this.target.remove();
              initJeu0();
            }
          });
        },
        each: function(loaded, count, success) {
          //console.log("waitForImages" + loaded, count);
        },
        waitForAll: true
      });
    }
  }


  /**** JEU 0 - INTRO ****/
  function initJeu0() {
    console.log("initJeu0- - - - - - - - - - -");

    TweenMax.to($("#bg .jeu1"), 0.3, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0
    });

   TweenMax.to($("#jeu #jeu0 .txts "), 0, {

      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0
    });

   TweenMax.to($("#jeu #jeu0 .txts h2"), 0.5, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.2
    });

    TweenMax.to($("#jeu #jeu0 .txts h1"), 0.6, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.4
    });

    TweenMax.to($("#jeu #jeu0 .txts .texte"), 0.6, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.6
    });

    TweenMax.to($("#jeu #jeu0 .txts .decompte"), 0.6, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.9
    });

    TweenMax.to($("#jeu #jeu0 .txts .start"), 0.9, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 1.5,
      onComplete: function() {
        $("#jeu #jeu0 .txts .start").bind("mouseover", function() {

          TweenMax.to($(this).find("span"), 0.3, {
            width: "100%",
            ease: "Cubic.easeOut"
          });
          TweenMax.to($(this).find("p"), 0.3, {
            color: "#000000",
            ease: "Cubic.easeOut"
          });

        }).bind("mouseout", function() {

          TweenMax.to($(this).find("span"), 0.3, {
            width: 0,
            ease: "Cubic.easeOut"
          });
          TweenMax.to($(this).find("p"), 0.3, {
            color: "#ffffff",
            ease: "Cubic.easeOut"
          });

        }).bind("click", function(e) {
          e.preventDefault();

          TweenMax.to($("#jeu0"), 0.3, {
            opacity: 0,
            ease: "Cubic.easeOut",
            onComplete: function() {
              $("#jeu #jeu0").css("display", "none");
              /* initJeu1(); */
              location.href='tirage-32-cartes.htm';
            }
          });
        });

      }
    });

    TweenMax.to($("#jeu #jeu0 .dots"), 0.9, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 2.4
    });

    TweenMax.to($("#jeu #jeu0 .toprev"), 0.9, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 2.4
    });

    TweenMax.to($("#jeu #jeu0 .tonext"), 0.9, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 2.4
    });
  }


  /**** JEU 1 - CARTE ACCCUEIL ****/

  var shuffle;
  var display;
  var melange;

  function shufle_cards(){

    clearTimeout(shuffle)
    var lencard = $("#jeu #jeu1 ul li");

  $("#jeu #jeu1 ul li:nth-child(13)").css("z-index", "12");

   for (var i = 5; i >=0; i--) {

      TweenMax.to($(lencard[i]), 0.3, {
          marginLeft:"20%",
          ease: "Cubic.easeOut",
          delay: 0.25 * (5-i) ,
          yoyo:true,
          repeat:1,
      });
      TweenMax.to($(lencard[i]), 0, {
          css:{"z-index" : -i},
          delay: 0.4 * (5-i)
      });

    }

    display = setTimeout(display_cards, 2500);
  }

  function display_cards(){


    clearTimeout(display)
    var lencard = $("#jeu #jeu1 ul li");

    var angle = 360/32;


    for (var i = 0; i < 32; i++) {


      $(lencard[i]).css("z-index", i);


      TweenMax.to($(lencard[i]), 0.4, {
          css:{"transform": 'rotate(' + angle*i + 'deg)', "transformOrigin":'60% 135% 0px', "left":"39%"},
          delay: 0.08*i
      });
    }

    initcardJeu1();
  }
  function coupe()
  {
    clearTimeout(melange)
    var lencard = $("#jeu #jeu1 ul li");

    for (var i = 0; i < lencard.length; i++) {

      $(lencard[i]).css("z-index", i);

      if(i<11)
      {
        TweenMax.to($(lencard[i]).find(".back"), 0.5, {
          marginLeft: "80px",
          rotation:10,
          ease: "Cubic.easeOut",
          delay: 3,
        });
      }
      else if(i==12)
      {
        TweenMax.to($(lencard[i]).find(".back"), 0.5, {
          marginLeft: "80px",
          rotation:10,
          ease: "Cubic.easeOut",
          delay: 3,
          onComplete: function() {
            this.target.parent().css("z-index", "100");
          }
        });
      }
      else
      {
        TweenMax.to($(lencard[i]).find(".back"), 0.5, {
          marginLeft: "-80px",
          rotation:-10,
          ease: "Cubic.easeOut",
          delay: 3,
        });
      }

      TweenMax.to($(lencard[i]).find(".back"), 0.5, {
          marginLeft: "0",
          rotation:0,
          ease: "Cubic.easeOut",
          delay: 4
      });
    }

  }

  function initcardJeu1(){
    var lencard = $("#jeu #jeu1 ul li");
    var imgFront;
    var rand;

    var $txt_defilement = $("#jeu #jeu1 .txts .decompte");
    var txtmsg = "VEUILLEZ SÃ‰LECTIONNER 12 CARTES DANS LE JEU CI-DESSOUS"
    $txt_defilement.html(txtmsg.replace(/./g, "<em>$&</em>").replace(/\s/g, "</span>&nbsp;<span>"));

    TweenMax.staggerFromTo($txt_defilement.find("em"), 0.01, {
      autoAlpha: 0
    }, {
      autoAlpha: 1
    }, 0.04);

    if(ssTitre == true)
    {

      $("#jeu #cardtitle").css("display","block");

      TweenMax.to($("#jeu #cardtitle"), 0.5, {
            opacity:1,
            delay: 1
        });
    }

    for (var i = 0; i < lencard.length; i++) {

      $(lencard[i]).bind("mouseover", function() {

        if (selected == false) {
          TweenMax.to($(this).find(".back"), 0.3, {
            transform: "matrix(1, 0, 0, 1, 0, -30)",
            ease: "Cubic.easeOut"
          });

        }

      }).bind("mouseout", function() {

        if (selected == false) {
          TweenMax.to($(this).find(".back"), 0.3, {
            transform: "matrix(1, 0, 0, 1, 0, 0)",
            ease: "Cubic.easeOut"
          });

        }

      }).bind("click", function() {

        if (selected == false) {
          selected = true;

          $(this).unbind('mouseover mouseout click');

          $(this).find(".front").css("opacity", 1);
          $(this).find(".front").css("marginTop", 0);

          TweenMax.to($(this).find(".back"), 0.3, {
            rotationY: 180,
            opacity: 0,

          });
          $(this).css("z-index", "200");
          //$(this).css("pointer-events", "none");


          TweenMax.to($(this).find(".front"), 0.3, {
            rotationY: 0
          });
          TweenMax.to($(this), 0.3, {
            rotation:0,
            scale:2,
            transformOrigin:"center",
            delay:0.5
          });


           if(ssTitre)
          {

            if($("#jeu #cardtitle p").text()!=""){
              $("#jeu #cardtitle p").append(" - ");
            }
            $("#jeu #cardtitle p").append( $(this).find(".front").attr("alt"));
          }


           TweenMax.to($(this), 0, {
            delay:1.4,
            onComplete: function() {
              this.target.addClass("is-selected");
            }

          });
          TweenMax.to($(this), 0.4, {
            marginTop: "95%",
            left: 8.375*(12-count)+"%",
            width:"7.8%",
            transform: "matrix(1, 0, 0, 1, 1, 0)",
            immediateRender : false,
            ease: "Cubic.easeOut",
            delay: 1.4,
            onComplete: function() {
              this.target.css("z-index", "100");
              selected = false;
              countJeu1();

              if(!isMobile)
              {
                this.target.bind("mouseover", function() {
                  TweenMax.to($(this), 1, {
                      marginTop:"85%",
                      ease: "Cubic.easeOut"
                  });

                }).bind("mouseout", function() {

                 TweenMax.to($(this), 1, {
                      marginTop:"95%",
                      ease: "Cubic.easeOut"
                  });

                });
              }
            }
          });



          tirage1.push($(this).find(".front").attr("src"));
          names1.push($(this).find(".front").attr("alt"));


          var separateur = ",";

          if (count==12) {
            $('#tirage1').val($('#tirage1').val()+$(this).find(".front").attr("src"));
            $('#names1').val($('#names1').val()+$(this).find(".front").attr("alt"));
          } else {
            $('#tirage1').val($('#tirage1').val()+separateur+$(this).find(".front").attr("src"));
            $('#names1').val($('#names1').val()+separateur+$(this).find(".front").attr("alt"));
          }


        }
      });
    }
  }

  function initJeu1() {

  /* On charge les cartes */

  for (var i = 0; i < 32; i++) {

      $("#jeu #jeu1 ul").append(' <li><img src="img/back-card.png" class="back" alt="Dos"><img src="../common/img/1px.png" class="front" alt="Carte"></li>');
    }


    /**** INIT ONLY CARD BITMAP *****/
    var lencard = $("#jeu #jeu1 ul li");
    for (var i = 0; i < lencard.length; i++) {
      rand = Math.floor((Math.random() * cards.length));
      imgFront = cards[rand];
      legende = names[rand];
      cards.splice(rand, 1);
      names.splice(rand, 1);
      $(lencard[i]).find(".front").attr("src", "img/" + imgFront + ".png");
      $(lencard[i]).find(".front").attr("alt", legende);
    }


    /* On charge les backgrounds */
    TweenMax.to($('.tarot7 #bg .jeu2'), 0, {
      backgroundImage: "url(img/bg1_light.jpg)",
      delay: 0
    });

    TweenMax.to($('.tarot7 #bg .jeu3'), 0, {
      backgroundImage: "url(img/bg1_light.jpg)",
      delay: 0
    });

    var lencard = $("#jeu #jeu1 ul li");
    var imgFront;
    var rand;


    for (var i = 0; i < lencard.length; i++) {

      $(lencard[i]).css("z-index", i);
      TweenMax.to($(lencard[i]).find(".back"), 0.3, {
        marginTop: "0px",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: (0.04 * i) + 0.6,

      });
      TweenMax.to($(lencard[i]).find(".front"), 0, {
        rotationY: 180
      });
    }
    melange = setTimeout(coupe, 0);
    shuffle = setTimeout(shufle_cards, 4500);
   // display_cards();

    TweenMax.to($('#jeu #jeu1'), 0, {
      left: "50%",
      ease: "Cubic.easeOut",
      delay: 0
    });

    TweenMax.to($("#bg .jeu1"), 1.2, {
      scale: 1.2,
      ease: "Cubic.easeInOut",
      delay: 0
    });

    TweenMax.to($("#jeu #jeu1 .txts .texte"), 0.6, {
      scale: 1,
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.3
    });

    TweenMax.to($("#jeu #jeu1 .txts .decompte"), 0.6, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 0.9
    });
  }



  /** JEU 1 - 1ER TIRAGE  **/
  function countJeu1() {
    count--;

    console.log("countJeu1- - - - - - - - - - -");
    console.log("tirage1: " + tirage1);
    console.log("count: " + count);

    $('#jeu #jeu1 .txts .decompte').text("VEUILLEZ SÃ‰LECTIONNER " + count + " CARTES DANS LE JEU CI-DESSOUS");

    if (count == 0) {

      selected = true;



      /* initJeu2a(); */
      $('form#formulaire').submit();
    }
  }


  /** JEU 2 - CARTES DE DOS  **/
  function initJeu2a() {

    selected = true;



      TweenMax.to($('#jeu #jeu1'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });
      TweenMax.to($('#bg .jeu1'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });

      TweenMax.to($('#jeu #jeu2'), 1.2, {
        left: "50%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });
      TweenMax.to($('#bg .jeu2'), 1.2, {
        left: "0%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });

    $("#jeu #jeu2 .txts a").bind("mouseover", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: "100%",
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#000000",
        ease: "Cubic.easeOut"
      });

    }).bind("mouseout", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: 0,
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#ffffff",
        ease: "Cubic.easeOut"
      });

    }).bind("click", function() {

      returnCard();
    });

    var lencard = $("#jeu #jeu2 ul li");

    for (var i = 0; i < lencard.length; i++) {

      $(lencard[i]).bind("click", function() {
          returnCard();
      });

    }

  }

  function returnCard()
  {
    TweenMax.to($("#jeu #jeu2 .txts a"), 0.3, {
        opacity: 0,
        ease: "Cubic.easeOut",
        onComplete: function() {
          this.target.css("visibility", "hidden");
        }
    });

    TweenMax.to($("#jeu #jeu2 .txts .title"), 0.3, {
        scale: 1.2,
        translate: "0 -50px",
        opacity: 0,
        ease: "Cubic.easeOut",
        onComplete: function() {
          this.target.css("visibility", "hidden");
          initJeu2b();
        }
      });

    $("#jeu #jeu2 .txts #step1").css("display", "block");
  }


  /** JEU 2  - LES CARTES SE RETOURNENT  **/
  function initJeu2b() {


    TweenMax.to($("#jeu #jeu2 .txts #step1"), 1, {
      scale: 2,
      opacity: 0,
      ease: "Cubic.easeOut",
      delay: 1
    });

    TweenMax.to($("#jeu #jeu2 .txts #step1"), 0.3, {
      scale: 1,
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 1.5,
      onComplete: function() {
        selected = false;
      }
    });


    var lencard = $("#jeu #jeu2 ul li");
    var imgFront;
    var rand;

    count = 3;
    selected = true;

    for (var i = 0; i < lencard.length; i++) {
      rand = Math.floor((Math.random() * tirage1.length));
      imgFront = tirage1[i];
      legende = names1[i];

      $(lencard[i]).find(".front").attr("src", imgFront);
      $(lencard[i]).find(".front").attr("alt", legende);
      $(lencard[i]).find(".front").css("opacity", 1);
      TweenMax.to($(lencard[i]), 0.3, {
        left:"-50px",
        delay: i * 0.2
      });
       TweenMax.to($(lencard[i]), 0.3, {
        left:"0px",
        delay: (i * 0.2) + 0.5
      });
      TweenMax.to($(lencard[i]).find(".back"), 1, {
        rotationY: 180,
        opacity: 0,
        delay: i * 0.2
      });
      TweenMax.to($(lencard[i]).find(".front"), 1, {
        rotationY: 0,
        opacity: 1,
        delay: i * 0.2
      });

      if(ssTitre)
      {
        $(lencard[i]).find("p").css("visibility", "visible");

        TweenMax.to($(lencard[i]).find("p"), 0.5, {
            opacity: 1,
            delay: i * 0.2 + 0.8
        });
      }

      $(lencard[i]).unbind( "click" );

      $(lencard[i]).bind("mouseover", function() {

        TweenMax.to($(this).find(".front"), 0.5, {
          left:"-10px"
        });

        TweenMax.to($(this).find("p"), 0.5, {
          left:"-10px"
        });


      }).bind("mouseout", function() {

        TweenMax.to($(this).find(".front"), 0.5, {
          left:"0"
        });

        TweenMax.to($(this).find("p"), 0.5, {
          left:"0"
        });

      }).bind("click", function() {

        var separateur = ",";

        if (selected == false) {
          selected = true;

          $(this).unbind('mouseover mouseout click');

          TweenMax.to($(this).find(".front"), 0.4, {
            left: 0,
            top:"-10px",
            onComplete: function() {
              selected = false;
              countJeu2();
            }
          });

          TweenMax.to($(this).find("p"), 0.4, {
            opacity:"0"
          });

          if (step != "step5") {
            tirage2.push($(this).find(".front").attr("src"))
            // On stock le nom des cartes dans le tableau name2
            names2.push($(this).find(".front").attr("alt")); // ADDON

            var separateur = ",";

            $('#tirage2').val($('#tirage2').val()+separateur+$(this).find(".front").attr("src"));
            $('#names2').val($('#names2').val()+separateur+$(this).find(".front").attr("alt"));
          }

          if (step == "step1") {
            cardsToGo1.push($(this));
          }
          if (step == "step2") {
            cardsToGo2.push($(this));
          }
          if (step == "step3") {
            cardsToGo3.push($(this));
          }
          if (step == "step4") {
            cardsToGo4.push($(this));
          }
        }
      });
    }
  }


  /** JEU 2 - 2EME TIRAGES SUCCESSIFS  **/
  function countJeu2() {
    count--;

    if (count == 0)
    {

      selected = true;

      if (step == "step1")
      {

        for (var i = 0; i < cardsToGo1.length; i++) {
          TweenMax.to($(cardsToGo1[i]).find(".front"), 0.4, {
            opacity: 0,
            top: "-20px",
            delay: i * 0.1,
            onComplete: function() {
              this.target.css("display", "none");
            }
          });
        }

        TweenMax.to($("#jeu #jeu2 .txts #step1"), 0.3, {
          scale: 1.2,
          translate: "0 -50px",
          opacity: 0,
          ease: "Cubic.easeOut",
          delay: 1,
          onComplete: function() {
            this.target.css("display", "none");
            $("#jeu #jeu2 .txts #step2").css("display", "block");
          }
        });

        TweenMax.to($("#jeu #jeu2 .txts #step2"), 1, {
          scale: 2,
          opacity: 0,
          ease: "Cubic.easeOut"
        });

        TweenMax.to($("#jeu #jeu2 .txts #step2"), 0.3, {
          scale: 1,
          opacity: 1,
          ease: "Cubic.easeOut",
          delay: 1.3,
          onComplete: function() {
            selected = false;
          }
        });



        count = 3;
        step = "step2";
      }

      else if (step == "step2") {

        for (var i = 0; i < cardsToGo2.length; i++) {
          TweenMax.to($(cardsToGo2[i]).find(".front"), 0.4, {
            opacity: 0,
            top: "-20px",
            delay: i * 0.1,
            onComplete: function() {
              this.target.css("display", "none");
            }
          });
        }

        TweenMax.to($("#jeu #jeu2 .txts #step2"), 0.3, {
          scale: 1.2,
          translate: "0 -50px",
          opacity: 0,
          ease: "Cubic.easeOut",
          delay: 1,
          onComplete: function() {
            this.target.css("display", "none");
            $("#jeu #jeu2 .txts #step3").css("display", "block");
          }
        });

        TweenMax.to($("#jeu #jeu2 .txts #step3"), 1, {
          scale: 2,
          opacity: 0,
          ease: "Cubic.easeOut"
        });

        TweenMax.to($("#jeu #jeu2 .txts #step3"), 0.3, {
          scale: 1,
          opacity: 1,
          ease: "Cubic.easeOut",
          delay: 1.3,
          onComplete: function() {
            selected = false;
          }
        });



        count = 2;
        step = "step3";
      }

      else if (step == "step3") {

        for (var i = 0; i < cardsToGo3.length; i++) {
          TweenMax.to($(cardsToGo3[i]).find(".front"), 0.4, {
            opacity: 0,
            top: "-20px",
            delay: i * 0.1,
            onComplete: function() {
              this.target.css("display", "none");
            }
          });
        }

        TweenMax.to($("#jeu #jeu2 .txts #step3"), 0.3, {
          scale: 1.2,
          translate: "0 -50px",
          opacity: 0,
          ease: "Cubic.easeOut",
          delay: 1,
          onComplete: function() {
            this.target.css("display", "none");
            $("#jeu #jeu2 .txts #step4").css("display", "block");
          }
        });

        TweenMax.to($("#jeu #jeu2 .txts #step4"), 1, {
          scale: 2,
          opacity: 0,
          ease: "Cubic.easeOut"
        });

        TweenMax.to($("#jeu #jeu2 .txts #step4"), 0.3, {
          scale: 1,
          opacity: 1,
          ease: "Cubic.easeOut",
          delay: 1.3,
          onComplete: function() {
            selected = false;
          }
        });



        count = 2;
        step = "step4";
      }

      else if (step == "step4") {

        for (var i = 0; i < cardsToGo4.length; i++) {
          TweenMax.to($(cardsToGo4[i]).find(".front"), 0.4, {
            opacity: 0,
            top: "-20px",
            delay: i * 0.1,
            onComplete: function() {
              this.target.css("display", "none");
            }
          });
        }

        TweenMax.to($("#jeu #jeu2 .txts #step4"), 0.3, {
          scale: 1.2,
          translate: "0 -50px",
          opacity: 0,
          ease: "Cubic.easeOut",
          delay: 1,
          onComplete: function() {
            this.target.css("display", "none");
            $("#jeu #jeu2 .txts #step5").css("display", "block");
          }
        });

        TweenMax.to($("#jeu #jeu2 .txts #step5"), 1, {
          scale: 2,
          opacity: 0,
          ease: "Cubic.easeOut"
        });

        TweenMax.to($("#jeu #jeu2 .txts #step5"), 0.3, {
          scale: 1,
          opacity: 1,
          ease: "Cubic.easeOut",
          delay: 1.3,
          onComplete: function() {
            selected = false;
          }
        });




        count = 1;
        step = "step5";
      }

      else if (step == "step5")
      {

        var lencard = $("#jeu #jeu2 ul li");

        for (var i = 0; i < lencard.length; i++)
        {
          if ($(lencard[i]).find(".front").css("display") == "block")
          {
            console.log($(lencard[i]).find(".front").css("top"))
            if ($(lencard[i]).find(".front").css("top") == "0px")
            {
              var color = {gray:0};
              TweenMax.to(color, 2, {gray:1, onUpdate:applyColor, onUpdateParams:[$(lencard[i]).find(".front")]})

              function applyColor(element) {
                element.css('filter', 'grayscale('+color.gray+')')
                element.css('-webkit-filter', 'grayscale('+color.gray+')')
              }

              TweenMax.to($(lencard[i]), 2, {
               opacity:0,
               scale:0.2,
                delay: 2,
                onComplete: function() {
                  this.target.css("display", "none");
                }
              });


              tirage2.splice(11,0,$(lencard[i]).find(".front").attr("src"));
            var separateur = ",";
            $('#tirage2').val($('#tirage2').val()+separateur+$(lencard[i]).find(".front").attr("src"));
            $('#names2').val($('#names2').val()+separateur+$(lencard[i]).find(".front").attr("alt")); // ADDON
            }
            else
            {
              TweenMax.to($(lencard[i]).find(".front"), 0.4, {
                opacity: 0,
                top: "-20px",
                delay: i * 0.01,
                onComplete: function() {
                  this.target.css("display", "none");
                }
              });

              tirage2.splice(10,0,$(lencard[i]).find(".front").attr("src"));

              tirage2.push($(lencard[i]).find(".front").attr("src"));

              // On stock le nom des cartes dans le tableau name2
              names2.push($(lencard[i]).find(".front").attr("alt")); // ADDON

            var separateur = ",";
            $('#tirage2').val($('#tirage2').val()+separateur+$(lencard[i]).find(".front").attr("src"));
            $('#names2').val($('#names2').val()+separateur+$(lencard[i]).find(".front").attr("alt")); // ADDON

            }
          }
        }
        TweenMax.to($("#jeu #jeu2 .txts #step5"), 0.3, {
            scale: 1.2,
            translate: "0 -50px",
            opacity: 0,
            ease: "Cubic.easeOut",
            delay: 0.3,
            onComplete: function() {
              this.target.css("display", "none");
            }
        });

        TweenMax.to($('#jeu #jeu2'), 1.2, {
            left: "-100%",
            ease: "Cubic.easeOut",
            delay: 4
        });


        /* initForm1(); */
        $('form#formulaire').submit();

      }
    }
  }


  /** JEU FORMULAIRE - CHECKBOX  **/
  function initForm1() {

          TweenMax.to($('#jeu #jeuFormCiv.step1'), 1.2, {
            left: "50%",
            ease: "Cubic.easeOut",
            delay: 2.2
          });

          TweenMax.to($('#jeu #jeuFormCiv.step1'), 0, {
            scale: 0.5,
          });
          TweenMax.to($('#jeu #jeuFormCiv.step1'), 1.2, {
            scale: 1,
            clearProps:"scale",
            ease: "Cubic.easeOut",
            delay: 3.6,

          });

    console.log("initForm1- - - - - - - - - - -");
    console.log("tirage1: " + tirage1);
    console.log("tirage2: " + tirage2);

     /* SI OUI -> FORMULAIRE */

    $("#homme, #femme").change(function() {

      TweenMax.to($('#jeu #jeuFormCiv.step1'), 0.6, {
        scale: 0.5,
        ease: "Cubic.easeOut",
        delay: 0.2
      });
      TweenMax.to($('#jeu #jeuFormCiv.step1'), 0.6, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.8
      });


      TweenMax.to($('#jeu #jeuFormCiv.step2'), 0.6, {
        left: "50%",
        //translate: "-50% 0%",
        ease: "Cubic.easeOut",
        delay: 0.8
      });

      TweenMax.to($('#jeu #jeuFormCiv.step2'), 0, {
        scale: 0.5,
      });

      TweenMax.to($('#jeu #jeuFormCiv.step2'), 1.2, {
            scale: 1,
            ease: "Cubic.easeOut",
            delay: 1.4,
            onComplete: function() {
              //$('#jeu #jeuFormCiv').addClass("is-centered");
            }
          });

    });

    $("#oui, #non").change(function() {
    /* Si la rÃ©ponse est oui */
    if ($("input[name='radio2']:checked").val() == "oui") {

      TweenMax.to($('#jeu #jeuFormCiv'), 0.6, {
        scale: 0.5,
        ease: "Cubic.easeOut",
        delay: 0.2
      });
      TweenMax.to($('#jeu #jeuFormCiv'), 0.6, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.8
      });


      TweenMax.to($('#jeu #jeuFormEmail'), 0.6, {
        left: "50%",
        //translate: "-50% 0%",
        ease: "Cubic.easeOut",
        delay: 0.8
      });

      TweenMax.to($('#jeu #jeuFormEmail'), 0, {
        scale: 0.5,
      });
      TweenMax.to($('#jeu #jeuFormEmail'), 1.2, {
        scale: 1,
        ease: "Cubic.easeOut",
        delay: 1.4,
        onComplete: function() {
          //$('#jeu #jeuFormEmail').addClass("is-centered");
          initForm2();
        }
      });


    } else {

      $('#go_sexe').val($('input[name="radio1"]:checked').val());

      TweenMax.to($('#jeu #jeuFormCiv.step2'), 1.2, {
        scale: 0.5,
        ease: "Cubic.easeOut",
        delay: 0.4
      });
      TweenMax.to($('#bg .jeu2'), 1.2, {
        scale: 1,
        ease: "Cubic.easeOut",
        delay: 0.4
      });

      TweenMax.to($('#jeu #jeuFormCiv.step2'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 1.6
      });
      TweenMax.to($('#bg .jeu2'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 1.6
      });
      TweenMax.to($('#jeu #jeu3'), 1.2, {
        left: "50%",
        ease: "Cubic.easeOut",
        delay: 1.6
      });
      TweenMax.to($('#bg .jeu3'), 1.2, {
        left: "0%",
        ease: "Cubic.easeOut",
        delay: 1.6
      });

      TweenMax.to($('#jeu #jeu3'), 0, {
        scale: 0.5,
      });
      TweenMax.to($('#jeu #jeu3'), 1.2, {
        scale: 1,
        ease: "Cubic.easeOut",
        delay: 2.8,
        onComplete: function() {
          $('#jeu #jeu3').addClass("is-centered");
        }
      });
      TweenMax.to($('#bg .jeu3'), 1.2, {
        scale: 1.2,
        ease: "Cubic.easeOut",
        delay: 2.8,
        onStart: function() {
          animFinaleCarte();
        }
      });
    }
    });
  }




  /** JEU FORMULAIRE - CIV/EMAIL **/
  function initForm2() {
    console.log("initForm2- - - - - - - - - - -");
    console.log("tirage1: " + tirage1);
    console.log("tirage2: " + tirage2);

    $("#jeu #jeuFormEmail .send").bind("mouseover", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: "100%",
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#000000",
        ease: "Cubic.easeOut"
      });

    }).bind("mouseout", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: 0,
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#ffffff",
        ease: "Cubic.easeOut"
      });

    }).bind("click", function() {

      /* On passe les variables pour la page rÃ©sultat */

        $('#go_email').val($('#email').val());
        $('#go_prenom').val($('#prenom').val());
        $('#go_sexe').val($('input[name="radio1"]:checked').val());
        $('#go_crit1').val($('#theme_box').val());
        $('#go_crit2').val($('#theme_amour').val());
  });
  }

  function goFinal() {

      TweenMax.to($('#jeu #jeuFormEmail'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });
      TweenMax.to($('#bg .jeu2'), 1.2, {
        left: "-100%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });
      TweenMax.to($('#jeu #jeu3'), 1.2, {
        left: "50%",
        ease: "Cubic.easeOut",
        delay: 0.5
      });
      TweenMax.to($('#bg .jeu3'), 1.2, {
        left: "0%",
        ease: "Cubic.easeOut",
        delay: 0.5,
        onComplete: function() {
          animFinaleCarte();
        }
      });
  }

  /** JEU 3 - Animation Finale Cartes **/
  function animFinaleCarte() {
    console.log("animFinaleCarte- - - - - - - - - - -");
    console.log("tirage1: " + tirage1);
    console.log("tirage2: " + tirage2);

     $("#jeu #cardtitle").css("display","block");
    $("#jeu #cardtitle p").html("Veuillez patienter, votre tirage est en cours dâ€™interprÃ©tation")

    TweenMax.to($("#jeu #cardtitle"), 0.5, {
        opacity:1,
        delay: 0.5,
    });

    /* INJECTION DU TIRAGE DE L'ECRAN FINAL */
    var lencard = $("#jeu #jeu3 .card ul li");

    $(lencard[0]).find(".front").attr("src", tirage2[0]);
    $(lencard[1]).find(".front").attr("src", tirage2[1]);
    $(lencard[2]).find(".front").attr("src", tirage2[2]);

    $(lencard[3]).find(".front").attr("src", tirage2[11]);

    $(lencard[4]).find(".front").attr("src", tirage2[3]);
    $(lencard[5]).find(".front").attr("src", tirage2[4]);
    $(lencard[6]).find(".front").attr("src", tirage2[5]);

    $(lencard[7]).find(".front").attr("src", tirage2[6]);
    $(lencard[8]).find(".front").attr("src", tirage2[7]);

    $(lencard[9]).find(".front").attr("src", tirage2[8]);
    $(lencard[10]).find(".front").attr("src", tirage2[9]);

    $(lencard[11]).find(".front").attr("src", tirage2[10]);

    var color = {gray:0};
    TweenMax.to(color, 2, {gray:1, onUpdate:applyColor, onUpdateParams:[$(lencard[3]).find(".front")]})

    function applyColor(element) {
       element.css('filter', 'grayscale('+color.gray+')')
       element.css('-webkit-filter', 'grayscale('+color.gray+')')
    }

    TweenMax.to($(lencard[0]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 0.5
    });
    TweenMax.to($(lencard[1]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 1
    });
    TweenMax.to($(lencard[2]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 1.5
    });
    TweenMax.to($("#jeu #jeu3 .card .qualite"), 1, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 2
    });

    TweenMax.to($(lencard[4]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 3
    });
    TweenMax.to($(lencard[5]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 3.5
    });
    TweenMax.to($(lencard[6]), 0.5, {
        marginLeft: "0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 4
    });
    TweenMax.to($("#jeu #jeu3 .card .difficulte"), 1, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 4.5
    });

    TweenMax.to($(lencard[7]), 0.5, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 5.5
    });
    TweenMax.to($(lencard[8]), 0.5, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 5.5
    });
    TweenMax.to($("#jeu #jeu3 .card .opportunite"), 1, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 6
    });

    TweenMax.to($(lencard[9]), 0.5, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 7
    });
    TweenMax.to($(lencard[10]), 0.5, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 7
    });
    TweenMax.to($("#jeu #jeu3 .card .frein"), 1, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 7.5
    });

    TweenMax.to($(lencard[11]), 0.5, {
        top:"0",
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 8
    });
    TweenMax.to($("#jeu #jeu3 .card .incertitude"), 3, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 8.5
    });

    TweenMax.to($(lencard[3]), 2, {
        opacity: 1,
        ease: "Cubic.easeOut",
        delay: 10,
      onComplete: function() {
        /* initJeu3(); */
        $('form#formulaire').submit();
        //$("#ecran").css("display", "block");
      }
    });

   /* TweenMax.to($('#ecran'), 2, {
      opacity:1,
      ease: "Cubic.easeOut",
      delay: 11,
      onComplete: function() {
        playVideo();
      }
    });*/

  }



  /** JEU 3 - RESULTATS **/
  function initJeu3() {

    TweenMax.to($("#jeu #cardtitle"), 5, {
          opacity:0,
          delay: 5,
           onComplete: function() {
            $("#jeu #cardtitle").css("display","none");
          }
      });

    /* INJECTION DU TIRAGE SUR L'INTERPRETATION */

    var lencard = $("#jeu #resultat .interpretation .bloc");
    var lencard2 = $("#jeu #resultat .interpretation .bloc");

    console.log(names2)

    // Bloc 1
    $(lencard2[0]).find(".cards li:nth-child(1) .front").attr("src", tirage2[0]);
    $(lencard2[0]).find(".cards li:nth-child(2) .front").attr("src", tirage2[1]);
    $(lencard2[0]).find(".cards li:nth-child(3) .front").attr("src", tirage2[2]);
    $(lencard2[0]).find(".cards li:nth-child(4) .front").attr("src", tirage2[3]);

    $(lencard2[0]).find(".sstitle").html(names2[0]+" - "+names2[1]+" - "+names2[2]+" - "+names2[3]); // ADDON


    // Bloc 2
    $(lencard2[1]).find(".cards li:nth-child(1) .front").attr("src", tirage2[4]);
    $(lencard2[1]).find(".cards li:nth-child(2) .front").attr("src", tirage2[5]);
    $(lencard2[1]).find(".cards li:nth-child(3) .front").attr("src", tirage2[6]);
    $(lencard2[1]).find(".cards li:nth-child(4) .front").attr("src", tirage2[7]);

    $(lencard2[1]).find(".sstitle").html(names2[4]+" - "+names2[5]+" - "+names2[6]+" - "+names2[7]); // ADDON


    // Bloc 3
    $(lencard2[2]).find(".cards li:nth-child(1) .front").attr("src", tirage2[8]);
    $(lencard2[2]).find(".cards li:nth-child(2) .front").attr("src", tirage2[9]);
    $(lencard2[2]).find(".cards li:nth-child(3) .front").attr("src", tirage2[10]);

    $(lencard2[2]).find(".sstitle").html(names2[8]+" - "+names2[9]+" - "+names2[10]); // ADDON


  /* Transmission des variables au PHP */

  var tirage ='tarot7';
  var carte1 = names2[0];
  var carte2 = names2[1];
  var carte3 = names2[2];
  var carte4 = names2[3];
  var carte5 = names2[4];
  var carte6 = names2[5];
  var carte7 = names2[6];
  var carte8 = names2[7];
  var carte9 = names2[8];
  var carte10 = names2[9];
  var carte11 = names2[10];

      $.ajax({
              url: '../ajax/result.php',
              type: "POST",
              data: {
                sexe : sexe,
                tirage : tirage,
                carte1 : carte1,
                carte2 : carte2,
                carte3 : carte3,
                carte4 : carte4,
                carte5 : carte5,
                carte6 : carte6,
                carte7 : carte7,
                carte8 : carte8,
                carte9 : carte9,
                carte10 : carte10,
                carte11 : carte11
              },
              dataType: 'json',
          success: function(data){
              $('#paragraphe1').html(data.cartes1);
              $('#paragraphe2').html(data.cartes2);
              $('#paragraphe3').html(data.cartes3);
            },
          error:function(){
              alert('Erreur ajax');
            }
          });


    $("#jeu #resultat").css("display", "block");

    TweenMax.to($("#jeu #jeu3"), 0.5, {
      opacity: 0,
      ease: "Cubic.easeOut",
      delay: 2
    });

   TweenMax.to($("#jeu #resultat"), 1.5, {
      opacity: 1,
      ease: "Cubic.easeOut",
      delay: 3,
      onComplete: function() {
        $('html').css("overflow-y", "auto");
        $('content').css("overflow-y", "auto");
        $('#jeu').css("overflow-y", "auto");
      }
    });

   var lencard = $("#jeu #resultat .tirage ul li");

    for (var i = 0; i < lencard.length; i++) {

      $(lencard[i]).bind("mouseover", function() {


        TweenMax.to($(this).find(".card .back"), 0.3, {
          rotation:20,

          ease: "Cubic.easeOut"
        });
        TweenMax.to($(this).find(".card .front"), 0.3, {
          rotation:-20,

          ease: "Cubic.easeOut"
        });

        TweenMax.to($(this).find(".bouton"), 0.3, {
          css:{"color":"#000000", "background":"#ffffff","box-shadow":"0px 0px 2px #000000"},
          ease: "Cubic.easeOut"
        });



        TweenMax.to($(this).find(".vignette img"), 0.3, {
          width:"110%",
          marginLeft:"-5%",
          ease: "Cubic.easeOut"
        });

      }).bind("mouseout", function() {


        TweenMax.to($(this).find(".card .back"), 0.3, {
          rotation:0,

          ease: "Cubic.easeOut"
        });
        TweenMax.to($(this).find(".card .front"), 0.3, {
          rotation:0,

          ease: "Cubic.easeOut"
        });

        TweenMax.to($(this).find(".vignette img"), 0.3, {
          width:"100%",
          marginLeft:"0%",
          clearProps:"width",
          ease: "Cubic.easeOut"
        });

        TweenMax.to($(this).find(".bouton"), 0.3, {
          css:{"color":"#ffffff", "background":"#27758c","box-shadow":"0px 2px 0px #16294f"},
          ease: "Cubic.easeOut"
        });
      });

    }

    $("#jeu #resultat .send").bind("mouseover", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: "100%",
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#000000",
        ease: "Cubic.easeOut"
      });

    }).bind("mouseout", function() {

      TweenMax.to($(this).find("span"), 0.3, {
        width: 0,
        ease: "Cubic.easeOut"
      });
      TweenMax.to($(this).find("p"), 0.3, {
        color: "#ffffff",
        ease: "Cubic.easeOut"
      });

    })
  }
