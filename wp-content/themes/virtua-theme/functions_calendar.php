<?php



function get_calendar_events_new( $month = false, $year = false ) {
	
   if ($year == false) { $year = date("Y");  }
   if ($month == false) {  $month = date("m"); }
  
  
  // Вычисляем число дней в текущем месяце
  $dayofmonth = date('t',$year.'-'.$month.'-01 01:01:01');

  // Счётчик для дней месяца
  $day_count = 1;


  // 1. Первая неделя 
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {

    // Вычисляем номер дня недели для числа
    $dayofweek = date('w', mktime(0, 0, 0, $month, $day_count, $year));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;
    if($dayofweek == $i)
    {
      // Если дни недели совпадают,
      // заполняем массив $week
      // числами месяца
      $week[$num][$i] = ($day_count < 10) ? "0".$day_count : $day_count ;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }

  }
  
  // 2. Последующие недели месяца
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] =  ($day_count < 10) ? "0".$day_count : $day_count ;
      $day_count++;

      // Если достигли конца месяца - выходим
      // из цикла
      if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим
    // из цикла
    if($day_count > $dayofmonth) break;
  }

  // 2.1 Собираем события
  $date_now_start = $year.$month.'01';
  $date_now_end = $year.$month.$dayofmonth;
  global $post; 
	$args = array(
	   'post_type' => 'events',
	   'publish' => true,
	   'posts_per_page' => -1,
   );
  	   
  	$args['meta_key']='on_event_data_start_int';
  	$args['orderby']='meta_value_num';
  	$args['order']='ASC';
  	$args['meta_query']=array(
	   'relation' => 'AND',
	   array(
			'key' => 'on_event_data_start_int',
			'value' => $date_now_start,
			'compare' => '>',
	   ),
	   array(
			'key' => 'on_event_data_start_int',
			'value' => $date_now_end,
			'compare' => '<',
	   )
   );
  	
  $events_list = get_posts( $args );
  foreach( $events_list as $post ){ setup_postdata($post);
  	$events[]=get_post_meta ($post->ID,'on_event_data_start_int',true);
  }


  // 3. Выводим содержимое массива $week
  // в виде календаря
  // Выводим таблицу
  echo '<div class="event-carousel__item">
			<div class="event-carousel__calendar-wrap">
									<table class="event-carousel__wp-calendar" border=1>
											<caption>'.mysql2date('F Y',$year.'-'.$month.'-01 01:01:01').'</caption>
											<thead>
											<tr>
												<th scope="col" title="Понедельник">Пн</th>
												<th scope="col" title="Вторник">Вт</th>
												<th scope="col" title="Среда">Ср</th>
												<th scope="col" title="Четверг">Чт</th>
												<th scope="col" title="Пятница">Пт</th>
												<th scope="col" title="Суббота">Сб</th>
												<th scope="col" title="Воскресенье">Вс</th>
											</tr>
											</thead>';

  for($i = 0; $i < count($week); $i++)
  {
    echo "<tr>";
    for($j = 0; $j < 8; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        // Если имеем дело с субботой и воскресенья
        // подсвечиваем их
		if (in_array($year.$month.$week[$i][$j], $events)) {
      if( $_GET['orday']==$year.$month.$week[$i][$j] ) {
        $a_current=" class='current'";
      } else {
        $a_current="";
      } 
      $print_a_start="<a".$a_current." href='?orday=".$year.$month.$week[$i][$j]."&orcount=".$_GET['orcount']."&ordate=".$_GET['ordate']."'>"; 
      $print_a_end="</a>"; 
    } else { 
      $print_a_start=""; 
      $print_a_end=""; 
    }
        if($j == 5 || $j == 6) {

             echo "<td><font color=red>".$print_a_start.$week[$i][$j].$print_a_end."</font></td>";
           }
        else {
          echo "<td>".$print_a_start.$week[$i][$j].$print_a_end."</td>";
        } 
      }
      else echo "<td>&nbsp;</td>";
    }
    echo "</tr>";
  } 
  echo "		</table>
			</div>
		</div>";
}



