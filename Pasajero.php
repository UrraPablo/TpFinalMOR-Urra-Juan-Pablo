<?php

class Pasajeros{
    // ATRIBUTOS 
    private $nombre; // string
    private $apellido; // string
    private $numDoc; // int 
    private $telefono; // string
    private $objViaje; // obj viaje 
    private $mensaje; 

    // CONSTRUTOR
    public function __construct()
    {
        $this->nombre="";
        $this->apellido="";
        $this->numDoc=0;
        $this->telefono="";
        $this->idViaje=0;       
    }// fin constructor 

    // CARGA DE DATOS DE LA CLASE PASAJERO , PROVINIENTE DE LA BASE DE DATO
    public function cargar($name,$ap,$nro,$phone,$Viaje){
        $this->setNombre($name);
        $this->setApellido($ap);
        $this->setDni($nro);
        $this->setTelefono($phone);
        $this->setViaje($Viaje); 

    }// fin metodo cargar
/******************************************************************************************** */
    // METODOS GET
    public function getNombre(){
        return $this->nombre;
    }// fin metodo get

    public function getApellido(){
        return $this->apellido;
    }// fin metodo get

    public function getDni(){
        return $this->numDoc;
    }// fin metodo get

    public function getTelefono(){
        return $this->telefono;
    }// fin metodo get


    public function getViaje(){
        return $this->objViaje;
    }// fin metodo get

    public function getMensaje(){
        return $this->mensaje;
    }// fin metodo get

  /******************************************************************************************* */  

    // METODOS SET
    public function setNombre($n){
        $this->nombre=$n;
    }// fin metodo set

    public function setApellido($ap){
        $this->apellido=$ap;
    }// fin metodo set

    public function setDni($dni){
        $this->numDoc=$dni;
    }// fin metodo set

    public function setTelefono($tel){
        $this->telefono=$tel;
    }// fin metodo set

    public function setViaje($unViaje){
        $this->objViaje=$unViaje;
    }// fin metodo set



    public function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }// fin metodo set

    /***************************************************** */
 
    /** METODO PASAJERO REPETIDO 
     * @param obj pasajero
     * @param int dni
     * @return array
     */
    public function pasajeroRepetido($dni){
            // VERIFICACION DE UNICIDAD DEL PASAJERO EN LA BD
            $colPasajeroBD=$this->listar();// recupera todos los pasajeros de la BD
            $i=0;
            $dniNuevo=$dni; // valor del nuevo dni por defecto INDICA QUE EL DNI INGRESADO NO ESTA REPETIDO 
            $salida=true;// bandera
            $repetido=false; // valor por defecto (NO ESTA REPETIDO)
            $max=sizeof($colPasajeroBD);  
            while($salida && $i<$max){
                if($dni==$colPasajeroBD[$i]->getDni()){ 
                    echo("El dni del pasajero ya se encuentra en la base de datos\n");
                    echo("¿Desea ingresar otro DNI?  Si/No \n");
                    $op=strtoupper(trim(fgets(STDIN))); 
                    if($op=="SI"){
                        echo("Ingrese nuevamente el DNI: \n");
                        $dniNuevo=trim(fgets(STDIN));
                        $salida=false; 
                        $repetido=false;

                    }// fin if 
                    else{
                        echo("El pasajero NO se cargo a la Base de Datos\n");
                        $salida=true; 
                        $repetido=$salida; 

                    }// fin else 


                }// fin if 
                $i++; 

            }// fin while 

            $salidaDni["dni"]=$dniNuevo;
            $salidaDni["respuesta"]=$repetido;
            return $salidaDni; 


    }// fin metodo pasajero repetido

    /***************************************************/
  

    /************************************************** */
       /**METODO BUSCAR 
     * Recupera los datos de la empresa en funcion del Id 
     * @param id
     * @return booelan
     * */
    public function buscar($id){
        // OBJ: bd     STRING: consulta    BOOLEAN: salida     ARRAY: PUNTERO
        $bd=new BaseDatos();
        $consulta="SELECT * FROM  pasajero WHERE  rdocumento=".$id;
        $salida=false;
        if($bd->Iniciar()){
            if($bd->Ejecutar($consulta)){
                if($puntero=$bd->Registro()){
                    $this->setDni($id);
                    $this->setNombre($puntero['pnombre']);
                    $this->setApellido($puntero['papellido']);
                    $this->setTelefono($puntero['ptelefono']);
                    $objV=new Viaje(); // creo un viaje nuevo
                    $id=$puntero['idviaje']; // recupero el id de viaje de la BD
                    $objV->buscar($puntero['idviaje']); // busco ese id y recupero todos los datos de ese viaje 
                    $this->setViaje($objV);// seteo el obj viaje al obj pasajero

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

    /************************************************************************************************* */

     /**METODO listarViajes
     * devuelve un array de los datos de los pasajeros 
     * @return array
     */
    public function listar(){
        // OBJ: bd,empresa_   STRING: consulta, nombre,direccion    
        //   INT: idE    ARRAY: puntero,arrayEmpresa 
    
        $bd=new BaseDatos(); // creo un objeto de la base de datos para poder realizar las consultas 
        $consulta="select * from pasajero"; // selecciona todos los datos de la tabla viajes 
        if($bd->Iniciar()){// inicia la base de dato
            if($bd->Ejecutar($consulta)){
                $arrayPasajero=array(); // almacena los campos de la clase viaje
                while($puntero=$bd->Registro()){
                    $dni=$puntero['rdocumento'];
                    //$nombre=$puntero['pnombre'];
                    //$apellido=$puntero['papellido'];
                    //$tef=$puntero['ptelefono'];

                    //$objViaje=new Viaje();// creo un nuevo objViaje
                    $objPasajero=new Pasajeros();// creo un nuevo pasajero
                    $objPasajero->buscar($dni);// carga al pasajero (si lo encuentra) con el dni (en la base de datos)
                   // $objViaje->buscar($puntero['idviaje']); // recupera el obj viaje de la BD
                    //$objPasajero->setViaje($objViaje);                
                    //$_pasajero->cargar($nombre,$apellido,$dni,$tef,$objViaje);
                    array_push($arrayPasajero,$objPasajero);


                }  // fin while 
            }// fin if 
            else{
                $this->setMensaje($bd->getError());
            }// fin else

        }// fin if 
        else{
            $this->setMensaje($bd->getError());

        }// fin else
        return $arrayPasajero;

    }// fin metodo listarViaje

    /****************************************************************************************************** */
     /** METODO INGRESAR 
     * añade a la tabla de la base de datos un nuevo pasajero
     * 
     * @return boolean
     */
    public function insertar(){
        // BOOLEAN: respuesta    OBJ: bd     STRING: consulta     
        $respuesta=false; 
        $bd=new BaseDatos();

        $objViaje=$this->getViaje();// obj viaje 
        $idV=$objViaje->getIdViaje();// almaceno el obj viaje 
        $consulta="INSERT INTO pasajero(rdocumento,pnombre,papellido,ptelefono,idviaje)
         VALUES('".$this->getDni()."','".$this->getNombre()."','".$this->getApellido()."','".$this->getTelefono()."','".$idV."')";
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

    /*********************************************************************************************************** */
     /**METODO MODIFICAR
     * actualiza un campo de la tabla viaje 
     * @return boolean
     */
    public function modificar(){  
        //OBJ: bd       BOOLEAN: salida  STRING: consulta
        $bd=new BaseDatos();
        $salida=false;
        $objV=$this->getViaje();
        $id=$objV->getIdViaje();// obtengo el id del obj viaje 
        $consulta="UPDATE pasajero SET rdocumento='".$this->getDni()."' ,pnombre='".$this->getNombre()."',papellido='".$this->getApellido()."',
        ptelefono='".$this->getTelefono()."',idviaje='".$id."' WHERE rdocumento='".$this->getDni()."'";
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

    /*************************************************************************************************************** */
     /** METODO ELIMINAR 
     * Elimina un registro en funcion del id de viaje
     * @return boolean
     */
    public function eliminar(){
        // OBJ: bd      STRING: consulta     BOOLEAN: salida
        $bd=new BaseDatos();
        $salida=false;
        if($bd->Iniciar()){
            $consulta="DELETE FROM pasajero WHERE rdocumento='".$this->getDni()."'";
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




    /** METODO TO STRING */
    public function __toString()
    {
        return "Pasjero: ".$this->getNombre()." ".$this->getApellido()."\n"
        ."DNI: ".$this->getDni()."\n"."Telefono: ".$this->getTelefono()."\n"
        ."Datos del Viaje: \n".$this->getViaje()."\n";
    }// fin to string





}// fin clase pasajero



?>