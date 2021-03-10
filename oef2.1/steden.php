<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
PrintNavbar();
?>

<div class="container">
    <div class="row">


<?php
    //toon messages als er zijn
    $container->getMessageService()->ShowErrors();
    $container->getMessageService()->ShowInfos();

    //export button
    $output ="";
    $output .= "<a style='margin-left: 10px' class='btn btn-info' role='button' href='export/export_images.php'>Export CSV</a>";
    $output .= "<div><br></div>";

    //get data
    $data = $container->getDBManager()->GetData( "select * from images" );


//    print_r($data);

//     $url = 'http://api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=e97bd757a9b4c619b67d39814366db46';
//     $restClient = new RESTclient( $authentication = null );
//     $restClient->CurlInit($url);
//     $response = $restClient->CurlExec();

//     print json_decode($response)->main->temp;


//    $data[0]['weather_description'] = json_decode($response)->main->temp;
//    print $data[0]['weather_description'];
//    print_r($data);

$aaa = [];

foreach ($data as $row => $value ) {


         $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $value['img_weather_location'] . '&APPID=e97bd757a9b4c619b67d39814366db46';
         $restClient = new RESTclient($authentication = null);
         $restClient->CurlInit($url);
         $response = $restClient->CurlExec();

        $value['weather_temp'] = round(json_decode($response)->main->temp - 273.15);
        $value['weather_description'] = json_decode($response)->weather[0]->description;
        $value['weather_humidity'] = json_decode($response)->main->humidity;


        $aaa[$row] = $value;
//        print_r($value);
//        print_r($aaa);




//

//        echo($value['img_weather_location']);
//        echo($value['weather_temp']);
//        echo($value['weather_description']);
//        echo($value['weather_humidity']);
//        echo"<br>";

    }
    print_r($data);

    echo "<hr>";
    echo "<br>";
//    print_r($value);
    print_r($aaa);



//        $url = 'api.openweathermap.org/data/2.5/weather?q='. $row['img_weather_location'] .'&lang=nl&units=metric&APPID=e97bd757a9b4c619b67d39814366db4';
//        $restClient = new RESTclient( $authentication = null );
//        $restClient->CurlInit($url);
//        $response = json_decode($restClient->CurlExec());
//
//        $row['weather_description'] = $response->weather[0]->description;
//        $row['weather_temp'] = round($response->main->temp);
//        $row['weather_humidity'] = $response->main->humidity;
//        print('<br>--------------------------<br>');
////        var_dump($row);
//        print('<br>--------------------------<br>');
//
//    }
//    print_r($data);

//    print_r($row);

//}

    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output .= MergeViewWithData( $template, $aaa );
    print $output;
//$land = $container->getDBManager()->GetData( "select img_weather_location from images" );

//    $url = 'http://api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=e97bd757a9b4c619b67d39814366db46';
//
//    $restClient = new RESTClient( $authentication = null );
//
//    $restClient->CurlInit($url);
//    $response = $restClient->CurlExec();
//
//    print json_decode($response)->main->temp;




?>

    </div>
</div>

</body>
</html>