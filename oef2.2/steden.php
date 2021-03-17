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



$new_data = [];

foreach ($data as $row => $value ) {


         $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $value['img_weather_location'] . '&lang=nl&APPID=e97bd757a9b4c619b67d39814366db46';
         $restClient = new RESTclient($authentication = null);
         $restClient->CurlInit($url);
         $response = $restClient->CurlExec();

        $value['weather_temp'] = round(json_decode($response)->main->temp - 273.15);
        $value['weather_description'] = json_decode($response)->weather[0]->description;
        $value['weather_humidity'] = json_decode($response)->main->humidity;
        $value['weather_icon'] = '<img src="http://openweathermap.org/img/w/' .json_decode($response)->weather[0]->icon . '.png" height="32" width="auto">';


    $new_data[$row] = $value;

    }

    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output .= MergeViewWithData( $template, $new_data );
    print $output;


?>

    </div>
</div>

</body>
</html>