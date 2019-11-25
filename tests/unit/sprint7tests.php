<?php
namespace tests\unit;
class UnitTests3 extends \PHPUnit\Framework\TestCase
{
  //Equivalence Class Testing
  //runs getMemberStatus() with faux data to test it returns accurate things
  function testMemberStatus(){

    //Newbie member (under 1 year)
    $date1 = "2019-11-4";
    $value1 = getMemberStatus($date1)
    $this->assertEquals("Newbie", $value1);

    //Novice member (year 1-2)
    $date2 = "2020-11-4";
    $value2 = getMemberStatus($date2)
    $this->assertEquals("Novice", $value2);

    //Master member (over 3 years)
    $date3 = "2022-11-4";
    $value3 = getMemberStatus($date3)
    $this->assertEquals("Master", $value3);

  }
}
?>
