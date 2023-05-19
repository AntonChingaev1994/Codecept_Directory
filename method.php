<?php

class MethodClass {
    public $waiting_time = 30;
    public $locator = '';
    public function __construct() {
        $this->locator = new LocatorClass;
    }
    
    public function click_element($I, $elemet)
    {
        $I->waitForElementVisible($elemet, $this->waiting_time);
        $I->click($elemet);
    }

    public function mouse_over_element($I, $elemet)
    {
        $I->waitForElementVisible($elemet, $this->waiting_time);
        $I->moveMouseOver($elemet);
    }

    public function switchIFrame($I, $switch) {
        if ($switch) {
            $I->switchToIFrame($this->locator->locator_iframe);
        } else {
            $I->switchToIFrame();
        }
    }
}

class PerehodClass {
    public $waiting_time = 30;
    public $object, $locator = '';

    public function __construct() {
        $this->object = new MethodClass;
        $this->locator = new LocatorClass;
    }
    public function project($I, $nameProject, $nameObject) {
        $this->object->click_element($I, $this->locator->locator_project);

        $this->object->mouse_over_element($I, '//ul[@class="dropdown-menu show"]//a[text()="'.$nameProject.'"]');

        $this->object->mouse_over_element($I, '//ul[@class="dropdown-menu "]//a[text()="'.$nameObject.'"]');
        $this->object->click_element($I, '//ul[@class="dropdown-menu "]//a[text()="'.$nameObject.'"]');

        $I->waitForElementVisible('//div[@class="compound_page_header"]//div[text()="'.$nameObject.'"]', $this->waiting_time);
    }

    public function module_selection($I, $module) {
        $locator_left = '//div[@class="compound_page_left"]';
        $locator_module = '//a[@data-tab="'.$module.'"]';

        $this->object->click_element($I, $locator_left.$locator_module);
    }

    public function open_object_and_module($I, $id_object, $name_module) {
        $I->amOnPage('?object_id='.$id_object.'&_ac=1#'.$name_module);
    }
}
?>