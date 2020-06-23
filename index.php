<?php

include('class/Weenect.php');

Weenect::login('veka610@gmail.com', '...');

$d = Weenect::getTracker();

$d = json_decode($d);

$latitude = $d->items[0]->position[0]->latitude;
$longitude = $d->items[0]->position[0]->longitude;
$name = $d->items[0]->position[0]->geofence_name;

$last_message = $d->items[0]->position[0]->last_message;
$last_message = date("d-m-Y H:i:s", strtotime($last_message));

$gsm = $d->items[0]->position[0]->gsm;
$valid_signal = $d->items[0]->position[0]->valid_signal;
$is_online = $d->items[0]->position[0]->is_online ?'EN LIGNE':'HORS LIGNE';

?>

<style>

    html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}
    article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}
    body{line-height:1}
    ol,ul{list-style:none}
    blockquote,q{quotes:none}
    blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}
    table{border-collapse:collapse;border-spacing:0}
    .bar_infos{position:absolute;top:0;left:0;width:100%;text-align:center}
    .bar_infos ul{background:rgba(255,255,255,0.9);margin:auto;display:inline-block;margin-top:10px}
    .bar_infos li{padding:10px;display:inline-block}

</style>

<div style="width: 100%; height:100%;">
    <iframe width="100%" height="100%" src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=loc:<?php echo $latitude.'+'.$longitude?>&amp;ie=UTF8&amp;t=k&amp;z=18&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

        <div class="bar_infos">
            <ul>
                <li><?php echo $last_message ?></li>
                <li>GSM : <?php echo $gsm ?></li>
                <li>SIGNAL : <?php echo $valid_signal ?></li>
                <li><?php echo $is_online ?></li>
            </ul>
        </div>

</div>




