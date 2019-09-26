<?php

namespace tests\unit;

class UnitTests extends \PHPUnit\Framework\TestCase
{
  public function testGetBookIdIsInt()
  {
    $i = 1;
    $this->assertIsInt($i);
  }
}

?>
