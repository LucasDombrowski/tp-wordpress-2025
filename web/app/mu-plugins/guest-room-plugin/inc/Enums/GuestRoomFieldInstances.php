<?php

/**
 * The GuestRoomFieldInstances enum class provides a list of field instances used throughout the Guest Room Plugin.
 */

namespace GuestRoomPlugin\Enums;

enum GuestRoomFieldInstances{
    case BEDS_COUNT;
    case PRICE;

    /**
     * Returns the label of the field instance.
     */
    public function label(){
        return match($this){
            self::BEDS_COUNT => __('Beds Count', GuestRoomTexts::TEXT_DOMAIN->value),
            self::PRICE => __('Price (€)', GuestRoomTexts::TEXT_DOMAIN->value),
            default => null
        };
    }

    /**
     * Returns the key of the field instance.
     */
    public function key(){
        $key = match($this){
            self::BEDS_COUNT => 'beds_count',
            self::PRICE => 'price',
            default => null
        };
        return $key ? GuestRoomTexts::PREFIX->value . $key : null;
    }

    /**
     * Returns if the field instance is required.
     */
    public function is_required(){
        return match($this){
            self::BEDS_COUNT, self::PRICE => true,
            default => false
        };
    }

    /**
     * Returns the placeholder of the field instance.
     */
    public function placeholder(){
        return match($this){
            self::BEDS_COUNT => __('Enter the number of beds', GuestRoomTexts::TEXT_DOMAIN->value),
            self::PRICE => __('Enter the price', GuestRoomTexts::TEXT_DOMAIN->value),
            default => null
        };
    }

    /**
     * Returns the ACF Codifier class of the field instance.
     */
     public function acf_codifier_class(){
        return match($this){
            self::BEDS_COUNT, self::PRICE => new \Geniem\ACF\Field\Number($this->label(), $this->key(), $this->key()),
            default => null
        };
    }

    /**
     * Returns the ACF Codifier instance of the field instance.
     */
    public function acf_codifier_instance(){
        $acf_codifier_class = $this->acf_codifier_class();
        if(!$acf_codifier_class){
            return null;
        }
        $acf_codifier_class->set_required($this->is_required());
        $acf_codifier_class->set_placeholder($this->placeholder());
        switch($this){
            case self::BEDS_COUNT || self::PRICE:
                $acf_codifier_class->set_min(1);
                break;
        }
        return $acf_codifier_class;
    }
}