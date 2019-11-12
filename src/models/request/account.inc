<?php

class Account {
    var $name;
    var $firstName;
    var $lastName;
    var $email;
    var $passwd;
    var $trialDays;
    var $addons;

    function __construct($name, $firstName, $lastName, $email, $passwd, $trialDays = 7) {
        $this->name = $name;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->passwd = $passwd;
        $this->trialDays = $trialDays;
        $this->addons=array();
    }

    public function addWebsiteAddon() {
        $objWebsiteAddon = new Addons("eWebsiteAddon", true);
        array_push($this->addons, $objWebsiteAddon);
    }

    public function removeWebsiteAddon() {
        if (count($this->addons) > 0) {
            $index = 0;

            foreach ($this->addons as $item) {
                if ($item->name == "eWebsiteAddon") {
                    break;
                }

                $index++;
            }

            unset($this->addons[$index]);
        }
        else {
            echo "Else";
        }
    }
}

?>