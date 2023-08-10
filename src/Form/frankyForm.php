<?php
namespace Developer\Form;

class frankyForm extends \Franky\Form\Form
{
    public function __construct($name)
    {
        

        parent::__construct();
       $this->setAtributos(array(
            'name' => $name,
            'action' => "/admin/franky/submit.php",
            'method' => 'post'
        ));

        
       $this->add(array(
                'name' => 'callback',
                'type'  => 'hidden',
                
            )
        );
       
       
        $this->add(array(
                'name' => 'nombre',
                'label' =>  _developer('Nombre de la página'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'       => 'required',
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );
        
      
        $this->add(array(
                'name' => 'constante',
                'label' =>  _developer('Constante de identificacion'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'     => 'required',
                    'style'     => "text-transform: uppercase;",
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );
        
         $this->add(array(
                'name' => 'url',
                'label' =>  _developer('URL'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'     => 'required',
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );
         
        $this->add(array(
                'name' => 'php',
                'label' =>  _developer('Path del archivo PHP'),
                'type'  => 'text',
                'required'  => true,
                'atributos' => array(
                    'class'     => 'required',
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );
        
         $this->add(array(
                'name' => 'modulo',
                'label' =>  _developer('Modulo'),
                'type'  => 'select',
                'required'  => true,
                'options' => array(),
                'label_atributos' => array(
                    'class'       => 'desc_form_obligatorio'
                 )
            )
        );
        
         
        $this->add(array(
                'label' =>  _developer('Javascript'),
                'name' => 'js[]',                
                'type'  => 'checkbox',                
                'options' => array(
                    "values" => array(),
                    "value" => array()
                ),
             
            )
        );
        
        $this->add(array(
                'label' =>  _developer('Plugins jQuery'),
                'name' => 'jquery[]',                
                'type'  => 'checkbox',                
                'options' => array(
                ),
             
            )
        );
         
        $this->add(array(
                'label' =>  _developer('AJAX'),
                'name' => 'ajax[]',                
                'type'  => 'checkbox',                
                'options' => array(
                ),
             
            )
        );
        
        $this->add(array(
                'label' =>  _developer('Hoja de estilos CSS'),
                'name' => 'css[]',                
                'type'  => 'checkbox',                
                'options' => array(
                ),
             
            )
        );
         
        $this->add(array(
                'label' =>  _developer('Resource'),
                'name' => 'resource',                
                'type'  => 'text',                
                'required'  => false,
                'atributos' => array(
                    'class'       => '',
                    'maxlength' => 255
                 ),
                'label_atributos' => array(
                    'class'       => 'desc_form_no_obligatorio'
                 )
             
            )
        );
        

         $this->add(array(
                'name' => 'guardar',
                'type'  => 'submit',
                'atributos' => array(
                    'class'       => 'btn btn-primary btn-big float_right',
                    'value' =>  _developer("Guardar")
                 )
                
            )
        );

    }
    
    public function addId()
    {
         $this->add(array(
                'name' => 'id',
                'type'  => 'hidden',
                
            )
        );
    }
 
}
?>