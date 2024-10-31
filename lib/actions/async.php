<?php 

class NF_Async_Pimex extends NF_Abstracts_Action
    {
        /**
        * @var string
        */
        protected $_name  = 'pimex';
    
        /**
        * @var array
        */
        protected $_tags = array();
    
        /**
        * @var string
        */
        protected $_timing = 'late';
    
        /**
        * @var int
        */
        protected $_priority = 10;
    
        /**
        * Constructor
        */
        public function __construct()
        {
            parent::__construct();
    
            $this->_nicename = __( 'Pimex', 'ninja-forms' );
    
            $settings = array(
                
                    /*
                    * Pimex
                    */
                
                    'pmx-id' => array(
                        'name' => 'pmx-id',
                        'type' => 'textbox',
                        'group' => 'primary',
                        'label' => __( 'id', 'ninja-forms' ),
                        'placeholder' => '',
                        'width' => 'full',
                        'value' => '',
                        'use_merge_tags' => array(
                            'include' => array(
                                'calcs',
                            ),
                        ),
                    ),
                    'pmx-token' => array(
                        'name' => 'pmx-token',
                        'type' => 'textbox',
                        'group' => 'primary',
                        'label' => __( 'token', 'ninja-forms' ),
                        'placeholder' => '',
                        'width' => 'full',
                        'value' => '',
                        'use_merge_tags' => array(
                            'include' => array(
                                'calcs',
                            ),
                        ),
                    ),
                
                );;
    
            $this->_settings = array_merge( $this->_settings, $settings );
        }
        
        /*
        * PUBLIC METHODS
        */
    
        public function save( $action_settings )
        {
    
        }
    
        public function process( $action_settings, $form_id, $data )
        {
            $data[ 'actions' ]['pimex'][ 'id' ] = $action_settings[ 'pmx-id' ];
            $data[ 'actions' ]['pimex'][ 'token' ] = $action_settings[ 'pmx-token'];
    
            return $data;
        }
    }