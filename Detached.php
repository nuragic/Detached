<?php

include_once('lib/simple_html_dom.php');

class Detached {

    private $_html;

    public $data = array();


    public function __construct($dude) {
        try {
            $this->_html = file_get_html("http://www.linkedin.com/in/$dude");
            ini_set('user_agent', 'Detached/0.1');
        } catch (Exception $e) {
            throw new Exception("Error loading the current URL.");
        }
    }

    public function getExperience() {

        $exp_wrapper = $this->_html->find('div#profile-experience', 0);

        foreach($exp_wrapper->find('div.position') as $position) {

            $item['position']           = trim($position->find('div.postitle h3 .title', 0)->plaintext);
            $item['company']            = trim($position->find('div.postitle h4 .summary', 0)->plaintext);
            $item['period']['start']    = trim($position->find('p.period .dtstart', 0)->plaintext);
            $item['period']['end']      = trim($position->find('p.period .dtstamp', 0)->plaintext);
            $item['period']['duration'] = trim($position->find('p.period .duration', 0)->plaintext);
            $item['period']['location'] = trim($position->find('p.period .location', 0)->plaintext);
            $item['description']        = trim($position->find('p.description', 0)->plaintext);

            $experience[] = $item;
        }

        $this->data['experience'] = $experience;

        return $this->data['experience'];
    }

    public function getLanguages() {

        $exp_wrapper = $this->_html->find('div#profile-languages', 0);

        foreach($exp_wrapper->find('li.language ') as $language) {

            $item['language']    = trim($language->find('h3', 0)->plaintext);
            $item['proficiency'] = trim($language->find('.proficiency', 0)->plaintext);

            $languages[] = $item;
        }

        $this->data['languages'] = $languages;

        return $this->data['languages'] = $languages;
    }

     public function getAll() {

        $this->getExperience();
        $this->getLanguages();

        return $this->data;
    }

    public function cleanUp() {
        $this->_html->clear();
        unset($this->_html);
    }

}
