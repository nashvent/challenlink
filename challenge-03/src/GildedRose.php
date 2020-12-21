<?php

namespace App;


class GildedRose
{
    public $name;

    public $quality;

    public $sellIn;

    public $rules;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn) {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        // Legendary
        if($this->name == "Sulfuras, Hand of Ragnaros"){
            return;
        }

        // Update SellIn for all
        $currentSellIn = $this->sellIn;
        $this->updateSellIn();

        // Initial Value -> change by default
        $qualityVariant = 0;
        switch($this->name){
            case "Aged Brie":
                $qualityVariant = ($currentSellIn > 0) ? 1 : 2;
                break;
                
            case "Backstage passes to a TAFKAL80ETC concert":
                switch(1){
                    case ($currentSellIn <= 0):
                        $qualityVariant = 0;
                        break;
                    case ( 10 >= $currentSellIn && $currentSellIn > 5 ) :
                        $qualityVariant = 2;
                        break;
                    case ( 5 >= $currentSellIn && $currentSellIn >= 0) : 
                        $qualityVariant = 3;
                        break;
                    default:
                        $qualityVariant = 1;    
                }
                break;

            case "Conjured Mana Cake":
                $qualityVariant = ($currentSellIn > 0)? -2 : -4;
                break;

            default: 
                $qualityVariant = ($currentSellIn > 0) ? -1 : -2;
        }
        $this->updateQuality($qualityVariant);    
    }

    public function updateQuality($val){
        // Update quality but not saving it
        $tempQuality = $this->quality + $val;

        // switch for dinamic conditionals
        switch(1){
            // Force quality zero
            case $val == 0 || $tempQuality<0:
                $this->quality = 0;
                break;
            // Check variations of quality
            case $tempQuality > 0 && $tempQuality <= 50:
                $this->quality = $tempQuality;
                break;

            // Force max value of quality
            case $tempQuality>50:
                $this->quality = 50;
                break;
        }
    }

    public function updateSellIn(){
        $this->sellIn -= 1;
    }
}
