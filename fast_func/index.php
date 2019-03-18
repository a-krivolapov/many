<?php

if ($argc < 2) {
  
  printf("Отсутствует сумма для расчёта\n");
  
} elseif (!is_numeric($sum = $argv[1])) {
  
  printf("Введено не числовое значение\n");
  
} else {
  
  require(__DIR__.'/app/const.php');
    
    $bills = BILLS;
    arsort($bills);
    
    foreach ($bills as $bill) {
      
      $answer[$bill] = ($sum - ($sum % $bill))/$bill;
      $sum %= $bill;

    }
    
    if ($sum == 0) {
      foreach ($answer as $bill => $count) {
        printf("Номиналом %s необходимо купюр %s\n", $bill, $count);
      }
    } else {
      printf("Введена неверная сумма\n");
    }
  
}
