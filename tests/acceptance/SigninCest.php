<?php
include_once 'method.php';
include_once 'page.php';
include_once 'page_directory.php';

class SigninCest {

    public $waiting_time = 30;
    public $object, $locator, $perehod, $locator_directory = '';
    public $login = 'chingaev';
    public $password = 'aschingaev1994';

    public function __construct() {
        $this->object = new MethodClass;
        $this->locator = new LocatorClass;
        $this->perehod = new PerehodClass;
        $this->locator_directory = new LocatorDirectoryClass;
    }

    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/login');
        $I->fillField($this->locator->locator_login, $this->login);
        $I->fillField($this->locator->locator_password, $this->password);
        $this->object->click_element($I, $this->locator->locator_submit);
    }
    // tests
    public function tryToTest(AcceptanceTester $I) {
        //created by Anton Chingaev

        $locator_dict = $this->locator_directory->locator_directory_types_of_messages_do;
        $name_data = date('Y-m-d H:i:s');

        $I->amOnPage('?lib='.$locator_dict['имя_справочника'].'&_ac=1');
        $I->waitForElementVisible($locator_dict['заголовок_справочника'], $this->waiting_time);

        $this->object->click_element($I, $this->locator_directory->close_notifi);
        $this->object->click_element($I, $locator_dict['кнопка_добавить_раздел']);

        $this->object->switchIFrame($I, True);
        $I->fillField('//textarea[@name="formData[title]"]', $name_data);
        $this->object->switchIFrame($I, False);

        $this->object->click_element($I, $locator_dict['кнопка_сохранить']);

        $data_id = $I->grabAttributeFrom('//a[text()="'.$name_data.'"]//..//..', 'data-id');
        $I->waitForElementVisible('//div[@data-id="'.$data_id.'"]', $this->waiting_time);

        $this->object->click_element($I, '//div[@data-id="'.$data_id.'"]//a[@title="Действия"]');
        $this->object->click_element($I, '//ul[@data-id="'.$data_id.'"]//a[@title="Удалить"]');

        $I->wait(1);
        $I->seeInPopup('Будут удалены так же дочерние элементы, удалить?');
        $I->acceptPopup();
        $I->wait(1);
        $I->waitForElementNotVisible('//div[@data-id="'.$data_id.'"]', $this->waiting_time);
    }
}