<?php
use Developer\Form\frankyForm;
use Developer\model\ORGANOS;
use Franky\Filesystem\File;

$id		= $MyRequest->getRequest('id');
$callback	= $MyRequest->getRequest('callback');

$data = $MyFlashMessage->getResponse();
$adminForm = new frankyForm("frmfranky");
$modulo_bd = array();

$OrganosCorporales  = new ORGANOS();
$title = "Alta";
if(!empty($id))
{
    $title = "Editar";
        $result	 = $OrganosCorporales->getData($id);

        $data = $OrganosCorporales->getRows();

        $data["css[]"]        = json_decode($data["css"],true);
        $data["js[]"]         = json_decode($data["js"],true);
        $data["jquery[]"]     = json_decode($data["jquery"],true);
        $data["permisos[]"]   = json_decode($data["permisos"],true);
        $data["ajax[]"]       = json_decode($data["ajax"],true);

        $adminForm->addId();
}

$File = new File;

$jquery_files = array();
$files = $File->getFiles(PROJECT_DIR."/public/jquery/","dir");

if(count($files) > 0)
{
    foreach($files as $file)
    {
        if(!in_array($file,array("menu-movil")))
        {
            $jquery_files[$file] = $file;
        }
    }
}


$ajax_files = array();
$modulos = getModulos();
$js_excluir = array();
$js_files = array();
foreach($modulos as $modulo)
{
    $js_excluir[] = $modulo.".js";
    $files = $File->getFiles(PROJECT_DIR."/modulos/$modulo/web/js/","file");

    if(count($files) > 0)
    {
        foreach($files as $file)
        {
            if(!in_Array($file,$js_excluir))
            {
                if(preg_match('/ajax\./',$file))
                {
                    $ajax_files["$modulo/".$file] = "$modulo/".$file;
                }
                else
                {
                    $js_files[$file] = $file;
                }
            }
            
            
        }
    }

    
}


$css_files = array();
$excluir = array("imprimir.css");
foreach($modulos as $modulo)
{

    $files = $File->getFiles(PROJECT_DIR."/modulos/$modulo/web/css/","file");
    if(count($files) > 0)
    {
        foreach($files as $file)
        {
          if(!in_array($file,$excluir)):
            $css_files[$file] = $file;
        endif;
        }
    }
}


       
$_modulos = array();
foreach ($modulos as $m)
{
    $_modulos[$m] = $m;
}



$adminForm->setOptionsInput("modulo", $_modulos);
$adminForm->setOptionsInput("js[]", $js_files);
$adminForm->setOptionsInput("jquery[]", $jquery_files);
$adminForm->setOptionsInput("ajax[]", $ajax_files);
$adminForm->setOptionsInput("css[]", $css_files);
$adminForm->setOptionsInput("permisos[]", $_Niveles_usuarios);
$adminForm->setData($data);
$adminForm->setAtributoInput("callback","value", urldecode($callback));
$title_form = "$title pagina";



?>
