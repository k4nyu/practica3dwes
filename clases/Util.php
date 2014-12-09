<?php

class Util {
   public static function getEnlacesPaginacion($p, $paginas, $numeroRegistros){ 
       $enlaces  = array();
       
        $ultimoCalculo = $numeroRegistros / $paginas;
        $ultimo = intval($ultimoCalculo);
        $enlaces["inicio"] = "<li><a href='?p=0'>&laquo; </a></li>"; 
        $enlaces["ultimo"] = "<li><a href='?p=$ultimo'>&raquo;</a></li>"; 
       if($p==0){           
            $enlaces["anterior"] = "<li><a href='?p=0'>&lt; </a></li>";
            $enlaces["primero"]= "<li class='active'><a href='?p=0'>1 </a></li>";
            $enlaces["segundo"]= "<li><a href='?p=1'>2 </a></li>"; 
            $enlaces["actual"]= "<li><a href='?p=2'>3 </a></li>"; 
            $enlaces["cuarto"]= "<li><a href='?p=3'>4 </a></li>";
            $enlaces["quinto"]= "<li><a href='?p=4'>5 </a></li>"; 
            $enlaces["siguiente"] = "<li><a href='?p=1'>&gt; </a></li>"; 
       }elseif ($p==1){ 
            $enlaces["anterior"] = "<li><a href='?p=0'>&lt; </a></li>";
            $enlaces["primero"]= "<li><a href='?p=0'>1 </a></li>";
            $enlaces["segundo"]= "<li class='active'><a href='?p=1'>2 </a></li>"; 
            $enlaces["actual"]= "<li><a href='?p=2'>3 </a></li>"; 
            $enlaces["cuarto"]= "<li><a href='?p=3'>4 </a></li>";
            $enlaces["quinto"]= "<li><a href='?p=4'>5 </a></li>"; 
            $enlaces["siguiente"] = "<li><a href='?p=2'>&gt; </a></li>";  
        }elseif ($p==$ultimo){ 
            $anterior = $ultimo-1;
            $enlaces["anterior"] = "<li><a href='?p=$anterior'>&lt; </a></li>"; 
            $primero= $ultimo-4;
            $primeroNumero= $ultimo-3;
            $enlaces["primero"]= "<li><a href='?p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $ultimo-3;
            $segundoNumero = $ultimo-2;
            $enlaces["segundo"]= "<li><a href='?p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $ultimo-2;
            $actualNumero = $ultimo-1;
            $enlaces["actual"]= "<li><a href='?p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $ultimo-1;
            $cuartoNumero = $ultimo;
            $enlaces["cuarto"]= "<li><a href='?p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $ultimo;
            $quintoNumero = $ultimo+1;
            $enlaces["quinto"]= "<li class='active'><a href='?p=".$quinto."'>$quintoNumero </a></li>"; 
            $siguiente = $ultimo;
            $enlaces["siguiente"] = "<li><a href='?p=".$siguiente."'>&gt; </a></li>"; 
        }elseif ($p==$ultimo-1){ 
            $anterior = $ultimo-2;
            $enlaces["anterior"] = "<li><a href='?p=$anterior'>&lt; </a></li>"; 
            $primero= $ultimo-4;
            $primeroNumero= $ultimo-3;
            $enlaces["primero"]= "<li><a href='?p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $ultimo-3;
            $segundoNumero = $ultimo-2;
            $enlaces["segundo"]= "<li><a href='?p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $ultimo-2;
            $actualNumero = $ultimo-1;
            $enlaces["actual"]= "<li><a href='?p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $ultimo-1;
            $cuartoNumero = $ultimo;
            $enlaces["cuarto"]= "<li class='active'><a href='?p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $ultimo;
            $quintoNumero = $ultimo+1;
            $enlaces["quinto"]= "<li><a href='?p=".$quinto."'>$quintoNumero </a></li>"; 
            $siguiente = $ultimo;
            $enlaces["siguiente"] = "<li><a href='?p=".$siguiente."'>&gt; </a></li>"; 
        }else{
            $anterior = $p-1;
            $enlaces["anterior"] = "<li><a href='?p=$anterior'>&lt; </a></li>"; 
            $primero= $p-2;
            $primeroNumero= $p-1;
            $enlaces["primero"]= "<li><a href='?p=".$primero."'>$primeroNumero </a></li>";
            $segundo = $p-1;
            $segundoNumero = $p;
            $enlaces["segundo"]= "<li><a href='?p=".$segundo."'>$segundoNumero </a></li>"; 
            $actual = $p;
            $actualNumero = $p+1;
            $enlaces["actual"]= "<li class='active'><a href='?p=".$actual."'>$actualNumero </a></li>"; 
            $cuarto = $p+1;
            $cuartoNumero = $p+2;
            $enlaces["cuarto"]= "<li><a href='?p=".$cuarto."'>$cuartoNumero </a></li>";
            $quinto = $p+2;
            $quintoNumero = $p+3;
            $enlaces["quinto"]= "<li><a href='?p=".$quinto."'>$quintoNumero </a></li>"; 
            $siguiente = $p+1;
            $enlaces["siguiente"] = "<li><a href='?p=".$siguiente."'>&gt; </a></li>"; 
        }
        return $enlaces;
   }
}

?>