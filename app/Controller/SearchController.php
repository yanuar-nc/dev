<?php


    class SearchController extends AppController
    {
        
        public $model_name      = 'Search';
        public $module_title    = 'Search';
        public $module_desc     = '';
        public $module_icon     = 'fa fa-search';

        public function beforeFilter()
        {
            parent::beforeFilter();
            
            $var_model      = $this->model_name;
            $module_title   = $this->module_title;
            $module_desc    = $this->module_title;
            $module_icon    = $this->module_icon;

            $title_for_layout = $module_title;
            
            $status  = array( 'Enabled', 'Disabled' );

            $this->loadModel( 'MailInbox' );
            $this->loadModel( 'Outbox' );

            $mail_types     = $this->MailInbox->getMailTypes();
            $getPurposes    = $this->Outbox->getPurposes();

            $data_models = array( 'MailInbox' => 'Surat Masuk / Disposisi', 'Outbox' => 'Surat Keluar' );
            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'module_icon', 'title_for_layout', 'data_models', 'status', 'mail_types', 'getPurposes' ) );
            
        }
        
        public function admin_xx()
        {


        }
        public function admin_index()
        {
            $time_start = microtime(true);
            $mail_inboxes   = $articles = $transactions = array();
            $keyword    = $_GET[ 'keyword' ];
            $outboxes   = $mail_inboxes = array() ;
            if ( !empty( $keyword ) )
            {
                $mail_inboxes = $this->MailInbox->find( 'all', array( 'conditions' => 
                                                                array( 
                                                                    'OR' => array (
                                                                        array( 'MailInbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'MailInbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'MailInbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                    )
                                                                ) 
                                                            ) );

                $outboxes = $this->Outbox->find( 'all', array( 'conditions' => 
                                                                array( 
                                                                    'OR' => array (
                                                                        array( 'Outbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'Outbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'Outbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                    )
                                                                ) 
                                                            ) );

            }

            $this->request->data['Search'][ 'keyword' ] = $keyword;
            $this->set( compact( 'mail_inboxes', 'outboxes', 'time_start' ) );
        }
               
        public function admin_refine()
        {

            $this->autoRender = false;
            $time_start = microtime(true);
            $keyword  = $this->request->query[ 'keyword' ];
            $data     = $this->request->query[ 'data' ];

            switch ( $data ) {
                case 'MailInbox':
                    $mail_inboxes = $this->MailInbox->find( 'all', array( 'conditions' => 
                                                                    array( 
                                                                        'OR' => array (
                                                                            array( 'MailInbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                            array( 'MailInbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                            array( 'MailInbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                        )
                                                                    ) 
                                                                ) );

                    $outboxes        = array();
                    break;
                case 'Outbox':
                    $outboxes = $this->Outbox->find( 'all', array( 'conditions' => 
                                                                    array( 
                                                                        'OR' => array (
                                                                            array( 'Outbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                            array( 'Outbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                            array( 'Outbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                        )
                                                                    ) 
                                                                ) );

                    $mail_inboxes     = array();
                break;
                default:
                $mail_inboxes = $this->MailInbox->find( 'all', array( 'conditions' => 
                                                                array( 
                                                                    'OR' => array (
                                                                        array( 'MailInbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'MailInbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'MailInbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                    )
                                                                ) 
                                                            ) );

                $outboxes = $this->Outbox->find( 'all', array( 'conditions' => 
                                                                array( 
                                                                    'OR' => array (
                                                                        array( 'Outbox.no_surat LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'Outbox.no_arsip LIKE' => '%' . $keyword . '%' ),
                                                                        array( 'Outbox.perihal LIKE' => '%' . $keyword . '%' ),
                                                                    )
                                                                ) 
                                                            ) );

                    break;
            }

            $this->request->data[ 'Search' ] = $this->request->query;

            $this->set( compact( 'mail_inboxes', 'outboxes', 'time_start' ) );
            $this->render( 'admin_index' );
        }
    }

?>

