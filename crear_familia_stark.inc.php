<?php

    include_once('Persona.inc.php');

    $eddardStark = new Persona('Eddard', 'Stark', 45, 'Hombre', 'Stark');
    $catelynStark = new Persona('Catelyn', 'Stark', 40, 'Mujer', 'Stark');

    $robStark = new Persona('Rob', 'Stark', 25, 'Hombre', 'Stark');
    $sansaStark = new Persona('Sansa', 'Stark', 20, 'Mujer', 'Stark');
    $aryaStark = new Persona('Arya', 'Stark', 16, 'Mujer', 'Stark');
    $brandonStark = new Persona('Brandon', 'Stark', 13, 'Hombre', 'Stark');
    $rickonStark = new Persona('Rickon', 'Stark', 10, 'Hombre', 'Stark');

    $eddardStark->SetConyuge($catelynStark);

    $eddardStark->addHijo($robStark);
    $eddardStark->addHijo($sansaStark);
    $eddardStark->addHijo($aryaStark);
    $eddardStark->addHijo($brandonStark);
    $eddardStark->addHijo($rickonStark);

    $catelynStark->addHijo($robStark);
    $catelynStark->addHijo($sansaStark);
    $catelynStark->addHijo($aryaStark);
    $catelynStark->addHijo($brandonStark);
    $catelynStark->addHijo($rickonStark);

?>