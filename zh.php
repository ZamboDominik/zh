<?php
$string = 'Zambo Dominik';
function tombkepzoszakkor($string){
    $elso = str_split($string);
    $masodik = letrehoz(20,15,45); 
    $harmadik = novekvosor(20,15,45);
    $negyedik = csokkenosor(20,15,45);
    $tomb[] = $elso;
    $tomb[] = $masodik;
    $tomb[] = $harmadik;
    $tomb[] = $negyedik;
    return $tomb;
}
function letrehoz($n,$k,$v){
    if($n<abs($k-$v)+1){
        while (!isset($tomb) || count($tomb)<$n){
            $vel =rand($k,$v);

            if( !isset($tomb) || !in_array($vel,$tomb)){
                $tomb[] = $vel;
            }
        }
        return $tomb;
    }else{
        return false;
    }
}
function novekvosor($szam,$kezdo,$veg){
 for ($i=0; $i < $szam; $i++) { 
     if($kezdo < $veg)  $tomb[] = $kezdo;   
     $kezdo++;
 }
 /*if(count($tomb) < $szam) return str_split('Ilyen paraméterekkel nem létrehozható!');
else*/ return $tomb;
}
function csokkenosor($szam,$kezdo,$veg){
    for ($i=$szam; $i > 0; $i--) { 
        if($veg > $kezdo)  $tomb[] = $veg;   
        $veg--;
    }
    if(count($tomb) != $szam) return str_split('Ilyen paraméterekkel nem létrehozható!');
    else return $tomb;
   }
$elsot = tombkepzoszakkor($string);
/*var_dump($elsot);*/
function kiirat($tomb){
    foreach ($tomb as $key => $value) {
        $string='';
        foreach ($value as $k => $v) {
            $string .= ' '.$v;
        }
        $tombki[] = $string.'<BR>';
    }
    return $tombki;
}
$stringt = kiirat($elsot);
for ($i=0; $i < count($stringt); $i++) { 
    echo $stringt[$i];
}


//Második feladat
echo'<BR> MÁSODIK FELADAT';
function cseres($tomb){
    $vizsgalat=0; 
    $modositas=0;
    for ($i=0; $i<count($tomb)-1; $i++){
        for ($j=$i+1; $j<count($tomb);$j++){
                $vizsgalat++;
            if ($tomb[$i]>$tomb[$j]){
                    $modositas++;
                $seged=$tomb[$i];
                $tomb[$i]=$tomb[$j];
                $tomb[$j]=$seged;
            }
        }
    }
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
    return $tombf;
}
function minimum($tomb){
	$vizsgalat=0;
    $modositas=0;
	for ($i=0; $i<count($tomb)-1; $i++){
		$min=$i;
		for ($j=$i+1; $j<count($tomb);$j++){
				$vizsgalat++;			
			if ($tomb[$min]>$tomb[$j]){
				$min=$j;
			}
		}
				$modositas++;
			$seged=$tomb[$i];
			$tomb[$i]=$tomb[$min];
			$tomb[$min]=$seged;
	}
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
    return $tombf;
}
function buborekos($tomb){
    $vizsgalat = 0;
    $modositas = 0;
	for ($i=count($tomb);$i>1;$i--){
		for($j=0;$j<($i-1);$j++){
            $vizsgalat++;
			if ($tomb[$j]>$tomb[$j+1]){
				$seged=$tomb[$j];
				$tomb[$j]=$tomb[$j+1];
				$tomb[$j+1]=$seged;
                $modositas++;
			}
		}
	}
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
	return $tombf;
}
function buborekos2($tomb){
	$i=count($tomb);
    $vizsgalat = 0;
    $modositas = 0;
	while($i>0){
		$id=0;
		for($j=0;$j<($i-1);$j++){
            $vizsgalat++;
			if ($tomb[$j]>$tomb[$j+1]){
				$seged=$tomb[$j];
				$tomb[$j]=$tomb[$j+1];
				$tomb[$j+1]=$seged;
				$id=$j+1;
                $modositas++;
			}
		}
		$i=$id;
	}
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
	return $tombf;
}
function beilleszteses($tomb){
    $vizsgalat = 0;
    $modositas = 0;
	for($i=1;$i<count($tomb);$i++){
		$j=$i-1;
		while ($vizsgalat++ && $j>-1 && $tomb[$j]>$tomb[$j+1]  ){
            
			$seged=$tomb[$j];
			$tomb[$j]=$tomb[$j+1];
			$tomb[$j+1]=$seged;
			$j--;
            $modositas++;
		}
        
	}
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
	return $tombf;
}


function beilleszteses2($tomb){
    $vizsgalat = 0;
    $modositas = 0;
	for($i=1;$i<count($tomb);$i++){
		$j=$i-1; 
        $seged=$tomb[$i];
		while ($vizsgalat++ && $j>-1 && $tomb[$j]>$seged){
            
			$tomb[$j+1]=$tomb[$j];
			$j--;
            $modositas++;
		}
		$tomb[$j+1]=$seged;
       
	}
    $tombf[] = $vizsgalat;
    $tombf[] = $modositas;
	return $tombf;
}
function tombosszesito($tomb){
    $munka[] = cseres($tomb);
    $munka[] = minimum($tomb);
    $munka[] = buborekos($tomb);
    $munka[] = buborekos2($tomb);
    $munka[] = beilleszteses($tomb);
    $munka[] = beilleszteses2($tomb);
    return $munka;
}

function tablazatgen($tomb,$min)
{
    $index = 0;
    $rendezesek =['cserés','minkiválasztásos','buborékos','javított buborékos','beillesztéses','javított beillesztéses' ];
    echo '<table>';
    echo '<tr> <td> </td> <td>Összehasonlítások</td> <td>Cserék</td> </tr>';
    /*foreach($tomb as $kulcs => $sor2){
        if($sor2 == $min) $index = $kulcs;
    }*/
    foreach ($tomb as $i => $sor) {
        if($sor == $min)   echo '<tr style="color:red">';
        else echo '<tr>';
        echo '<td>';
        echo $rendezesek[$i];
        echo '</td>';
        foreach ($sor as $key => $value) {
           echo '<td>';
           echo $value;
           echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
echo '<br>';
echo 'Első sor:';
$munkatomb = tombosszesito($elsot[0]);
$minimum = min($munkatomb);
tablazatgen($munkatomb,$minimum);
echo 'Második sor:';
$munkatomb = tombosszesito($elsot[1]);
$minimum = min($munkatomb);
tablazatgen($munkatomb,$minimum);
echo 'Harmadik sor:';
$munkatomb = tombosszesito($elsot[2]);
$minimum = min($munkatomb);
tablazatgen($munkatomb,$minimum);
echo 'Negyedik sor:';
$munkatomb = tombosszesito($elsot[3]);
$minimum = min($munkatomb);
tablazatgen($munkatomb,$minimum);