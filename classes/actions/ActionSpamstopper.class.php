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

class PluginSpamstopper_ActionSpamstopper extends ActionPlugin {
	/**
	 * Инициализация 
	 *
	 * @return null
	 */
	public function Init() {

	}
	
	protected function RegisterEvent() {
        $this->AddEvent('ajaxgetkey','EventAjaxGetRegistrationKey');
	}

    public function EventAjaxGetRegistrationKey()
    {
        $this->Viewer_SetResponseAjax('json');

        $sName = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
        $sValue = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);

        $this->Session_Set('registration-key-name', $sName);
        $this->Session_Set('registration-key-value', $sValue);

        $this->Viewer_AssignAjax('name', $sName);
        $this->Viewer_AssignAjax('value', $sValue);
    }
}