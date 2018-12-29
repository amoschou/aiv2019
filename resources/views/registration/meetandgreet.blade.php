@extends('registration.layouts.app')

@section('content')
<div class="container">

  <p>Meet and greet</p>
  
  
  
    
    @php
      $BuyString = '****';
      $BringString = '----';
      $ScoreNames = [
        'arnesen' => ['Arnesen', 'Magnificat'],
        'dove' => ['Dove', 'Seek him that maketh the seven stars'],
        'esenvalds' => ['Ešenvalds', 'Stars'],
        'gjeilo' => ['Gjeilo', 'Northern lights'],
        'lauridsenii' => ['Lauridsen', 'Soneto de la noche'],
        'lauridseniii' => ['Lauridsen', 'Sure on this shining night'],
        'part' => ['Pärt', 'Magnificat'],
        'sandstrom' => ['Sandström', 'Es ist in Ros entsprungen'],
        'whitacre' => ['Whitacre', 'The seal lullaby'],
      ];
      $ScoreListArray = [
        57 => ['arnesen' => 'au1', 'dove' => 'pA1', 'esenvalds' => 'cm2', 'gjeilo' => 'qu1', 'lauridsenii' => 'pu1', 'lauridseniii' => 'pu1', 'part' => 'sp1', 'sandstrom' => 'oc1', 'whitacre' => 'nu1'],
        103 => ['arnesen' => 'au2', 'dove' => 'pA2', 'esenvalds' => 'cm3', 'gjeilo' => 'qu2', 'lauridsenii' => 'pu2', 'lauridseniii' => 'pu2', 'part' => 'sp2', 'sandstrom' => 'oc2', 'whitacre' => 'nu2'],
        106 => ['arnesen' => 'au3', 'dove' => 'pA3', 'esenvalds' => 'cm4', 'gjeilo' => 'qu3', 'lauridsenii' => 'pu3', 'lauridseniii' => 'pu3', 'part' => 'sp3', 'sandstrom' => 'oc3', 'whitacre' => 'nu3'],
        43 => ['arnesen' => 'au4', 'dove' => 'pA4', 'esenvalds' => 'cm5', 'gjeilo' => 'qu4', 'lauridsenii' => 'pu4', 'lauridseniii' => 'pu4', 'part' => 'sp4', 'sandstrom' => 'oc4', 'whitacre' => '****'],
        68 => ['arnesen' => 'au5', 'dove' => 'pA5', 'esenvalds' => 'cm6', 'gjeilo' => 'qu5', 'lauridsenii' => 'pu5', 'lauridseniii' => 'pu5', 'part' => 'sp5', 'sandstrom' => 'oc5', 'whitacre' => 'nu4'],
        83 => ['arnesen' => 'au6', 'dove' => 'pA6', 'esenvalds' => 'cm7', 'gjeilo' => 'qu6', 'lauridsenii' => 'pu6', 'lauridseniii' => 'pu6', 'part' => 'sp6', 'sandstrom' => 'oc6', 'whitacre' => 'nu5'],
        44 => ['arnesen' => 'au7', 'dove' => 'pA7', 'esenvalds' => 'cm8', 'gjeilo' => '****', 'lauridsenii' => 'pu7', 'lauridseniii' => 'pu7', 'part' => 'sp7', 'sandstrom' => 'oc7', 'whitacre' => '****'],
        3 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '----', 'gjeilo' => '****', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '----'],
        66 => ['arnesen' => 'au8', 'dove' => 'pA8', 'esenvalds' => 'cm9', 'gjeilo' => 'qu7', 'lauridsenii' => 'pu8', 'lauridseniii' => 'pu8', 'part' => 'sp8', 'sandstrom' => 'oc8', 'whitacre' => 'nu6'],
        143 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        34 => ['arnesen' => 'au9', 'dove' => 'pA9', 'esenvalds' => 'cm10', 'gjeilo' => 'qu8', 'lauridsenii' => 'pu9', 'lauridseniii' => 'pu9', 'part' => 'sp9', 'sandstrom' => 'oc9', 'whitacre' => 'nu7'],
        52 => ['arnesen' => 'au10', 'dove' => 'pA10', 'esenvalds' => 'cm11', 'gjeilo' => 'qu9', 'lauridsenii' => 'pu10', 'lauridseniii' => 'pu10', 'part' => 'sp10', 'sandstrom' => 'oc10', 'whitacre' => 'nu8'],
        88 => ['arnesen' => '****', 'dove' => 'pA11', 'esenvalds' => 'cm12', 'gjeilo' => 'qu10', 'lauridsenii' => 'pu12', 'lauridseniii' => 'pu12', 'part' => 'sp11', 'sandstrom' => '****', 'whitacre' => 'nu9'],
        13 => ['arnesen' => 'au11', 'dove' => 'pA12', 'esenvalds' => 'cm13', 'gjeilo' => 'qu11', 'lauridsenii' => 'pu13', 'lauridseniii' => 'pu13', 'part' => 'sp12', 'sandstrom' => 'oc11', 'whitacre' => 'nu10'],
        4 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '----', 'gjeilo' => '****', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '----'],
        42 => ['arnesen' => 'au12', 'dove' => 'pA13', 'esenvalds' => 'cm14', 'gjeilo' => 'qu12', 'lauridsenii' => 'pu14', 'lauridseniii' => 'pu14', 'part' => 'sp13', 'sandstrom' => 'oc12', 'whitacre' => 'nu11'],
        92 => ['arnesen' => 'au13', 'dove' => 'pA14', 'esenvalds' => 'cm15', 'gjeilo' => 'qu13', 'lauridsenii' => 'pu16', 'lauridseniii' => 'pu15', 'part' => 'sp14', 'sandstrom' => 'oc13', 'whitacre' => 'nu12'],
        73 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        161 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        48 => ['arnesen' => 'au14', 'dove' => 'pA15', 'esenvalds' => 'cm16', 'gjeilo' => 'qu14', 'lauridsenii' => 'pu18', 'lauridseniii' => 'pu16', 'part' => 'sp15', 'sandstrom' => 'oc14', 'whitacre' => 'nu13'],
        65 => ['arnesen' => '****', 'dove' => 'pA16', 'esenvalds' => 'cm17', 'gjeilo' => 'qu15', 'lauridsenii' => 'pu19', 'lauridseniii' => 'pu18', 'part' => 'sp16', 'sandstrom' => '****', 'whitacre' => 'nu14'],
        51 => ['arnesen' => 'au15', 'dove' => 'pA17', 'esenvalds' => 'cm18', 'gjeilo' => 'qu16', 'lauridsenii' => 'pu21', 'lauridseniii' => 'pu19', 'part' => 'sp18', 'sandstrom' => 'oc15', 'whitacre' => 'nu15'],
        79 => ['arnesen' => 'au16', 'dove' => 'pA18', 'esenvalds' => 'cm19', 'gjeilo' => 'qu17', 'lauridsenii' => 'pu22', 'lauridseniii' => 'pu21', 'part' => 'sp19', 'sandstrom' => 'oc16', 'whitacre' => 'nu16'],
        1 => ['arnesen' => '****', 'dove' => 'pA19', 'esenvalds' => '----', 'gjeilo' => 'qu18', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '****', 'sandstrom' => 'oc17', 'whitacre' => '----'],
        84 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        8 => ['arnesen' => 'au17', 'dove' => 'pA20', 'esenvalds' => 'cm21', 'gjeilo' => 'qu19', 'lauridsenii' => 'pu23', 'lauridseniii' => 'pu22', 'part' => 'sp20', 'sandstrom' => 'oc18', 'whitacre' => 'nu17'],
        50 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '----', 'gjeilo' => '****', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '----'],
        77 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        97 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        165 => ['arnesen' => 'au18', 'dove' => 'pA21', 'esenvalds' => 'cm22', 'gjeilo' => 'qu20', 'lauridsenii' => 'pu25', 'lauridseniii' => 'pu23', 'part' => 'sp21', 'sandstrom' => 'oc19', 'whitacre' => 'nu18'],
        33 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        159 => ['arnesen' => 'au19', 'dove' => 'pA22', 'esenvalds' => 'cm23', 'gjeilo' => 'qu21', 'lauridsenii' => 'pu26', 'lauridseniii' => 'pu25', 'part' => 'sp22', 'sandstrom' => 'oc20', 'whitacre' => 'nu19'],
        108 => ['arnesen' => 'au20', 'dove' => 'pA23', 'esenvalds' => 'cm24', 'gjeilo' => 'qu22', 'lauridsenii' => 'pu27', 'lauridseniii' => 'pu26', 'part' => 'sp23', 'sandstrom' => 'oc21', 'whitacre' => 'nu20'],
        95 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => 'cm25', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => 'pu27', 'part' => 'sp24', 'sandstrom' => 'oc22', 'whitacre' => 'nu21'],
        174 => ['arnesen' => 'au21', 'dove' => 'pA24', 'esenvalds' => 'cm26', 'gjeilo' => 'qu23', 'lauridsenii' => 'pu28', 'lauridseniii' => 'pu28', 'part' => 'sp25', 'sandstrom' => 'oc23', 'whitacre' => 'nu22'],
        160 => ['arnesen' => 'au22', 'dove' => 'pA25', 'esenvalds' => 'cm27', 'gjeilo' => 'qu24', 'lauridsenii' => 'pu29', 'lauridseniii' => 'pu29', 'part' => 'sp26', 'sandstrom' => 'oc24', 'whitacre' => 'nu23'],
        86 => ['arnesen' => 'au23', 'dove' => 'pA26', 'esenvalds' => 'cm28', 'gjeilo' => 'qu25', 'lauridsenii' => 'pu30', 'lauridseniii' => 'pu30', 'part' => 'sp27', 'sandstrom' => 'oc25', 'whitacre' => 'nu24'],
        101 => ['arnesen' => 'au24', 'dove' => 'pA27', 'esenvalds' => 'cm29', 'gjeilo' => 'qu26', 'lauridsenii' => 'pu31', 'lauridseniii' => 'pu31', 'part' => 'sp28', 'sandstrom' => 'oc26', 'whitacre' => 'nu25'],
        58 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '----', 'sandstrom' => '****', 'whitacre' => '----'],
        15 => ['arnesen' => 'au25', 'dove' => 'pA28', 'esenvalds' => 'cm30', 'gjeilo' => 'qu27', 'lauridsenii' => 'pu32', 'lauridseniii' => 'pu32', 'part' => 'sp29', 'sandstrom' => 'oc27', 'whitacre' => 'nu26'],
        69 => ['arnesen' => 'au26', 'dove' => 'pA29', 'esenvalds' => 'cm36', 'gjeilo' => 'qu28', 'lauridsenii' => 'pu33', 'lauridseniii' => 'pu33', 'part' => 'sp30', 'sandstrom' => 'oc28', 'whitacre' => 'nu27'],
        151 => ['arnesen' => 'au27', 'dove' => 'pA30', 'esenvalds' => 'cm37', 'gjeilo' => 'qu29', 'lauridsenii' => 'pu34', 'lauridseniii' => 'pu34', 'part' => '****', 'sandstrom' => 'oc29', 'whitacre' => 'nu28'],
        2 => ['arnesen' => 'au28', 'dove' => 'pA31', 'esenvalds' => 'cm38', 'gjeilo' => 'qu30', 'lauridsenii' => 'pu36', 'lauridseniii' => 'pu36', 'part' => 'sp31', 'sandstrom' => 'oc30', 'whitacre' => 'nu29'],
        5 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        31 => ['arnesen' => 'au29', 'dove' => 'pA32', 'esenvalds' => 'cm39', 'gjeilo' => 'qu31', 'lauridsenii' => 'pu37', 'lauridseniii' => 'pu37', 'part' => '****', 'sandstrom' => 'oc31', 'whitacre' => 'nu30'],
        105 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        39 => ['arnesen' => 'au30', 'dove' => 'pA33', 'esenvalds' => 'cm40', 'gjeilo' => 'qu32', 'lauridsenii' => 'pu38', 'lauridseniii' => 'pu38', 'part' => 'sp32', 'sandstrom' => 'oc32', 'whitacre' => 'nu31'],
        117 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        49 => ['arnesen' => '****', 'dove' => 'au1', 'esenvalds' => 'wg1', 'gjeilo' => 'qu33', 'lauridsenii' => 'pu39', 'lauridseniii' => 'pu39', 'part' => 'sp33', 'sandstrom' => 'oc33', 'whitacre' => 'nu32'],
        81 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        32 => ['arnesen' => 'au31', 'dove' => 'au2', 'esenvalds' => 'wg2', 'gjeilo' => 'qu34', 'lauridsenii' => 'pu40', 'lauridseniii' => 'pu40', 'part' => 'sp34', 'sandstrom' => 'oc34', 'whitacre' => 'nu33'],
        72 => ['arnesen' => 'au32', 'dove' => 'au3', 'esenvalds' => 'wg4', 'gjeilo' => 'qu35', 'lauridsenii' => 'pu41', 'lauridseniii' => 'pu41', 'part' => 'sp35', 'sandstrom' => 'oc35', 'whitacre' => 'nu34'],
        172 => ['arnesen' => 'au33', 'dove' => 'au4', 'esenvalds' => 'wg5', 'gjeilo' => 'qu36', 'lauridsenii' => 'pu42', 'lauridseniii' => 'pu42', 'part' => 'tc1', 'sandstrom' => 'oc36', 'whitacre' => 'nu35'],
        11 => ['arnesen' => 'au34', 'dove' => 'au5', 'esenvalds' => 'wg6', 'gjeilo' => 'qu37', 'lauridsenii' => 'pu43', 'lauridseniii' => 'pu43', 'part' => 'tc2', 'sandstrom' => 'oc37', 'whitacre' => 'nu36'],
        82 => ['arnesen' => 'au35', 'dove' => 'au6', 'esenvalds' => 'wg7', 'gjeilo' => 'qu38', 'lauridsenii' => '****', 'lauridseniii' => 'pu44', 'part' => 'tc5', 'sandstrom' => 'oc38', 'whitacre' => 'nu37'],
        7 => ['arnesen' => '****', 'dove' => 'au7', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => 'pu44', 'lauridseniii' => 'pu45', 'part' => '****', 'sandstrom' => 'oc39', 'whitacre' => '****'],
        28 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        26 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        89 => ['arnesen' => 'au36', 'dove' => 'au8', 'esenvalds' => 'wg8', 'gjeilo' => 'qu39', 'lauridsenii' => 'pu45', 'lauridseniii' => 'pu46', 'part' => 'tc6', 'sandstrom' => 'oc40', 'whitacre' => 'nu38'],
        36 => ['arnesen' => 'au37', 'dove' => 'au9', 'esenvalds' => 'wg9', 'gjeilo' => 'qu40', 'lauridsenii' => 'pu46', 'lauridseniii' => 'pu47', 'part' => 'tc8', 'sandstrom' => 'wg1', 'whitacre' => 'nu39'],
        14 => ['arnesen' => 'au38', 'dove' => 'au10', 'esenvalds' => 'wg10', 'gjeilo' => 'qu41', 'lauridsenii' => 'pu47', 'lauridseniii' => 'pu48', 'part' => 'tc9', 'sandstrom' => 'wg2', 'whitacre' => 'nu40'],
        53 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '----', 'sandstrom' => '****', 'whitacre' => '****'],
        67 => ['arnesen' => 'au39', 'dove' => 'au11', 'esenvalds' => '****', 'gjeilo' => '----', 'lauridsenii' => 'pu48', 'lauridseniii' => 'pu49', 'part' => 'tc10', 'sandstrom' => 'wg3', 'whitacre' => '****'],
        38 => ['arnesen' => '****', 'dove' => 'au12', 'esenvalds' => 'wg11', 'gjeilo' => '****', 'lauridsenii' => 'pu49', 'lauridseniii' => 'pu50', 'part' => '****', 'sandstrom' => 'wg4', 'whitacre' => '****'],
        87 => ['arnesen' => 'au40', 'dove' => 'au13', 'esenvalds' => 'wg12', 'gjeilo' => 'qu42', 'lauridsenii' => 'pu50', 'lauridseniii' => 'pu52', 'part' => 'tc11', 'sandstrom' => 'wg5', 'whitacre' => 'nu41'],
        24 => ['arnesen' => 'au41', 'dove' => 'au14', 'esenvalds' => 'wg13', 'gjeilo' => 'qu43', 'lauridsenii' => 'pu52', 'lauridseniii' => 'pu53', 'part' => 'tc12', 'sandstrom' => 'wg6', 'whitacre' => 'nu42'],
        99 => ['arnesen' => 'au42', 'dove' => 'au15', 'esenvalds' => 'wg14', 'gjeilo' => 'qu44', 'lauridsenii' => 'pu53', 'lauridseniii' => 'pu54', 'part' => 'tc13', 'sandstrom' => 'wg7', 'whitacre' => 'nu43'],
        111 => ['arnesen' => 'au43', 'dove' => 'au16', 'esenvalds' => 'wg15', 'gjeilo' => 'qu45', 'lauridsenii' => 'pu54', 'lauridseniii' => 'pu55', 'part' => 'tc14', 'sandstrom' => 'wg8', 'whitacre' => 'nu44'],
        155 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        60 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        59 => ['arnesen' => 'au44', 'dove' => 'au17', 'esenvalds' => 'wg16', 'gjeilo' => 'qu46', 'lauridsenii' => 'pu55', 'lauridseniii' => 'pu57', 'part' => 'tc18', 'sandstrom' => 'wg9', 'whitacre' => 'nu45'],
        18 => ['arnesen' => 'au45', 'dove' => 'au18', 'esenvalds' => 'wg17', 'gjeilo' => 'qu47', 'lauridsenii' => 'pu57', 'lauridseniii' => 'pu58', 'part' => 'tc20', 'sandstrom' => 'wg10', 'whitacre' => 'nu46'],
        29 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        41 => ['arnesen' => 'au46', 'dove' => 'au19', 'esenvalds' => 'wg18', 'gjeilo' => 'qu48', 'lauridsenii' => 'pu58', 'lauridseniii' => 'pu60', 'part' => 'tc21', 'sandstrom' => 'wg11', 'whitacre' => 'nu47'],
        115 => ['arnesen' => 'au47', 'dove' => 'au20', 'esenvalds' => 'wg19', 'gjeilo' => 'qu49', 'lauridsenii' => 'pu60', 'lauridseniii' => 'wg1', 'part' => 'tc22', 'sandstrom' => 'wg12', 'whitacre' => 'nu48'],
        54 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        63 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        6 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        19 => ['arnesen' => 'au48', 'dove' => 'au21', 'esenvalds' => 'wg20', 'gjeilo' => 'qu50', 'lauridsenii' => 'gv1', 'lauridseniii' => 'wg2', 'part' => 'tc24', 'sandstrom' => 'wg13', 'whitacre' => 'nu49'],
        30 => ['arnesen' => 'au49', 'dove' => 'au22', 'esenvalds' => 'wg21', 'gjeilo' => 'qu51', 'lauridsenii' => 'gv2', 'lauridseniii' => 'wg4', 'part' => 'tc26', 'sandstrom' => 'wg14', 'whitacre' => 'nu50'],
        109 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        94 => ['arnesen' => 'au50', 'dove' => 'au23', 'esenvalds' => 'wg22', 'gjeilo' => 'qu52', 'lauridsenii' => 'gv3', 'lauridseniii' => 'wg5', 'part' => 'tc29', 'sandstrom' => 'wg15', 'whitacre' => 'nu51'],
        162 => ['arnesen' => 'au51', 'dove' => 'au24', 'esenvalds' => 'wg23', 'gjeilo' => 'qu53', 'lauridsenii' => 'gv4', 'lauridseniii' => 'wg6', 'part' => 'tc30', 'sandstrom' => 'wg16', 'whitacre' => 'nu52'],
        56 => ['arnesen' => 'au52', 'dove' => 'au25', 'esenvalds' => 'wg24', 'gjeilo' => 'qu54', 'lauridsenii' => 'gv5', 'lauridseniii' => 'wg7', 'part' => 'tc31', 'sandstrom' => 'wg17', 'whitacre' => 'nu53'],
        104 => ['arnesen' => 'au53', 'dove' => 'au26', 'esenvalds' => 'wg25', 'gjeilo' => 'qu55', 'lauridsenii' => 'gv6', 'lauridseniii' => 'wg8', 'part' => 'tc32', 'sandstrom' => 'wg18', 'whitacre' => 'nu54'],
        107 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        62 => ['arnesen' => 'au54', 'dove' => 'au27', 'esenvalds' => 'wg26', 'gjeilo' => 'qu56', 'lauridsenii' => 'gv7', 'lauridseniii' => 'wg9', 'part' => 'tc33', 'sandstrom' => 'wg19', 'whitacre' => 'nu55'],
        98 => ['arnesen' => 'au55', 'dove' => 'au28', 'esenvalds' => 'wg27', 'gjeilo' => 'qu57', 'lauridsenii' => 'gv8', 'lauridseniii' => 'wg10', 'part' => 'tc34', 'sandstrom' => 'wg20', 'whitacre' => 'nu56'],
        93 => ['arnesen' => 'au56', 'dove' => 'au29', 'esenvalds' => 'wg29', 'gjeilo' => 'qu58', 'lauridsenii' => 'gv9', 'lauridseniii' => 'wg11', 'part' => 'tc35', 'sandstrom' => 'wg21', 'whitacre' => 'nu57'],
        100 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        90 => ['arnesen' => 'au57', 'dove' => 'au30', 'esenvalds' => 'wg30', 'gjeilo' => 'qu59', 'lauridsenii' => 'gv10', 'lauridseniii' => 'wg12', 'part' => 'tc37', 'sandstrom' => 'wg22', 'whitacre' => 'nu58'],
        22 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        158 => ['arnesen' => 'au58', 'dove' => 'pA34', 'esenvalds' => 'wg31', 'gjeilo' => 'qu60', 'lauridsenii' => 'gv11', 'lauridseniii' => 'wg13', 'part' => 'tc38', 'sandstrom' => 'wg23', 'whitacre' => 'nu59'],
        157 => ['arnesen' => 'au59', 'dove' => 'pA35', 'esenvalds' => 'wg32', 'gjeilo' => 'pu1', 'lauridsenii' => 'gv12', 'lauridseniii' => 'wg14', 'part' => 'tc40', 'sandstrom' => 'wg24', 'whitacre' => 'nu60'],
        113 => ['arnesen' => 'au60', 'dove' => 'pA36', 'esenvalds' => 'wg33', 'gjeilo' => 'pu2', 'lauridsenii' => 'gv13', 'lauridseniii' => '----', 'part' => '----', 'sandstrom' => 'wg25', 'whitacre' => 'nu61'],
        700 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '****', 'gjeilo' => '****', 'lauridsenii' => '****', 'lauridseniii' => '****', 'part' => '****', 'sandstrom' => '****', 'whitacre' => '****'],
        701 => ['arnesen' => '****', 'dove' => '****', 'esenvalds' => '----', 'gjeilo' => '----', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '----', 'sandstrom' => '----', 'whitacre' => '----'],
        702 => ['arnesen' => '****', 'dove' => '----', 'esenvalds' => '----', 'gjeilo' => '----', 'lauridsenii' => '----', 'lauridseniii' => '----', 'part' => '****', 'sandstrom' => '----', 'whitacre' => '----']
      ];
    @endphp


  @php
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
      function centstodollarsandcents($a) {
        $hundredths = $a % 10;
        $a = (int) ($a - $hundredths)/10;
        $tenths = $a % 10;
        $a = (int) ($a - $tenths)/10;
        return '$' . $a . '.' . $tenths . $hundredths ;
      }
    $authenticatedusersemail = DB::table('iv_users')->select('email')->where('id',Auth::id())->first()->email;
  @endphp
  @php
    $numpages = $getnumpages;
    $newpeople = [];
    foreach($people as $person)
    {
      if($person->id % $numpages === (int) $getpeoplelist)
      {
        $newpeople[] = $person;
      }
    }
    if($newpeople !== [])
    {
      $people = $newpeople;
    }
  @endphp
  @foreach($people as $person)
    <hr>
    <div class="page-break"></div>
    @php
      $accountref = DB::table('iv_users')->select('accountref')->where('id',$person->id)->first()->accountref;
      $personemail = DB::table('iv_users')->select('email')->where('id',$person->id)->first()->email;
    @endphp
    <h1>{{ $person->id }}: {{ $person->firstname }} {{ $person->lastname }} <small>({{ $accountref }})</small></h1>




    <div class="row">
      <div class="col-7">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Pre registration checks</h3>
          @php
            $ConcessionList = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','concession')->first();
            $Fresher = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','fresher')->first();
            $IVHistory = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','ivhistory')->first();
        
            if(!is_null($ConcessionList))
            {
              $ConcessionList = json_decode($ConcessionList->responsejson);
            }
            if(!is_null($Fresher))
            {
              $Fresher = json_decode($Fresher->responsejson);
            }
            if(!is_null($IVHistory))
            {
              $IVHistory = json_decode($IVHistory->responsejson);
            }
        
          @endphp
          <table class="table border-primary mb-0">
            @php $hasrows = false; @endphp
            <tbody class="border-primary">
              @if(!is_null($ConcessionList))
                @foreach($ConcessionList as $Concession)
                  @if($Concession === 'student')
                    <tr class="border-primary">@php $hasrows = true; @endphp
                      <th class="border-primary px-5"></th>
                      <td class="border-primary"><Strong>Full time student</strong><br>Enrolled full time at an Australian university during Semester Two 2018 or Semester One 2019 or equivalent</td>
                    </tr>
                  @endif
                  @if($Concession === 'youth')
                    <tr class="border-primary">@php $hasrows = true; @endphp
                      <th class="border-primary px-5"></th>
                      <td class="border-primary"><strong>Youth</strong><br>Born on or after 10 January 1989</td>
                    </tr>
                  @endif
                @endforeach
              @endif
              @if($Fresher === 'yes')
                <tr class="border-primary">@php $hasrows = true; @endphp
                  <th class="border-primary px-5"></th>
                  <td class="border-primary"><strong>Fresher</strong> (First time singing at an IV)<br>IV history: {{ $IVHistory }}</td>
                </tr>
              @endif
              @if(!$hasrows)
                <tr><td>No checks necessary.</td></tr>
              @endif
            </tbody>
          </table>
        </div>
        {{-- End pre registration check --}}
      </div>
      
      
      <div class="col-5">
        {{-- Red green box begins --}}
        @php
          $q = "select sectionid from rego_responses natural join rego_questions where userid = ? group by sectionid";
          $tmp = DB::select($q,[$person->id]);
          $submittedsections = [];
          foreach($tmp as $a)
          {
            $submittedsections[] = $a->sectionid;
          }
          $q = "SELECT
                  sectionid,
                  sectionname,
                  sectionord
                from
                  v_rego_required_sections
                  natural join
                  rego_sections
                where
                  userid = ?
                  and
                  required = 'true'
                order by
                  sectionord";
          $sections = DB::select($q,[$person->id]);
          $registrationiscomplete = True;
          $omittedsections = [];
        @endphp
        @foreach($sections as $section)
          @php
            $tick = in_array($section->sectionid,$submittedsections);
            if(!$tick)
            {
              $registrationiscomplete = False;
              $omittedsections[] = $section->sectionid;
            }
          @endphp
        @endforeach
        <div class="alert alert-{{ $registrationiscomplete ? 'success' : 'danger' }} rounded-0 pb-0" role="alert">
          <p class="h4">Registration is {{ $registrationiscomplete ? 'complete' : 'not yet finished' }}</p>
          @php
            switch(config('database.default'))
            {
              case('pgsql'):
                $caststring = '::TEXT';
                break;
              case('mysql'):
                $caststring = '';
                break;
            }
            $q = "with a as (select userid,checklistdescr,'Yes' as tickbox from rego_checklist natural join v_user_rego_items order by userid,checklistord), b as (select distinct checklistdescr,checklistord from rego_checklist), c as (select id as userid from iv_users) select userid,checklistdescr,coalesce(tickbox{$caststring},'No') as tickbox from (b cross join c) left join a using (userid,checklistdescr) where userid = ? order by userid,checklistord";
            $checklist = DB::select($q,[$person->id]);
            $numberofactivities = 0;
            $includedevents = [];
            $excludedevents = [];

            $essentialrecord = DB::table('v_cols_essential')->select('id','doing_singing','doing_social','adelaide')->where('id',$person->id)->first();
            $personalrecord = DB::table('v_cols_personal')->select('id','student','youth')->where('id',$person->id)->first();
        
        
            $ischoral = $essentialrecord->doing_singing ? true : false;
            $issocial = $essentialrecord->doing_social ? true : false;
            $isadelaide = $essentialrecord->adelaide ? true : false;

            $isstudent = $personalrecord->student ?? NULL;
            $isyouth = $personalrecord->youth ?? NULL;

            $sleepingatcampq = "select userid as id,case when json_search(responsejson,'one','no') is not null then false else true end as sleepingatcamp from rego_responses where questionshortname = 'sleepingatcamp' and userid = ?";
            $billetingrequestq = "select userid as id, case when responsejson <> '[\"hiddeninput\"]' then true else false end as billetingrequest from rego_responses where questionshortname = 'billetingrequest' and userid = ?";
            $accommodationq = "select userid as id,case when json_unquote(responsejson) is not null then true else false end as accommodation from rego_responses where questionshortname = 'accommodation' and userid = ?";
        

            $sleepingatcampselect = DB::select($sleepingatcampq,[$person->id]); // [0]->sleepingatcamp ? true : false;
            $billetingrequestselect = DB::select($billetingrequestq,[$person->id]); // [0]->billetingrequest ? true : false;
            $accommodationselect = DB::select($accommodationq,[$person->id]); // [0]->accommodation ? true : false;

            $sleepingatcamp = NULL;
            $billetingrequest = NULL;
            $accommodation = NULL;
            foreach($sleepingatcampselect as $a)
            {
              $sleepingatcamp = $a->sleepingatcamp ? true : false;
            }
            foreach($billetingrequestselect as $a)
            {
              $billetingrequest = $a->billetingrequest ? true : false;
            }
            foreach($accommodationselect as $a)
            {
              $accommodation = $a->accommodation ? true : false;
            }

            $antisocialchorister = $ischoral && !$issocial ? true : false;
            $foreignernotsleepingatcamp = !$isadelaide && !$sleepingatcamp ? true : false;
            $homelessforeignstudent = $isstudent && !$isadelaide && !$billetingrequest;
            $homelessforeignnonstudents = !$isstudent && !$isadelaide && !$accommodation;
        
            $unusualcombination = $antisocialchorister || $foreignernotsleepingatcamp || $homelessforeignstudent || $homelessforeignnonstudents;
        
          @endphp
          <table class="table table-sm">
            @foreach($checklist as $checklistitem)
              <tr>
                <td class="pl-0">{{ $checklistitem->checklistdescr }}</td>
                <td class="pr-0">{{ $checklistitem->tickbox }}</td>
                @php
                  if($checklistitem->tickbox == 'Yes')
                  {
                    $numberofactivities++;
                    $includedevents[] = $checklistitem->checklistdescr;
                  }
                  else
                  {
                    $excludedevents[] = $checklistitem->checklistdescr;
                  }
                @endphp
              </tr>
            @endforeach
          </table>
          @if(!$registrationiscomplete)
            @php
              $omittedsectionsobj = DB::table('rego_sections')->whereIn('sectionid',$omittedsections)->get();
            @endphp
            <p>Omitted sections:</p>
            <ul>
              @foreach($omittedsectionsobj as $section)
                <li>{{ $section->sectionname }}</li>
              @endforeach
            </ul>
          @else
            @php
              $omittedsectionsobj = [];
            @endphp
          @endif
        </div>
        {{-- Red Green box ends --}}
      </div>
    </div>



    
    





    <div class="row">


    {{-- Invoice --}}
    <div class="col-7">
      <div class="card border-primary mb-3 ">
        <h3 class="card-header text-white bg-primary">Invoice</h3>
        <div class="card-body pb-0">
          <h2>AIVCF Adelaide<br><small><span class="font-weight-bold">ABN</span> 41 628 114 920</small></h2>
          <p class="text-right lead">Date: {{ date('l, j F Y') }}</p>
          <div class="row">
            <div class="col-2 text-right">To:</div>
            <div class="col-10">
              {{ $person->firstname }} {{ $person->lastname }}
            </div>
          </div>
          <p class="text-right lead"><span class="font-weight-bold">INVOICE</span> No. {{ $accountref }}</p>
          @php
            $regoitems = DB::table('v_user_rego_items')
              ->select('itemname','unitprice','qty','price')
              ->where('userid',$person->id)
              ->get();
            $regoitemtotal = 0;
          @endphp
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="pl-0">Description</th>
                <th>Qty</th>
                <th class="text-right">Unit price</th>
                <th class="text-right pr-0">Amount payable</th>
              </tr>
            </thead>
            <tbody>
              @foreach($regoitems as $regoitem)
                @php $regoitemtotal += $regoitem->price; @endphp
                <tr>
                  <td class="pl-0">{{ $regoitem->itemname }}</td>
                  <td>{{ $regoitem->qty }}</td>
                  <td class="text-right">{{ $regoitem->unitprice }}</td>
                  <td class="text-right pr-0">{{ $regoitem->price }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="font-weight-bold">
              <tr>
                <td colspan="3" class="pl-0">TOTAL AMOUNT PAYABLE</td>
                <td class="text-right pr-0">${{ number_format($regoitemtotal,2,'.','') }}</td>
              </tr>
            </tfoot>
          </table>
          <p class="font-weight-bold">No GST has been charged.</p>
        </div>
      </div>
    </div>
    {{-- End invoice --}}
    
    
    
    
    {{-- Receipts --}}
    <div class="col-5">
      <div class="card border-primary mb-3">
        <h3 class="card-header text-white bg-primary">Receipts</h3>
        <div class="card-body pb-0">
          <h4>Card payments</h4>
          @php
            $charges = DB::table('rego_stripe_charges')->select('chargeid')->where('accountref',$accountref)->get();
            $stripetotal = 0;
          @endphp
          <table class="table table-sm">
            <thead>
              <tr class="border-bottom-0 mb-0 pb-0"><th class="pl-0 border-bottom-0 mb-0 pb-0" colspan="4">Charge ID</th></tr>
              <tr class="border-top-0 mt-0 pt-0">
                <th class="pl-0 border-top-0 mt-0 pt-0">Date</th>
                <th class="border-top-0 mt-0 pt-0">Status</th>
                <th class="text-right border-top-0 mt-0 pt-0">Transaction amount</th>
                <th class="text-right border-top-0 pr-0 mt-0 pt-0">Transaction net</th>
              </tr>
            </thead>
            <tbody>
              @foreach($charges as $charge)
                @php
                  $chargeobject = \Stripe\Charge::retrieve($charge->chargeid);
                  if($chargeobject->captured)
                  {
                    $balancetransactionobject = \Stripe\BalanceTransaction::retrieve($chargeobject->balance_transaction);
                  }
                @endphp
                <tr class="border-bottom-0 mb-0 pb-0"><td class="pl-0 border-bottom-0 mb-0 pb-0" colspan="4">{{ $chargeobject->id }}</td></tr>
                <tr class="border-top-0 mt-0 pt-0">
                  <td class="pl-0 border-top-0 mt-0 pt-0">{{ date('j/m/y',$chargeobject->created) }}</td>
                  <td class="border-top-0 mt-0 pt-0">
                    {{ $chargeobject->status }}
                    @if( $chargeobject->status === 'failed' )
                      ({{ $chargeobject->failure_message }})
                    @endif
                  </td>
                  @if( $chargeobject->captured )
                    <td class="text-right border-top-0 mt-0 pt-0">${{ number_format($balancetransactionobject->amount/100,2,'.','') }}</td>
                    <td class="text-right border-top-0 pr-0 mt-0 pt-0">${{ number_format($balancetransactionobject->net/100,2,'.','') }}</td>
                    @php
                      $stripetotal += $balancetransactionobject->net/100;
                    @endphp
                  @else
                    <td class="text-right border-top-0 mt-0 pt-0"></td>
                    <td class="text-right border-top-0 pr-0 mt-0 pt-0"></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
          <h4>Electronic bank transfer</h4>
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="pl-0">Transaction ID</th>
                <th>Date</th>
                <th>Description</th>
                <th class="text-right pr-0">Credit</th>
              </tr>
            </thead>
            <tbody>
              @php
                $bankq = "SELECT id,date,description,credit FROM bank_transaction_accounts JOIN bank_transactions ON (id = transactionid) WHERE accountref = ?";
                $transactions = DB::SELECT($bankq,[$accountref]);
                $banktotal = 0;
              @endphp
              @foreach($transactions as $transaction)
                <tr>
                  <td clas="pl-0">{{ $transaction->id }}</td>
                  <td class="">{{ $transaction->date }}</td>
                  <td class="">{{ $transaction->description }}</td>
                  <td class="text-right pr-0">${{ $transaction->credit }}</td>
                  @php
                    $banktotal += $transaction->credit;
                  @endphp
                </tr>
              @endforeach
            </tbody>
          </table>
          <h4>Other transfer</h4>
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="pl-0">Transaction ID</th>
                <th>Description</th>
                <th class="text-right pr-0">Credit</th>
              </tr>
            </thead>
            <tbody>
              @php
                $otherq = "SELECT othertransactionid,description,value FROM rego_othertransactions WHERE accountref = ?";
                $othertransactions = DB::SELECT($otherq,[$accountref]);
                $othertotal = 0;
              @endphp
              @foreach($othertransactions as $transaction)
                <td clas="pl-0">{{ $transaction->othertransactionid }}</td>
                <td class="">{{ $transaction->description }}</td>
                <td class="text-right pr-0">${{ $transaction->value }}</td>
                @php
                  $othertotal += $transaction->value;
                @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- End receipts --}}

    </div>  {{-- Invoice/receipts row --}}

    <div class="card border-primary mb-3">
      <h3 class="card-header text-white bg-primary">Balance due</h3>
      <div class="card-body pb-0">
        <p class="lead">${{ number_format($regoitemtotal - $stripetotal - $banktotal - $othertotal,2,'.','') }}</p>
      </div>
    </div>
    
    
    
    
    
    
    
    <hr>
    <div class="page-break"></div>
    <h1>{{ $person->id }}: {{ $person->firstname }} {{ $person->lastname }} <small>({{ $accountref }})</small></h1>
    <h2>Registration package</h2>
    
    @php
      $ScoreList = $ScoreListArray[$person->id];
      $ScoreList = $ScoreList ?? [];
    @endphp

    <div class="row">
      {{-- Borrowed scores --}}
      <div class="col-5">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Borrowed scores</h3>
          <table class="table border-primary mb-0">
            @php $hasrows = false; @endphp
            <tbody class="border-primary">
              @if($ScoreList !== [])
                @foreach($ScoreNames as $ScoreShortName => $ScoreName)
                  @if($ScoreList[$ScoreShortName] !== $BuyString && $ScoreList[$ScoreShortName] !== $BringString)
                    <tr class="border-primary">@php $hasrows = true; @endphp
                      <th class="border-primary px-5"></th>
                      <td class="border-primary"><strong>{{ $ScoreName[0] }}</strong>: {{ $ScoreName[1] }}<br>{{ $ScoreList[$ScoreShortName] }}</td>
                    </tr>
                  @endif
                @endforeach
              @endif
              @if(!$hasrows)
                <tr><td>None</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      {{-- End borrowed scores --}}
      {{-- Bought scores --}}
      <div class="col-5">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Bought scores</h3>
          <table class="table border-primary mb-0">
            @php $hasrows = false; @endphp
            <tbody class="border-primary">
              @if($ScoreList !== [])
                @foreach($ScoreNames as $ScoreShortName => $ScoreName)
                  @if($ScoreList[$ScoreShortName] === $BuyString)
                    <tr class="border-primary">@php $hasrows = true; @endphp
                      <th class="border-primary px-5"></th>
                      <td class="border-primary"><strong>{{ $ScoreName[0] }}</strong>: {{ $ScoreName[1] }}</td>
                    </tr>
                  @endif
                @endforeach
              @endif
              @if(!$hasrows)
                <tr><td>None</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      {{-- End bought scores --}}
      {{-- Excluded scores --}}
      <div class="col-2">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Excluded scores</h3>
          <table class="table border-primary mb-0">
            @php $hasrows = false; @endphp
            <tbody class="border-primary">
              @if($ScoreList !== [])
                @foreach($ScoreNames as $ScoreShortName => $ScoreName)
                  @if($ScoreList[$ScoreShortName] === $BringString)
                    <tr class="border-primary">@php $hasrows = true; @endphp
                      <td class="border-primary"><strong>{{ $ScoreName[0] }}</strong>: {{ $ScoreName[1] }}</td>
                    </tr>
                  @endif
                @endforeach
              @endif
              @if(!$hasrows)
                <tr><td>None</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      {{-- End excluded scores --}}
    </div>
    @php
      $MerchQtyRaw = DB::table('rego_responses')->select('questionshortname','responsejson')->where('userid',$person->id)->whereIn('questionshortname',['photo','cd','wineglass','bag'])->get();
      $MerchQty = ['photo' => 0, 'cd' => 0, 'wineglass' => 0, 'bag' => 0];
      foreach($MerchQtyRaw as $MerchQtyRawRecord)
      {
        $MerchQty[$MerchQtyRawRecord->questionshortname] = json_decode($MerchQtyRawRecord->responsejson);
      }
      $Bottle = DB::table('rego_responses')->select('responsejson')->where('userid',$person->id)->where('questionshortname','bottle')->first();
    @endphp
    <div class="row">
      {{-- Merchandise items --}}
      <div class="col-6">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Merchandise items</h3>
          <table class="table border-primary mb-0">
            @php $hasrows = false; @endphp
            <tbody class="border-primary">
              @foreach($MerchQty as $MerchItemKey => $MerchItemValue)
                @if($MerchItemValue > 0)
                  <tr class="border-primary">@php $hasrows = true; @endphp
                    <th class="border-primary px-5"></th>
                    <td class="border-primary"><Strong>{{ $MerchItemKey }}</strong><br>{{ $MerchItemValue }}</td>
                  </tr>
                @endif
              @endforeach
              @if(!is_null($Bottle))
                @php
                  $Bottle = json_encode(json_decode($Bottle),JSON_PRETTY_PRINT);
                @endphp              
                <tr class="border-primary">@php $hasrows = true; @endphp
                  <th class="border-primary px-5"></th>
                  <td class="border-primary"><Strong>Bottle</strong><br>{{ $Bottle }}</td>
                </tr>
              @endif
              @if(!$hasrows)
                <tr><td>None</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      {{-- End merchandise items --}}
      {{-- Common items --}}
      <div class="col-6">
        <div class="card border-primary mb-3 pb-0">
          <h3 class="card-header text-white bg-primary">Common items</h3>
          <table class="table border-primary mb-0">
            <tbody class="border-primary">
              <tr class="border-primary">
                <th class="border-primary px-5"></th>
                <td class="border-primary"><Strong>Pencil</strong></td>
              </tr>
              <tr class="border-primary">
                <th class="border-primary px-5"></th>
                <td class="border-primary"><Strong>Rubber</strong></td>
              </tr>
              <tr class="border-primary">
                <th class="border-primary px-5"></th>
                <td class="border-primary"><Strong>SHINE SA package</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      {{-- End common items --}}
    </div>
    


    
  
  @endforeach
</div>
@endsection

