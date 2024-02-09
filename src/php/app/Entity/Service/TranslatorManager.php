<?php

namespace IWA_FormBuilder\Entity\Service;

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorManager
{
    protected static string $locale;
    protected static Translator $translator;

    public static function init(string $locale): void
    {
        static::$locale = $locale;
        $translator     = new Translator($locale);

        $translator->setFallbackLocales(['en_US']);

        $translator->addLoader('php', new PhpFileLoader());

        $path = \IWA_FormBuilder\App::getRootPath() . '/src/php/translations/';

        $translator->addResource('php', $path . 'messages.ru.php', 'ru_RU');
        $translator->addResource('php', $path . 'messages.en.php', 'en_US');

        static::$translator = $translator;
    }

    public static function trans(?string $id, array $parameters = [], string $domain = null, string $locale = null): string
    {
        return static::$translator->trans($id, $parameters, $domain, $locale);
    }

    public static function getTranslator(): Translator
    {
        return static::$translator;
    }
}
