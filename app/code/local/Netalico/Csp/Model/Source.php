<?php
class Netalico_Csp_Model_Source
{
  public function toOptionArray()
  {
    return array(
      array('value' => 0, 'label' =>'Wizard'),
      array('value' => 1, 'label' => 'Report Only'),
      array('value' => 2, 'label' =>'Enforce'),
      array('value' => 3, 'label' =>'No Reporting'),
    );
  }
}