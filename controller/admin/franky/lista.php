<?php
use Developer\model\ORGANOS;
use Developer\entity\organosEntity;
use Franky\Haxor\Tokenizer;
if ($MyRequest->isAjax()) {
        $callback	= $MyRequest->getRequest('callback');
        $filters = $MyRequest->getRequest('filters');
        $dataPost = json_decode(stripslashes($filters),true);
        $dataPost = $dataPost['rules'];
        $requestFranky = [];
        $request = [];
        foreach($dataPost as $data) {
          
          $request[$data['field']] = $MyRequest->Sanitizacion($data['data']);
          
        }
        $OrganosCorporales  = new ORGANOS();
        $organosEntity  = new organosEntity($request);
        $Tokenizer = new Tokenizer();
        $sortInput  = (!empty($MyRequest->getRequest('sidx',"nombre")) ? : "nombre");


        $OrganosCorporales->setPage($MyRequest->getRequest('page',1));
        $OrganosCorporales->setTampag($MyRequest->getRequest('rows',12));
        $OrganosCorporales->setOrdensql($sortInput." ".$MyRequest->getRequest('sord',"ASC"));
        $result	= $OrganosCorporales->getData($organosEntity->getArrayCopy());
        $dataRows = ["rows" => [], "total" => ceil($OrganosCorporales->getTotal() / $MyRequest->getRequest('rows',12)), "page" => (int)$MyRequest->getRequest('page',1),"records" => $OrganosCorporales->getTotal()];

        if($OrganosCorporales->getTotal() > 0)
        {

                while($registro = $OrganosCorporales->getRows())
                {
                        $registro = array_filter($registro, function($llave) {
                                return !is_numeric($llave);
                        }, ARRAY_FILTER_USE_KEY);
                 
                        $dataRows['rows'][] = array_merge($registro,array(
                        "id" => $Tokenizer->token('dev-pages',$registro["id"]),
                        "status"  => ($registro["status"] == 1 ? "desactivar" : "activar"),
                        "callback" => $Tokenizer->token('dev-pages',$MyRequest->getURI()),
                        ));
                }
        }

        header('Content-Type: application/json; charset=utf-8');
        echo $callback . '(' . json_encode($dataRows). ');';
        die;
} else {
        $MyMetatag->setJs("/public/plugins/jqGrid/js/jquery.jqGrid.js");
        $MyMetatag->setJs("/public/plugins/jqGrid/js/i18n/grid.locale-$lang_root.js");
        $MyMetatag->setCSS("/public/plugins/jqGrid/css/ui.jqgrid.css");
      
}
?>