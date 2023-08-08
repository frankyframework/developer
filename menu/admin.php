<?php
global $MySession;
return array(
    array('title'=> "Desarrolladores",
            'children' =>  array(
    
        array(
            "permiso" =>   "administrar_franky",
            "url" => $MyRequest->url(LISTA_PAGINAS),
            "etiqueta" => _("Administrar Páginas")
        ),
        
        array(
            "permiso" =>   "administrar_shell",
            "url" => $MyRequest->url(SHELL),
            "etiqueta" => _("Shell")
        ),
        array(
            "permiso" =>   "administrar_ftp",
            "url" => $MyRequest->url(ADMIN_FTP),
            "etiqueta" => _("FTP")
        ),
    )
    )
);
?>