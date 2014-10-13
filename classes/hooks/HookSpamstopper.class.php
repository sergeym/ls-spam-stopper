<?php
/*-------------------------------------------------------
*
*   SpamStopper plugin for LiveStreet
*   Copyright © 2014 Sergey Marin
*
*--------------------------------------------------------
*
*   Developer site: www.sergeymarin.com
*   Contact e-mail: marin.sergey@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

class PluginSpamstopper_HookSpamstopper extends Hook {

    public function RegisterHook() {
        $this->AddHook('template_form_registration_end', 'InjectRegistrationKey', __CLASS__);
        $this->AddHook('template_body_end', 'InjectRegKeyScript', __CLASS__);
        $this->AddHook('registration_validate_before', 'CheckRegistrationKeys', __CLASS__);
        $this->AddHook('template_content_end', 'TemplateContentEnd', __CLASS__, 2);
    }

    /**
     * Вставляет скрытое поле для хранения ключа
     * @param $aVars
     * @return String
     */
    public function InjectRegistrationKey($aVars)
    {
        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_window_login_registration_key.tpl');
    }

    /**
     * Вставляет скрипт запроса ключа, вставляемого в скрытое поле
     * @param $aVars
     * @return String
     */
    public function InjectRegKeyScript($aVars)
    {
        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_window_login_registration_key_script.tpl');
    }

    /**
     * Проверка ключа
     * @param $aVars
     */
    public function CheckRegistrationKeys($aVars)
    {
        /** @var ModuleUser_EntityUser $oUser */
        $oUser = $aVars['oUser'];
        $sName = $this->Session_Get('registration-key-name');


        $sReqValue = getRequest($sName);

        if (!($sReqValue && $this->Session_Get('registration-key-value')==$sReqValue)) {
            $oUser->setLogin('');
        }
    }

    public function TemplateContentEnd($aVars)
    {
        if ($this->PluginSpamstopper_ModuleSpamstopper_Check()) {
            return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'spamstopper.counter.tpl');
        }
    }

}