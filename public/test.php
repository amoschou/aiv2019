<?php

require __DIR__.'/../vendor/autoload.php';
use Tuupola\Base62Proxy as Base62;

function b62str($l)
{
  $c = strlen(Base62::encode(PHP_INT_MAX)) - 1;
  $b64str = $l % $c !== 0 ? Base62::encode(random_int(0,Base62::decode(str_repeat('z',$l % $c),True))) : '';
  $l = (int) ($l/$c);
  while($l > 0)
  {
    $b64str .= Base62::encode(random_int(0,Base62::decode(str_repeat('z',$c),True)));
    $l--;
  }
  return $b64str;
}



echo base62w(40);