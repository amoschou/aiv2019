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
      <span class="mdl-layout__title">70th Australian Intervarsity Choral Festival, Adelaide 2019</span>
    </span>
  </div>
  <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
    <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
      <a class="mdl-navigation__link <?php activetab($activetab,'event') ?>" href="/adelaideiv">Adelaide IV</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'organisation') ?>" href="/aivcfadelaide">AIVCF Adelaide</a>
      <a class="mdl-navigation__link <?php activetab($activetab,'participate') ?>" href="/participate">Participate</a>
      <!--
      <a class="mdl-navigation__link <?php activetab($activetab,'login') ?>" href="/home">Registration</a>
      -->
      <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
    </nav>
  </div>
</header>
<div class="mdl-layout__drawer mdl-layout--small-screen-only">
  <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
    <a class="mdl-navigation__link <?php activetab($activetab,'event') ?>" href="/adelaideiv">Adelaide IV</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'organisation') ?>" href="/aivcfadelaide">AIVCF Adelaide</a>
    <a class="mdl-navigation__link <?php activetab($activetab,'participate') ?>" href="/participate">Participate</a>
    <!--
    <a class="mdl-navigation__link <?php activetab($activetab,'login') ?>" href="/home">Registration</a>
    -->
    <a class="mdl-navigation__link <?php activetab($activetab,'contact') ?>" href="/contact">Contact</a>
  </nav>
</div>

