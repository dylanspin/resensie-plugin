<?php


  //@author     Dylan spin,
 
    defined('_JEXEC') or die;
    jimport('joomla.plugin.plugin');

    class PlgSystemtks_recensie extends JPlugin{

        protected $app;
        public $params;

        function __construct(&$subject, $config) {
            parent :: __construct($subject, $config);
        }

        function reloadPost(){
            echo "<script>
                      if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href);
                        location.reload(true);
                      }
                  </script>";
        }

        public function createCon($pluginParams){

            $recensietext = $pluginParams->get('recensietext');

            $cont = "<div class='recensie_start' id='startpopup' onclick='openPop()'>
                        <div class='recensie_text'>Feedback</div>
                    </div>
                    <div class='recensie_popup' id='popup'>
                        <div class='recensie_popup_text'>$recensietext</div>
                        <div class='recensie_close' onclick='closePop()'>
                            <i class='fa fa-times'></i>
                        </div>
                        <div class='smiley' onclick='selectScore(this)' id='sm1'><i class='fa fa-frown-o'></i></div>
                        <div class='smiley' onclick='selectScore(this)' id='sm2'><i class='fa fa-meh-o'></i></div>
                        <div class='smiley' onclick='selectScore(this)' id='sm3'><i class='fa fa-smile-o'></i></div>
                        <form class='popupform' method='post'>
                            <textarea name='rec' class='recensie_popup_textarea' rows='5' cols'80'></textarea>  
                            <input type= 'hidden' name='smiley' id='hiddenPopup' value=''>
                            <button class='popup_send' name='sendRec'>Stuur</button> 
                        </form>
                    </div>";

      	    return $cont;

      	}

        public function sendEmail($pluginParams, $text, $score){

            $recipient = $pluginParams->get('email');
            $site = $pluginParams->get('site');

            if($score == "sm1"){
                $score = "Matig";
            }
            elseif ($score == "sm2"){
                $score = "medium";
            } 
            elseif ($score == "sm3"){
                $score = "Goed";  
            }
            else{
               $score = "Persoon heeft dingen aangepast";  
            }
            
            $mailer = JFactory::getMailer();
            $mailer->addRecipient($recipient);
            $mailer->addRecipient($recipient);

            //email layout
            $body   = "<h1>Site : $site</h1>
                       <h2>Score : $score</h2>
                       <h2>Recensie : $text</h2>";

            $mailer->isHtml(true);
            $mailer->Encoding = 'base64';
            $mailer->setBody($body);

            $send = $mailer->Send();//stuurt de email.

        }

        public function onAfterDispatch(){

            $plugin = JPluginHelper::getPlugin('system', 'tks_recensie');
            $pluginParams = new JRegistry($plugin->params);

            $font = $pluginParams->get('font');

            $plgURL = JURI::base() . 'plugins/system/tks_recensie';
            $doc = JFactory::getDocument();

            $doc->addStyleSheet($plgURL . '/css/style.css');
            $doc->addScript($plgURL.'/js/javascript.js');

      	    $css = "";

            $doc->addStyleDeclaration($css);
            $this->params = $pluginParams;

        }

        public function onAfterRender(){

            $getapp = JFactory::getApplication();
            if ($getapp->isAdmin()) {
                return false;
            }

            $pluginParams = $this->params;

            $body = $this->app->getBody();
            $content = $this->createCon($pluginParams);

            $body = str_replace('</body>', $content . '</body>', $body );

            $this->app->setBody($body);

            if(isset($_POST['sendRec'])){
                $this->sendEmail($pluginParams,$_POST['rec'],$_POST['smiley']);
                $this->reloadPost();
            }

        }

    }

?>
