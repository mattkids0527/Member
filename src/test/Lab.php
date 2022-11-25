<?php
$data = [
    ['john','Doe'],
    ['wayne','rong'],
    ['php','laravel'],
    ['db','sql']
];

//foreach($data as $row){
//    print_r($row);
//}

for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
        echo $data[$i][$j];
        echo '<br>';
    }
}

?>