<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
  public function home()
  {
    # To redirect the home page to the event page:
    return redirect()->route('adelaideiv');
    # Or to have an independent home page, comment the above
    $context = [
      'imagesource' => 'public/images/image-1.jpg',
      'activetab' => 'home',
      'titletext' => 'Adelaide IV 2019',
      'text1' => [
        'The 70th AIVCF will take place in Adelaide in 2019.',
        'Out of courtesy to the upcoming festivals (68th in Perth 2017, 69th in Melbourne 2018), we won’t have any news until Melbourne 2018 has begun. Festival details will be revealed in 2018.',
      ]
    ];
    return view('index', $context);
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
    return view('home', $context);
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
            . committeeperson('Emily Filmer','Corporate sponsorship officer')
            . committeeperson('Simone Corletto and Brittany Radcliffe','Social secretaries',True)
            . committeeperson('Greg Read and Sean Tanner','General assistants',True)
            . '</ul>'
          ]
        ]
      ]
    ];
    return view('index', $context);
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
    return view('index', $context);
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
    return view('index', $context);
  }
  public function participatechoir()
  {
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
            '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/choir/register">Sign up</a>&emsp;<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="/participate/informationforregistrants">Information for registrants</a>',
            '<h5>News bulletins</h5><ul><li><a href="/documents/newsbulletins/aiv2019sheet1.pdf">Sheet 1</a></li></ul>',
          ]
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
    return view('index', $context);
  }
}



