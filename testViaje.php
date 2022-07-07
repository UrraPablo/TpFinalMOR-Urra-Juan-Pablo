<?php
// CLASE TEST-VIAJE 
include("Pasajero.php");
include("Empresa.php");
include("Responsable.php");
include("Viaje.php");
include("BaseDatos.php");

// Creacion de obj de cada clase 
$objEmpresa=new Empresa();
$objResponsable=new Responsable();
$bd=new BaseDatos();
$objPasajero=new Pasajeros();
$objViaje=new Viaje();



/**METODO OPERACION 
 * Devuelve la operacion a realizar 
 * @return int
 */
function operacion(){
    echo("Ingrese con un Nro la operacion que quiere realizar\n");
    echo("*************************************************************************************\n"); 
    echo("1) Modificar   2) Agregar   3) Eliminar   4) Mostrar datos   \n");

    echo("*************************************************************************************\n");
    $opreacion=trim(fgets(STDIN));
    $opreacion=(int)$opreacion;
    return $opreacion;
}// fin metodo operacion

/**METODO operarEn
 * @return int
 */
function operarEn(){
    echo("¿Sobre quien quiere realizar la operacion?\n");
    echo("*************************************************************************************\n"); 
    echo("1) Pasajeros   2) Responsable del viaje   3) Empresa de Viaje   4) Viajes   \n");
    echo("*************************************************************************************\n"); 
    $opreacion=trim(fgets(STDIN));
    $opreacion=(int)$opreacion;
    return $opreacion;
}// fin metodo

/**METODO OPERACION ESPECIFICA
 * @param int opreacion
 * @param int sobreClase
 */
function operacionEspecifica($operacion,$sobreClase){
    $operacion="$operacion";
    $sobreClase="$sobreClase";
    return ($operacion.$sobreClase);

}// fin metodo



/******************************************************************************************** */
//                  METODOS  MODIFICAR
/******************************************************************************************* */


 /** METODO MODIFICAR DATOS DEL PASAJERO
  * @param object objPasajero
  */
function modificarPasajero($objPasajero){
    // ARRAY: colPasajeros   INT: op, dniNuevo, k   STRING: nombre, apellido
    echo("¿A que pasajero desea modifiar sus datos?\n");
    $k=0; 
    $colPasajero=$objPasajero->listar();
    foreach($colPasajero as $unP){
        echo(($k+1)."  Nombre: ".$unP->getNombre()."  Apellido: ".$unP->getApellido()."   Telefono: ".$unP->getTelefono()."\n");
        echo("\n"); 
       $k++; 
   }// fin for
    $nroPasajero=(int)trim(fgets(STDIN));
    echo("**********************************************\n");       
    echo("¿Que dato del pasajero desea mofidicar?\n");
    echo("1) Nombre  2) Apellido   3) Telefono   \n");
    
    $op=(int)trim(fgets(STDIN));

    switch($op){
        case 1:
            echo("Ingrese el Nuevo Nombre del pasajero\n");
            $nuevoNombre=trim(fgets(STDIN)); 
            $colPasajero[$nroPasajero-1]->setNombre($nuevoNombre);
            $colPasajero[$nroPasajero-1]->modificar();
            echo("La modificacion se realizó con exito \n");
            break; 
            case 2:
                echo("ingrese el nuevo apellido del pasajero\n");
                $nuevoApellido=trim(fgets(STDIN)); 
                $colPasajero[$nroPasajero-1]->setApellido($nuevoApellido);
                $colPasajero[$nroPasajero-1]->modificar();
                echo("La modificacion se realizó con exito \n");
                break; 
                case 3:
                    echo("Ingrese el nuevo Telefono del Pasajero\n");
                    $telNuevo=trim(fgets(STDIN));
                    $colPasajero[$nroPasajero-1]->setTelefono($telNuevo);
                    $colPasajero[$nroPasajero-1]->modificar();
                    echo("La modificacion se realizó con exito \n");

                    break; 

    }// fin switch
}// fin metodo modificar

/**METODO MODIFICAR RESPONSABLE
 * @param obj
 */
function modificarResponsable($objResponsable){
    // ARRAY: colResponsable   INT: i
    $colResponsable=$objResponsable->listar();
    $i=1; 
    echo("¿A que responsable quiere modificar sus datos?\n");

    foreach($colResponsable as $unResp){
        echo($i." Nombre: ".$unResp->getNombre()."   Apellido: ".$unResp->getApellido()."   NroLicencia: ".$unResp->getNroLicencia()."\n"); 

    }// fin for 
    $nroResp=(int)trim(fgets(STDIN));
    echo("¿Que dato del Responsable quiere modificar?\n");
    echo("\n");
    echo("1) Nombre    2)  Apellido    3)Nro Licencia \n");
    $ResponsableModificar=$colResponsable[$nroResp-1];
    $op=trim(fgets(STDIN));
    switch($op){
        case 1:
            echo("Ingrese el nuevo Nombre: ");
            $nuevoNombre=trim(fgets(STDIN));
            $ResponsableModificar->setNombre($nuevoNombre);
            $ResponsableModificar->modificar();
            echo("La modificacion se realizó con exito \n");
            break;
            case 2:
                echo("Ingrese el nuevo Apellido: ");
                $nuevoApellido=trim(fgets(STDIN));
                $ResponsableModificar->setApellido($nuevoApellido);
                $ResponsableModificar->modificar();
                echo("La modificacion se realizó con exito \n");
                break;
                case 3:
                    echo("Ingrese el nuevo Nro de Licencia: ");
                    $nuevoNro=trim(fgets(STDIN));
                    $ResponsableModificar->setNroLicencia($nuevoNro);
                    $ResponsableModificar->modificar();
                    echo("La modificacion se realizó con exito \n");
                    break; 

    }// fin switch

}// fin metodo modificarResponsable

/**METODO MODIFICAR EMPRESA */
function modificarEmpresa($objEmpresa){
    // ARRAY: colResponsable   INT: i
    $colEmpresa=$objEmpresa->listar();
    $i=1; 
    echo("¿A que responsable quiere modificar sus datos?\n");

    foreach($colEmpresa as $unEm){
        echo($i." Nombre: ".$unEm->getNombre()."   Apellido: ".$unEm->getDire()."\n"); 

    }// fin for 
    $nroEm=(int)trim(fgets(STDIN));
    echo("¿Que dato de la Empresa quiere modificar?\n");
    echo("\n");
    echo("1) Nombre    2)  Direccion  \n");
    $EmpresaModificar=$colEmpresa[$nroEm-1];
    $op=trim(fgets(STDIN));
    switch($op){
        case 1:
            echo("Ingrese el nuevo Nombre: ");
            $nuevoNombre=trim(fgets(STDIN));
            $EmpresaModificar->setNombre($nuevoNombre);
            $EmpresaModificar->modificar();
            echo("La modificacion se realizó con exito \n");
            break;
            case 2:
                echo("Ingrese la nueva direccion: \n");
                $nuevoDire=trim(fgets(STDIN));
                $EmpresaModificar->setDire($nuevoDire);
                $EmpresaModificar->modificar();
                echo("La modificacion se realizó con exito \n");
                break;
                     

    }// fin switch

}// fin metodo modificarResponsable

/**METODO MODIFICAR VIAJE */
function modificarViaje($objViaje){
    //
    echo("¿A que Viaje desea modifiar sus datos?\n");
    $k=0; 
    $colViaje=$objViaje->listar();
    foreach($colViaje as $unV){
        echo(($k+1)."  Destino: ".$unV->getDestino()."  Capacidad: ".$unV->getMaxPasajeros()."   ID Empresa: ".$unV->getEmpresa()->getId()."\n");
        echo(($k+1)."Importe: ".$unV->getImporte()."  Tipo Asiento: ".$unV->getTipoAsiento()."  Ida y Vuelta: ".$unV->getIdaVuelta()."\n");
    
        echo("\n"); 
       $k++; 
   }// fin for
    $nroViaje=(int)trim(fgets(STDIN));
    echo("**********************************************\n");       
    echo("¿Que dato del Viaje  desea mofidicar?\n");
    echo("1) Destino  2) Capacidad   3) Id Empresa  4) Importe   5) Tipo Asiento    6)  Ida y Vuelta  7)Responsable   8) Pasajeros    \n");
    $viajeModificar=$colViaje[$nroViaje]; // selecciona el obj viaje a modificar
    $op=(int)trim(fgets(STDIN));
    switch($op){
        case 1:
            echo("Ingrese el nuevo destino \n");
            $nuevoDestino=trim(fgets(STDIN));
            $destino=$viajeModificar->destinoRepetido($nuevoDestino);
            if($destino!=""){
                $viajeModificar->setDestino();
                $viajeModificar->modificar();
                echo("El destino se cargo con exito\n");

            }// fin if 
            else{
                echo("El destino se encuentra repetido en la base de datos\n");
            }
            break; 
            case 2:
                echo("Ingrese la nueva capacidad del viaje \n");
                $nuevaCapacidad=(int)trim(fgets(STDIN));
                $viajeModificar->setMaxPasajeros($nuevaCapacidad);
                $viajeModificar->modificar();

                break;
                case 3:
                    echo("Ingrese el nuevo ID de la empresa\n");
                    $nuevoId=(int)trim(fgets(STDIN));
                    $resp=$viajeModificar->getEmpresa()->buscar($nuevoId);
                    if($resp){
                        $objE=new Empresa();
                        $objE->buscar($nuevoId); // recupera el obj empresa de la base de datos 
                        $viajeModificar->setEmpresa($objE);

                    }// fin if
                    else{
                        echo("NO existe el ID ingresado\n");
                    }
                    break;
                    case 4:
                        echo("Ingrese el nuevo Importe \n");
                        $nuevoImporte=trim(fgets(STDIN));
                        $viajeModificar->setImporte($nuevoImporte);
                        $viajeModificar->modificar();
                        break;
                        case 5:
                            echo("Ingrese el asiento (cama - semicama - primera clase) \n");
                            $nuevoAsiento=trim(fgets(STDIN));
                            $viajeModificar->setTipoAsiento($nuevoAsiento);
                            $viajeModificar->modificar();
                            break;
                            case 6:
                                echo("Ingrese el recorrido (ida o  ida y vuelta) \n");
                                $nuevoIdaV=trim(fgets(STDIN));
                                $viajeModificar->setIdaVuelta($nuevoIdaV);
                                $viajeModificar->modificar();
                                break;
                                case 7:
                                    echo("Ingrese el nuevo nro empleado del responsable \n");
                                    $nuevoNro=(int)trim(fgets(STDIN));
                                    $respuesta=$viajeModificar->getResponsable()-> getNroEmpleado();
                                    if($respuesta){
                                        $objR=new Responsable();
                                        $objR->buscar($nuevoNro);
                                        $viajeModificar->setResponsable($objR);
                                        $viajeModificar->modificar();
                                    }// fin if 
                                    else{
                                        echo("El nr Empleado no existe \n");

                                    }
                                    break;
                                    case 8:// ESTA PARTE TENGO DUDAS 
                                        $colPasajero=$viajeModificar->getPasajeros();
                                        $cantidad=sizeof($colPasajero);
                                        if($cantidad==0){
                                            echo("Este viaje no tiene pasajeros\n");

                                        }// fin if
                                        else{// Recupero un pasajero de la coleccion de pasajeros del viaje
                                           $pasajero=$viajeModificar->unPasajero($nroViaje);
                                           $pasajero->modificarPasajero();
                                        } // fin else
                                        break;

    }// fin switch


}// fin metodo modificar Viaje

/***************************************** METODOS INGRESAR ************************************************************* */
/** METODO AGREGRA VIAJE 
 * 
 */
function agregarViaje(){
    // STRING:destino        INT: capacidad, id, idEmpres, nroResponsable    FLOAT: costo
        // CREO LOS OBJ EMPRESA, RESPONSABLE Y VIAJE
    $objR=new Responsable();
    $objE=new Empresa(); 
    $objV=new Viaje();

    echo("ingrese el ID del viaje \n");
    $id=trim(fgets(STDIN));
    echo("ingrese el destino \n");
    $destino=trim(fgets(STDIN));
    echo("ingrese la capacidad maxima de pasajeros \n");
    $capacidad=trim(fgets(STDIN));
    echo("ingrese el ID de la Empresa del viaje \n");
    $objE->mostrarEmpresa();
    $idEmpresa=trim(fgets(STDIN));
    echo("ingrese el importe del viaje \n");
    $costo=trim(fgets(STDIN));
    echo("ingrese el  tipo de asiento del viaje  (cama - semi cama - primera clase) \n");
    $asiento=trim(fgets(STDIN));
    echo("ingrese si el viaje es (ida) o (ida y vuelta) \n");
    $idaVuelta=trim(fgets(STDIN));
    echo("ingrese el nro de empleado del responsable del viaje  \n");
    $objR->mostrarResponsable();
    $nroResponsable=trim(fgets(STDIN));
    echo("ingrese quiere ingresar pasajeros al viaje (Si / No) \n");
    $respuesta=trim(fgets(STDIN));


    // BUSCO SI HAY UNA EMPRESA Y RESPONSABLE EN LA BD
    $buscarEmpresa=$objE->buscar($idEmpresa);
    $buscarResponsable=$objR->buscar($nroResponsable);
    // pregunta si se encuentra la empresa o el responsable
    if($buscarEmpresa){
        $verificarEm=true;

    }// fin if
    else{
        $verificarEm=false; 

    }// fin else 

    if($buscarResponsable){
        $verificarResp=true;

    }// fin if
    else{
        $verificarResp=false;

    }// fin else

    // VERIFICACION DE ID REPETIDO
    if($objV->buscar($id)){
        echo("Ya un viaje con ese ID en la BD\n");
        $verificacionViaje=false;
    }// fin if 
    else{
        $verificacionViaje=true; 
    }// fin else 



    // carga del obj viaje
    if($verificacionViaje){
        if($verificarEm){
            if($verificarResp){
                $objV->cargar($id,$destino,$capacidad,$objE,$costo,$asiento,$idaVuelta,$objR);
                $dest=$objV->destinoRepetido($destino);
                if($dest!=""){
                    $objV->insertar();
                        // CARGA DEL PASAJERO
                        $objP=new Pasajeros();
                        $k=0;
                        $pasajerosViaje=array(); // almacena los pasajeros del mismo viaje que se ingresa 
                        // $colObjPasajero=null; // valor por defecto de la cantidad de pasajeros del viaje
                        if( strtoupper($respuesta)=="SI"){
                            echo("Cuantos pasajeros quiere aregar al viaje?\n");
                            $cant=(int)trim(fgets(STDIN));
                           for($i=0; $i<$cant; $i++){
                                ingresarPasajero();// cargo un oasajero a la BD , llamando al metodo de la clase pasajero

                            $colObjPasajero=$objP->listar();// una vez ingresado el pasajero lo busco en la BD
                            if($colObjPasajero[$i]->getViaje()->getIdViaje()==$id){
                                $pasajerosViaje[$k]=$colObjPasajero[$i];
                                $k++;

                            }// fin if
            

                            }// fin for

    }// fin if 

                    $objV->setPasajeros($pasajerosViaje);
                    echo("La carga se realiza corectamente\n");

                }// fin if 
                else{
                    echo("El viaje no se cargo porque el destino esta repetido\n");

                }// fin else 
                
            }// fin if
            else{
                echo("El viaje no se cargo porque NO habia un responsable cargado en la BD\n");
            }// fin else
             
        }// fin if
        else{
            echo("El viaje no se cargo porque NO habia una empresa cargado en la BD\n");
        }// fin else 

    }// fin if 
    else{
        echo("El viaje no se cargo porque el ID del viaje ya existe \n");
    }// fin else



}//fin metodo agregar viaje


/** METODO AGREGAR PASAJERO
     * realiza una serie de verificaciones antes de agregar un pasajero
     * a la BD
     */
    function ingresarPasajero(){
        // STRING: nombre,              INT: dni,idViaje, telefono    ARRAY: colPasajeroBD, colViajeBD, 

        $objPasajero=new Pasajeros();
        $objViaje=new Viaje(); // CREO UN NUEVO VIAJE
        echo("DATOS DEL PASAJERO \n");
        echo("Ingrese el nombre del pasajero \n");
        $nombre=trim(fgets(STDIN));
        echo("Ingrese el apellido del pasajero \n");
        $apellido=trim(fgets(STDIN));
        echo("Ingrese el Nro de documento del pasajero \n");
        $dni=trim(fgets(STDIN));
        echo("Ingrese el telefono de contacto \n");
        $telefono=trim(fgets(STDIN));
        echo("Ingrese el ID del viaje del pasajero \n");
        $objViaje->mostrarDestinos();
        $id=(int)trim(fgets(STDIN));
        
        $seEncuentraNroPasajero=$objPasajero->buscar($dni);
        $resp=$objViaje->buscar($id); // busca en la BD si esta el obj viaje con ese ID
        if($resp){
            if($seEncuentraNroPasajero){
                echo("Ya  existe un pasajero en la  BD con el mismo DNI \n");
            }// fin if
            else{
                $objPasajero->cargar($nombre,$apellido,$dni,$telefono,$objViaje);
                $objPasajero->insertar();
                echo("La carga se realizó corectamente\n");

            }// fin else

        }//fin if
        else{
            echo("El Id ingresado no esta en la BD \n");
            echo("¿Desea crear el viaje?  Si / No \n");
            $check=strtoupper(trim(fgets(STDIN)));
            if($check=="SI"){
                agregarViaje();  // supuestamente el obj viaje se agrega a la BD
                $$objViaje->buscar($id); // vuelve a buscar el obj viaje 
                $objPasajero->cargar($nombre,$apellido,$dni,$telefono,$objViaje);
                $objPasajero->insertar();
                echo("La carga se realizó corectamente\n");

            }// fin if 
            else{
                echo("No se cargo el pasajero a la BD \n");

            }// fin else
        }// fin else
    
    }// fin metodo ingresarPasajero


/** METODO INGRESAR RESPONSABLE  */
function ingresarResponsable(){
    // INT: cont, tam   BOOLEAN: salir    ARRAY: colResponsables
    $nuevoResponsable=new Responsable();
    //$colResponsables=$objResponsable->listar();
    echo("Ingrese el nuevo nombre del responsable del viaje\n");
    $nombre=trim(fgets(STDIN));
    echo("Ingrese el apellido\n");
    $apellido=trim(fgets(STDIN));
    echo("Ingrese el Nro de Empleado\n");
    $nroE=trim(fgets(STDIN));
    echo("Ingrese el Nro de licencia \n");
    $nroL=trim(fgets(STDIN));
    
    $seRepite=$nuevoResponsable->buscar($nroE);
    if($seRepite){
        echo("Ya existe un persona con el mismo Nro de Empleado\n");

    }// fin if
    else{
        $nuevoResponsable->cargar($nombre,$apellido,$nroE,$nroL);
        $nuevoResponsable->insertar();
        echo("La carga se realizó con exito\n");

    }// fin else



}// fin metodo ingresar responsable  

/**METODO INGRESAR EMPRESA */
function ingresarEmpresa(){

    $objEmp=new Empresa();
    echo("Ingrese el ID de la Empresa\n");
    $idE=trim(fgets(STDIN));
    echo("Ingrese el nombre de la Empresa\n");
    $nombre=trim(fgets(STDIN));
    echo("Ingrese la direccion  de la Empresa\n");
    $dire=trim(fgets(STDIN));

    $resp=$objEmp->buscar($idE);
    if($resp){
        $objEmp->cargar($idE,$nombre,$dire);
        $objEmp->insertar();

    }//fin if
    else{
        echo("NO se pudo cargar la empresa porque ya hay una con el mismo ID\n");
    }
    
}// fin metodo ingresar empresa

   /*********************************METODOS ELIMINAR ********************************************************* */

    /**METODO ELIMINAR PASAJERO 
     * 
    */
function eliminarPasajero(){

        $objP=new Pasajeros(); 
        $colPasajero=$objP->listar();
        $j=1;
        foreach($colPasajero as $unPasajero){
            echo("¿Cual Pasajero desea elimnar?\n");
            echo($j.") ".$unPasajero->getNombre()."   DNI: ".$unPasajero->getDni()."\n");
            $j++;
            
        }// fin for 
        $op=trim(fgets(STDIN));
        $op=$op-1;
        $pasajeroEliminar=$colPasajero[$op];
        $pasajeroEliminar->eliminar(); 
        echo("El pasajerose elimino correctamente \n"); 
    }// fin metodo eliminar pasajero



/** METODO ELIMINAR VIAJE 
 * * Verifica si el viaje tiene pasajeros antes de eliminarlo
 
*/
    function eliminarViaje(){
        
        $objV=new Viaje();
        $objP=new Pasajeros();

        $colViajes=$objV->listar();
        $colPasajersoEnBaseDato=$objP->listar();
        
        $k=1; 
        foreach($colViajes as $unViaje){
            echo("Ingrese el Nro del viaje que quiere eliminar \n");
            echo($k.")"."  Destino del viaje: ".$unViaje->getDestino()."\n");
            $k++;
        }// fin for 
        $nro=(int)trim(fgets(STDIN)); // nro del viaje a eliminar
        $viajeParaEliminar=$colViajes[$nro-1];
        $salir=true; 
        $count=0; 

        while($count<sizeof($colPasajersoEnBaseDato) && $salir){
            $id=$colPasajersoEnBaseDato[$count]->getViaje()->getIdViaje();// ID del viaje en la clase pasajero
            $idViaje=$viajeParaEliminar->getIdViaje(); // ID del viaje en la clase viaje
            if($id==$idViaje){
                $eliminar=false; 
                $salir=false; 

            }// fin if
            else{
                $eliminar=true; 

            }// fin else
            $count++;

        }// fin while 

        if($eliminar){
            $viajeParaEliminar->eliminar();
            echo("El viaje se elimino exitosamente \n");
        }// fin if
        else{
            echo("El viaje no se puedo elimianr porque posee pasajeros \n");
        }

    }// fin metodo eliminar viaje 

/**METODO ELIMINAR RESPONSABLE */    
function eliminarResponsable(){
    $objR=new Responsable();
    $colR=$objR->listar();

    $i=0;
    foreach($colR as $unR){
        echo(($i+1).")"."Elija el responsable que desea eliminar \n");
        echo(($i+1).")"."Nombre: ".$unR->getNombre()."   Nro: ".$unR->getNroEmpleado()." \n");

    }// fin for 
    $op=trim(fgets(STDIN));
    $objReliminar=$colR[$op];
    $objReliminar->eliminar(); 

}// fin metodo eliminar Responsable

/**METODO ELIMINAR RESPONSABLE */    
function eliminarEmpresa(){
    $objE=new Empresa();
    $colE=$objE->listar();

    $i=0;
    foreach($colE as $unE){
        echo(($i+1).")"."Elija el responsable que desea eliminar \n");
        echo(($i+1).")"."Nombre: ".$unE->getNombre()."   Nro: ".$unE->getId()." \n");

    }// fin for 
    $op=trim(fgets(STDIN));
    $objReliminar=$colE[$op];
    $objReliminar->eliminar(); 

}// fin metodo eliminar Responsable

/**********************************METODOS MOSTRAR*********************************************** */

function mostrarPasajero(){

    $obj=new Pasajeros();
    $col=$obj->listar();
    foreach($col as $unObj){
        echo($unObj." \n");

    }// fin for
}// fin metodo mostrar Pasajero

function mostrarResponsable(){

    $obj=new Responsable();
    $col=$obj->listar();
    foreach($col as $unObj){
        echo($unObj." \n");

    }// fin for
}// fin metodo mostrar Pasajero


function mostrarEmpresa(){

    $obj=new Empresa();
    $col=$obj->listar();
    foreach($col as $unObj){
        echo($unObj." \n");

    }// fin for
}// fin metodo mostrar Pasajero


function mostrarViaje(){

    $obj=new Viaje();
    $col=$obj->listar();
    foreach($col as $unObj){
        echo($unObj." \n");

    }// fin for
}// fin metodo mostrar Pasajero



    /******************************************************************************************** */
//                                  MENU 
/******************************************************************************************* */
$bandera=true;
while($bandera){
    $tarea=operacion(); // elije la tarea a realizar
    $clase=operarEn(); // elije sobre que clase operar
    $operacioParticular=operacionEspecifica($tarea,$clase);

    switch($operacioParticular){
        case "11": // modificar pasajero
            modificarPasajero($objPasajero); 
            break;
            case "12":// modificar Responsable
                modificarResponsable($objResponsable);
                break;
                case "13":// Modificar Empresa
                    modificarEmpresa($objEmpresa);
                    break;
                    case "14": // Modificar Viaje
                        modificarViaje($objViaje);
                        
                        break;
                        case "21":// agregar pasajero
                            ingresarPasajero();


                            break;
                            case "22":// agregar Responsable
                                ingresarResponsable();
                              
                                break;
                                case "23":// agregar empresa
                                    ingresarEmpresa();
                                    break;
                                    case "24":// agregar viaje
                                        agregarViaje();
                                       
                                        break;
                                        case "31":// Eliminar pasajero
                                            eliminarPasajero();

                                            break;
                                            case "32":// Eliminar Responsable
                                                eliminarResponsable();
                                                                              
                                                break;
                                                case "33":// Eliminar Empresa 
                                                    eliminarEmpresa();
                                                    break;
                                                    case "34":// Eliminar Viaje
                                                        eliminarViaje();
                                                        break;
                                                        case "41":// Mostrar Pasajero
                                                            mostrarPasajero();
                                                            break;
                                                            case "42":// Mostrar Responsable
                                                                mostrarResponsable();
                                                                break;
                                                                case "43":// Mostrar Empresa
                                                                    mostrarEmpresa();
                                                                    break;
                                                                    case "44":// Mostrar Viaje
                                                                        mostrarViaje();
                                                                        break;
                                        

    }// fin switch

    echo("¿Desea Realizar otra operacion? Si / No \n" );
    $op=strtoupper(trim(fgets(STDIN)));
    if($op=="SI"){
        $bandera=true; 

    }// fin if 
    else{
        $bandera=false; 

    }// fin else

} // fin whil




?>