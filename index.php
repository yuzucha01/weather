<?php
function get_json( $type = null ){
    $city = "Gifu-shi,jp";
    $appid = "XXXXXXXXXXXXXXXXXX";
    $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&APPID=" . $appid;

    $json = file_get_contents( $url );
    $json = mb_convert_encoding( $json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN' );
    $json_decode = json_decode( $json );

    //現在の天気
    if( $type  === "weather" ):
      $out = $json_decode->weather[0]->main;

    //現在の天気アイコン
    elseif( $type === "icon" ):
      $out = "<img src='https://openweathermap.org/img/wn/" . $json_decode->weather[0]->icon . "@2x.png'>";

    //現在の気温
    elseif( $type  === "temp" ):
      $out = $json_decode->main->temp;

    //パラメータがないときは配列を出力
    else:
      $out = $json_decode;

    endif;

    return $out;
  }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>weather</title>
    </head>
    <body>
        <table id="border">
            <tr>
                <th>天気</th>
                <th>気温</th>
            </tr>
            <tr>
                <th>
                    <?php echo get_json("icon"); ?>
                    <?php echo get_json("weather"); ?>
                </th>
                <th><?php echo get_json("temp"); ?>℃</th>
            </tr>
        </table>
    </body>
</html>
