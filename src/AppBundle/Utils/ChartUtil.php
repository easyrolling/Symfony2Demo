<?php
namespace AppBundle\Utils;

class ChartUtil
{

  public static function getChartData($data)
    {
      $chart_data = array();
      foreach($data as $key => $value)
      {
        $chart_data[] = array($key, $value);
      }
      return $chart_data;
    }
}
