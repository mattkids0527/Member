<?php
$arr =[];

$data = [
    "ABC",
    "DEF",
    "GHI",
    "JKL"
];

//foreach($data as $row){
//    print_r($row);
//}

//for($i=0;$i<count($data);$i++){
//    for($j=0;$j<count($data[$i]);$j++){
//        echo $data[$i][$j];
//        echo '<br>';
//    }
//}
for($i=0;$i<2;$i++){
array_push($arr,$data);
}

foreach($arr as $fow){
    print_r($fow);
    echo '<br>';
}
?>