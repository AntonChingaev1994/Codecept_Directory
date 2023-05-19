<?php

class LocatorDirectoryClass {

    public $close_notifi = '//div[@class="notification-center-title"]//i[@class="fas fa-times"]';

    public $locator_directory_types_of_messages_do = array(
        'имя_справочника' => 'exchange_messages_types',
        'заголовок_справочника' => '//div[@class="tree_list_header"]//div[text()=" Типы сообщений ДО"]',
        'кнопка_добавить_раздел' => '//a[@title="Добавить раздел"]',
        'кнопка_сохранить' => '//a[@class="btn btn-primary btn-iframe-save-override"]'
    );
}

?>