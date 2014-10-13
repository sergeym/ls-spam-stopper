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

if (!class_exists('Plugin')) {
	die('Hacking attemp!');
}

class PluginSpamstopper extends Plugin {

    /**
     * Активация плагина
     */
    public function Activate() {
        return $this->PluginSpamstopper_ModuleSpamstopper_Activate();
    }

    /**
     * Инициализация плагина
     */
    public function Init() {
        
    }

    public function Deactivate() {
        return true;
    }
}