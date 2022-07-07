<?php

class Empresa {
    private $idEmpresa; // int
    private $eNombre; // string
    private $eDireccion; // string
    private $mensajeOperacion; // string


    // CONSTRUCTOR 
    public function __construct()
    {
        $this->idEmpresa="";
        $this->eNombre="";
        $this->eDireccion="";
    }// fin metodo constructor

    // METODO CARGAR DATOS 
    public function cargar($id,$name,$dire){
        $this->setId($id);
        $this->setNombre($name);
        $this->setDire($dire);
    }// fin metodo cargar

    // METODOS GET AND SET
    public function getId(){
        return $this->idEmpresa; 
    }// fin metodo get

    public function getNombre(){
        return $this->eNombre; 
    }// fin metodo get

    public function getDire(){
        return $this->eDireccion; 
    }// fin metodo get


    public function getMensaje(){
        return $this->mensajeOperacion; 
    }// fin metodo get
 
    // METODOS SET 
    public function setNombre($nombre){
        $this->eNombre=$nombre; 

    }// fin metodo set

    public function setDire($dire){
        $this->eDireccion=$dire; 

    }// fin metodo set


    public function setId($id){
        $this->idEmpresa=$id; 

    }// fin metodo set

    public function setMensaje($mensaje){
        $this->idEmpresa=$mensaje; 

    }// fin metodo set

//************************************************************************************** */

/** METODO MOSTRAR EMPRESA */
public function mostrarEmpresa(){
    $colEmpresas=$this->listar();
    foreach($colEmpresas as $unaEmpresa){
        echo("Nombre Empresa: ".$unaEmpresa->getNombre()."\n");
        echo("ID: ".$unaEmpresa->getId()."\n");  

    }// fin for 
}// fin metodo mostrar empresa



/*************************************************************************************** */

     /**METODO BUSCAR 
     * Recupera los datos de la empresa en funcion del Id 
     * @param id
     * @return booelan
     * */
    public function buscar($id){
        // OBJ: bd     STRING: consulta    BOOLEAN: salida     ARRAY: PUNTERO
        $bd=new BaseDatos();
        $consulta="SELECT * FROM  empresa WHERE  idempresa=".$id;
        $salida=false;
        if($bd->Iniciar()){
            if($bd->Ejecutar($consulta)){
                if($puntero=$bd->Registro()){
                    $this->setId($id);
                    $this->setNombre($puntero['enombre']);
                    $this->setDire($puntero['edireccion']);
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
//************************************************************************************************************************ */

     /**METODO listarViajes
     * devuelve un array de los datos de la  empresa 
     * @return array
     */
    public function listar(){
        // OBJ: bd,empresa_   STRING: consulta, nombre,direccion    
        //   INT: idE    ARRAY: puntero,arrayEmpresa 
    
        $bd=new BaseDatos(); // creo un objeto de la base de datos para poder realizar las consultas 
        $consulta="select * from empresa"; // selecciona todos los datos de la tabla viajes 
        if($bd->Iniciar()){// inicia la base de dato
            if($bd->Ejecutar($consulta)){
                $arrayEmpresa=array(); // almacena los campos de la clase viaje
                while($puntero=$bd->Registro()){
                    $idE=$puntero['idempresa'];
                    $nombre=$puntero['enombre'];
                    $direccion=$puntero['edireccion'];
                    $empresa__=new Empresa();
                    $empresa__->cargar($idE,$nombre,$direccion);
                    array_push($arrayEmpresa,$empresa__);


                }  // fin while 
            }// fin if 
            else{
                $this->setMensaje($bd->getError());
            }// fin else

        }// fin if 
        else{
            $this->setMensaje($bd->getError());

        }// fin else
        return $arrayEmpresa;

    }// fin metodo listarViaje
//******************************************************************************************************************************* */
     /** METODO INFRESAR 
     * añade a la tabla de la base de datos una nueva empresa
     * @return boolean
     */
    public function insertar(){
        // BOOLEAN: respuesta    OBJ: bd     STRING: consulta     
        $respuesta=false; 
        $bd=new BaseDatos();


        $consulta="INSERT INTO empresa(idempresa,enombre,edireccion)
         VALUES('".$this->getId()."','".$this->getNombre()."','".$this->getDire()."')";
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
//****************************************************************************************************************** */
     /**METODO MODIFICAR
     * actualiza un campo de la tabla viaje 
     * @return boolean
     */
    public function modificar(){
        //OBJ: bd       BOOLEAN: salida  STRING: consulta
        $bd=new BaseDatos();
        $salida=false;

        $consulta="UPDATE empresa SET enombre='".$this->getNombre()."' ,edireccion='".$this->getDire()."' WHERE idempresa='".$this->getId()."'";
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
//***************************************************************************************************************************** */
     /** METODO ELIMINAR 
     * Elimina un registro en funcion del id de viaje
     * @return boolean
     */
    public function eliminar(){
        // OBJ: bd      STRING: consulta     BOOLEAN: salida
        $bd=new BaseDatos();
        $salida=false;
        if($bd->Iniciar()){
            $consulta="DELETE FROM empresa WHERE idempresa='".$this->getId()."'";
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




    /**METODO TO STRING  */
    public function __toString()
    {
        return "La empresa : ".$this->getNombre()." con el N° de identificacion: ".$this->getId()."\n"
        ."Ubicado en: ".$this->getDire()."\n";
    }// fin to string 




}// fin clase empresa

?>