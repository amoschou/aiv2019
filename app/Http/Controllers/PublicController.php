<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
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
      'activetab' => 'festival',
      'titletext' => 'Festival concert: Northern lights',
      'essay' => [
        [
          '',
          [
            'AIVCF Adelaide presents the 2019 festival concert ‘Northern lights’ on Saturday, 19 January 2019.',
            'This concert presents works by incredible Scandinavian and Baltic composers Pärt, Gjeilo, Ešenvalds and Sandström, as well as Whitacre, Dove and Lauridsen.',
            'Of particular highlight is the wonderful <em>Magnificat</em> by Kim André Arnesen, a talented young Norwegian composer. A recording of <em>Magnificat</em> in Nidaros Cathedral was nominated for a Grammy Award in 2016, and we are excited to feature the Australian première of this spine-tingling work.',
            'The festival choir, comprising members from university choirs across Australia as well as the wider Australian choral community and even internationally, is directed by Peter Kelsall and incorporates the newly restored organ at St Peter’s Cathedral.',
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/concert">Read more</a>',
          ]
        ]
      ]
    ];
    return view('public.frontpage', $context);
  }
  public function concert()
  {
    $context = [
      'useimagesource' => True,
      'imagesource' => '/style/css/images/pkelsallyorkminster-960x640.jpg',
      'activetab' => 'festival',
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
      'activetab' => 'event',
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
    function committeeperson($Name,$Subtitle,$Plural = False)
    {
      $out = '
        <li class="mdl-list__item mdl-list__item--two-line">
          <span class="mdl-list__item-primary-content">
            <i class="material-icons mdl-list__item-avatar">' . ($Plural ? 'people' : 'person') . '</i>
            <span>' . $Name . '</span>
            <span class="mdl-list__item-sub-title">' . $Subtitle . '</span>
          </span>
        </li>';
      return $out;
    }
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'organisation',
      'titletext' => 'AIVCF Adelaide',
      'essay' => [
        [
          '',
          [
            'The 70th Australian Intervarsity Choral Festival is presented by AIVCF Adelaide in 2019. The organisation was elected by the members of Adelaide University Choral Society (AUCS).',
            'We represent the Adelaide contingent of a wider choral community across Australia with combined membership of over a thousand nationally in the Australian Intervarsity Choral Societies Association (AICSA).',
          ]
        ],
        [
          'Committee',
          [
            '<ul class="demo-list-two mdl-list">'
            . committeeperson('Riana Chakravarti','Convenor')
            . committeeperson('Andrew Moschou','Treasurer')
            . committeeperson('David Shields','Secretary')
            . committeeperson('Phoebe Knight','Concert manager')
            . committeeperson('Waseem Kamleh','Librarian')
            . committeeperson('Timothy Sheehan','Camp officer')
            . committeeperson('Genevie Spalding','Publicity officer')
            . committeeperson('Emily Filmer','Corporate sponsorship officer')
            . committeeperson('Alistair Knight','Transport and billeting officer')
            . committeeperson('Simone Corletto and Brittany Radcliffe','Social secretaries',True)
            . committeeperson('Greg Read and Sean Tanner','General assistants',True)
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
          'Prospective choristers',
          [
            'Choristers from across the country and Adelaide are invited to take part on stage and for other festival events.',
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/choir">Read more</a>&emsp;<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/choir/register">Sign up</a>',
          ]
        ],
        [
          'Connect',
          [
            'There are a number of other ways to participate in this festival:',
            '<ul>
               <li><a href="/participate/fundraising">Join us at our fundraising or social events.</a></li>
               <li><a href="/payments/checkout">Donate to AIVCF Adelaide.</a></li>
               <li><a href="/contact">Join the committee.</a></li>
             </ul>',
            'In 2018, we will reveal how to:',
            '<ul>
               <li>Join the Australian Intervarsity Festival Choir and perform on stage.</li>
               <li>Purchase concert tickets and see us perform.</li>
               <li>Purchase other merchandise.</li>
               <li>Host choristers at your home during their stay in Adelaide.</li>
             </ul>'
          ]
        ]
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
    if(config('app.env') === 'local')
    {
      $feesarray = [
        'This section is not displayed online.',
        '<table><tbody>
        <tr>' . tablecell('',NULL,TRUE) . tablecell('Full experience','hilite',TRUE) . tablecell('Choral component',NULL,TRUE)             . tablecell('Social component',NULL,TRUE)                        . '</tr>
        <tr>' . tablecell('',NULL,TRUE) . tablecell('<small>Includes all components</small>','hilite',TRUE)  . tablecell('<small>Includes camp</small>',NULL,TRUE) . tablecell('<small>Includes academic dinner</small>',NULL,TRUE) . '</tr>
        <tr>' . tablecell('Students'.$ttstudent) . tablecell('$480','hilite') . tablecell('$359') . tablecell('$121') . '</tr>
        <tr>' . tablecell('Youth'.$ttyouth)      . tablecell('$530','hilite') . tablecell('$404') . tablecell('$126') . '</tr>
        <tr>' . tablecell('Full fee payers')     . tablecell('$580','hilite') . tablecell('$449') . tablecell('$131') . '</tr>
        </tbody>
        <tfoot><tr><td colspan="4">
          <span class="mdl-typography--body-2 mdl-typography--body-2-color-contrast">First time singing at an IV?</span>
          <br>
          <span class="mdl-typography--headline">Take $100 off</span>
          </td></tr></tfoot>
        </table>',
        '<ul>
         <li>Any chorister who has never been a singing participant in an IV festival before can receive $100 the price of their registration. Full registration becomes $380 for students (or $259 choral only), youth $430 (or $304), full fee payers $480 (or $349).</li>
         <li>Accommodation is included in camp. Choristers choosing to stay elsewhere will pay a rate that excludes the cost of accommodation.</li>
         <li>Academic dinner tickets are normally bundled in the social component but can also be purchased separately at $120 each.</li>
         <li>Merchandise and concert tickets are sold separately.</li>
         </ul>',
      ];
    }
    else
    {
      $feesarray = [
        'We’re not yet ready to announce registration fees but we hope to do this very soon. Watch this space.'
      ];
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
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/choir/register">Sign up</a>',
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
