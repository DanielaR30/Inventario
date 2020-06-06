<?php
require "../modelo/Login.php";
$login = new Login();

 session_start();
 if(isset($_SESSION["NmUsuario"]))
 {
      header("Dashboard/index.php");
 }   

    $NmUsuario = "";
    $Clave = "";
     
   (isset($_POST["NmUsuario"])) ? $NmUsuario = $_POST["NmUsuario"] : "";
   (isset($_POST["Clave"]))     ? $Clave     = $_POST["Clave"]     : "";
   
   switch ($_GET["op"]) {
   
   case 'usuariohas':
     $rspta = $login->validarusuario($NmUsuario);           
     if ($rspta) {
       $row = sqlsrv_has_rows($rspta);
       //si no coincide con ningun usuario
         if ($row === false) {
           echo "null";
         } else {
          //  echo "usuario existente";              
           while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC))    
           {        
           // desencriptar clave y validar
                    if(password_verify($Clave, $row["Clave"]))
                    {
                          $_SESSION["NmUsuario"]=$row['NmUsuario'];
                          $_SESSION["TipoUsuario"]=$row['TipoUsuario']; 
                          $_SESSION["IdUsuario"]=$row['IdUsuario'];
                          
                          echo $_SESSION["NmUsuario"];   
                          
                          // header("location:Dashboard/index.php");
                    }                    
                    else
                    {
                         echo "false";                      
                    }    
           }
         }          
     }               
    break;    

 }
//  switch ($_GET["op"]) {
     // case 'validaracceso':
          // if(isset($_POST["login"]))
          // {
          //     if(empty($_POST["NmUsuario"]) || empty($_POST["Clave"]))
          //     {          
          //          echo '<script>alert("Campos requeridos*")</script>'; 
          //     }
          //     else
          //     {          
          //   (isset($_POST["NmUsuario"])) ? $NmUsuario = $_POST["NmUsuario"] : "";
          //   (isset($_POST["Clave"])) ? $Clave = $_POST["Clave"] : "";      
                  
          //      while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC))
          //           {
          //               // if(isset($row))
          //               if (sqlsrv_num_rows($rspta) !== 0)
          //               {
          //               echo "1 registro";
          //                //     if(password_verify($Clave, $row["Clave"]))
          //                //     {
          //                //           $_SESSION["NmUsuario"]=$row['NmUsuario'];
          //                //           header("location:Example/index.php");
          //                //     }
          //                //     else
          //                //     {
          //                //      echo '<script>alert("Contraseña incorrecta")</script>';                      
                     
          //                //     }
          //               }
          //               else
          //               {
          //                echo '<script>alert("Datos incorrectos")</script>';
          //               }
          //           }
               // }
          // }
          // $rspta=$login->validarusuario($NmUsuario);
          // while ($row = sqlsrv_fetch_array($rspta, SQLSRV_FETCH_ASSOC)) {
          //      $verify=password_verify($Clave, $rspta['Clave']);
          //      if ($verify > 0) {
          //           // echo '<script>console.log("aaaaaaaaaaa")</script>';
          //            print_r("Entró");
          //            $_SESSION["NmUsuario"]=$rspta['NmUsuario'];
          //             header("location:Example/index.php");
     
          //          } else{
          //           echo 'funcion.preventDefault();';
          //           print_r("falló"); //die();
          //          } 
          //    } 
     // break;
     // default:
     //      # code...
     //      break;
// }
 ?> 