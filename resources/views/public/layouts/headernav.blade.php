<?php
  function activetab($activetab,$string){
    echo $activetab === $string ? 'is-active' : '' ;
  }
  function ischoristers($activetab){
    if(   $activetab === 'choristers'
        || $activetab === 'camp'
        || $activetab === 'social'
        || $activetab === 'fees'
        || $activetab === 'bulletins'
        || $activetab === 'home')
    {
      return true;
    }
    else
    {
      return false;
    }
  }
?>

<header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
  <div class="mdl-layout__header-row portfolio-logo-row">
    <span class="mdl-layout__title">
      <a href="/">
        <div class="portfolio-logo"></div>
      </a>
      <span class="mdl-layout__title mdl-layout--large-screen-only">70th Australian Intervarsity Choral Festival, Adelaide: 10–20 January 2019</span>
      <span class="mdl-layout__title mdl-layout--small-screen-only">70th AIVCF, Adelaide: 10–20 January 2019</span>
    </span>
  </div>
  <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
    <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
      <a class="mdl-navigation__link <?php activetab($activetab,'welcome') ?>" href="/">Welcome</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'about') ?>" href="/about">About</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'concert') ?>" href="/concert">Concert</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'choristers') ?>" href="/choristers">Choristers</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'merchandise') ?>" href="/merchandise">Merchandise</a>
<!--
      <a class="mdl-navigation__link <?php activetab($activetab,'camp') ?>" href="/camp">Camp</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'social') ?>" href="/social">Social</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'fees') ?>" href="/fees">Fees</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'bulletins') ?>" href="/bulletins">Bulletins</a>
-->
      <a class="mdl-navigation__link <?php activetab($activetab,'committee') ?>" href="/committee">Committee</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
    </nav>
  </div>
  @if(ischoristers($activetab))
  <div class="mdl-layout__header-row portfolio-navigation-row">
    <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
      <a class="mdl-navigation__link <?php activetab($activetab,'camp') ?>" href="/choristers/camp">Camp</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'social') ?>" href="/choristers/social">Social</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'fees') ?>" href="/choristers/fees">Fees</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'bulletins') ?>" href="/choristers/bulletins">Bulletins</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'whattobring') ?>" href="/choristers/whattobring">What to bring</a>
    </nav>
  </div>
  @endif
</header>
<div class="mdl-layout__drawer mdl-layout--small-screen-only">
  <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
    <a class="mdl-navigation__link <?php activetab($activetab,'welcome') ?>" href="/">Welcome</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'about') ?>" href="/about">About</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'concert') ?>" href="/concert">Concert</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'choristers') ?>" href="/choristers">Choristers</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'merchandise') ?>" href="/merchandise">Merchandise</a>
<!--
    <a class="mdl-navigation__link <?php activetab($activetab,'camp') ?>" href="/camp">Camp</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'social') ?>" href="/social">Social</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'fees') ?>" href="/fees">Fees</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'bulletins') ?>" href="/bulletins">Bulletins</a>
-->
    <a class="mdl-navigation__link <?php activetab($activetab,'committee') ?>" href="/committee">Committee</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
  </nav>
</div>

