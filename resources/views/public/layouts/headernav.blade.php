<?php
  function activetab($activetab,$string){
    echo $activetab === $string ? 'is-active' : '' ;
  }
?>

<header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
  <div class="mdl-layout__header-row portfolio-logo-row">
    <span class="mdl-layout__title">
      <a href="/">
        <div class="portfolio-logo"></div>
      </a>
      <span class="mdl-layout__title">70th Australian Intervarsity Choral Festival, Adelaide 10–20 January 2019</span>
    </span>
  </div>
  <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
    <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
      <a class="mdl-navigation__link <?php activetab($activetab,'welcome') ?>" href="/">Welcome</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'about') ?>" href="/about">About</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'concert') ?>" href="/concert">Concert</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'camp') ?>" href="/camp">Camp</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'social') ?>" href="/social">Social</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'fees') ?>" href="/fees">Fees</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'participate') ?>" href="/participate">Participate</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'bulletins') ?>" href="/bulletins">Bulletins</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'home') ?>" href="/home">Registration</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'committee') ?>" href="/committee">Committee</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
    </nav>
  </div>
</header>
<div class="mdl-layout__drawer mdl-layout--small-screen-only">
  <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
    <a class="mdl-navigation__link <?php activetab($activetab,'welcome') ?>" href="/">Welcome</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'about') ?>" href="/about">About</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'concert') ?>" href="/concert">Concert</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'camp') ?>" href="/camp">Camp</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'social') ?>" href="/social">Social</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'fees') ?>" href="/fees">Fees</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'participate') ?>" href="/participate">Participate</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'bulletins') ?>" href="/bulletins">Bulletins</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'home') ?>" href="/home">Registration</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'committee') ?>" href="/committee">Committee</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
  </nav>
</div>

