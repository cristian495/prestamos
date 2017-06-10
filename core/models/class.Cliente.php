<?php

class Cliente
{
    private $db;
    private $id;
    private $nombre, $apellidoPaterno, $apellidoMaterno, $dni, $telefono, $telefono2, $direccion, $sexo, $fechaNacimiento;


    public function __construct()
    {
        try {
            $this->db = new Conexion();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function ValidarDatos()
    {
        if (empty($_POST['nombreCliente'])) {
            throw new ValidationClientException('Error el campo Nombre no es correcto');
        }
        if (empty($_POST['apellidoPaternoCliente'])) {
            throw new ValidationClientException('Error el campo Apellido Paterno no es correcto');
        }
        if (empty($_POST['apellidoMaternoCliente'])) {
            throw new ValidationClientException('Error el campo Apellido Materno no es correcto');
        }
        if (empty($_POST['sexoCliente'])) {
            throw new ValidationClientException('Error el campo Sexo del cliente no es correcto');
        }
        if (empty($_POST['fechaNacimientoCliente'])) {
            throw new ValidationClientException('Error el campo Fecha de nacimiento no es correcto');
        }
        if (empty($_POST['dniCliente'])) {
            throw new ValidationClientException('Error el campo DNI no es correcto');
        }
        if (empty($_POST['telefonoCliente'])) {
            throw new ValidationClientException('Error el campo Telefono  no es correcto');
        }
        if (empty($_POST['direccionCliente'])) {
            throw new ValidationClientException('Error el campo Telefono  no es correcto');
        }
    }

    private function Errors($url)
    {

        try {
            if ( //empty($_POST['idCliente'])||
                empty($_POST['nombreCliente']) ||
                empty($_POST['apellidoPaternoCliente']) ||
                empty($_POST['apellidoMaternoCliente']) ||
                empty($_POST['sexoCliente']) ||
                empty($_POST['fechaNacimientoCliente']) ||
                empty($_POST['dniCliente']) ||
                empty($_POST['telefonoCliente']) ||
                empty($_POST['direccionCliente'])
            ) {

                throw new Exception(1);
            } else {
                //$this->id = $this->db->real_escape_string($_POST['idCliente']);
                $this->nombre = $this->db->real_escape_string($_POST['nombreCliente']);
                $this->apellidoPaterno = $this->db->real_escape_string($_POST['apellidoPaternoCliente']);
                $this->apellidoMaterno = $this->db->real_escape_string($_POST['apellidoMaternoCliente']);
                $this->sexo = $this->db->real_escape_string($_POST['sexoCliente']);
                $this->fechaNacimiento = $this->db->real_escape_string($_POST['fechaNacimientoCliente']);
                $this->dni = $this->db->real_escape_string($_POST['dniCliente']);
                $this->telefono = $this->db->real_escape_string($_POST['telefonoCliente']);
                $this->telefono2 = $this->db->real_escape_string($_POST['telefono2Cliente']);
                $this->direccion = $this->db->real_escape_string($_POST['direccionCliente']);
            }
        } catch (Exception $error) {
            header('location: ' . $url . $error->getMessage());
            exit;
        }
    }

    public function Add()
    {
        $this->Errors('?view=cliente&mode=add&error=');

        $this->db->query("INSERT INTO cliente (nombre,apellidoPaterno,apellidoMaterno,sexo,fechaNacimiento,dni,telefono,telefono2,direccion)
                        VALUES ('$this->nombre',
                        '$this->apellidoPaterno',
                        '$this->apellidoMaterno',
                        '$this->sexo',
                        '$this->fechaNacimiento',
                        '$this->dni',
                        '$this->telefono',
                        '$this->telefono2',
                        '$this->direccion')")
        or die ('error en la insercion' . $this->db->errno . '  ' . $this->db->error);
        header('location: ?view=cliente&mode=add&success=1');
    }

    /* public function getAllClients(){
         $sql = $this->db->query("SELECT * FROM cliente;");
         if($this->db->rows($sql) > 0) {
             while($data = $this->db->recorrer($sql)) {
                 $clientes[$data['idCliente']] = $data;
             }
         } else {
             $clientes = false;
         }
         $this->db->liberar($sql);

         return $clientes;
     }*/

    public function Edit()
    {
        $this->id = intval($_GET['id']);
        $this->Errors('?view=cliente&mode=edit&id=' . $this->id . '&error=');
        $this->db->query("UPDATE cliente
                        SET nombre='$this->nombre',
                        apellidoPaterno='$this->apellidoPaterno',
                        apellidoMaterno='$this->apellidoMaterno',
                        sexo='$this->sexo',
                        fechaNacimiento='$this->fechaNacimiento',
                        dni='$this->dni',
                        telefono='$this->telefono',
                        telefono2='$this->telefono2',
                        direccion='$this->direccion'
                        WHERE idCliente=$this->id;")
        or die ('error en la insercion' . $this->db->errno . '  ' . $this->db->error);
        header('location: ?view=cliente&mode=edit&id=' . $this->id . '&success=true');
    }

    public function Delete()
    {
        $this->id = intval($_GET['id']);

        $q = "DELETE FROM cliente WHERE idCliente='$this->id';";

        $this->db->query($q) or die ('error al eliminar' . $this->db->errno . '  ' . $this->db->error);
        header('location: ?view=cliente&mode=seeAll&deleteSuccess=true');
    }

    public function __destruct()
    {
        $this->db->close();
    }
}

?>
