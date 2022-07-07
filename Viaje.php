<?php

class Viaje{

    // ATRIBUTOS 
    private $idViaje; // int 
    private $vDestino; // string
    private $vCantMaxPasajeros; // int
    private $empresa; // obj empresa
    private $importeViaje; // float
    private $tipoAsiento; // string 
    private $idaVuelta; // boolean   
    private $colPasajeros; // array obj pasajeros
    private $responsable; // obj de responsable 
    private $mesajeOperacion; 
    // CREAR CREAR UN OBJ RESPONSABLE ANTES DE CARGAR A LA CLASE VIAJE 

    // METODO CONSTRUCTOR 
    public function __construct()
    {
        $this->idViaje=""; 
        $this->vDestino="";
        $this->vCantMaxPasajeros="";
        $this->docResponsable="";
        $this->empresa="";
        $this->nroEmpleResponsable="";
        $this->importeViaje="";
        $this->tipoAsiento="";
        $this->idaVuelta="";
        $this->colPasajeros="";
        $this->responsable="";
    }// fin constructor 

    // METODO CARGAR DATOS 
    public function cargar($id,$destino,$maximoPasajeros,$objEmpresa,$importe,$tipoAs,$ida_Vuelta,$objResponsable){
        $this->setIdViaje($id);
        $this->setDestino($destino);
        $this->setMaxPasajeros($maximoPasajeros);
        $this->setEmpresa($objEmpresa);
        $this->setImporte($importe);
        $this->setIdaVuelta($ida_Vuelta);
        $this->setTipoAsiento($tipoAs);
        //$this->setPasajeros($objColPasajeros);
        $this->setResponsable($objResponsable);
    }// fin metodo cargar

    // METODOS GET
    public function getIdViaje(){
        return $this->idViaje;
    }// fin metodo get

    public function getDestino(){
        return $this->vDestino;
    }// fin metodo get
    public function getMaxPasajeros(){
        return $this->vCantMaxPasajeros;
    }// fin metodo get
    public function getEmpresa(){
        return $this->empresa;
    }// fin metodo get

    public function getImporte(){
        return $this->importeViaje;
    }// fin metodo get
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }// fin metodo get
    public function getIdaVuelta(){
        return $this->idaVuelta;
    }// fin metodo get

    public function getPasajeros(){
        return $this->colPasajeros;
    }// fin metodo get

    public function getResponsable(){
        return $this->responsable;
    }// fin metodo get

    public function getMensaje(){
        return $this->mesajeOperacion;
    }// fin metodo get

    // METODOS SET************************************************************************************************
    public function setIdViaje($idV){
        $this->idViaje=$idV;
    }// fin metodo set

    public function setDestino($dest){
        $this->vDestino=$dest;
    }// fin metodo set

    public function setMaxPasajeros($max){
        $this->vCantMaxPasajeros=$max;
    }// fin metodo set


    public function setEmpresa($empr){
        $this->empresa=$empr;
    }// fin metodo set

    public function setImporte($price){
        $this->importeViaje=$price;
    }// fin metodo set

    public function setTipoAsiento($tipoA){
        $this->tipoAsiento=$tipoA;
    }// fin metodo set

    public function setIdaVuelta($idaV){
        $this->idaVuelta=$idaV;
    }// fin metodo set

    public function setPasajeros($pasajeros){
        $this->colPasajeros=$pasajeros;
    }// fin metodo set

    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }// fin metodo set

    public function setMensaje($error){
        $this->mensajeOperacion=$error;
    }// fin metodo set

    /******************************************************************************************************************* */
   
    /** METODO VERIFICACION DE DESTINO REPETIDO
     * @param string destino
     * @return string
     */
    public function destinoRepetido($destino){
        $colViajes=$this->listar();// almacena la coleccion de viajes en la BD
        $salir=true;
        $nuevoDestino=$destino; // asume que el usuario no quiere cambiar el destino repetido
        $i=0;  
        $tam=sizeof($colViajes);
        $destino=strtoupper($destino); 
        while( $i<$tam && $salir){
            $destinoBD=$colViajes[$i]->getDestino();
            $destinoBD=strtoupper($destinoBD);
            if($destinoBD==$destino){
                $salir=false;
                $nuevoDestino=""; 
            }// fin if 

            $i++; 
            
        }// fin while 
        return $nuevoDestino; 
    }// fin metodo destino repetido

    /** MEODO CAPACIDADMAXIMA 
     * VERIFICA QUE LA CAPACIDAD MAXIMA DEL VIAJE NO SUPERRE A LA CANTIDAD DE PASAJEROS 
     * @param int cantMaximo
     * @return boolean
     */
    public function capacidadMaxima(){
        $respuesta=false; // valor por defecto que indica que no se supera la capacidad maxima 
        $capacidadViaje=$this->getMaxPasajeros(); // almacena la cantidad maxima de pasajeros
        $colPasajeros=$this->getPasajeros();// almacena la cantidad de pasajeros de este viaje 
        $cantPasajeros=sizeof($colPasajeros);


        if($capacidadViaje<=$cantPasajeros){
            echo("No se puede agregar mas pasajeros al viaje. \n Supera la capacidad maxima \n");
            $respuesta=true; 
        }// fin if 
        return $respuesta; 

    }// fin metodo capacidadMaxima


    /** METODO MOSTRAR DESTINOS DE VIAJE */
    public function mostrarDestinos(){
        $colViajes=$this->listar();
        
        foreach($colViajes as $unViaje){
            echo("ID Viaje; ".$unViaje->getIdViaje()."\n"
            ."Destino: ".$unViaje->getDestino()."\n"); 
            echo("\n"); 
        
        }// fin for
    } // fin metodo mostrarDestinos



    // METODO TO STRING*************************************************************************************
    public function __toString()
    {
        return "ID:".$this->getIdViaje()."\n"."Destino:".$this->getDestino()."\n"
        ."Cantidad Maxima: ".$this->getMaxPasajeros()."\n"
        ."Importe: ".$this->getImporte()."\n"
        ."Asiento: ".$this->getTipoAsiento()."\n"
        ."Ida y Vuelta del Viaje: ".$this->getIdaVuelta()."\n"
        ."Datos de los Pasajeros : \n"
        .$this->getPasajeros()."\n"
        ."Dato del Responsable del Viaje \n"
        .$this->getResponsable()."\n".
        "Datos de la Empresa que realiza el viaje :\n".
        $this->getEmpresa()."\n"; 
    }// fin to string 

    /*********************************************************************************************************** */
    /**METODO BUSCAR 
     * Recupera los datos del viaje en funcion del Id 
     * @param id
     * @return obj
     * */
    public function buscar($id){
        // OBJ: bd     STRING: consulta    BOOLEAN: salida     ARRAY: PUNTERO
        $bd=new BaseDatos();
        $salida=false;  

        $consulta="SELECT * FROM  viaje WHERE  idviaje=".$id;
        $salida=false;
        if($bd->Iniciar()){
            if($bd->Ejecutar($consulta)){
                if($puntero=$bd->Registro()){
                    $this->setIdViaje($id);
                    $this->setDestino($puntero['vdestino']);
                    $this->setMaxPasajeros($puntero['vcantmaxpasajeros']);
                    $idEmpresa=$puntero['idempresa']; // recupero el id de la empresa 
                    $objEmpresa=new Empresa();// creo el obj empresa
                    $objEmpresa->buscar($idEmpresa);//  
                    $objEmpleadoR=new Responsable();// creo el obj responsable
                    $nroR=$puntero['rnumeroempleado'];// obtengo el valor de nroEmpleado de la BD
                    $objEmpleadoR->buscar($nroR);// 
                    $this->setImporte($puntero['vimporte']);
                    $this->setTipoAsiento($puntero['tipoAsiento']);
                    $this->setIdaVuelta($puntero['idayvuelta']);
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


  /************************************************************************************************** */  
    /**METODO listarViajes
     * devuelve un array de los datos de los viajes 
     * @return array
     */
    public function listar(){
        // OBJ: bd,Viaje_   STRING: consulta, destino,doc,asiento,idaVuelta    
        //BOOLEAN:   INT: idV,cantAsientoMax,idE,numEmpl    ARRAY: puntero,arrayViaje   FLOAT: importe
    
        $bd=new BaseDatos(); // creo un objeto de la base de datos para poder realizar las consultas 
        $consulta="select * from viaje"; // selecciona todos los datos de la tabla viajes 
        if($bd->Iniciar()){// inicia la base de dato
            if($bd->Ejecutar($consulta)){
                $arrayViaje=array(); // almacena los campos de la clase viaje
                while($puntero=$bd->Registro()){
                    $viaje_=new Viaje();
                    $objEmpresa=new Empresa();
                    $objResponsable=new Responsable();

                    $idV=$puntero['idviaje'];
                    $viaje_->buscar($idV);
                    //$destino=$puntero['vdestino'];
                    //$cantAsientoMax=$puntero['vcantmaxpasajeros'];
                    $objEmpresa->buscar($puntero['idempresa']);
                    $objResponsable->buscar($puntero['rnumeroempleado']); 
                    //$viaje_->setResponsable($objResponsable);
                    //$viaje_->setEmpresa($objEmpresa); 
                    //$importe=$puntero['vimporte'];
                    //$asiento=$puntero['tipoAsiento'];
                    //$idaVuelta=$puntero['idayvuelta'];
                    //cargar($id,$destino,$maximoPasajeros,$objEmpresa,$importe,$tipoAs,$ida_Vuelta,$objColPasajeros,$objResponsable)
                    //$viaje_->cargar($idV,$destino,$cantAsientoMax,$objEmpresa,$importe,$asiento,$idaVuelta,$objResponsable);
                    array_push($arrayViaje,$viaje_);


                }  // fin while 
            }// fin if 
            else{
                $this->setMensaje($bd->getError());
            }// fin else

        }// fin if 
        else{
            $this->setMensaje($bd->getError());

        }// fin else
        return $arrayViaje;

    }// fin metodo listarViaje

    /********************************************************************************************************* */
    /** METODO INFRESAR VIAJE
     * añade a la tabla de la base de datos un nuevo viaje
     * @return boolean
     */
    public function insertar(){
        // BOOLEAN: respuesta    OBJ: bd     STRING: consulta     
        $respuesta=false; 
        $bd=new BaseDatos();
        $objEmpresa=$this->getEmpresa();// llamado al obj empresa 
        $objResponsable=$this->getResponsable();// llamo al obj responsable 
        $nroEmpleado=$objResponsable->getNroEmpleado();
        $idEmpresa=$objEmpresa->getId();
        
        $consulta="INSERT INTO viaje(idviaje,vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte,tipoAsiento,idayvuelta)
         VALUES('".$this->getIdViaje()."','".$this->getDestino()."','".$this->getMaxPasajeros()."',
         '".$idEmpresa."','".$nroEmpleado."','".$this->getImporte()."','".$this->getTipoAsiento()."','".$this->getIdaVuelta()."')";
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

    /********************************************************************************************** */
    /**METODO MODIFICAR
     * actualiza un campo de la tabla viaje 
     * @return boolean
     */
    public function modificar(){
        //OBJ: bd       BOOLEAN: salida  STRING: consulta
        $bd=new BaseDatos();
        $salida=false;
        $objEmp=$this->getEmpresa();
        $objRes=$this->getResponsable();
        $id=$objEmp->getId();
        $nro=$objRes->getNroEmpleado();
        $consulta="UPDATE viaje SET vdestino='".$this->getDestino()."' ,vcantmaxpasajeros='".$this->getMaxPasajeros()."'
        , idempresa='".$id."',rnumeroempleado='".$nro."',vimporte='".$this->getImporte()."',tipoAsiento='".$this->getTipoAsiento()."'
        ,idayvuelta='".$this->getIdaVuelta()."' WHERE idViaje='".$this->getIdViaje()."' ";
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

/************************************************************************************************ */
    /** METODO ELIMINAR 
     * Elimina un registro en funcion del id de viaje
     * @return boolean
     */
    public function eliminar(){
        // OBJ: bd      STRING: consulta     BOOLEAN: salida
        $bd=new BaseDatos();
        $salida=false;

        if($bd->Iniciar()){
            $consulta="DELETE FROM viaje WHERE idviaje='".$this->getIdViaje()."'";

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





}// fin clase viaje


?>