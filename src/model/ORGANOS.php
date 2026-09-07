<?php
namespace Developer\model;

class ORGANOS  extends \Franky\Database\Mysql\objectOperations
{
    private $busca;

    public function __construct()
    {
        parent::__construct();
        $this->from()->addTable('franky');
        $this->busca = '';
    }


    function getData($data = array())
    {
        $campos = array("nombre","url","id","css","js","jquery","php","resource","constante","ajax","modulo","status");

        $data = $this->optimizeEntity($data);
        foreach($data as $k => $v)
        {
              if(!empty($v) || is_numeric($v))
            {
                if(is_array($v))
                {
                    $this->where()->concat('AND (');
                    foreach ($v as $_v)
                    {
                        $this->where()->addOr($k,$_v,'=');

                    }
                    $this->where()->concat(')');
                }
                else
                {
                    if(in_array($k,['id'])) {
                        $this->where()->addAnd($k,$v,'=');
                    } else {
                        $this->where()->addAnd($k,"%".$v."%",'like');
                    }
                } 
            }
        }
        return $this->getColeccion($campos);

    }

    function findPagina($campo, $valor,$id)
    {
        $campos = array("id");
        $this->where()->addAnd('status','1','=');
        $this->where()->addAnd($campo,$valor,'=');
        if(!empty($id))
        {
          $this->where()->addAnd('id',$id,'<>');
        }


        return $this->getColeccion($campos);


    }

    private function optimizeEntity($array)
    {
        foreach ($array as $k => $v )
        {
            if (!isset($v)) {
                unset($array[$k]);
            }
        }
        return $array;
    }

    public function save($organos)
    {

        $organos = $this->optimizeEntity($organos);

        if (isset($organos['id']))
        {
            $this->where()->addAnd('id',$organos['id'],'=');
            return $this->editarRegistro($organos);
        }
        else {

            return $this->guardarRegistro( $organos);
        }

    }
}

?>
