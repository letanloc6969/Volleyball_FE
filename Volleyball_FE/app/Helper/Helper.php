<?php

function getConfigValueFromSettingTable($configkey)
{
    $settings = \App\Setting::where('config_key' , $configkey)->first();
    if (!empty($settings))
    {
        return $settings->config_value;
    }
    return null;
}
