<?php
class Persona{
    private $id;
    private $imagen;
    private $nombre;
    private $apellido;
    private $edad;
    private $sexo;
    private $casa;
    private $padre;
    private $madre;
    private $conyuge;
    private $hijos;
    private $hermanos;
    private $stringHijos = '';
    private $stringHermanos = '';
    private $stringPadre = '';
    private $stringMadre = '';

    function __construct($nombre, $apellido, $edad, $sexo, $casa) {
        $this->id = uniqid('', true);
        $this->nombre =  $nombre;
        $this->apellido =  $apellido;
        $this->edad =  $edad;
        $this->sexo =  $sexo;
        $this->casa =  $casa;
        $this->imagen =  "img/".$apellido.$nombre.".png";
        $this->padre =  '';
        $this->madre =  '';
        $this->conyuge =  '';
        $this->hijos =  [];
        $this->hermanos =  [];
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }

    public function setPadre($padre){
        $this->padre = $padre;
        $this->stringPadre = $padre->getNombre() . "&nbsp" . $padre->getApellido();
    }

    public function getPadre(){
        return $this->padre;
    }

    public function setMadre($madre){
        $this->madre = $madre;
        $this->stringMadre = $madre->getNombre() . "&nbsp" . $madre->getApellido();
    }

    public function getMadre(){
        return $this->madre;
    }

    public function setConyuge($conyuge) {
        if ($conyuge !== $this){ // Evitamos que se pase como conyuge a si mismo 
            $this->conyuge = $conyuge->getNombre() . " " . $conyuge->getApellido();
            // $conyuge->setConyuge($this->nombre . " " . $this->apellido);  // Se que esto está mal porque no pasa como parámetro un objeto sino un string, pero si paso objeto entra en bucle y no se por qué
            $conyuge->conyuge = $this->nombre . " " . $this->apellido; // No acabo de entender por que puedo cambiar el parametro de otro objeto sin usar un getter, pero si uso setConyuge no funciona
        } else{
            $this->conyuge = "ERROR:<br>Incesto eXtreme"; // Si se intenta pasar como conyuge a si mismo, se avisa de que ni los Targaryen se atrevieron a tanto
        }
    }

    public function getConyuge(){
        return $this->conyuge;
    }

    public function addHijo($hijo){
        if ($this->sexo == 'Hombre'){
            $hijo->setPadre($this);
        } else {
            $hijo->setMadre($this);
        }
        array_push($this->hijos, $hijo);

        foreach ($this->hijos as $hermano) {
            if ($hermano !== $hijo) { // No incluir el mismo hijo
                $hermano->addHermano($hijo); // Agrega los hermanos ya existentes
                $hijo->addHermano($hermano); // Agrega el nuevo hermano
            }
        }

    }

    public function getHijos(){
        return $this->hijos;
    }

    private function addHermano($bro){
        if (!in_array($bro, $this->hermanos)) {  // nos aseguramos de que el hermano NO está en la lista de hermanos
        array_push($this->hermanos, $bro); // Sería lo mismo que $this->hermanos[] = $bro; pero esto último lo veo mas lioso
    }
    }

    public function getHermanos(){
        return $this->hermanos;
    }

    public function __toString() {
        

        foreach ($this->hijos as $hijo){
            $this->stringHijos .= $hijo->getNombre() . "&nbsp;" . $hijo->getApellido() . ", ";
        }

        foreach ($this->hermanos as $bro){
            $this->stringHermanos .= $bro->getNombre() . "&nbsp;" . $bro->getApellido() . ", ";
        }

        // Quitamos la última coma
        $this->stringHijos = rtrim($this->stringHijos, ', ');
        $this->stringHermanos = rtrim($this->stringHermanos, ', ');

        return "<td>{$this->id}</td>
                <td><img src='{$this->imagen}'></td>
                <td>{$this->nombre}</td>
                <td>{$this->apellido}</td>
                <td>{$this->edad}</td>
                <td>{$this->sexo}</td>
                <td>{$this->casa}</td>
                <td>{$this->stringPadre}</td>
                <td>{$this->stringMadre}</td>
                <td>{$this->conyuge}</td>
                <td>{$this->stringHijos}</td>
                <td>{$this->stringHermanos}</td>";
    }

}

?>