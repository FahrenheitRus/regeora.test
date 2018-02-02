## Начало работы
0. Установка


      artisan migrate
    
  
1. Распарсить xml в классы для работы с данными. Каждый “выход” должен быть
       отдельным объектом, содержащий в себе массив смен. То есть объединять
       <graph> с одинаковым num, смены должны быть в порядке возрастания их номера.
       
       
      ~ 4 часа
      
      Graph::first()->smena()->get()
      
      artisan raspvariant:parse storage/app/data/raspvariant.xml          


2. Реализовать метод у класса “выхода“, возвращающий количество производственных
       рейсов, общее время производственных рейсов (сумма всех end-start).
       
      
       ~ 1 час                  
                  
       $graph->getRaspEventCount();
       $graph->getRaspTimeCount();
       
       artisan raspvariant:get_events [graph_num]
       
       
3. Реализовать метод у класса “выхода“, принимающий на вход “время с” и “время по“,
       возвращающий все остановки всех производственных рейсов “выхода“, попадающих
       в этот временной диапазон. Результат должен быть в таком виде, чтобы у каждой
       записи можно было определить номер смены и порядковый номер рейса в смене
       
             
       ~ 1 час
       
       Stop::getIndustrialStopsBetween($start_time_munites,$end_time_minutes);
       
       artisan raspvariant:get_stops 18:00 20:00
       
      
  4. Реализовать таблицу в БД StopPoints с id (внутренний идентификатор), external_id
      (внешний идентификатор), name (наименование). Сделать чтобы метод из пункта 3
      возвращал так же названия остановок по их external_id.
           
           
       ~ 2 часа
       
       Stop::getIndustrialStopsBetweenWithNames($start_time_munites,$end_time_minutes);
       
       artisan raspvariant:get_stops_with_name 18:00 20:00
