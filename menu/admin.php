<?php
global $MySession;
return array(
    array('title'=> "Desarrolladores",
            'children' =>  array(
    
        array(
            "permiso" =>   "administrar_franky",
            "url" => $MyRequest->url(LISTA_PAGINAS),
            "etiqueta" => _("Administrar Páginas")
        )
    )
    )
);
?>