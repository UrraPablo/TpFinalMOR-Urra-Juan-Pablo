<?php

class Responsable{

    // ATRIBUTOS 
    private $nombre; // string
    private $apellido; // string
    private $nroEmpleado; // int
    private $nroLicencia; // int
    private $mensaje; 

    // CONSTRUCTOR 
    public function __construct()
    {
        $this->nroEmpleado="";
        $this->nroLicencia="";
        $this->nombre="";
        $this->apellido="";
       
        
        
    } // fin constructor

    // METODO CARGAR
    public function cargar($name,$ap,$nroEmp,$nroLic){
        $this->setNombre($name);
        $this->setApellido($ap);
        $this->setNroEmpleado($nroEmp);
        $this->setNroLicencia($nroLic);
    }// fin metodo cargar

  /******************************************************************************** */  
    // METODOS GET
    public function getNombre(){
        return $this->nombre;
    }// fin metodo get

    public function getApellido(){
        return $this->apellido;
    }// fin metodo get

    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }// fin metodo get

    public function getNroLicencia(){
        return $this->nroLicencia;
    }// fin metodo get

    public function getMensaje(){
        return $this->mensaje;
    }// fin metodo get
/**************************************************************************************************** */
    // METODOS SET
    public function setNombre($n){
        $this->nombre=$n;
    }// fin metodo set

    public function setApellido($ap){
        $this->apellido=$ap;
    }// fin metodo set

    public function setNroEmpleado($nroE){
        $this->nroEmpleado=$nroE;
    }// fin metodo set

    public function setNroLicencia($nroL){
        $this->nroLicencia=$nroL;
    }// fin metodo set

    public function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }// fin metodo set

/*************************************************************** */

/**  MOSTRAR  RESPONSABLES */
public function mostrarResponsable(){
    $colResponsables=$this->listar();
    foreach($colResponsables as $unResponsable){
        echo("Nombre Responsable: ".$unResponsable->getNombre()."\n");
        echo("Nro Empleado: ".$unResponsable->getNroEmpleado()."\n");  

    }// fin for 
}// fin metodo mostrar responsable 

/** METODO RECUPERAR RESPONSABLE 
 * @param int nroEm
 * @return object
 */
public function recuperarResponsable($nroEm){
    $responsable=null;
    $colResponsables=$this->listar();
    foreach($colResponsables as $unRes){
        if($unRes->getNroEmpleado()==$nroEm){
            $responsable=$unRes; 

        }// fin if 

    }// fin for 
    return $responsable; 

}// fin metodo recuperar responsable  



/******************************************************************** */

     /**METODO BUSCAR 
     * Recupera los datos del responsable  en funcion del N° empleado  
     * @param nro
     * @return booelan
     * */
    public function buscar($nro){
        // OBJ: bd     STRING: consulta    BOOLEAN: salida     ARRAY: PUNTERO
        $bd=new BaseDatos();
        $consulta="SELECT * FROM responsable  WHERE  rnumeroempleado=".$nro;
        $salida=false;
        if($bd->Iniciar()){
            if($bd->Ejecutar($consulta)){
                if($puntero=$bd->Registro()){
                    $this->setNroEmpleado($nro);
                    $this->setNombre($puntero['rnombre']);
                    $this->setApellido($puntero['rapellido']);
                    $this->setNroLicencia($puntero['rnumerolicencia']);
                    $salida=true;

                }// fin if

            }// fin if 
            else{
                $this->setMensaje($bd->getError());

            }// fin else

        }// fin if 
        else{
            $this->setMensaje($bd->getError());

        }// fin else

        return $salida;

    }// fin metodo buscar

/***************************************************************************************************** */
     /**METODO listarViajes
     * devuelve un array de los datos de la  empresa 
     * @return array
     */
    public function listar(){
        // OBJ: bd,responsable_   STRING: nombre, apellido,    
        //   INT: nroLicencia, nroEmpleado    ARRAY: puntero,arrayResponsable
        $arrayResponsable=null; 
        $bd=new BaseDatos(); // creo un objeto de la base de datos para poder realizar las consultas 
        $consulta="SELECT * FROM responsable"; // selecciona todos los datos de la tabla viajes 
        if($bd->Iniciar()){// inicia la base de dato
            if($bd->Ejecutar($consulta)){
                $arrayResponsable=array(); // almacena los campos de la clase viaje
                while($puntero=$bd->Registro()){
                    $nroLicencia=$puntero['rnumerolicencia'];
                    $nroEmpleado=$puntero['rnumeroempleado'];
                    $nombre=$puntero['rnombre'];
                    $apellido=$puntero['rapellido'];
                    $objR=new Responsable();// creo el obj responsable 

                    $objR->cargar($nombre,$apellido,$nroEmpleado,$nroLicencia);

                    array_push($arrayResponsable,$objR);


                }  // fin while 
            }// fin if 
            else{
                $this->setMensaje($bd->getError());
            }// fin else

        }// fin if 
        else{
            $this->setMensaje($bd->getError());

        }// fin else
        return $arrayResponsable;

    }// fin metodo listarViaje


/************************************************************************************************* */
     /** METODO INFRESAR 
     * añade a la tabla de la base de datos una nueva empresa
     * @return boolean
     */
    public function insertar(){
        // BOOLEAN: respuesta    OBJ: bd     STRING: consulta     
        $respuesta=false; 
        $bd=new BaseDatos();


        $consulta="INSERT INTO responsable(rnumeroempleado,rnumerolicencia,rnombre,rapellido)
         VALUES('".$this->getNroEmpleado()."','".$this->getNroLicencia()."','".$this->getNombre()."','".$this->getApellido()."')";
        // llamado a la BD para ejecutar la consulta
        if($bd->Iniciar()){
         if($bd->Ejecutar($consulta)){
            $respuesta=true; 

         }// fin if 
         else{
            $this->setMensaje($bd->getError());
         }// fin else

        }// fin if
        else{
            $this->setMensaje($bd->getError());
        } 
        return $respuesta; 
    }// fin metodo insertar


/********************************************************************************************************* */
     /**METODO MODIFICAR
     * actualiza un campo de la tabla viaje 
     * @return boolean
     */
    public function modificar(){
        //OBJ: bd       BOOLEAN: salida  STRING: consulta
        $bd=new BaseDatos();
        $salida=false;

        $consulta="UPDATE responsable SET rnumerolicencia='".$this->getNroLicencia()."',
        rnombre='".$this->getNombre()."',rapellido='".$this->getApellido()."' WHERE  rnumeroempleado='".$this->getNroEmpleado()."'";
        if($bd->Iniciar()){
            if($bd->Ejecutar($consulta)){
                $salida=true;

            }// fin if
            else{
                $this->setMensaje($bd->getError());

            }// fin else


        }// fin if 
        else{
            $this->setMensaje($bd->getError());
        }// fin else

        return $salida; 

    }// fin metodo modificar

    /*************************************************************************************************** */
     /** METODO ELIMINAR 
     * Elimina un registro en funcion del id de viaje
     * @return boolean
     */
    public function eliminar(){
        // OBJ: bd      STRING: consulta     BOOLEAN: salida
        $bd=new BaseDatos();
        $salida=false;
        if($bd->Iniciar()){
            $consulta="DELETE FROM responsable WHERE rnumeroempleado='".$this->getNroEmpleado()."'";
            if($bd->Ejecutar($consulta)){
                $salida=true; 

            }// fin if
            else{
                $this->setMensaje($bd->getError());

            }// fin else

        }// fin if
        else{
            $this->setMensaje($bd->getError());


        }// fin else

        return $salida; 
    }// fin metodo eliminar



    // METODO TO STRING
    public function __toString()
    {
        return "Nombre: ".$this->getNombre()."   Apellido: ".$this->getApellido()."\n"
        ."Nro Empleado: ".$this->getNroEmpleado()."\n"."Nro Licencia: ".$this->getNroLicencia()."\n"; 

    }// fin to string



}// fin clase Responsable


?>