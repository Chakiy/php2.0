<?php
$public_access = true;
require_once "../lib/autoload.php";

header("Access-Control-Allow-Origin: 'https://gf.dev'");
//header('Content-Type: json/application');

$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

$parts = explode("/", $request_uri);

//zoek "rest" in de uri
for ( $i=0; $i<count($parts) ;$i++)
{
    if ( $parts[$i] == "oef2.2" )
    {
        break;
    }
}

$request_part = $parts[$i+2];
if ( count($parts) > $i + 3 ) $id = $parts[$i + 3];

//GET codes: alle spelers geven
if ( $method == "GET" AND $request_part == "btwcodes" )
{

    $sql = "select * from eu_btw_codes";

    // ... execute $sql
    $data = $container->getDBManager()->GetData( $sql, 'assoc' );

    print json_encode( [ "msg" => "ok" , "data" => $data ] ) ;//normaal zou je hier alle spelers teruggeven
}

//GET codes: één btwcode geven
if ( $method == "GET" AND $request_part == "btwcode" )
{
    $sql = "select * from eu_btw_codes where eub_id=$id";
    // ... execute $sql
    $data = $container->getDBManager()->GetData( $sql, 'assoc' );

    print json_encode( [ "msg" => "ok" , "data" => $data] ) ;//normaal zou je hier één speler teruggeven
}

//POST codes: een speler toevoegen
if ( $method == "POST" AND $request_part == "btwcodes"  )
{
    $name = $_POST["name"];
    $sh_name = $_POST["sh_name"];
    $sql = "INSERT INTO eu_btw_codes (eub_land, eub_code) VALUES ('$name', '$sh_name') ";
    $data = $container->getDBManager()->ExecuteSQL($sql);
    // ... execute $sql
    http_response_code(201);
    print json_encode( [ "msg" => "BTW code $sh_name - $name is aangemaakt" ] ) ; //normaal zou je hier een OK teruggeven

}



//PUT codes: een speler updaten
if ( $method == "PUT" AND $request_part == "btwcode" )
{
    $contents = json_decode( file_get_contents("php://input") );

    $l_name = $contents->naam;
    $bCode = $contents->code;


    $sql = "UPDATE eu_btw_codes SET eub_land='$l_name', eub_code='$bCode' WHERE eub_id=$id";
    // ... execute $sql
    $data = $container->getDBManager()->ExecuteSQL($sql);

    print json_encode( [ "msg" => "ok", "info" => "BTW code $bCode - $l_name gewijzigd" ] ) ; //normaal zou je hier een OK teruggeven
}


//DELETE codes: een btwcode verwijderen
if ( $method == "DELETE" AND $request_part == "btwcode" )
{
    $sql = "DELETE FROM eu_btw_codes WHERE eub_id=$id";
    // ... execute $sql
    $data = $container->getDBManager()->ExecuteSQL($sql);

    print json_encode( [ "msg" => "ok", "info" => "BTW code ... verwijderd" ] ) ; //normaal zou je hier een OK teruggeven
}
?>

