<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
  public function merchandise()
  {
    $context = [
      'activetab' => 'merchandise',
    ];
    return view('public.merchandise.index', $context);
  }

  public function choristers()
  {
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'choristers',
      'titletext' => 'Choristers',
      'essay' => [
        [
          'Register',
          [
            'You can register for AIV using the form at <a href="' .route('home'). '">www.aiv.org.au/home</a>.',
            'This is also the place to go if you wish to order merchandise, host interstate student choristers, or attend our social events.',
          ]
        ],
      ]
    ];
    return view('public.choristers.index', $context);
  }
  public function bulletins()
  {
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'bulletins',
      'titletext' => 'News bulletins',
      'essay' => [
        [
          'News bulletins',
          [
            '<ul>
            <li><a href="/documents/newsbulletins/aurora-adelaideiv2019.pdf">AURORA edition: Introductory information for everyone</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news4.pdf">May 2018 edition: Pricing, important dates and Committee information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news3.pdf">April 2018 edition: Transport, billeting and accommodation information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news2.pdf">March 2018 edition: Repertoire and conductor information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news1.pdf">January 2018 edition</a><br><small>Note: January 2018 edition contains some outdated information, please check more recent news or the website for current information.</small></li>
            </ul>',
          ],
        ],
      ]
    ];
    return view('public.index', $context);
  }
  public function fees()
  {
    function tablecell($str = '',$class = NULL,$head = False)
    {
      $tdorth = $head ? 'th' : 'td' ;
      if($class === 'hilite')
      {
        $classstr = ' class="mdl-color-text--primary"';
      }
      else
      {
        $classstr = $class === NULL ? '' : " class=\"{$class}\"";
      }
      return "<{$tdorth}{$classstr}>{$str}</{$tdorth}>";;
    }
    $ttstudent = 'Enrolled full time at an Australian University during Semester Two 2018 or Semester One 2019 (or equivalent)';
    $ttyouth = 'Born on or after 10 January 1989';
    $ttstudent = ' <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored material-icons" id="ttstudent">info</button><div class="mdl-tooltip mdl-tooltip--large" for="ttstudent">' . $ttstudent. '</div>';
    $ttyouth = ' <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored material-icons" id="ttyouth">info</button><div class="mdl-tooltip mdl-tooltip--large" for="ttyouth">' . $ttyouth. '</div>';
    $feesarraylocal = [
      'Please note that fees will need to be paid according to the timeline on page two of <a href="/documents/newsbulletins/adelaideiv2019news4.pdf">news bulletin 4</a>.',
      'Early bird registration has been extended until 30/09/2018.',
      '<table><tbody>
      <tr>' . tablecell('Complete registration',NULL,TRUE) . tablecell('Early ','hilite',TRUE) . tablecell('Late',NULL,TRUE) . '</tr>
      <tr>' . tablecell('Pay a $50 deposit',NULL) . tablecell('by 30/09/2018','mdl-color-text--primary outertablecell') . tablecell('after 30/09/2018','outertablecell') . '</tr>
      <tr>' . tablecell('Students'.$ttstudent) . tablecell('$450','hilite') . tablecell('$500') . '</tr>
      <tr>' . tablecell('Youth'.$ttyouth)      . tablecell('$600','hilite') . tablecell('$650') . '</tr>
      <tr>' . tablecell('General') . tablecell('$700','hilite') . tablecell('$750') . '</tr>
      </tbody>
      <tfoot><tr><td colspan="4">
        <span class="mdl-typography--body-2 mdl-typography--body-2-color-contrast">First time singing at an IV?</span>
        <br>
        <span class="mdl-typography--headline">Take $100 off</span>
        </td></tr></tfoot>
      </table>',
      '<ul>
       <li>Any chorister who has never been a singing participant in an IV festival before can receive $100 the price of their registration, courtesy of the AICSA trust fund. Complete registration with a deposit made by 30/09/2018 becomes $350 for students, youth $500, general $600.</li>
       <li>Complete registration includes:<ul><li>Choral participation and camp</li><li>Academic dinner</li><li>Post concert party and farewell barbecue</li></ul></li>
       <li>Social registration is $150 and is available to those who don’t wish to sing in the concert, but want to attend social events including the academic dinner.</li>
       <li>Registration options will also be available for those who don’t wish to participate in the academic dinner and/or those who don’t wish to stay overnight at camp.</li>
       <li>Academic dinner tickets are normally bundled in the social component but can also be purchased separately at $130 each.</li>
       <li>Merchandise, scores and concert tickets are sold separately.</li>
       </ul>',
    ];
    $feesarraynotready = [
      'We’re not yet ready to announce registration fees but we hope to do this very soon. Watch this space.'
    ];
    if(config('app.env') === 'local')
    {
      $feesarray = $feesarraylocal;
    }
    else
    {
      $feesarray = $feesarraynotready;
      $feesarray = $feesarraylocal;
    }
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'fees',
      'titletext' => 'Registration fees',
      'essay' => [
        [
          '',
          [
            'Your registration fee covers a number of things including your food and accommodation at camp, the hire or purchase of scores, the academic dinner ticket, fees for our musical staff, and so on.',
            'We have three categories for registration: Student (full time enrolled at an Australian university during Semester Two, 2018 or Semester One, 2019 or equivalent), Youth (born on or after 10 January 1989), and General (everyone else). There is also a discount for first time choristers, who have never sung at an intervarsity choral festival before, courtesy of the AICSA trust fund.',
          ],
        ],
        [
          'Fees',
          $feesarray
        ],
      ]
    ];
    return view('public.index', $context);
  }
  public function social()
  {
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'social',
      'titletext' => 'Social',
      'essay' => [
        [
          'Social events',
          [
            'Social events are probably the most anticipated aspect of the festival, maybe even more than the concert! There are a number of social events that are traditionally held at IVs. Here are a few.',
          ],
        ],
        [
          'Opening night party',
          [
            'The theme of our festival is Northern Lights, and we invite you to bring a costume to match—think astronomical, think celestial bodies, think cool natural phenomena. The sky’s the limit! This will be held on the first night of <a href="' .route('public.choristers.camp'). '">camp</a>.',
          ],
        ],
        [
          'Revue',
          [
            'A talent night/variety show, held at camp. We welcome all kinds of acts: society, group or individual; funny, intentionally or otherwise; serious or seriously bad; fully-rehearsed or halfremembered. This will be held on the last night of camp.',
          ],
        ],
        [
          'Pub nights',
          [
            'Pub night venues in Adelaide are to be decided, but will be in the CBD and close to public transport. These are relaxed events and drinking is totally optional—treat them like an opportunity to catch up with friends old and new.',
          ],
        ],
        [
          'Academic dinner',
          [
            'The highlight of the social calendar, a starstudded evening in the beautiful Ayers House Conservatory. Dress to impress! This will be held on 16 January 2019.',
          ],
        ],
        [
          'Post concert party',
          [
            'Give yourselves a round of applause and buy yourselves a round. You’ve earned it! This will be held at the Caledonian Hotel in North Adelaide after the concert.',
          ],
        ],
        [
          'Farewell barbecue',
          [
            'All good things must come to a deliciously calorific, sunshiney end. Enjoy a glorious Adelaide day in the company of all the friends that you’ve made over the last ten days.',
          ],
        ],
      ]
    ];
    return view('public.index', $context);
  }
  public function camp()
  {
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'camp',
      'titletext' => 'Camp',
      'essay' => [
        [
          'Camp',
          [
            'A big part of the IV rehearsal process is the rehearsal camp. This doesn’t involve tents and bonfires, but marshmallows and singalongs are perfectly acceptable! It’s the part of the festival where we travel to a location together, stay there for a few nights, and buckle down to some intensive rehearsing. We generally rehearse for six hours a day, with breaks in between for meals.',
            'Not only is camp a big help in learning the music, it’s a big factor in creating the social atmosphere of an IV—there are <a href="' .route('public.choristers.social'). '">social events</a> every evening, accommodation is in shared dormitories to help you get to know your new friends, and we spend time together in rehearsals, at meal times, and at breaks. You’re guaranteed to make friends and have fun!',
            'Our camp will be held in <strong>Nunyara Conference Centre</strong> in Belair in the Adelaide Hills, 20 minutes from the Adelaide CBD. The historic building, with its spacious grounds and spectacular views of the city, is named after the Kaurna word for ‘place of healing’. Camp is held over four nights from <strong>11–15 January</strong>.',
            'The rest of the rehearsals will be held on the North Terrace campus of the University of Adelaide in the CBD. Our rehearsal policy doesn’t differentiate between camp and non-camp rehearsals, and you will need to ensure you attend the majority of the rehearsals at both locations. Trust us—they’re lots of fun, you won’t want to miss out!',
          ],
        ],
        [
          'Accommodation',
          [
            'If you’re a student, you’ll be staying in the home of one of our friendly Adelaide choristers during the time that you’re not at camp. If you’re not a student, you will need to arrange your own accommodation. We can recommend St Ann’s College or Aquinas College, but you’re free to choose another place if you wish.',
            'If you are based in Adelaide, you may wish to help us out by hosting one of our lovely student registrants during the time they’re not at camp.',
            'Either way, our <a href="' .route('aivcfadelaide'). '">transport and billeting officer</a> is the person to talk to if you need help!',
          ],
        ],
      ]
    ];
    return view('public.index', $context);
  }
  public function about()
  {
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'about',
      'titletext' => 'About',
      'essay' => [
        [
          'History',
          [
            'Australian Intervarsity Choral Festivals first began in 1950 when the Sydney University Musical Society and Melbourne University Choral Society got together for a combined concert. This was widely regarded as a good move, and since then, festivals have been hosted by university choirs in every Australian state capital city and in Canberra.',
            'Adelaide’s university choirs hosted the 64th IV in 2013, and the Adelaide University Choral Society will again host the 70th IV during 10–20 January 2019. This is the seventieth festival overall, and the tenth in Adelaide—double anniversary!',
            'Most IV participants are current or former singers from university choirs around the country. However, we’re a friendly, welcoming bunch, so you’re very welcome to participate in IVs even if you’re not a member of a uni choral society. There are no auditions, and you don’t even have to be a uni student. How easy is that?',
          ],
        ],
        [
          'Experience',
          [
            'Any amount of experience with singing and reading music will certainly assist you with learning the repertoire for the concert more easily. However, IV is designed to be an immersive experience, and the idea is that we all start on an equal footing, and learn together. Additionally, a big part of our rehearsal structure involves <a href="' .route('public.choristers.camp'). '">camp</a>, which helps to really consolidate the learning process.',
            'IVs are incredibly fun, with an equal emphasis on intensive rehearsals, producing a high-quality concert that we can be proud to be a part of, and enjoyable <a href="' .route('public.choristers.social'). '">social activities</a> that will ensure you make lifelong friendships. You’ll meet experienced choristers, nervous freshers, and lots of people in between, and we all come together to create something beautiful, and have a lot of fun doing it.',
            'Music and good times—what more could a chorister ask for?',
          ]
        ]
      ]
    ];
    return view('public.index', $context);
  }
  public function frontpage()
  {
    # To redirect the home page to the event page:
#    return redirect()->route('adelaideiv');
    # Or to have an independent home page, comment the above
/*
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'home',
      'titletext' => 'Adelaide IV 2019',
      'text1' => [
        'The 70th AIVCF will take place in Adelaide in 2019.',
        'Out of courtesy to the upcoming festivals (68th in Perth 2017, 69th in Melbourne 2018), we won’t have any news until Melbourne 2018 has begun. Festival details will be revealed in 2018.',
      ]
    ];
*/
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'welcome',
//      'titletext' => 'Festival concert: Northern lights',
      'titletext' => 'Welcome',
      'essay' => [
        [
          '',
          /*
          [
            'AIVCF Adelaide presents the 2019 festival concert ‘Northern lights’ on Saturday, 19 January 2019.',
            'This concert presents works by incredible Scandinavian and Baltic composers Pärt, Gjeilo, Ešenvalds and Sandström, as well as Whitacre, Dove and Lauridsen.',
            'Of particular highlight is the wonderful <em>Magnificat</em> by Kim André Arnesen, a talented young Norwegian composer. A recording of <em>Magnificat</em> in Nidaros Cathedral was nominated for a Grammy Award in 2016, and we are excited to feature the Australian première of this spine-tingling work.',
            'The festival choir, comprising members from university choirs across Australia as well as the wider Australian choral community and even internationally, is directed by Peter Kelsall and incorporates the newly restored organ at St Peter’s Cathedral.',
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/concert">Read more</a>',
          ]
          */
          [
            'We’d like to invite you to participate in the 70th Australian Intervarsity Choral Festival, to be held in January 2019 in Adelaide!',
            'We’ve been hard at work hand-crafting a solid gold festival for all of you, as befits a big anniversary year. We hope it will be filled with fun, friendship, good times, and of course—music!',
            'The theme of our festival is the Northern Lights. This is reflected in both our <a href="' .route('public.concert'). '">music</a> and our <a href="' .route('public.choristers.social'). '">social events</a>, and we encourage you to get into the celestial spirit!',
            'We’ve got some amazing repertoire planned, featuring lots of wonderful modern choral music, and including an Australian première performance of a major work—the Norwegian composer Kim Arnesen’s Grammy-nominated <em>Magnificat</em>. We will be working with some excellent musicians, and performing in a beautiful venue.',
            'But that’s not all—we have a full calendar of fun social activities in the works, from casual pub nights all the way up to the dazzling academic dinner. We’ll also be holding a rehearsal camp with lots of fun events that we know you’ll love being a part of.',
            'Please read through our website for details—in particular, please check out our bulletin sheets. Feel free to <a href="' .route('contact'). '">get in touch with us</a> if you have any questions.',
            'It’s a pleasure to invite you to join us in Adelaide, and we look forward to meeting you next January!',
          ]
        ]
      ]
    ];
    return view('public.index', $context);
  }
  public function concert()
  {
    $context = [
      'useimagesource' => True,
//      'imagesource' => '/style/css/images/pkelsallyorkminster-960x640.jpg',
      'activetab' => 'concert',
      'titletext' => 'Festival concert: Northern lights',
      'essay' => [
        [
          'Repertoire',
          [
            'Northern Lights presents works by incredible Scandinavian and Baltic composers Arvo Pärt, Ēriks Ešenvalds, Jan Sandström and Ola Gjeilo, as well as works by Eric Whitacre, Morten Lauridsen, and Jonathan Dove.',
            'The major work of the concert is the wonderful <em>Magnificat</em> by Kim André Arnesen, a talented young Norwegian composer. A recording of <em>Magnificat</em> in Nidaros Cathedral was nominated for a Grammy Award in 2016, and we are excited to feature the Australian première of this spine-tingling work.',
            'We’ll also be performing Pärt’s <em>Magnificat</em>, a work of sublime purity and austerity. Ešenvalds’ warm, glittering <em>Stars</em> captures the beauty of the composer’s native Latvian skies, while Gjeilo’s <em>Northern Lights</em> evokes a sense of fear and awe for Norway’s winter. Sandström’s radiant, mystical arrangement of <em>Es ist ein Ros’ entsprungen</em> is a modern choral masterpiece. <em>Seek Him That Maketh the Seven Stars</em> is Dove’s joyous setting of Amos 5:8 and Psalm 139, complemented by a sparkling, complex organ part. ‘Soneto de la Noche’ and ‘Sure on this Shining Night’ from Lauridsen’s much-loved <em>Nocturnes</em> make their festival reappearance. Finally, <em>Seal Lullaby</em>, featuring Whitacre’s signature use of soaring, soothing harmonies, transports us to a ‘slow-swinging sea’ under a northern sky, where a baby seal is sung to sleep by its mother.',
            'These beautiful, lush pieces will be performed in the warm acoustic of St Peter’s Cathedral, one of Adelaide’s best classical music venues, accompanied by the newly-restored cathedral organ.',
          ]
        ],
        [
          'Musical director',
          [
            'We are thrilled to introduce Peter Kelsall as the festival’s musical director.',
            'Peter Kelsall completed his Bachelor of Music degree in 1989 at Adelaide University studying piano with Zelda Bock. He commenced organ studies with Christa Rumsey in 1987 and completed a Graduate Diploma in Performance on the instrument in 1993. In 1998 he completed his Masters Degree in Music Theory. He also holds a Certificate in Church Music from the Flinders Street School of Music TAFE and has undertaken studies in choral conducting with Carl Crossin.',
            'As an organist Peter has given recitals in the Adelaide Town Hall, St. Peter’s Cathedral, Pilgrim Church and at various locations for the Organ Music Society of Adelaide for which he was a committee member for a number of years. He has played with the Adelaide Symphony Orchestra on many occasions, including performances of Saint Saens’ ‘Organ’ Symphony, Holst’s <em>Planets</em>, Handel’s <em>Messiah</em>, Mahler’s Symphony no. 2 and the 2010 Adelaide Festival performances of Ligeti’s opera <em>Le Grande Macabre</em> and Mahler’s Symphony no. 8. He has also played on a number of occasions with the Adelaide Art Orchestra.',
            'Peter has performed with many Adelaide choirs, including the Adelaide Chamber Singers, Syntony, Adelaide Philharmonia Chorus, Graduate Singers, Corinthian Singers, Elder Conservatorium Chorale and the Adelaide and Flinders Universities Choral Societies.',
            'In 1995 he was appointed Organist and Choir Director at Pilgrim Uniting Church in the city where he continues to build on this church’s strong musical tradition. Pilgrim has recently developed a tradition of ‘importing’ some of the world’s best organists to Adelaide to play for services and to give recitals on the church’s organ (South Australia’s largest). As a result of this initiative Peter has had the opportunity in recent years to work with highly distinguished organists including Thomas Trotter, David Goode, Benjamin Bayl, Clive Driskill-Smith, Simon Preston, John Scott and Daniel Roth.',
            'In December 2017 and January 2018 Peter directed the Choirs of Pilgrim Church and Christ Church North Adelaide on their English Cathedrals Tour. The Choirs sang Evensongs in some 10 English cathedrals, including Lincoln, Durham, Salisbury, Gloucester and York Minster.',
            'An honorary life member of the Adelaide University Choral Society, he has been their Musical Director since 1997. With AUCS he has conducted a wide range of repertoire, from Palestrina to Pink Floyd and most things in between.',
            'Peter is in demand as an accompanist and has been associated with a number of choirs in this capacity. He is also a piano, organ, and music theory teacher and works as an accompanist and music tutor at Walford School.',
          ]
        ],
      ],
    ];
    return view('public.index', $context);
  }
  public function adelaideiv()
  {
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'about',
      'titletext' => 'About Adelaide IV',
      'essay' => [
        [
          'Adelaide IV 2019',
          [
            '2019 sees the 70th IV, hosted in Adelaide by Adelaide University Choral Society (AUCS). Choristers from all over Adelaide and wider Australia will be in Adelaide for the 70th anniversary festival, a brilliant opportunity for amateurs and professionals. Daily routine includes a mixture of rehearsals and sectionals as well as social activities culminating with a grand concert for the Adelaide audience.',
            'AIVCF Adelaide acknowledges that Adelaide IV is being held on the traditional lands of the Kaurna people; we pay respect to the elders of the community and extend our recognition to their descendants.',
          ]
        ],
        [
          'History',
          [
            'Intervarsity choral festivals (IVs) have been an annual event since 1950 when the Melbourne University Choral Society travelled to Sydney to present a combined concert with the Sydney University Musical Society. IVs quickly expanded to include other university choirs and are now hosted in many cities across Australia with participation drawing from the wider choral community in Australia and occasionally overseas.',
          ]
        ],
        [
          'Recent IVs and previous Adelaide IVs',
          [
            'The 2018 festival, held in Melbourne, presented ‘Light the dark’, conducted by Patrick Burns, a programme including <em>Toward the unknown region</em> (Vaughan Williams), <em>Alto rhapsody</em> (Brahms), <em>I was glad</em> (Parry) and <em>Light of life</em> (Elgar). This was in association with Melbourne Opera and supported by the Elgar Society.',
            'Christie Anderson conducted the 2013 festival concert in Adelaide, featuring Rachmaninoff’s <em>All-night vigil</em> and other works by contemporary Australian and international composers exploring the theme of light: ‘Morning fanfare’ from <em>The true samaritan</em> (Butterley), <em>Lux aurumque</em> (Whitacre), <em>We beheld once again the stars</em> (Stroope), <em>O nata lux</em> (Lauridsen).',
            'Adelaide IV in 2006 held two concerts with the Adelaide Art Orchestra. The first conducted by Timothy Sexton: <em>Missa criolla</em> (Ramírez), <em>Missa luba</em> (Haazen) and <em>African sanctus</em> (Fanshawe). The second conducted by Graham Abbott: <em>Israel in Egypt</em> (Handel).'
          ]
        ],
      ],
    ];
    return view('public.index', $context);
  }
  public function aivcfadelaide()
  {
    function committeeperson($Name,$Subtitle,$Email,$hasPhoto = True,$Plural = False)
    {
      $out = '
        <li class="mdl-list__item mdl-list__item--three-line">
          <span class="mdl-list__item-primary-content">';
      if($hasPhoto)
      {
        $out .= '<img class="mdl-list__item-avatar" src="/documents/photographs/committee/' . $Email . '.jpg">';
      }
      else
      {
        $out .= '<i class="material-icons mdl-list__item-avatar">' . ($Plural ? 'people' : 'person') . '</i>';
      }
      $out .='<span>' . $Name . '</span>
            <span class="mdl-list__item-text-body">' . $Subtitle . '<br>' . $Email . '@aiv.org.au</span>
          </span>
        </li>';
      return $out;
    }
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'committee',
      'titletext' => 'AIVCF Adelaide',
      'essay' => [
        [
          '',
          [
            'The 70th Australian Intervarsity Choral Festival is presented by AIVCF Adelaide in 2019. The organisation was elected by the members of Adelaide University Choral Society (AUCS).',
            'We represent the Adelaide contingent of a wider choral community across Australia with combined membership of over a thousand nationally in the Australian Intervarsity Choral Societies Association (AICSA).',
            'AIVCF Adelaide acknowledges that Adelaide IV is being held on the traditional lands of the Kaurna people; we pay respect to the elders of the community and extend our recognition to their descendants.',
          ]
        ],
        [
          'Committee',
          [
            '<ul class="demo-list-two mdl-list">'
            . committeeperson('Riana Chakravarti','Convenor','riana')
            . committeeperson('Andrew Moschou','Treasurer','andrew')
            . committeeperson('David Shields','Secretary','david')
            . committeeperson('Phoebe Knight','Concert manager','phoebe')
            . committeeperson('Waseem Kamleh','Librarian','waseem')
            . committeeperson('Timothy Sheehan','Camp officer','tim')
            . committeeperson('Genevieve Spalding','Publicity officer','eve')
            . committeeperson('Emily Filmer','Grants and merchandise officer','emily')
            . committeeperson('Alistair Knight','Transport and billeting officer','alistair')
            . committeeperson('Simone Corletto','Social secretary','simone')
            . committeeperson('Greg Read','General assistant','greg',False)
            . '</ul>'
          ]
        ]
      ]
    ];
    return view('public.index', $context);
  }
  public function participate()
  {
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'participate',
      'titletext' => 'Participate',
      'essay' => [
        [
          'Participate',
          [
            'You can register for AIV using the form at <a href="' .route('home'). '">www.aiv.org.au/home</a>.',
            'This is also the place to go if you wish to order merchandise, host interstate student choristers, or attend our social events.',
          ]
        ],
      ]
    ];
    return view('public.index', $context);
  }
  public function participatefundraising()
  {
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'participate',
      'titletext' => 'Past fundraising events',
      'essay' => [
        [
          '',
          [
            '<ul>
               <li>Rogue One: A Star Wars Story<br />
                   16&nbsp;December&nbsp;2016; Capri Theatre, Goodwood.</li>
               <li>Absolutely Fabulous: The Movie<br />
                   13&nbsp;August&nbsp;2016; Capri Theatre, Goodwood.</li>
             </ul>',
           ]
        ]
      ]
    ];
    return view('public.index', $context);
  }
  public function participatechoir()
  {
    function tablecell($str = '',$class = NULL,$head = False)
    {
      $tdorth = $head ? 'th' : 'td' ;
      if($class === 'hilite')
      {
        $classstr = ' class="mdl-color-text--primary"';
      }
      else
      {
        $classstr = $class === NULL ? '' : " class=\"{$class}\"";
      }
      return "<{$tdorth}{$classstr}>{$str}</{$tdorth}>";;
    }
    $ttstudent = 'Enrolled full time at an Australian University during Semester Two 2018 or Semester One 2019 (or equivalent)';
    $ttyouth = 'Born on or after 10 January 1989';
    $ttstudent = ' <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored material-icons" id="ttstudent">info</button><div class="mdl-tooltip mdl-tooltip--large" for="ttstudent">' . $ttstudent. '</div>';
    $ttyouth = ' <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored material-icons" id="ttyouth">info</button><div class="mdl-tooltip mdl-tooltip--large" for="ttyouth">' . $ttyouth. '</div>';
    $feesarraylocal = [
      '<table><tbody>
      <tr>' . tablecell('Complete registration',NULL,TRUE) . tablecell('Early ','hilite',TRUE) . tablecell('Late',NULL,TRUE) . '</tr>
      <tr>' . tablecell('Pay a $50 deposit',NULL) . tablecell('by 16/09/2018','mdl-color-text--primary outertablecell') . tablecell('after 16/09/2018','outertablecell') . '</tr>
      <tr>' . tablecell('Students'.$ttstudent) . tablecell('$450','hilite') . tablecell('$500') . '</tr>
      <tr>' . tablecell('Youth'.$ttyouth)      . tablecell('$600','hilite') . tablecell('$650') . '</tr>
      <tr>' . tablecell('General') . tablecell('$700','hilite') . tablecell('$750') . '</tr>
      </tbody>
      <tfoot><tr><td colspan="4">
        <span class="mdl-typography--body-2 mdl-typography--body-2-color-contrast">First time singing at an IV?</span>
        <br>
        <span class="mdl-typography--headline">Take $100 off</span>
        </td></tr></tfoot>
      </table>',
      '<ul>
       <li>Any chorister who has never been a singing participant in an IV festival before can receive $100 the price of their registration, courtesy of the AICSA trust fund. Complete registration with a deposit made by 16/09/2018 becomes $350 for students, youth $500, general $600.</li>
       <li>Complete registration includes:<ul><li>Choral participation and camp</li><li>Academic dinner</li><li>Post concert party and farewell barbecue</li></ul></li>
       <li>Social registration is $150 and is available to those who don’t wish to sing in the concert, but want to attend social events including the academic dinner.</li>
       <li>Registration options will also be available for those who don’t wish to participate in the academic dinner and/or those who don’t wish to stay overnight at camp.</li>
       <li>Academic dinner tickets are normally bundled in the social component but can also be purchased separately at $130 each.</li>
       <li>Merchandise and concert tickets are sold separately.</li>
       </ul>',
    ];
    $feesarraynotready = [
      'We’re not yet ready to announce registration fees but we hope to do this very soon. Watch this space.'
    ];
    if(config('app.env') === 'local')
    {
      $feesarray = $feesarraylocal;
    }
    else
    {
      $feesarray = $feesarraynotready;
      $feesarray = $feesarraylocal;
    }
    $context = [
      'imagesource' => 'public/images/image-2.jpg',
      'activetab' => 'participate',
      'titletext' => 'Prospective choristers',
      'essay' => [
        [
          '',
          [
            'Choristers from all over Adelaide and wider Australia will be in Adelaide for the 70th anniversary festival. The 11 exciting days will be filled with music making and friendship forging by people who love choral music.',
            'Adelaide IV is a brilliant opportunity for amateur and professional singers to produce a concert to be rewarded with after more than a week of intensive rehearsals and to network with like-minded individuals. Daily routine includes a mixture of rehearsals and sectionals as well as social activities.',
//            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/choir/register">Sign up</a>',
          ],
        ],
        [
          'Fees',
          $feesarray
        ],
        [
          'News bulletins',
          [
            '<ul>
            <li><a href="/documents/newsbulletins/aurora-adelaideiv2019.pdf">AURORA edition: Introductory information for everyone</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news4.pdf">May 2018 edition: Pricing, important dates and Committee information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news3.pdf">April 2018 edition: Transport, billeting and accommodation information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news2.pdf">March 2018 edition: Repertoire and conductor information</a></li>
            <li><a href="/documents/newsbulletins/adelaideiv2019news1.pdf">January 2018 edition</a><br><small>Note: January 2018 edition contains some outdated information, please check more recent news or the website for current information.</small></li>
            </ul>',
          ],
        ],
        [
          'Dates',
          [
            'To take part on stage in the concert, you would need to be available for all rehearsals within the festival dates. And there are other events too.',
            '<dl class="mdl-components-dl">
               <dt class="mdl-components-dt">Festival</dt>
               <dd class="mdl-components-dd">Thursday to Sunday, 10 to 20 January 2019</dd>
               <dt class="mdl-components-dt">Camp</dt>
               <dd class="mdl-components-dd">Friday to Tuesday, 11 to 15 January 2019</dd>
               <dt class="mdl-components-dt">Academic dinner</dt>
               <dd class="mdl-components-dd">Wednesday, 16 January 2019</dd>
               <dt class="mdl-components-dt">Concert</dt>
               <dd class="mdl-components-dd">Saturday, 19 January 2019</dd>
             </dl>'
          ]
        ],
        [
          'Camp',
          [
            'Camp will be at Nunyara Conference Centre, in the Adelaide Hills, close to the city and with a majestic view of the city. Many of our rehearsals will be at camp, and we have the entire site reserved for us.',
            'Nunyara is only 20 minutes from the Adelaide city centre and close to train and bus routes, so if you choose to commute every day and not sleep in the dormitories or apartments on site, there are still plenty of options available for you.',
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="https://unitingvenuessa.org.au/nunyara/">Read about Nunyara</a>',
          ]
        ],
        [
          'Academic dinner',
          [
            'The academic dinner will be at Ayers House, on North Terrace in the city. We will be dining in the Conservatory.',
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="https://www.ayershouse.com">Read about Ayers House</a>',
          ]
        ],
      ]
    ];
    return view('public.index', $context);
  }
}
