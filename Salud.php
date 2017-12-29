<?php

class Salud
{
    public $db;
    public $usuario;
    public $tipoDeUsuario;

    public function __construct()
    {
        session_start();
        unset($_POST['fn']);
        require_once './libs/MysqliDb.php';
        $this->db = new MysqliDb('localhost', 'salud', 'vezPHxngE9vXHaWdF55656aVvMNHxa6rHTKFgmK8Dp4hm6cqZcfpmJ2gxny5ASaY', 'salud');
        $this->db->setTrace(true);

        if (isset($_SESSION['id'])) {
            $this->usuario = $_SESSION['id'];
            $GLOBALS['tiposSeguridad'] = $this->db->get('tipo_seguridad');
            $this->tiposSeguridad = $GLOBALS['tiposSeguridad'];

            $GLOBALS['tiposServicio'] = $this->db->get('tipo_servicio');
            $this->tiposServicio = $GLOBALS['tiposServicio'];

            $GLOBALS['tiposEventos'] = $this->db->get('tipos_siniestros');
            $this->tiposEventos = $GLOBALS['tiposEventos'];

            $GLOBALS['tiposSiniestros'] = $this->db->get('tipos_siniestros');
            $this->tiposSiniestros = $GLOBALS['tiposSiniestros'];

            $GLOBALS['tiposVehiculos'] = $this->db->get('tipos_vehiculos');
            $this->tiposVehiculos = $GLOBALS['tiposVehiculos'];

            $this->tipoDeUsuario = $_SESSION['tipo'];

        } else {
            $this->usuario = '';
        }

    }

    public function login()
    {
        if ($usuario = $this->db->where('email', $_POST['email'])->get('usuarios', 1)[0]) {
            if (password_verify($_POST['password'], $usuario['password'])) {
                $departamento = $this->db->where('id', $usuario['departamento'])->get('departamentos')[0];
                $usuario['departamento'] = $departamento['nombre'];
                $usuario['departamento_abreviacion'] = $departamento['abreviacion'];
                $_SESSION = $usuario;
                header('location: ./?landing');
            } else {
                header('location: /');
//                echo $this->_error('contrasenia incorrecta');
            }
        } else {
            header('location: /');
//            echo $this->_error('usuario no existente');
        }
    }

    public function cerrar_sesion()
    {
        unset($_SESSION);
        session_destroy();
        header('location: /');
        return true;
    }

    public function crear_usuario()
    {
        if (isset($_POST['password']) &&
            ($_POST['password'] == $_POST['password_verify'])
        ) {
            unset($_POST['password_verify']);
            $insert = $_POST;
            $insert['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if ($res = $this->db->insert('usuarios', $insert)) {
                $_SESSION['alerta']['msg'] = 'Usuario Creado';
                $_SESSION['alerta']['tipo'] = 'success';
                header('location: /');
            } else {
                $this->_error('hubo un error al crear tu usuario');
            }
        } else {
            header('location: /?crear_usuario');
        }
    }

    public function _error($error = [])
    {
        $toreturn = ['status' => 'error'];
        if (is_array($error)) {
            array_push($toreturn, $error);
        } else {
            $toreturn['msg'] = $error;
        }
        return json_encode($toreturn);
    }

    public function _ok($ok = [])
    {
        $toreturn = ['status' => 'ok'];
        if (is_array($ok)) {
            array_push($toreturn, $ok);
        } else {
            $toreturn['msg'] = $ok;
        }
        return json_encode($toreturn);
    }

    public function vista($vista = null, $data = [])
    {
        if ($vista != null && file_exists('vistas/' . $vista . '.php')) {
            foreach ($data as $k => $v) {
                $$k = $v;
            }
            require 'vistas/' . $vista . '.php';
            return true;
        } else {
            return false;


        }
    }

    public function buscar_siniestro()
    {
        unset($_SESSION['siniestro']);
//        var_dump($_SESSION['departamento_abreviacion']);
//        die();
        $ifadmin = $_SESSION['departamento_abreviacion'] == 'it' ? '1 = 1' : 'usuario = ' . $this->usuario;
        $siniestros = $this->db
            ->where("codigo like '%{$_POST['siniestro']}%'")
            ->where('capturado', 1)
            ->where($ifadmin)
            ->get('siniestros');
        $_SESSION['busqueda'] = $siniestros;
        header('location: /?resultados_busqueda');
    }

    public function agregar_victima()
    {
//        var_dump($_POST);

        $insert = $_POST;
        $insert['usuario'] = $this->usuario;


        if ($this->db->insert('victimas', $insert)) {
//            $victimaId = $this->db->getInsertId();
            $_SESSION['activo'][$_POST['tipo']]--;

            $victimasCapturadas = $this->_victimasEnSiniestro($_POST['siniestro']);
            if ($_SESSION['siniestro']['victimas'] > count($victimasCapturadas)) {
                header('location: /?agregar_victima');
            } else {
                $_SESSION['victimas'] = $victimasCapturadas;
                header('location: /?agregar_vehiculo');
            }


        } else {
//            var_dump($_POST);
            var_dump($this->db->trace);
            echo 'error x aqui';
        }
    }

    private function _victimasEnSiniestro($siniestro)
    {
        return $this->db->where('siniestro', $siniestro)->get('victimas');
    }

    public function agregar_siniestro()
    {
        $insert = $_POST;
        if ($_POST['leve'] == '' | $_POST['fatal'] == '' | $_POST['grave'] == '') {
            header('location: /?nuevosiniestro');
            die();
        }
        $insert['victimas'] = $_POST['leve'] + $_POST['grave'] + $_POST['fatal'];
        $insert['usuario'] = $this->usuario;
        if ($this->db->insert('siniestros', $insert)) {
            $siniestroId = $this->db->getInsertId();
            $_SESSION['siniestro'] = $insert;
            $_SESSION['siniestro']['id'] = $siniestroId;
            $_SESSION['activo'] = $insert;
            $_SESSION['activo']['id'] = $siniestroId;
            $_SESSION['activo']['siniestro'] = $this->db->getInsertId();
            header('location: /?agregar_victima');
        } else {
            $this->_error('no se pudo ingresar siniestro');
        }
    }

    public function agregar_vehiculo()
    {

        $insert = $_POST;
        $insert['usuario'] = $this->usuario;
        $insert['tipo_siniestro'] = $_SESSION['activo']['tipo'];
        unset($insert['victima']);

        if ($this->db->insert('vehiculos', $insert)) {
            $vehiculoId = $this->db->getInsertId();
            if (isset($_POST['victima']) && is_array($_POST['victima'])) {
                foreach ($_POST['victima'] as $v) {
                    $update = ['vehiculo' => $vehiculoId];
                    $this->db->where('id', $v['id'])->update('victimas', $update);
                    unset($_SESSION['victimas'][$v]);
                }

            }
            unset($_SESSION['victimas'][$_POST['chofer']]);
            $_SESSION['activo']['vehiculos']--;

            $vehiculosCapturados = $this->_vehiculosEnSiniestro($_POST['siniestro']);
            if ($_SESSION['siniestro']['vehiculos'] > count($vehiculosCapturados)) {
                header('location: /?agregar_vehiculo');
            } else {
                $_SESSION['vehiculos'] = $vehiculosCapturados;
                $_SESSION['resumensiniestro'] = $this->resumen_siniestro($_POST['siniestro']);
                $this->db->where('id', $_POST['siniestro'])->update('siniestros', ['capturado' => 1]);
                header('location: /?resumen_siniestro');
            }

        } else {
            echo 'aqui';

        }

    }

    private function _vehiculosEnSiniestro($siniestro)
    {
        return $this->db
            ->where('siniestro', $siniestro)
            ->get('vehiculos');
    }

    public function resumen_siniestro($siniestro = null)

    {
        if (isset($_REQUEST['siniestro']) && $_REQUEST['siniestro'] != '') {
            $siniestroId = $_REQUEST['siniestro'];
        } else {
            $siniestroId = $siniestro;
        }


        $siniestroGeneral = $this->db->where('id', $siniestroId)->get('siniestros')[0];

        $siniestroGeneral['tipo'] = $this->tiposEventos[array_search($siniestroGeneral['tipo'], $this->tiposEventos)];
        $siniestroGeneral['victimas_info'] = $this->db->where('siniestro', $siniestroId)->get('victimas');
        $siniestroGeneral['vehiculos_info'] = $this->db->where('siniestro', $siniestroId)->get('vehiculos');
        $siniestroGeneral['usuario_info'] = $this->db->where('id', $siniestroGeneral['usuario'])->get('usuarios')[0];
        $siniestroGeneral['usuario_info']['departamento'] = $this->db->where('id', $siniestroGeneral['usuario_info']['departamento'])->get('departamentos')[0];
        unset($siniestroGeneral['usuario_info']['password']);
//        var_dump($siniestroGeneral);
//
        $_SESSION['resumensiniestro'] = $siniestroGeneral;

        if ($siniestro == null) {
            header('location: /?resumen_siniestro');
        }
        return $siniestroGeneral;
    }

    private function siniestroInfo($siniestro)
    {
        $siniestro['victimasArray'] = $this->db->where('siniestro', $siniestro['id'])->get('victimas');
        $siniestro['vehiculosArray'] = $this->db->where('siniestro', $siniestro['id'])->get('vehiculos');
        return $siniestro;
    }
}